<?php 
$panel=array();
$panel['currentdb'] = "client";
$panel['showbranches'] = TRUE; 

//If a search was submitted, go to the page first the first individual in the results

//
// Start Quick Result
//

$ngDo ="";

if (isset($_GET['mquery'])){

	$hits = 0;
	$searchq = strip_tags($_GET['mquery']);
	$hitmid = array();
	if(strlen($searchq)>1){
	$getRecord_sql	=	'SELECT * FROM member WHERE first_name LIKE "'.$searchq.'%"';
	$getRecord		=	mysql_query($getRecord_sql);
	while ($row = mysql_fetch_array($getRecord)) {
	if($row['mClient'] == 1) {
	$hits++;
	$hitmid[$hits] = $row['mid'];
	}
	}
	
	$getRecord_sql	=	'SELECT * FROM member WHERE last_name LIKE "'.$searchq.'%"';
	$getRecord		=	mysql_query($getRecord_sql);
	while ($row = mysql_fetch_array($getRecord)) {
	if($row['mClient'] == 1) {
	$hits++;
	$hitmid[$hits] = $row['mid'];
	}
	}
	}
	if (($hits >= 1) && (strlen($hitmid[1]) > 1)) 
	$ngDo= "search";
}
//
// End Quick Result
//

if (!(isset($_GET['do']))){
$getDo="unset";
} else {
$getDo =$_GET['do'];
}
if ($getDo == "routesheet"){
  include '../include/client/routesheet.php';
} elseif ($getDo == "printlabels"){
include '../include/client/printlabel.php';
} elseif ($getDo == "kitchencount"){
include '../include/client/kitchencount.php';
} elseif ($getDo == "binder"){
include '../include/client/binderpdf.php';
} elseif ($ngDo == "search") {
	//Redirect to result
	echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=client.php?do=show&mid=" . $hitmid[1] . "\">";

} else {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/panel.js"></script>
<?php
if (($getDo == "unset")||($getDo == "show")){

$panel['showbranches'] = FALSE; 
//$panel['bstyle'] = "light"; 

?><script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="editor/editor.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
<link type="text/css" rel="stylesheet" href="editor/editor.css" />
<link type="text/css" rel="stylesheet" href="clib/ajax.css" /><?php if(isset($_GET['spec'])){
	if($_GET['spec'] == "dlvr"){ 
?><script type="text/javascript" src="clib/ajaxsimple.js"></script>
<script type="text/javascript">
function updateMonth(colNo){
if(document.getElementById('chk' + colNo).checked == 0) {
   for(i = 1;     i < 8; i++) {
	if (document.getElementById('d' + i + colNo))
    document.getElementById('d' + i + colNo).className = "non";
   }
	document.getElementById('c' + colNo).style.background = '#ddd';
	document.getElementById('d0' + colNo).style.background = '#AAA';
} else {
	for(i = 1;     i < 8; i++) {
	if (document.getElementById('d' + i + colNo))
    document.getElementById('d' + i + colNo).className = "meal";
	}
    document.getElementById('c' + colNo).style.background = '#87C313';
	document.getElementById('d0' + colNo).style.background = '#507F08';
}
}
function addMeal(colNo,cellID,thisDate) {
	if(document.getElementById(colNo).checked == 1) {
		if(document.getElementById(cellID).className == 'nomeal') {
		thsType="add";
		thshide = "thsUnmeal";
		thshide2 = "thsDemeal";
		thsshow = "thsMeal";
		}else{
		thsType="susp";
		thshide = "thsMeal";
		thshide2 = "thsUnmeal";
		thsshow = "thsDemeal";
		}
	} else {
		if(document.getElementById(cellID).className == 'meal') {
		thsType="rem";
		thshide = "thsMeal";
		thshide2 = "thsDemeal";
		thsshow = "thsUnmeal";
		}else{
		thsType="add";
		thshide = "thsUnmeal";
		thshide2 = "thsDemeal";
		thsshow = "thsMeal";
		}
	}
	document.getElementById('changeType').value = thsType;
	document.getElementById('thsMonth').style.display = "none";
	document.getElementById('thsDate').innerHTML = thisDate + ",&nbsp;";
	document.getElementById('mDay').value = thisDate;
	document.getElementById('thsDay').style.display = "block";
	document.getElementById(thshide).style.display = "none";
	document.getElementById(thshide2).style.display = "none";
	document.getElementById(thsshow).style.display = "block";
}
function editMeal(colNo,cellID,thisDate) {
//getdata('clib/month.php','');
}
function suspMeal() {
document.getElementById('spcMeal').innerHTML = "A special meal will be added in it's place:<br /><br />";
document.getElementById('thsMeal').style.display = "block";
document.getElementById('changeType').value = "add";
	}

function cancelChange() {
document.getElementById('mDay').value = 0;
document.getElementById('thsMonth').style.display = "block";
document.getElementById('spcMeal').innerHTML = '<input type="button" value="Special Order" onClick="suspMeal()" style="margin:12px 0 0 40px;"/>';
document.getElementById('thsDay').style.display = "none";
document.getElementById('changeType').value = "";
hideEdit();
return false;
}
var noSides = 1;
function addSide(){
	noSides++;
	rmvVar = "rmvRow('" + noSides + "')";
	rmvVar = '"' + rmvVar + '"';
	toAdd = '<div class="num"><select name="nosd' + noSides + '">';
	toAdd += "><option selected='selected'>1</option><option>2</option><option>3</option><option>4</option></select></div><div><select name=";
	toAdd += '"slct' + noSides + '" id="slct' + noSides + '" onChange="';
	toAdd += "changeSide('" + noSides + "')";
	toAdd += '"';
	toAdd += "class='in8'><option value='sd'>side dish</option><option";
	if (document.getElementById('adSide').selectedIndex == 2)
	toAdd += ' selected="selected"';
	toAdd += " value='gz'>newspaper</option><option";
	if (document.getElementById('adSide').selectedIndex == 3)
	toAdd += ' selected="selected"';
	toAdd += " value='vb'>garden basket</option></select></div><div class='mid'><select class='in6' id=";
	toAdd += '"dsh' + noSides + '" name="dsh' + noSides + '"';
	if (document.getElementById('adSide').selectedIndex != 1)
	toAdd += ' style="display:none">';
    toAdd += "><option value='ds'>dessert</option><option value='dd'>diabetic dessert</option><option value='fs'>fruit salad</option><option value='gs'>green salad</option><option value='pd'>pudding</option></select>&nbsp;</div><div class='mid'><input type='button' value='remove' onClick=" + rmvVar + " />";
	toAdd += "<input type='hidden' name='";
	toAdd += "skip" + noSides + "'" + " id='skip";
	toAdd += noSides + '" value=""></div>';
	document.getElementById('sd' + noSides).innerHTML += toAdd;
	document.getElementById('adSide').selectedIndex = 0;
}

function changeSide(cside){
	if (document.getElementById('slct' + cside).selectedIndex == 0){
	document.getElementById('dsh' + cside).style.display = "inline";
	} else {
	document.getElementById('dsh' + cside).style.display = "none";
	}
}
function isMeal(){
	if (document.getElementById('ismeal').selectedIndex == 0){
	document.getElementById('msize').style.display = "inline";
	} else {
	document.getElementById('msize').style.display = "none";
	}
}
function rmvRow(toHide){
	document.getElementById('sd' + toHide).style.display = "none";
	document.getElementById('skip' + toHide).value = "skip";
	}
	function editStatus() {
document.getElementById('bStat').style.display = "none";
document.getElementById('sStat').style.display = "inline";
	}
		function editDType() {
document.getElementById('bDType').style.display = "none";
document.getElementById('sDType').style.display = "inline";
	}
</script>
<?php
	} elseif($_GET['spec'] == "meal") {
?><script type="text/javascript">
function addText(toWhat, toAdd, byWho) {
	tArea = document.getElementById(toWhat);
    if(document.getElementById(byWho).checked == true) {
	if (tArea.value.length < 1)
	tArea.value = tArea.value + toAdd;
	else
	tArea.value = tArea.value + " / " + toAdd;
    }
}
</script><?php
	} elseif($_GET['spec'] == "refer") {
		?><script type="text/javascript">
function billSlct() {
	document.getElementById('bdivblu').style.display = 'none';  
	document.getElementById('bdivoth').style.display = 'none';  
	document.getElementById('bdivcur').style.display = 'none';  
  if (document.getElementById('bdiv' + document.getElementById('billTo').value))
	document.getElementById('bdiv' + document.getElementById('billTo').value).style.display = 'block';  
}
</script>
<?php
	} elseif($_GET['spec'] == "route") {
		?><script type="text/javascript">
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
	function editDirect() {
document.getElementById('oldDirect').style.display = "none";
document.getElementById('nDirect').style.display = "inline";
document.getElementById('bDirect').style.display = "none";
document.getElementById('sDirect').style.display = "inline";
	}
        function showRoute() {
document.getElementById('oldRoute').style.display = "none";
document.getElementById('nRoute').style.display = "block";
        }

</script><?php
	}	elseif($_GET['spec'] == "relate"){
?><script type="text/javascript" src="clib/cwid.js"></script>
<script type="text/javascript">
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
</script><?php
 }
  }
} elseif (($getDo == "create") ||($getDo == "modify")){ ?><link type="text/css" rel="stylesheet" href="theme/default/alr3.css" /><?php
} elseif ($getDo == "cnew"){
?><link type="text/css" rel="stylesheet" href="theme/default/p2.css" />
<script type="text/javascript">
function en_lang(){
if (document.all || document.getElementById){
if (document.mowcreate.lang.value == "other"){
document.mowcreate.lang2.disabled=false;
document.mowcreate.lang2.focus();
} else {
document.mowcreate.lang2.disabled=true;
}
}
return true;
}

function cinNext(fshow){	
fxshow = fshow + 1;
	document.getElementById('cin'+ fshow).style.display = 'none';
	document.getElementById('cin'+ fxshow).style.display = 'block';
        document.getElementById('stg'+ fshow).style.color = '#CCCCCC';
        document.getElementById('stg'+ fxshow).style.color = '#000000';
}

function cinPrev(fshow){
fxshow = fshow - 1;
        document.getElementById('cin'+ fshow).style.display = 'none';
        document.getElementById('cin'+ fxshow).style.display = 'block';
        document.getElementById('stg'+ fshow).style.color = '#CCCCCC';
        document.getElementById('stg'+ fxshow).style.color = '#000000';
}
function billShow() {
        document.getElementById('bdivself').style.display = "none";
        document.getElementById('bdivcur').style.display = 'none';
        document.getElementById('bdivoth').style.display = 'none';
        document.getElementById('bdivrel').style.display = 'none';
varChange = "bdiv" + document.mowcreate.billto.value;
        document.getElementById(varChange).style.display = 'block';
        document.mowcreate.nobx.value = document.mowcreate.lastName.value.toUpperCase() + ' ' + document.mowcreate.firstName.value.toUpperCase() ; 
return false;
}

function orgDiv(divNo) {
  eval('slctDiv = document.mowcreate.relateSl' + divNo +  ';');
  if (slctDiv.selectedIndex < 5) {
        document.getElementById('relOdiv' + divNo).style.display = 'block';
        document.getElementById('relOfdiv' + divNo).style.display = 'block';
	document.getElementById('relHphone' + divNo).style.display = 'none';
        document.getElementById('relHfphone' + divNo).style.display = 'none';
  } else {
        document.getElementById('relOdiv' + divNo).style.display = 'none';
        document.getElementById('relOfdiv' + divNo).style.display = 'none';
        document.getElementById('relHphone' + divNo).style.display = 'block';
        document.getElementById('relHfphone' + divNo).style.display = 'block';
  }
}

function relSummary(InputNo) {
 if(InputNo == "1") {
 document.getElementById('rel_sumparent').style.display = 'block';
 }
 document.getElementById('rel_sum'+ InputNo).style.display = 'block';
 document.getElementById('relform'+ InputNo).style.display = 'none';
eval('document.mowcreate.sumshowR' + InputNo  +  '.value = document.mowcreate.relateSl' + InputNo  + '.value;');
eval('document.mowcreate.sumshowN' + InputNo  +  '.value = document.mowcreate.relFname' + InputNo  + '.value + \' \' + document.mowcreate.relLname' + InputNo  + '.value;');
eval('document.mowcreate.sumshowO' + InputNo  +  '.value = document.mowcreate.relOrg' + InputNo  + '.value;');
}

function relsReopen(editNo) {
relSummary(editNo)
document.getElementById('relform1').style.display = 'none';
document.getElementById('relform2').style.display = 'none';
document.getElementById('relform3').style.display = 'none';
document.getElementById('relform'+ editNo).style.display = 'block';
}

function Select_Value_Set(SelectName, rNo, Value) {
  eval('relNo = ' + rNo + ';');
  eval('SelectObject = document.mowcreate.' + SelectName + (relNo + 1) +  ';');
  for(index = 0; 
    index < SelectObject.length; 
    index++) {
  if(SelectObject[index].value == Value){
     SelectObject.selectedIndex = index;
   }
   document.mowcreate.nwrelate.selectedIndex = 0;
   }
 orgDiv(relNo + 1);
 relSummary(relNo);
 if(relNo == "2") {
 document.getElementById('nwrelateparent').style.display = 'none';
 }
 relNo++;
 document.mowcreate.nrelate.value = relNo;
 if (relNo != "4")
 document.getElementById('relform' + relNo).style.display = 'block';
}
</script><?php
} else {
?><script type="text/javascript" src="js/cdefault.js"></script>
<script type="text/javascript" src="clib/ncwid.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" /><?php 
}
?></head>
<body bgcolor="#FFFFFF">
<?php
include "../include/general/gtop.php"; 

if ($getDo == "unset"){
include '../include/client/cstart1.php';
} elseif ($getDo == "show") {
  $panel['bstyle'] == "light";
  include '../include/client/cshow1.php';
} elseif ($getDo == "new") {
include '../include/client/cstartnwentry1.php';
} elseif ($getDo == "cnew") {
include '../include/client/cnewentry1.php';
}
}
?>
