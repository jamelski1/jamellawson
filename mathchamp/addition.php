<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=yes'>

<title>Math Champ - Addition</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

<script>
$( document ).ready(function() {
  $("#checkOrNext").html("<button id='submitButton' onClick='checkAnswer()'>Check</button>");
});

$( document ).ready(function() {
  $("#answerField").html("<input id='inputBox' name='userAnswer' type='number' maxlength='3'/>");
});

var userGuess;
var topValue;
var bottomValue;
var answer;
var numCorrect = 0;
var numIncorrect = 0;

function checkAnswer(){
    getTopValue();
	getBottomValue();
	answer = parseInt((topValue + bottomValue), 10);
	
	userGuess = $("#inputBox").val();
	//Remove the Check Button
	$("#checkOrNext").empty();
	
	//Remove the Input Field
	$("#answerField").empty();
	
	//Add the Next Button
	$("#checkOrNext").html("<button id='submitButton' onClick='generateNewProblem()'>Next</button>");
	
	if (topValue+bottomValue == userGuess){
		numCorrect +=1;
		$("#numCorrect").empty();
		$("#numCorrect").html("Correct: " + numCorrect);
		
		$("#feedback").html("CORRECT");
		$("#feedback").css("color", "green");
		//Display the Answer
	$("#answerField").html("<div id='inputBox'>" + answer + "</div>");
	}else{
		numIncorrect +=1;
		$("#numIncorrect").empty();
		$("#numIncorrect").html("Incorrect: " + numIncorrect);
		$("#feedback").html("CORRECT <br/> ANSWER:");
		$("#feedback").css("color", "green");
		$("#answerField").html("<div id='inputBox'>" + userGuess + "</div>");
		$("#inputBox").css("text-decoration", "line-through");
		$("#inputBox").css("color", "red");
		$("#correctAnswer").html(answer);
	}
	
}

function generateNewProblem(){
	var topNumber = Math.floor(Math.random() * 100);
	var bottomNumber = Math.floor(Math.random() * 100);
	
	$("#topNumber").empty();
	$("#topNumber").html(topNumber);
	
	$("#bottomNumber").empty();
	$("#bottomNumber").html(bottomNumber);
	
	$("#answerField").empty();
	$("#answerField").html("<input id='inputBox' name='userAnswer' type='number' maxlength='3'/>");
	
	$("#feedback").empty();
	
	$("#correctAnswer").empty();
	
	$("#checkOrNext").empty();
	$("#checkOrNext").html("<button id='submitButton' onClick='checkAnswer()'>Check</button>");
}

function getTopValue(){
	topValue = parseInt(($("#topNumber").html()),10);
}

function getBottomValue(){
	bottomValue = parseInt(($("#bottomNumber").html()),10);
}

</script>
<style>
* {
    margin: 0;
	padding: 0;
}
body{
}

#wrapper{
	width:100%;
}

#content{
	margin-left:auto;
	margin-right:auto;
	width:320px;
}

h1{
	float:left;
}
h2{
	float:left;
	clear:left;
}

#problemSet {
	font-size: 96px;
	overflow:auto;
	clear:left;
}
#topNumber {
	float: right;
}
#sign {
	float: left;
	clear: right;
}
#bottomNumber {
	float: right;
}
#line {
	clear:both;
	float: right;
	height: 3px;
	width:100%;
}
#line hr {
	border: none;
	height: 3px;
	color: #333;
	background-color: #333;
}
#answer {
	float: right;
}
#answer #inputBox {
	margin-top: 10px;
	width: 150px;
	height: 120px;
	font-size: 96px;
	float: right;
}
#submitButton {
	clear: right;
	float: right;
	margin-top:5px;
	height:50px;
	width:150px;
	Font-Size:36px;
}

#contentForm{
	float:right;
}

#feedback{
	font-size:24px;
	float:right;
	margin-top:75px;
	margin-left:10px;
	margin-right:25px;
}

#correctAnswer{
	font-size:48px;
	margin-right:25px;
	margin-top:10px;
	float:right;
	color:green;
}

#numCorrect{
	font-size:18px;
}

#numIncorrect{
	font-size:18px;
}
</style>
</head>

<body>
<div id="wrapper">
<div id="content">
<?php
    $bodyStr = '';
    $topNumber = rand (0 ,100);
    $bottomNumber = rand (0 , 100);
    $answer;
    $sign = '+';
    $answer = $topNumber + $bottomNumber;
    
    $bodyStr .= '<h1>Math Champ</h1>
                <h2>Addition</h2>
    
                <div id="problemSet">
                <div id="topNumber">' . $topNumber . '</div>';
                
    $bodyStr .= '<div id="sign">' . $sign . '</div>';
    
    $bodyStr .= '<div id="bottomNumber">' . $bottomNumber . '</div>';
    $bodyStr .= '<div id="line"><hr/></div>';
    $bodyStr .= '<div id="contentForm">
                <div id="answer">
                <div id="answerField"></div>
                <div id="checkOrNext"></div>
                </div>
                </div><!--End of form-->
                <div id="feedback"></div>
                <div id="correctAnswer"></div>
                <div id="numCorrect">Correct: 0</div>
                <div id="numIncorrect">Incorrect: 0</div>
            </div>
            <!--End of problem set-->
            </div><!--End of wrapper-->';
    
    echo $bodyStr;
    
    
?>
    
    
</body>
</html>