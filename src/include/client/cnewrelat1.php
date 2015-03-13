<?php

$panel=array();
$panel['currentdb'] = "client";
$panel['showbranches'] = TRUE; 

 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/panel.js"></script>
<script type="text/javascript">
function fHide(chitem,hide){
if(hide == "hide"){
 document.getElementById(chitem).style.display = 'none';
} else {
document.getElementById(chitem).style.display = 'block';
}
}

function dropdnChk(dropDn,goodVal,toEnable) {
select = document.getElementById(dropDn);
if (select.value == goodVal) {
document.getElementById(toEnable).style.display = 'block';
} else {
document.getElementById(toEnable).style.display = 'none';
}
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
</script><script type="text/javascript" src="clib/ncwid.js"></script>
<link type="text/css" rel="stylesheet" href="c1.css" /></head>
<body bgcolor="#FFFFFF"><?php
	include "../include/general/gtop.php";
 ?><div id="ut"><div id="us"><ul><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="bio.php"><span class="h6"> <br></span>adv. search</a></li><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
class="pg"><span class="h6"> <br></span>clients</a></li><li 
class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="?do=new"><span class="h6"> <br></span>create new</a></li><li class="sp"><b><span> <br></span> </b></li><li class="df"><a
href="?go=search"><span class="h6"> <br></span>search</a></li></ul></div></div></div><?php

//keep passing along our member's ID number
$pass_mid = $_GET['mid'];

//setup database entry info
include '/var/www/feastdb/include/config/mysql_login.php';
mysql_connect("localhost", $mysqluser, $mysqlpass);
mysql_select_db("mowdata");

//prepare certain variables
 	$cwID = $_GET['rid'];
		$query = "INSERT INTO client_relationships (mid, rid) Values ('";
		$query .= $_GET['mid'] . "','" . $cwID . "')";
		//add the entry 
		mysql_query($query)  or die(mysql_error());

?><div id="fn" class="w8"><form name="mowcreate" action="client.php?do=new&cc=10" method="post"><table width="100%"
border="0" cellpadding="0"
cellspacing="0">

<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:250px;color:#BBBBBB;">Next, enter some contacts for this client.<br 
/>&nbsp;</div></td>
<td class="gr"><img src="p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle"><center><table cellpadding="0" cellspacing="0" class="relshw"><tr style="font-size:80%;font-style:italic;font-weight:bold;">
<td>name</td><td>relationship</td><td>organization</td><td>phone</td><td>emerg</td><td>refered</td></tr><?php

$query = "SELECT * FROM client_relationships WHERE mid = '" . $_GET['mid'] . "' ORDER BY rid ASC";
$people = mysql_query($query);
//ORDER BY first_name ASC
$i=0;
while($person = mysql_fetch_array( $people )) {

	$query = "SELECT * FROM contacts WHERE rid = '" . $person['rid'] . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	//count number of relationships
	$i++;
	$isOdd = "";
	$rPhone	= $row['phone1'];
	$isRefer = "&nbsp;";
	$isEmrg = "&nbsp;";
	//is the row an odd number - vary colour
	//if ($row['emerge'] == 1)
	//	$isEmrg = "<img src=\"checksm.gif\" border=\"0\" style=\"padding-top:4px\">";
	//if ($row['refer'] == 1)
	//	$isRefer = "<img src=\"checksm.gif\" border=\"0\" style=\"padding-top:4px\">";
	if ( $i&1 )
		$isOdd = " class=\"odd\"";
	if ($row['prof'] == 1 )
		$rPhone = $row['phone3'];
	if (($row['prof'] == 1) && (strlen($row['phone3ext']) > 0))
		$rPhone .= " ext. " . $row['phone3ext'];
echo "<tr" .$isOdd . "><td>".$row['first_name'] . " " . $row['last_name'] . "</td><td>" . $row['relate'] . "</td>
<td>" .  $row['organ'] . "</td><td>" . $rPhone . "</td><td>" . $isEmrg . "</td><td>" . $isRefer . "</td><td><a href=\"contacts.php?mid=" . $cMid . "&rid=" . $row['rid'] ."\">edit</a></td></tr>";

 }
?></table></center>Enter a third party contact for the client.</div>
<div class="gtle" id="cworkers" style="display:none;">&nbsp;</div>
<table class="inpt"><tbody><tr>
<td class="rt">first&nbsp;name:</td><td><input class="i13" name="relf_name" maxlength="20" size="10" type="text">

&nbsp;last&nbsp;name:&nbsp;<input class="i13" name="rell_name" maxlength="20" size="10" type="text" onkeyup="javascript:autocw('<?php echo $pass_mid; ?>')">
</td></tr><tr><td class="rt">relationship:<div id="relOdiv" style="padding-top: 2px;">organization:</div></td><td><select 
name="slctRel" id="slctRel" onchange="relDiv()">
<option>case worker</option><option>nurse</option><option>dietician</option><option>physiotherapist</option><option>doctor</option>
<option>next of kin</option><option>husband</option><option>grandchild</option><option>wife</option><option>mother</option>

<option>father</option><option>brother</option><option>sister</option><option>friend</option><option>guardian</option><option>daughter</option>
<option>son</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_refr" class="chkbx" style="padding-left: 10px;" 
type="checkbox">&nbsp;Referring&nbsp;Party&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_emrg" class="chkbx" 
type="checkbox">&nbsp;Emergency&nbsp;Contact<br>
<div id="relOfdiv" style="padding-top: 2px;"><input class="i25" name="relorg" id="relOrg" maxlength="30" size="30" type="text"></div>
</td></tr><tr><td class="rt" rowspan="2">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" 
type="text"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text">
</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" 
type="text">&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="QC" 
type="text">&nbsp;&nbsp;postal&nbsp;code:&nbsp;<input class="i5" name="post" maxlength="7" size="7" type="text" style="text-transform: uppercase;"></td></tr><tr><td 
class="rt">email:</td><td><input class="i25" name="email" maxlength="45" size="10" type="text"></td></tr><tr><td class="rt"><div 
id="relHphone" style="padding-bottom: 2px; display: none;">home&nbsp;phone:</div>cell&nbsp;phone:</td><td><div
id="relHfphone" style="display: none; padding-bottom: 2px;"><input class="i2" name="phone1" maxlength="3" size="3" value="514"
type="text">&nbsp;<input class="i7" name="phone2" maxlength="10" size="10" type="text"><br /></div><input class="i2" name="phoneb1" 
maxlength="3" size="3" value="514" type="text">&nbsp;<input class="i7" name="phoneb2" maxlength="10" size="10" 
type="text"></td></tr><tr><td class="rt">work:</td><td><input class="i2" name="phonec1" maxlength="3" size="3" value="514" 
type="text">&nbsp;<input class="i7" name="phonec2" maxlength="10" size="10" type="text"> ext. <input class="i3" name="phonec3" 
maxlength="6" size="6" type="text">
</td></tr></table>
</div><div class="snd"><input type="hidden" name="relDo" id="relDo" value="add"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Add Relationship &raquo;" /><input type="button" onClick="document.getElementById('relDo').value='done';document.mowcreate.submit(); return false;" value="No More Relationships&raquo;" /></div></th></tr><tr>
<td rowspan="2"><img src="p1/apl.gif" width="138"height="150" border="0"alt="FeastDB" /></td>
<td class="gr"> </td></tr></table></form></div><div class="fbt"><a 
href="http://www.fireboytech.com">2008 © fireboy technologies</a></div>
</div></div></div></center></body></html>
