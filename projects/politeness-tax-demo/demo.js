/* Politeness Tax interactive demo.
   Loads the study's actual extractor code (extractors.py, same folder) into
   Pyodide and runs it in the visitor's browser. No server, no API calls. */
(function () {
    "use strict";

    var REGISTER_NAME = {
        agentic_terse: "Terse",
        agentic_casual: "Casual",
        webchat_detailed: "Detailed (polite)",
        webchat_multilingual: "Multilingual"
    };
    var CONDITIONS = ["agentic_terse", "agentic_casual", "webchat_detailed", "webchat_multilingual"];

    var GLUE = [
        "import json",
        "",
        "def _check_extraction(code, entry):",
        "    if code is None:",
        "        return {\"code\": None, \"compiles\": False,",
        "                \"error\": \"The extractor returned nothing at all.\"}",
        "    err = None",
        "    try:",
        "        compile(code, \"<extract>\", \"exec\")",
        "    except SyntaxError as e:",
        "        err = \"%s: %s\" % (e.__class__.__name__, e)",
        "    return {\"code\": code, \"compiles\": bool(extraction_compiles(code, entry)), \"error\": err}",
        "",
        "def run_extractors(completion, entry):",
        "    return json.dumps({",
        "        \"naive\": _check_extraction(extract_naive(completion, entry), entry),",
        "        \"sieve\": _check_extraction(extract_sieve(completion, entry), entry),",
        "    })",
        ""
    ].join("\n");

    var state = {
        data: null,
        extractorsSource: null,
        pyodide: null,
        pyReady: false,
        pyFailed: false
    };

    function el(id) { return document.getElementById(id); }

    function setStatus(msg) {
        var s = el("py-status");
        if (s) { s.textContent = msg; }
    }

    function currentRecord() {
        var model = el("sel-model").value;
        var cond = el("sel-register").value;
        var task = el("sel-problem").value;
        for (var i = 0; i < state.data.completions.length; i++) {
            var c = state.data.completions[i];
            if (c.model === model && c.condition === cond && c.task_id === task) { return c; }
        }
        return null;
    }

    function fillProblems() {
        var sel = el("sel-problem");
        var seen = {};
        state.data.completions.forEach(function (c) {
            if (!seen[c.task_id]) {
                seen[c.task_id] = c;
                var opt = document.createElement("option");
                opt.value = c.task_id;
                opt.textContent = "LiveCodeBench " + c.task_id.replace("lcb/", "") +
                    " · " + c.entry_point + " · " + c.difficulty;
                sel.appendChild(opt);
            }
        });
    }

    function showRecord() {
        var c = currentRecord();
        if (!c) { return; }
        el("prompt-view").textContent = c.prompt_text;
        el("reply-view").textContent = c.completion;
        el("record-meta").textContent = c.model_name + " · " + REGISTER_NAME[c.condition] +
            " register · problem " + c.task_id + " · target: class Solution with method " + c.entry_point;
        clearResults("Press the button to run both extractors on this reply.");
    }

    function badge(ok, okText, badText) {
        return "<span class=\"badge " + (ok ? "badge-ok" : "badge-bad") + "\">" +
            (ok ? okText : badText) + "</span>";
    }

    function outcomeHtml(kind, res, c) {
        if (!res) { return ""; }
        if (kind === "naive") {
            if (!c.naive_compiles) {
                return "<p class=\"outcome outcome-bad\">Score under this ruler: <strong>wrong answer</strong>. " +
                    "The extraction did not compile, so the grader recorded a failure without running a single test.</p>";
            }
            return "<p class=\"outcome " + (c.naive_passed ? "outcome-ok" : "outcome-bad") + "\">" +
                "Score under this ruler: <strong>" + (c.naive_passed ? "pass" : "fail") + "</strong>. " +
                "The extraction compiled, and when the naive extraction compiles it is the same code the robust " +
                "extractor produces (true for 1,067 of 1,068 replies in the full study), so it inherits the study " +
                "outcome shown on the right.</p>";
        }
        return "<p class=\"outcome " + (c.sieve_passed ? "outcome-ok" : "outcome-bad") + "\">" +
            "Study outcome: <strong>" + (c.sieve_passed ? "PASS" : "FAIL") + "</strong>. " +
            "This is the grade the study recorded for this exact reply, with this extraction, against the problem's " +
            "full LiveCodeBench test suite.</p>";
    }

    function renderResult(targetId, title, res, c, kind) {
        var box = el(targetId);
        if (!res) {
            box.innerHTML = "<h3>" + title + "</h3><p class=\"muted\">No result yet.</p>";
            return;
        }
        var html = "<h3>" + title + "</h3>";
        html += "<p>" + badge(res.compiles, "Compiles and defines the target", "Does not compile / no target") + "</p>";
        if (res.error) {
            html += "<p class=\"error-line\">" + escapeHtml(res.error) + "</p>";
        } else if (!res.compiles && res.code) {
            html += "<p class=\"error-line\">It compiles as Python, but it does not define the target class or method, so the grader cannot run it.</p>";
        }
        html += "<pre class=\"code-view\">" + escapeHtml(res.code === null ? "(the extractor returned nothing)" : res.code) + "</pre>";
        if (c) { html += outcomeHtml(kind, res, c); }
        box.innerHTML = html;
    }

    function escapeHtml(s) {
        return s.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
    }

    function clearResults(msg) {
        el("result-naive").innerHTML = "<h3>Naive extractor</h3><p class=\"muted\">" + msg + "</p>";
        el("result-sieve").innerHTML = "<h3>Robust extractor (Sieve)</h3><p class=\"muted\">" + msg + "</p>";
    }

    function fallbackResults(c, note) {
        var naive = {
            code: null,
            compiles: c.naive_compiles,
            error: c.naive_compiles ? null : "Precomputed with the same code: this extraction does not compile."
        };
        var sieve = {
            code: null,
            compiles: c.sieve_compiles,
            error: null
        };
        renderResult("result-naive", "Naive extractor", naive, c, "naive");
        renderResult("result-sieve", "Robust extractor (Sieve)", sieve, c, "sieve");
        var n = el("run-note");
        if (n) { n.textContent = note; }
    }

    function runOnRecord() {
        var c = currentRecord();
        if (!c) { return; }
        if (state.pyFailed) {
            fallbackResults(c, "The Python runtime could not be loaded from its CDN, so the extracted code text is " +
                "unavailable. The compile results above were precomputed with the identical extractor code.");
            return;
        }
        if (!state.pyReady) {
            setStatus("The Python runtime is still loading. One moment.");
            return;
        }
        var btn = el("btn-run");
        btn.disabled = true;
        state.pyodide.globals.set("completion_text", c.completion);
        state.pyodide.globals.set("entry_name", c.entry_point);
        var out = state.pyodide.runPython("run_extractors(completion_text, entry_name)");
        var res = JSON.parse(out);
        renderResult("result-naive", "Naive extractor", res.naive, c, "naive");
        renderResult("result-sieve", "Robust extractor (Sieve)", res.sieve, c, "sieve");
        btn.disabled = false;
        var n = el("run-note");
        if (n) { n.textContent = "Ran just now, in your browser, with the study code shown below."; }
    }

    function runOwn() {
        var text = el("own-text").value;
        var entry = el("own-entry").value.trim() || "solve";
        if (!text.trim()) {
            el("own-note").textContent = "Paste a model reply first.";
            return;
        }
        if (state.pyFailed) {
            el("own-note").textContent = "The Python runtime could not be loaded, so the live run is unavailable.";
            return;
        }
        if (!state.pyReady) {
            el("own-note").textContent = "The Python runtime is still loading. One moment.";
            return;
        }
        state.pyodide.globals.set("completion_text", text);
        state.pyodide.globals.set("entry_name", entry);
        var out = state.pyodide.runPython("run_extractors(completion_text, entry_name)");
        var res = JSON.parse(out);
        renderResult("own-result-naive", "Naive extractor", res.naive, null, "naive");
        renderResult("own-result-sieve", "Robust extractor (Sieve)", res.sieve, null, "sieve");
        el("own-note").textContent = "Extraction and compile check only. Grading a reply needs the benchmark's " +
            "test suite for its problem, which is not part of this page.";
    }

    function initPyodide() {
        setStatus("Loading the Python runtime (Pyodide, about 10 MB, one time) so the study code can run in your browser.");
        var attempt = loadPyodide({ indexURL: "https://cdn.jsdelivr.net/pyodide/v0.26.4/full/" });
        attempt.catch(function () {
            setStatus("The first load attempt failed. Retrying once.");
            return loadPyodide({ indexURL: "https://cdn.jsdelivr.net/pyodide/v0.26.4/full/" });
        }).then(function (py) {
            state.pyodide = py;
            py.runPython(state.extractorsSource);
            py.runPython(GLUE);
            state.pyReady = true;
            setStatus("Python runtime ready. The extractors below are live.");
            el("btn-run").disabled = false;
            el("btn-own").disabled = false;
            runOnRecord();
        }).catch(function (err) {
            state.pyFailed = true;
            setStatus("The Python runtime could not be loaded from its CDN. You can still read every reply and " +
                "the study code; run results fall back to values precomputed with the identical code.");
            el("btn-run").disabled = false;
            el("btn-own").disabled = false;
        });
    }

    function init() {
        Promise.all([
            fetch("politeness-tax-demo/completions-subset.json").then(function (r) { return r.json(); }),
            fetch("politeness-tax-demo/extractors.py").then(function (r) { return r.text(); })
        ]).then(function (parts) {
            state.data = parts[0];
            state.extractorsSource = parts[1];
            el("extractor-code").textContent = state.extractorsSource;
            el("subset-note").textContent = "This page bundles " + state.data.meta.subset_size +
                " of the study's " + state.data.meta.full_size + " recorded replies: " +
                state.data.meta.subset_problems.length + " problems, each with all eight replies " +
                "(two models times four registers). " + state.data.meta.selection_rule;
            fillProblems();
            el("sel-model").value = "chatgpt";
            el("sel-register").value = "webchat_detailed";
            el("sel-problem").value = "lcb/3533";
            showRecord();
            ["sel-model", "sel-register", "sel-problem"].forEach(function (id) {
                el(id).addEventListener("change", showRecord);
            });
            el("btn-run").addEventListener("click", runOnRecord);
            el("btn-own").addEventListener("click", runOwn);
            initPyodide();
        }).catch(function (err) {
            setStatus("The demo data failed to load: " + err);
        });
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init();
    }
})();
