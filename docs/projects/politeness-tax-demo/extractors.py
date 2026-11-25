# The two extractors from the Politeness Tax study, copied unmodified from
# the demonstration notebook (politeness-tax-demo.ipynb), which adapted them
# from the study pipeline. The demo page loads this exact file into Pyodide
# and runs it in the visitor's browser.
import re

def extract_naive(completion, entry):
    """The study's ORIGINAL extractor (the 'naive' ruler).
    Take the first fenced code block that names the target; if there is no usable
    fence, take the WHOLE reply with fence lines removed -- trailing prose and all.
    A reply that ends with an English explanation therefore hands the grader
    code + English, which is not valid Python."""
    if not completion:
        return None
    blocks = re.findall(r"```(?:python|py)?\s*\n(.*?)```", completion, re.DOTALL)
    for b in blocks:
        if "class Solution" in b or f"def {entry}" in b:
            return b
    if "class Solution" in completion or f"def {entry}" in completion:
        return "\n".join(l for l in completion.split("\n") if not l.strip().startswith("```"))
    return None


def _trim_to_compilable(code):
    """Drop trailing lines until the source compiles. Conversational replies put a
    prose paragraph AFTER the code; trimming removes exactly that tail and keeps
    the largest leading prefix that is valid Python. It can only ever REMOVE text,
    so it cannot make wrong code right -- the trimmed code must still pass the
    real tests on its own."""
    lines = code.split("\n")
    while lines:
        src = "\n".join(lines)
        try:
            compile(src, "<extract>", "exec")
            return src
        except SyntaxError:
            lines.pop()
    return None


def extract_sieve(completion, entry):
    """The study's ROBUST extractor ('Sieve').
    Build a few candidate slices of the reply (from the first code-like line to the
    end; all fenced blocks joined; a block naming the target; from the target's
    anchor onward), trim each to something that compiles, and return the first
    candidate that compiles AND still defines the target."""
    if not completion:
        return None
    text = "\n".join(l for l in completion.split("\n") if not l.strip().startswith("```"))
    blocks = re.findall(r"```(?:python|py)?\s*\n(.*?)```", completion, re.DOTALL)
    code_blocks = [b for b in blocks if re.search(r"(?m)^\s*(?:class|def|import|from|@)\s", b)]
    cands = []
    m = re.search(r"(?m)^(?:class|def|import|from|@)\s", text)
    if m:
        cands.append(text[m.start():])
    if code_blocks:
        cands.append("\n\n".join(code_blocks))
    for b in blocks:
        if "class Solution" in b or f"def {entry}" in b:
            cands.append(b)
    for anchor in ("class Solution", f"def {entry}"):
        i = text.find(anchor)
        if i != -1:
            cands.append(text[i:])
    for c in cands:
        t = _trim_to_compilable(c)
        if t and ("class Solution" in t or f"def {entry}" in t):
            return t
    return cands[0] if cands else None


def extraction_compiles(code, entry):
    """Would the grader even be able to RUN this extraction?
    True only if it compiles and still defines the target class/method."""
    if not code:
        return False
    try:
        compile(code, "<extract>", "exec")
    except SyntaxError:
        return False
    return "class Solution" in code or f"def {entry}" in code
