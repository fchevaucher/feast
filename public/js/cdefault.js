
function fHide(chitem,hide){
if(hide == "hide"){
 document.getElementById(chitem).style.display = 'none';
} else {
document.getElementById(chitem).style.display = 'block';
}
}
function enableSub(pass1,pass2) {
fHide(pass1,pass2);
document.getElementById('subB').disabled=false;
}
function dropdnChk(dropDn,goodVal,toEnable) {
select = document.getElementById(dropDn);
if (select.value == goodVal) {
document.getElementById(toEnable).style.display = 'block';
} else {
document.getElementById(toEnable).style.display = 'none';
}
}

function wrapText(el, openTag, closeTag) {
	if (el.setSelectionRange) {
 		// W3C/Mozilla
 		el.value = el.value.substring(0,el.selectionStart) + openTag + 
el.value.substring(el.selectionStart,el.selectionEnd) + closeTag + el.value.substring(el.selectionEnd,el.value.length);
 	}
 	else if (document.selection && document.selection.createRange) {
 		// IE code goes here
		el.focus(); //or else text is added to the activating control
		var range = document.selection.createRange();
		range.text = openTag + range.text + closeTag;
 	}
}

function addText(toWhat, toAdd, byWho) {
	tArea = document.getElementById(toWhat);
    if(document.getElementById(byWho).checked == true) {
	if (tArea.value.length < 1)
	tArea.value = tArea.value + toAdd;
	else
	tArea.value = tArea.value + " / " + toAdd;
    }
}
function switchBx(current,toswitch){
	nameBxThen = "or_name" + current;
	nameBxNow = "or_name" + toswitch;
        midBxThen = "or_mid" + current;
        midBxNow = "or_mid" + toswitch;
	addBxThen = "or_add" + current;
	addBxNow = "or_add" + toswitch;
	add2BxThen = "or_addb" + current;
	add2BxNow = "or_addb" + toswitch;
        oldValName = document.getElementById(nameBxThen).value;
	oldValMid = document.getElementById(midBxThen).value;
	oldValAdd = document.getElementById(addBxThen).value;
	oldValAdd2 = document.getElementById(add2BxThen).value;
	document.getElementById(nameBxThen).value = document.getElementById(nameBxNow).value;
        document.getElementById(midBxThen).value = document.getElementById(midBxNow).value;
 	document.getElementById(addBxThen).value =  document.getElementById(addBxNow).value;
	document.getElementById(add2BxThen).value =  document.getElementById(add2BxNow).value;
        document.getElementById(nameBxNow).value = oldValName;
	document.getElementById(midBxNow).value = oldValMid;
	document.getElementById(addBxNow).value =  oldValAdd;
	document.getElementById(add2BxNow).value =  oldValAdd2;
}
function relDiv() {
  if (document.getElementById('slctRel').selectedIndex < 5) {
        document.getElementById('relOdiv').style.display = 'block';
        document.getElementById('relOfdiv').style.display = 'block';
        document.getElementById('relHphone').style.display = 'none';
        document.getElementById('relHfphone').style.display = 'none';
  } else {
	document.getElementById('relOdiv').style.display = 'none';
        document.getElementById('relOfdiv').style.display = 'none';
        document.getElementById('relHphone').style.display = 'block';
        document.getElementById('relHfphone').style.display = 'block';
  }
}
function billSlct() {
	document.getElementById('bdivblu').style.display = 'none';  
	document.getElementById('bdivoth').style.display = 'none';  
	document.getElementById('bdivcur').style.display = 'none';  
  if (document.getElementById('bdiv' + document.getElementById('billTo').value))
	document.getElementById('bdiv' + document.getElementById('billTo').value).style.display = 'block';  
}


