var charIndex = -1;
var stringLength = 0;
var inputText;
function writeContent(init){
	if(init){
		inputText = document.getElementById('contentToWrite').innerHTML;
	}
	if(charIndex==-1){
		charIndex = 0;
		stringLength = inputText.length;
	}
	var initString = document.getElementById('myContent').innerHTML;
	initString = initString.replace(/<SPAN.*$/gi,"");

	var theChar = inputText.charAt(charIndex);
	var nextFourChars = inputText.substr(charIndex,4);
	//alert(nextFourChars)
	if(nextFourChars=='<BR>' || nextFourChars=='<br>'){
		theChar  = '<BR>';
		charIndex+=3;


	}
    if(nextFourChars=='<nb>' || nextFourChars=='<nb>'){
        theChar  = "&nbsp;&nbsp;";
        charIndex+=3;
    }
    var nextFourChars1 = inputText.substr(charIndex,5);
    if(nextFourChars1=='</nb>'){
        theChar  = "";
        charIndex+=4;
    }
	initString = initString + theChar + "<SPAN id='blink'>_</SPAN>";
	document.getElementById('myContent').innerHTML = initString;

	charIndex = charIndex/1 +1;
	if(charIndex%2==1){
		document.getElementById('blink').style.display='none';
	}else{
		document.getElementById('blink').style.display='inline';
	}

	if(charIndex<=stringLength){
		setTimeout('writeContent(true)',100);
	}else{
		blinkSpan();
	}  
}

var currentStyle = 'inline';
function blinkSpan(){
	if(currentStyle=='inline'){
		currentStyle='none';
	}else{
		currentStyle='inline';
	}
	document.getElementById('blink').style.display = currentStyle;
	setTimeout('blinkSpan()',10);
}
