<?php

$cMid = $_GET['mid']; 
if(!(isset($_GET['spec'])))
$cSpec = "home";
else 
$cSpec = $_GET['spec'];
?>
            <div class="w8">
                <div id="ul"><div<?php
  //in this case, the mysql variables are loaded in ../client.php
  //so that they will not be loaded twice by cedit1.php
$query = "SELECT * FROM client
 WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
$cAlert = "&nbsp;";
if ($row['alert'] == 1){
$cAlert = $row['alertmsg'] . "</div>";
?> style="background-image:
url(theme/default/alert.png);background-repeat:no-repeat;height:64px;width:560px;margin-left:35px;padding:0;"><div
style="height:64px;width:35px;float:left;padding:0;margin:0"><img src="theme/default/excl_flash.gif" height="64px;" border="0"
style="float:right;"></div><div
style="width:400px;float:left;text-align:center;padding-top:24px"<?php
}
echo ">" . $cAlert;

$query = "SELECT * FROM member
 WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );
// Print out the contents of the entry
$cName = $row['first_name'] . "&nbsp;";
if (strlen($row['m_name']) > 0)
$cName .= $row['m_name']  . "&nbsp;";
$cName .= $row['last_name'];
$cfName = $row['first_name'];
$clName = $row['last_name'];

$cHome = "<span style=\"font-size:16px;\"><b>" . $cName . "</b></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . substr($row['phone'],0,3) . "-" . substr($row['phone'],3,3);
if (substr($row['phone'],6,1) != "-") $cHome .= "-";
$cHome .= substr($row['phone'],6);
$cHome .= "<br />" . $row['address1'] . "<br />";
if ($row['address2'] != "")
$cHome .= $row['address2'];

?></div></div><div id="ur"><img src="theme/default/branche.gif" width="179" height="64" border="0" alt="" /></div>

            </div>
            <div id="cn" class="w8">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="clear:left;height:234px;">
                <tr><td style="vertical-align:top;">

                <div id="sidmen" style="height:312px;z-index:10;background:#87C313 
url(theme/default/mmene.gif);background-repeat:repeat-y;width:200px;float:right;overflow:hidden;">
<div id="vmenu"><ul onmouseover="vMenOver()" onmouseout="vMenOut()">
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=meal"<?php if ($cSpec == "meal") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>1.&nbsp;</b>Meal<span><br />change meal specifications</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=dlvr"<?php if ($cSpec == "dlvr") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>2.&nbsp;</b>Delivery<span><br />schedule a delivery</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=route"<?php if ($cSpec == "route") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>3.&nbsp;</b>Route<span><br />change delivery route settings</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=home"<?php if ($cSpec == "home") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>4.&nbsp;</b>Contact<span><br />view contact info for this client</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=relate"<?php if ($cSpec == "relate") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>5.&nbsp;</b>Relationships<span><br />view relationships of this client</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=refer"<?php if ($cSpec == "refer") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>6.&nbsp;</b>Service<span><br />referral and billing info</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=dft"<?php if ($cSpec == "dft") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>7.&nbsp;</b>Meal Defaults<span><br />view or change meal default settings</span></a></li>
<li><a href="client.php?do=show&mid=<?php echo $cMid; ?>&spec=nfo"<?php if ($cSpec == "nfo") echo " class=\"slctd\""; ?> onmouseover="clearTimeout(vTimer)"><b>8.&nbsp;</b>Special Info<span><br />birthdate, start date, language, alerts...</span></a></li>
</ul>
</div></div><div style="height:100px;width:7px;background:transparent;float:right;"><img src="theme/default/mmenw.gif" width="7" height="60" 
border=""></div><?php
if ($cSpec == "meal") {

$query = "SELECT * FROM client WHERE mid='" . $cMid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$portionH = "";
$portionR = "";
$portionL = "";
$portionD = "";
switch($row['mPortion']) {
		case "H":
		//Half
		$portionH = " checked=\"checked\"";
		break;
		case "R":
		//Regular
		$portionR = " checked=\"checked\"";
		break;
		case "L":
		//Large
		$portionL  = " checked=\"checked\"";
		break;
		case "D":
		//Double
		$portionD = " checked=\"checked\"";
		break;
		default:
		$portionR = " checked=\"checked\"";
}

$isChecked=array();
$chkYes = " checked=\"checked\"";
if ($row['mMealmod_cut'])
$isChecked['pr1'] = $chkYes;
if ($row['mMealmod_pur'])
$isChecked['pr2'] = $chkYes;
if ($row['mMealmod_dat'])
$isChecked['pr3'] = $chkYes;
if ($row['mDiet_salt'])
$isChecked['di1'] = $chkYes;
if ($row['mDiet_spicy'])
$isChecked['di2'] = $chkYes;
if ($row['mDiet_choc'])
$isChecked['di3'] = $chkYes;
if ($row['mDiet_milk'])
$isChecked['di4'] = $chkYes;
if ($row['mDiet_msg'])
$isChecked['di6'] = $chkYes;
if ($row['mDiet_rice'])
$isChecked['di7'] = $chkYes;
if ($row['mDiet_ptat'])
$isChecked['di8'] = $chkYes;
if ($row['mDiet_nuts'])
$isChecked['di9'] = $chkYes;
if ($row['mDiet_past'])
$isChecked['di10'] = $chkYes;
if ($row['mDiet_poul'])
$isChecked['di11'] = $chkYes;
if ($row['mDiet_ham'])
$isChecked['di12'] = $chkYes;
if ($row['mDiet_pork'])
$isChecked['di13'] = $chkYes;
if ($row['mDiet_beef'])
$isChecked['di14'] = $chkYes;
if ($row['mDiet_veal'])
$isChecked['di15'] = $chkYes;
if ($row['mDiet_fish'])
$isChecked['di16'] = $chkYes;
if ($row['mMealdiabete'])
$isChecked['ds1'] = $chkYes;
if ($row['mMealallergy'])
$isChecked['ds2'] = $chkYes;
if ($row['mDiet_glut'])
$isChecked['ds3'] = $chkYes;
if ($row['mDiet_div'])
$isChecked['ddv'] = $chkYes;


?><form name="clientedit" action="edit.php?&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><div style="width:500px;overflow:auto;"><div style="width:120px;float:left;">
<input type="radio" name="dportion"<?php echo $portionH; ?> value="H" />half<br />
<input type="radio" name="dportion"<?php echo $portionR; ?> value="R" />regular</div><div style="width:120px;float:left;">
<input type="radio" name="dportion"<?php echo $portionL; ?> value="L" />large<br />
<input type="radio" name="dportion"<?php echo $portionD; ?> value="D" />double</div></div>
<div class="gtle" style="clear:left;">What special preparations need to be done for this client?</div><div 
style="padding:0 0 10px 85px"><div style="width:120px;">
<input type="checkbox" name="dietr_pr1" value="1" id="pr1"<?php echo $isChecked['pr1']; ?> onClick="addText('label', 'cut up food','pr1')" />Cut Up<br />
<input type="checkbox" name="dietr_pr2" value="1" id="pr2"<?php echo $isChecked['pr2']; ?> onClick="addText('label', 'puree','pr2')" />Puree</div><div style="width:120px;float:left;">
<input type="checkbox" name="dietr_pr3" value="1" id="pr3"<?php echo $isChecked['pr3']; ?> onClick="addText('label', 'date','pr3')" />Print Date<br /></div></div>
<div class="gtle" style="clear:left;">What ingredient restrictions does the client have?</div><div style="padding:0 0 10px 60px">
<table cellspacing="0" style="border:1px solid #456F06;width:500px;padding:4px;margin:2px;clear:left;">
<tr><td>
<input type="checkbox" name="dietr_i1" id="di1" value="1"<?php echo $isChecked['di1']; ?> onClick="addText('label', 'no salt','di1')" />salt<br />
<input type="checkbox" name="dietr_i2" value="1" id="di2"<?php echo $isChecked['di2']; ?> onClick="addText('label', 'no spicy','di2')" />spicy<br />
<input type="checkbox" name="dietr_i3" value="1" id="di3"<?php echo $isChecked['di3']; ?> onClick="addText('label', 'no chocolate','di3')" />chocolate<br />
<input type="checkbox" name="dietr_i4" value="1" id="di4"<?php echo $isChecked['di4']; ?> onClick="addText('label', 'no dairy','di4')" />dairy<br />
<input type="checkbox" name="dietr_i6" value="1" id="di6"<?php echo $isChecked['di6']; ?> onClick="addText('label', 'no MSG','di6')" />MSG<br />
<input type="checkbox" name="dietr_i7" value="1" id="di7"<?php echo $isChecked['di7']; ?> onClick="addText('label', 'no rice','di7')" />rice<br />
<input type="checkbox" name="dietr_i8" value="1" id="di8"<?php echo $isChecked['di8']; ?> onClick="addText('label', 'no potato','di8')" />potato<br />
</td><td style="vertical-align:top;">
<input type="checkbox" name="dietr_i9" value="1" id="di9"<?php echo $isChecked['di9']; ?> onClick="addText('label', 'no nuts','di9')" />nuts<br />
<input type="checkbox" name="dietr_i10" value="1" id="di10"<?php echo $isChecked['di10']; ?> onClick="addText('label', 'no pasta','di10')" />pasta<br />
<input type="checkbox" name="dietr_i11" value="1" id="di11"<?php echo $isChecked['di11']; ?> onClick="addText('label', 'no poultry','di11')" />poultry<br />
<input type="checkbox" name="dietr_i12" value="1" id="di12"<?php echo $isChecked['di12']; ?> onClick="addText('label', 'no ham','di12')" />ham<br />
<input type="checkbox" name="dietr_i13" value="1" id="di13"<?php echo $isChecked['di13']; ?> onClick="addText('label', 'no pork','di13')" />pork<br />
<input type="checkbox" name="dietr_i14" value="1" id="di14" <?php echo $isChecked['di14']; ?> onClick="addText('label', 'no beef','di14')" />beef<br />
<input type="checkbox" name="dietr_i15" value="1" id="di15"<?php echo $isChecked['di15']; ?> onClick="addText('label', 'no veal','di15')" />veal<br />
<input type="checkbox" name="dietr_i16" value="1" id="di16"<?php echo $isChecked['di16']; ?> onClick="addText('label', 'no fish','di16')" />fish<br />
</td></tr></table></div><div class="gtle" style="clear:left;">What special restrictions does the client have?</div><div 
style="padding:0 0 10px 60px"><table cellspacing="0" style="border:1px solid #456F06;width:80%;padding:4px;margin:2px;">
<tr><td style="vertical-align:top;">
<input type="checkbox" name="dDiabetic" value="1" id="ds1"<?php echo $isChecked['ds1']; ?> onClick="addText('label', 'Diabetic','ds1')" />diabetic<br />
<input type="checkbox" name="dAllergy" value="1" id="ds2"<?php echo $isChecked['ds2']; ?> onClick="addText('label', 'ALLERGY:','ds2')" />allergy<br />
<input type="checkbox" name="dGluten" value="1" id="ds3"<?php echo $isChecked['ds3']; ?> onClick="addText('label', 'gluten','ds3')" />gluten intolerent<br />
</td></tr></table></div><div class="gtle" style="clear:both;">Does the client have any restrictions not categorized above?</div><div
class="cntr" style="margin-left:45px"><input type="checkbox" name="dDiv"<?php echo $isChecked['ddv']; ?> value="1" id="dDiv" />Yes (specialized label will 
always 
be 
printed)</div>
<textarea rows="3" cols="20" style="margin-left:45px; height:70px;width:280px;" name="dLabel" id="label"><?php echo $row['mLabel']; ?></textarea><br 
/><input type="submit" 
value="Save Changes" style="margin-left:45px"/><br />
<br />
</div></form>
<?php
} elseif ($cSpec == "dlvr") {

include '../include/client/cmeals1.php';

} elseif ($cSpec == "dft") {

include '../include/client/cdefault1.php';

} elseif ($cSpec == "refer") {
$query = "SELECT * FROM client WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
?><div style="height:272px;overflow:auto;max-width:740px"><div style="z-index:1;"><br />
<table cellpadding="0" cellspacing="0" class="tshw">
<tr><td class="ll"><div class="clName">Reason for Referal</div></td><td style="padding:0 0 5px 5px;">
<?php if ($row['rfref_loa']==1)
echo "Loss of Autonomy<br/>";
if ($row['rfref_iso']==1)
echo "Social Isolation<br/>";
if ($row['rfref_fin']==1)
echo "Financial Difficulty<br/>";
if ($row['rfref_nut']==1)
echo "Malnutrition<br/>";
if ($row['rfref_cog']==1)
echo "Cognitive Problems<br/>";
if ($row['rfref_mob']==1)
echo "Reduced Mobility<br/>";
if ($row['rfref_vis']==1)
echo "Visually Impaired<br/>";
if ($row['rfref_aln']==1)
echo "Lives Alone<br/>";
?></td></tr><tr><td class="ll"><div class="clName">Referral Notes</div></td><td><?php
echo $row['rNotes'];
?></td></tr><tr><td><div class="clName">Billing</div></td><td><?php
$query = "SELECT * FROM client_billing WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$bTo= $row['billto'];

$bcurateur_address = "600 Boul. René Lévesque Ouest, ";
$bcurateur_address2 = "étage";
$bcurateur_address3 = "Montréal, Québec  H3B 4W9";
$bbluecross_sal = "National Provider Center";
$bbluecross_address = "Provider Reimbursement Claims<br />C.P. 6200<br />STANLCD1<br />Moncton, NB  E1C 8R2";
$bprovider = "SR 20922";

$billTo = "";
$bAdd = "";

if ($bTo == "slf") {
$billTo = "Self Funded";
$bAdd = "";
}elseif ($bTo == "cur") {
$billTo = "Curateur Public";
$bAdd = "# " . $row['accountno'] . "<br />" . $bcurateur_address . "<br />" . $row['address1'] . "<sup>e</sup> " . $bcurateur_address2  . "<br /> " . $bcurateur_address3;
} elseif ($bTo == "blu") {
$billTo = "Blue Cross";
$bAdd = $bbluecross_sal .  "<br />" . $bbluecross_address  . "client #: " . $row['accountno'] . "<br />authorization #: " . $row['authno'] . "" . $bcurateur_address . "<br />provider #:" . $bprovider;
} elseif ($bTo == "oth") {
$billTo = $row['salutation'];
$bAdd = $row['address1'] . "<br />" . $row['address2'] . "<br />" . $row['address3'] . "<br />" . $row['city'] . " " . $row['prov'] . ", " . $row['post'] . "<br />" . substr($row['phone'],0,3) . "-" . substr($row['phone'],3,3) . "-" . substr($row['phone'],6) . " ext" . $row['ext'];
} else {
$query = "SELECT * FROM client_relationships WHERE mid = '" . $cMid . "' and billto='1'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$rid=$row['rid'];
$query = "SELECT * FROM contacts WHERE rid = '" . $rid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$billTo = $row['first_name'] . " " . $row['last_name'];
$bAdd = $row['address1'] . "<br />" . $row['address2'] . "<br />" . $row['city'] . " " . $row['prov'] . ", " . $row['post'] . "<br />" . substr($row['phone1'],0,3) . "-" . substr($row['phone1'],3,3) . "-" . substr($row['phone1'],6);
}
echo $billTo . "<br />" . $bAdd;
?></td></tr>
<tr><td class="ll"><div class="clName">Billing History</div></td><td><a href="billing.php?do=edit&mid=<?php echo $cMid; ?>">edit&raquo</a></td></tr>
<tr><td><div class="clName">Edit Billing</div></td><td><input type="button" value="Edit Billing Info" onClick="showEdit(); return false;" style="margin-left:10px;"/>
</td></tr></table></div>

</div><?php

} elseif ($cSpec == "relate") {

$query = "SELECT * FROM client_relationships WHERE mid = '" . $_GET['mid'] . "' ORDER BY rid ASC";
$people = mysql_query($query);
?><div style="height:272px;overflow:auto;max-width:740px"><div style="z-index:1;"><br />
<table cellpadding="0" cellspacing="0" class="tshw">
<tr><td class="ll"><div class="clName">Relationships</div></td><td style="padding:0 0 5px 5px;"><table
cellpadding="0" cellspacing="0" class="relshw">
<?php
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
	if ($person['emerge'] == 1)
		$isEmrg = "<img src=\"checksm.gif\" border=\"0\" style=\"padding-top:4px\">";
	if ($person['refer'] == 1)
		$isRefer = "<img src=\"checksm.gif\" border=\"0\" style=\"padding-top:4px\">";
	if ( $i&1 )
		$isOdd = " class=\"odd\"";
	if ($row['prof'] == 1 )
		$rPhone = $row['phone3'];
	if (($row['prof'] == 1) && (strlen($row['phone3ext']) > 0))
		$rPhone .= " ext. " . $row['phone3ext'];
echo "<tr" .$isOdd . "><td>".$row['first_name'] . " " . $row['last_name'] . "</td><td>" . $row['relate'] . "</td>
<td>" .  $row['organ'] . "</td><td>" . $rPhone . "</td><td>" . $isEmrg . "</td><td>" . $isRefer . "</td><td><a href=\"contacts.php?mid=" . $cMid . "&rid=" . $row['rid'] ."\">edit</a></td><td><a href=\"edit.php?mid=" . $cMid . "&client=del&rid=" . $row['rid'] ."&spec=relate\">delete</a></td></tr>";

 }
?></table></td></tr><tr><td class="ll"><div class="clName">Manage Entries</div></td><td><a href="#" onclick="showEdit(); return
false;">add a new relationship</a><?php
?></td></tr></table></div></div><?php

} elseif ($cSpec == "route") {
// View Deliveries

$query = "SELECT * FROM client  WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );
// Print out the contents of the entry
$wNone = "<span>&nbsp;<br /></span>none";
$dRoute = "unknown";
$thsRoute = $row['dRoute'];
switch ($row['dRoute']) {
case "CS":
$dRoute = "Centre Sud";
  break;
case "CDN":
$dRoute = "Cote Des Neiges";
  break;
case "ME":
$dRoute = "Mile End";
  break;
case "MG":
$dRoute = "McGill";
  break;
case "MGW":
$dRoute = "McGill West";
  break;
case "NDG":
$dRoute = "Notre Dame de Grace";
  break;
case "CV":
$dRoute = "Downtown";
  break;
case "WM":
$dRoute = "Westmount";
}
$dStat = "";
switch ($row['mealstatus']) {
case "A":
$dStat = "";
  break;
case "I":
$dStat = "<b>inactive</b> ";
  break;
case "S":
$dStat = "<b>stopped</b> ";
}
?><div style="height:272px;overflow:hidden;"><div style="z-index:1;"><br />
<div style="height:18px;width:370px"><form name="mowRoute" action="edit.php?change=route&spec=route&mid=<?php echo $cMid; ?>" 
method="post"><div id="oldRoute" style="height:15px;width:200px;float:right;padding-top:2px;"><?php
echo "&nbsp;<b>" . $dRoute . "</b><br />";
if ($row['address2'] != "")
$cHome .=  $row['address2'] . "<br />";
?></div><div id="nRoute" style="height:15px;width:200px;float:right;padding-top:2px;display:none;"><select 
style=";margin-left:10px;" id="sRoute" onChange="mowRoute.submit()" name="newroute">
<option value="NA">choose route...</option>
<option value="CS">Centre Sud</option>
<option value="CDN">Cote Des Neiges</option>
<option value="CV">Downtown</option>
<option value="MG">McGill</option>
<option value="MGW">McGill West</option>
<option value="ME">Mile End</option>
<option value="NDG">Notre Dame de Grace</option>
<option value="WM">Westmount</option>
</select></div></form><div 
class="clName">Route</div></div>
<div style="width:170px;"><div class="clName">Directions</div></div>
<div style="height:51px;padding-left:180px;width:610px;position:relative;top:-23px;left:0px;"><form name="mowDirect" action="edit.php?change=direct&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><div id="oldDirect"
style="width:420px;overflow:auto;height:86px;font-size:90%;<?php 
if ((substr_count("\n",$row['dDirections']) > 3) || (strlen($row['dDirections']) > 105))
$add = "border:1px solid #DDD; ";
else 
$add = "";
 echo $add . "\">" . str_replace("\n","<br />",$row['dDirections']); ?></div><textarea id="nDirect" name="newdirect"
style="width:420px;overflow:auto;display:none;height:86px;font-size:90%;border:1px solid #DDD;"><?php
 echo $row['dDirections']; ?></textarea></form></div><div class="clName">Stop</div><?php
$thisStop = $row['dStop'];
if ($thisStop > 1) { ?><div style="height:14px;height:50px;width:700px;"><div style="width:93px;height:50px;float:left;margin-left:20px"><img src="theme/default/arstart.gif" height="50" width="82" alt="" border="0"></div><?php
} else { ?><div style="height:14px;padding-left:105px;height:50px;width:600px;"><?php
}
$query = "SELECT * FROM client WHERE dRoute = '" . $row['dRoute'] . "'  AND mealstatus='A' ORDER BY dStop ASC";
$result = mysql_query($query);
// find which stops come before and after this client
while($row = mysql_fetch_array( $result )) {
if ($thisStop > 1) {
 if (($row['dStop'] + 1) == $thisStop) {
 $prevStop = $row['dStop'];
 $prevClient = $row['mid'];
 }
}
if (($row['dStop'] - 1) == $thisStop) {
$nextStop = $row['dStop'];
$nextClient = $row['mid'];
}
$lastStop = $row['dStop'];
$lastClient = $row['mid'];
}

// get their names and address
// stop before
$prevClientPrint = "<div class=\"cpr\">";
if ($thisStop > 1) {
$query = "SELECT * FROM member WHERE mid = '" . $prevClient . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
$prevClientPrint .= "<b>" . $row['first_name'] . " " . $row['last_name'] . "</b><br />" . $row['address1'] . "<br/>" . $row['address2'];
} else {
$prevClientPrint .= "<center>&nbsp;<br /><b>Begin Route</b></center>";
$prevStop = "&nbsp;";
}
$prevClientPrint .= "</div><div class=\"cpa\"><div class=\"cpb\">" . $prevStop . "</div></div>";

// stop after
$nextClientPrint = "<div class=\"cpr\">";
if ($thisStop < $lastStop) {
$query = "SELECT * FROM member WHERE mid = '" . $nextClient . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );  
$nextClientPrint .= "<b>" .$row['first_name'] . " " . $row['last_name'] . "</b><br />" . $row['address1'] . "<br/>" . $row['address2'];
} else {
$nextClientPrint .= "<center>&nbsp;<br /><b>End Route</b></center>";
$nextStop = "&nbsp;";
}
$nextClientPrint .= "</div><div class=\"cpa\"><div class=\"cpb\">" . $nextStop  . "</div></div>";

echo $prevClientPrint . "<div style=\"width:150px;height:50px;text-align:center;background:#7eb811 url(theme/default/thstop.gif);background-repeat:repeat-y;float:left;\"><div style=\"padding:9px 0 0 5px;font-size:14px;font-weight:bold;color:#fff;\">" . $cfName . "<br />" . $clName . "</div></div><div class=\"cpt\"><div class=\"cpb\">" . $thisStop . "</div></div>". $nextClientPrint;
?></div></div><div style="padding: 6px 0 0 100px;">
<input type="button" value="Change Stop" onClick="showEdit(); return false;" style="margin-left:10px;"/>
<input type="button" value="Change Route" onClick="showRoute(); return false;" style="margin-left:10px;"/>
<input type="button" value="Edit Directions" onClick="editDirect();" style="margin-left:10px;" id="bDirect"/><input type="button" value="Save Changes to Directions" onClick="mowDirect.submit();" style="display:none;margin-left:10px;" id="sDirect"/>
</div>
<?php
} elseif ($cSpec == "nfo") {
	$query = "SELECT * FROM client WHERE mid='" . $cMid . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array( $result );

	?><div><div style="z-index:1;"><br />
	<table cellpadding="0" cellspacing="0" class="tshw">
	  <tr><td class="ll"><div class="clName">Birthdate</div></td><td><?php
		echo date("F j, Y", strtotime($row['bday'])); ?></td></tr>
	  <tr><td class="ll"><div class="clName">First Meal</div></td><td><?
		echo date("F j, Y", strtotime($row['firstmealdate'])); ?></td></tr>
	  <tr><td class="ll"><div class="clName">First Language</div></td><td><?php
		echo $row['mlang']; ?></td></tr>
	  <tr><td class="ll"><div class="clName">Language of Correspondance</div></td><td><?php
		echo $row['clang']; ?></td></tr>
	  <tr><td class="ll"><div class="clName">Edit Alert</div></td><td>[link goes here]</td></tr>
	</table></div></div>
	<?php

} else {
?> <div style="height:272px;overflow:auto;"><div style="z-index:1;"><br />
<table cellpadding="0" cellspacing="0" class="tshw">
<tr><td class="ll"><div class="clName">Client</div></td><td><?php
echo "<span style=\"font-size:16px;\"><b>" . $row['first_name'] . " " . $row['last_name'] . "</b></span><br />";
echo "address: " . $row['address1'] . "<br />";
if ($row['address2'] != "")
echo $row['address2'] . "<br />";
echo $row['city'] . ", " . $row['prov'] . "&nbsp;&nbsp;&nbsp; " . $row['post'] . "<br />";
?></td></tr><tr><td class="ll"><div class="clName">Phone</div></td><td><?php
$ePhone = "home phone: " . substr($row['phone'],0,3) . "-" . substr($row['phone'],3,3);
if (substr($row['phone'],6,1) != "-") $ePhone .= "-";
$ePhone .= substr($row['phone'],6);
if (strlen($row['phoneb']) > 4) {
$ePhone .= "<br />second phone: " . substr($row['phoneb'],0,3) . "-" . substr($row['phoneb'],3,3);
if (strrchr($row['phoneb'],"-") == 3) $ePhone .= "-";
$ePhone .= substr($row['phoneb'],6);
}
echo $ePhone;
if(strlen($row['email']) > 5){
?></td></tr><tr><td class="ll"><div class="clName">e-mail</div></td><td><?php
echo "<a href=\"mailto:" . $row['email'] . "\">" .  $row['email'] . "</a><br />";
}
?></td></tr></table><div style="padding-left:25px"><a href="#" onclick="showEdit(); return 
false;">edit&nbsp;profile</a></div></div></div><?php
}?>
                </td>

                </tr>

                </table>


            </div>
            <div id="sep" class="w8">&nbsp;</div>

            <div id="fn" class="w8"><form name="mowquery" autocomplete="off">

            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                <tr>

                <td style="width:110px;"></td>

                <td style="vertical-align:top;background:#507F08 url(theme/default/gfade_n.gif);background-repeat:repeat-y;overflow:visible;"
rowspan="2"><div style="overflow:visible;"><div style="z-index:10;background:#fff
url(theme/default/sr_nd.gif);background-repeat:no-repeat;background-position:0px
80px;width:20px;float:left;height:160px">&nbsp;</div><div id="srchmen" style="z-index:10;background:#fff
url(theme/default/sr_rp.gif);background-repeat:repeat-x;background-position:0px
80px;width:60px;float:left;height:160px;overflow:hidden;"><input type="text" style="height:15px;margin:82px 0
0 2px;border:0;padding:0;width:270px;background:transparent;" id="mq_sr" name="mquery" size="10"  onkeyup="javascript:autosuggest()"
onFocus="slideout2('srchmen',320)" onBlur="slidein2('srchmen',320)" /><br /><span style="padding:0 0 0
35px;color:#BBB">enter&nbsp;a&nbsp;first&nbsp;or&nbsp;last&nbsp;name&nbsp;to&nbsp;begin&nbsp;search...</span><br/><div
style="position:absolute;width:100px;height:10px;overflow:visible;"><div id="mq_ac"></div></div></div></div><div
style="z-index:11;width:8px;float:left;height:160px;background:transparent
url(theme/default/arw.gif);background-repeat:no-repeat;background-position:0px 81px">&nbsp;</div><div 
style="height:100px;padding:0 0 0 200px;"><br /><?php if ($cSpec != "home") {
echo $cHome;
} else {
echo "&nbsp;";
}
 ?></div><div>menu<br /><a href="client.php?do=new">New Client</a><br /><a href="client.php?do=routesheet">Print Route Sheet</a>
&nbsp;&nbsp;&nbsp;<a href="client.php?do=kitchencount">Print Kitchen Count</a>&nbsp;&nbsp;&nbsp;<a href="client.php?do=printlabels">Print Labels</a>&nbsp;&nbsp;&nbsp;<a href="billing.php">Print Monthly Billing Summary</a></div></td><?php 
//<td style="width:150px;background:#507F08;" rowspan="2">&nbsp;</td>
?></tr><tr>
                <td><img src="theme/default/<?php if(($usr_settings['usrname'])=="kateri") { ?>lemime4.jpg" width="108" height="111<?php } else {
?>apple4.jpg" width="86" height="118<?php } ?>" border="0" alt="" /></td>
                </tr></table>
            </form></div>
            <div class="fbt"><a href="http://www.fireboytech.com">2008 &copy; fireboy technologies</a></div>
        </div>
</center>
<div id="editDialog">
  <div id="editBox">
	<div style="width:507px;height:416px;padding:14px 201px 0 14px;background: url(./editor/editor.png) no-repeat;margin:0;">
<?php
if ($cSpec == "home") {
?>
<form name="clientedit" action="edit.php?&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><table cellpadding="0" 
cellspacing="0" 
style="width:515px;border:0;padding:0;margin:0;"><tr><td 
style="width:180px;padding:0;text-align:left;height:38px;"><div class="clName">Client</div></td><td 
style="text-align:right;vertical-align:top;"><img src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table>
<table cellpadding="0" cellspacing="0" class="inpte"><tr><td class="rt">name:</td><td><input class="i9" type="text" name="f_name" maxlength="20" size="10" value="<?php echo $row['first_name']; ?>" /><input 
class="i7" type="text" name="m_name" maxlength="20" size="10" style="margin:0 2px" value="<?php echo  $row['m_name']; ?>" /><input 
class="i13" type="text" name="l_name" id="Lname" maxlength="20" size="10" value="<?php echo  $row['last_name']; ?>" /></td></tr>
<tr><td class="rt" rowspan="2">address:</td><td><input class="i25" type="text" name="add1" maxlength="35" size="35" value="<?php echo $row['address1']; ?>"/></td></tr><tr><td><input class="i25" type="text" name="add2" maxlength="35" size="35" value="<?php echo $row['address2']; ?>" />
</td></tr><tr><td class="rt">city:</td><td><input class="i13" type="text" name="city" maxlength="25" size="25" value="<?php echo  $row['city']; ?>"
/>&nbsp;province/state: <input class="i2" type="text" name="prov" maxlength="2" size="2" value="<?php echo  $row['prov']; ?>" /></td>
</tr><tr><td class="rt">postal code:</td><td><input
class="i5" type="text" name="post" maxlength="7" size="7" value="<?php echo  $row['post']; ?>" style="text-transform: uppercase;" /></td></tr>
<tr><td colspan="2"><div class="clName">e-Mail</div><tr><td class="rt">email:</td><td><input class="i25" type="text" name="email" maxlength="45" size="10" value="<?php echo  $row['email']; ?>" /></td></tr>
<tr><td colspan="2"><div class="clName">Phone</div></td></tr>
<tr><td class="rt">home&nbsp;phone:</td><td><input class="i2" type="text" name="phone1" maxlength="3" size="3" value="<?php echo substr($row['phone'],0,3); ?>" />-<input class="i7" type="text" name="phone2" maxlength="10" size="10" value="<?php echo substr($row['phone'],3); ?>" /></td></tr>
<tr><td class="rt">2<sup>nd</sup> phone:</td><td><input class="i2" type="text" name="phoneb1" maxlength="3" size="3" value="<?php echo substr($row['phoneb'],0,3); ?>" />-<input class="i7" type="text" name="phoneb2" maxlength="10" size="10" value="<?php echo substr($row['phoneb'],3); ?>" /></td>
</tr></table><input type="hidden" name="mid" value="<?php echo $cMid; ?>" />
<div style="float:right;padding-top:10px"><a href="#" onclick="hideEdit(); return false;"><img src="editor/cancel.png" alt="cancel" 
title="CANCEL"  onmouseover="this.src = 'editor/cancel_over.png'" onmouseout="this.src = 'editor/cancel.png'" 
/></a>&nbsp;<a 
href="#" onclick="document.clientedit.submit(); return false;"><img src="editor/ok.png" alt="save"
title="OK"  onmouseover="this.src = 'editor/ok_over.png'" onmouseout="this.src = 'editor/ok.png'" /></a></div>
<?php } elseif ($cSpec == "relate") {
//relationships
 ?>
<form name="clientedit" action="edit.php?&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><table cellpadding="0"
cellspacing="0" style="width:515px;border:0;padding:0;margin:0;"><tr><td
style="width:180px;padding:0;text-align:left;height:38px;"><div class="clName">Add Relationship</div></td><td style="overflow:hidden;height:38px;vertical-align:top;"><div id="cworkers" style="padding-top:15px;"></div></td><td
style="text-align:right;vertical-align:top;"><img src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table>
<table cellpadding="0" cellspacing="0" class="inpte">
<tr>
<td class="rt">first&nbsp;name:</td><td><input class="i13" name="relf_name" maxlength="20" size="10" type="text">
&nbsp;last&nbsp;name:&nbsp;<input class="i13" name="rell_name" maxlength="20" size="10" type="text" id="rell_name" onkeyup="javascript:autocw('<?php echo $cMid; ?>')">
</td></tr><tr><td class="rt">relationship:<div id="relOdiv" style="padding-top: 2px;">organization:</div></td><td><select 
name="slctRel" id="slctRel" onchange="relDiv()">
<option>case worker</option><option>nurse</option><option>dietician</option><option>physiotherapist</option><option>doctor</option>
<option>next of kin</option><option>husband</option><option>grandchild</option><option>wife</option><option>mother</option>
<option>father</option><option>brother</option><option>sister</option><option>friend</option><option>guardian</option><option>daughter</option>
<option>son</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_refr" class="chkbx" style="padding-left: 10px;" 
type="checkbox" value="1">&nbsp;Referring&nbsp;Party&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_emrg" class="chkbx" value="1"
type="checkbox">&nbsp;Emergency&nbsp;Contact<br />
<div id="relOfdiv" style="padding-top: 2px;"><input class="i25" name="relorg" id="relOrg" maxlength="30" size="30" type="text"></div>
</td></tr><tr><td class="rt" rowspan="2">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" 
type="text"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text">
</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" type="text" value="Montreal"
/>&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="QC" 
type="text">&nbsp;&nbsp;postal&nbsp;code:&nbsp;<input class="i5" name="post" maxlength="7" size="7" type="text" style="text-transform: uppercase;"></td></tr>
<tr><td colspan="2"><div class="clName">Contact Info</div></td></tr><tr><td class="rt">email:</td><td><input class="i25" name="email" 
maxlength="45" size="10" type="text"></td></tr><tr><td class="rt"><div 
id="relHphone" style="padding-bottom: 2px; display: none;">home:</div>work:</td><td><div
id="relHfphone" style="display: none; padding-bottom: 2px;"><input class="i2" name="phone1" maxlength="3" size="3" value="514"
type="text">-<input class="i7" name="phone2" maxlength="10" size="10" type="text"><br /></div><input class="i2" name="phonec1" 
maxlength="3" size="3" value="514"
type="text">-<input class="i7" name="phonec2" maxlength="10" size="10" type="text"> ext. <input class="i3" name="phonec3"
maxlength="6" size="6" type="text"></td></tr><tr><td class="rt">cell:</td><td><input
class="i2" name="phoneb1"
maxlength="3" size="3" value="514" type="text">-<input class="i7" name="phoneb2" maxlength="10" size="10"
type="text">
</td></tr></table><input type="hidden" name="mid" value="<?php echo $cMid; ?>" />
<div style="float:right;padding-top:10px"><a href="#" onclick="hideEdit(); return false;"><img src="editor/cancel.png" alt="cancel"
title="CANCEL"  onmouseover="this.src = 'editor/cancel_over.png'" onmouseout="this.src = 'editor/cancel.png'"
/></a>&nbsp;<a
href="#" onclick="document.clientedit.submit(); return false;"><img src="editor/ok.png" alt="save"
title="OK"  onmouseover="this.src = 'editor/ok_over.png'" onmouseout="this.src = 'editor/ok.png'" /></a></div>
<?php } elseif ($cSpec == "refer") {
//billing
$query = "SELECT * FROM client_billing WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$bTo= $row['billto'];
if ($bTo == "slf") {
$billTo = "Self Funded";
$bAdd = "";
}elseif ($bTo == "cur") {
$billTo = "Curateur Public";
$bAdd = "# " . $row['accountno'] . "<br />" . $bcurateur_address . "<br />" . $row['address1'] . "<sup>e</sup> " . $bcurateur_address2  . "<br /> " . $bcurateur_address3;
} elseif ($bTo == "blu") {
$billTo = "Blue Cross";
$bAdd = $bbluecross_sal .  "<br />" . $bbluecross_address  . "client #: " . $row['accountno'] . "<br />authorization #: " . $row['authno'] . "" . $bcurateur_address . "<br />provider #:" . $bprovider;
} elseif ($bTo == "oth") {
$billTo = $row['salutation'];
$bAdd = $row['address1'] . "<br />" . $row['address2'] . "<br />" . $row['address3'] . "<br />" . $row['city'] . " " . $row['prov'] . ", " . $row['post'] . "<br />" . substr($row['phone'],0,3) . "-" . substr($row['phone'],3,3) . "-" . substr($row['phone'],6) . " ext" . $row['ext'];
} else {
$query = "SELECT * FROM client_relationships WHERE mid = '" . $cMid . "' and billto='1'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$rid=$row['rid'];
$query = "SELECT * FROM contacts WHERE rid = '" . $rid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$billTo = $row['first_name'] . " " . $row['last_name'];
$bAdd = $row['address1'] . "<br />" . $row['address2'] . "<br />" . $row['city'] . " " . $row['prov'] . ", " . $row['post'] . "<br />" . substr($row['phone1'],0,3) . "-" . substr($row['phone1'],3,3) . "-" . substr($row['phone1'],6);
}
$relHidden ="";
$relBill ="";
$query = "SELECT * FROM client_relationships WHERE mid='" . $cMid . "' ORDER BY rid ASC";
$result = mysql_query($query) or die ('Error: '.mysql_error ());
while($person = mysql_fetch_array( $result )) {
$query = "SELECT * FROM contacts WHERE rid = '" . $person['rid'] . "'";
$result2 = mysql_query($query);
$row = mysql_fetch_array($result2);
$qsel = "";
if ($person['billto']==1)
$qsel = " selected=\"selected\"";
$relBill .= "<option value=\"r" . $person['rid'] . "\"" . $qsel . ">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
$relHidden .= "<input type=\"hidden\" name=\"relnames\" value=\"" . $row['first_name'] . "|" . $row['last_name']  . "\" />";
$q++;
}  ?><form name="clientedit" action="edit.php?&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><table cellpadding="0"
cellspacing="0" style="width:515px;border:0;padding:0;margin:0;"><tr><td
style="width:180px;padding:0;text-align:left;height:38px;"><div class="clName">Change Billing</div></td><td style="overflow:hidden;height:38px;vertical-align:top;"><div id="cworkers" style="padding-top:15px;"></div></td><td
style="text-align:right;vertical-align:top;"><img src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table>
<table cellpadding="0" cellspacing="0" class="inpte" style="height:270px">
<tr>
<td style="padding:5px 0 0 20px; text-align:center;"><select name="billTo" id="billTo" onChange="billSlct()">
<option value="slf"<?php if ($bTo == "slf") echo " selected=\"selected\""; ?>>Self Funded</option>
<?php echo $relBill; ?>
<option value="cur"<?php if ($bTo == "cur") echo " selected=\"selected\""; ?>>Curateur Public</option>
<option value="blu"<?php if ($bTo == "blu") echo " selected=\"selected\""; ?>>Blue Cross</option>
<option value="oth"<?php if ($bTo == "oth") echo " selected=\"selected\""; ?>>Other</option>
</select><?php echo $relHidden; ?></td></tr><tr>
<td style="padding:5px 0 0 20px">
<div id="bdivoth" style="clear:both;display:none;">
<table class="inpt"><tr><td class="rt">salutation:</td><td>
<input class="i25" name="salut" maxlength="30" size="30" type="text"></td></tr><tr><td class="rt" rowspan="3">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" 
type="text"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text">
</td></tr><tr><td><input class="i25" name="add3" maxlength="35" size="35" type="text">
</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" 
type="text" value="Montreal">&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="QC" 
type="text"></td></tr><tr><td class="rt">postal&nbsp;code:</td><td><input class="i5" name="post" maxlength="7" size="7" type="text" style="text-transform: uppercase;"></td></tr>
<tr><td class="rt">phone:</td><td><input class="i2" name="phone1" maxlength="3" size="3" value="514" 
type="text">&nbsp;<input class="i7" name="phone2" maxlength="10" size="10" type="text"> ext. <input class="i3" name="ext" maxlength="6" size="6" type="text">
</td></tr></table>
</div>
<div id="bdivcur" style="display:none;"><?php 
echo $billName . "#<input type=\"text\" style=\"width:50px\" name=\"baccount\" maxlength=\"12\"><br />";
echo $bcurateur_address . "<input type=\"text\" style=\"width:18px;\" value=\"12\" name=\"betage\" maxlength=\"3\" /><sup>e</sup> " . $bcurateur_address2 . "<br />" . $bcurateur_address3; 
?></div>
<div id="bdivblu" style="display:none;"><?php 
echo $bbluecross_sal . "<br />" . $bbluecross_address;
?><br />client # <input type="text" style="width:80px" name="bacc" maxlength="12"><br />
authorization # <input type="text" style="width:80px" name="bauth" maxlength="15"><br />
provider # <?php echo $bprovider; ?>
</div></td></tr>
</table><input type="hidden" name="mid" value="<?php echo $cMid; ?>" />
<div style="float:right;padding-top:10px"><a href="#" onclick="hideEdit(); return false;"><img src="editor/cancel.png" alt="cancel"
title="CANCEL"  onmouseover="this.src = 'editor/cancel_over.png'" onmouseout="this.src = 'editor/cancel.png'"
/></a>&nbsp;<a
href="#" onclick="document.clientedit.submit(); return false;"><img src="editor/ok.png" alt="save"

title="OK"  onmouseover="this.src = 'editor/ok_over.png'" onmouseout="this.src = 'editor/ok.png'" /></a></div>
<?php } elseif ($cSpec == "dlvr") {

//deliveries
 include '../include/client/cmealsb1.php';

} elseif ($cSpec == "dft") {

//meal defaults
 include '../include/client/cdefaultb1.php';

} elseif ($cSpec == "nfo") {

//change alert
// include '../include/client/cdefaultb1.php';

} elseif ($cSpec == "route") {

//Find anyone else on the same route
$query = "SELECT * FROM client WHERE dRoute LIKE '" . $thsRoute. "' AND mealstatus='A' ORDER BY dStop ASC";
$result = mysql_query($query) or die(mysql_error());
$outputR = "";
$countR = 0;
$midArray = array();
$i=0;
while($row = mysql_fetch_array($result)){
$midArray[$i] = $row['mid'];
$i++;
}

$nMid = count($midArray);
for ($i = 0; $i < $nMid; $i++) {
//use the the Member IDs to get the name and address.
$query = "SELECT * FROM member WHERE mid='" . $midArray[$i] . "'";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
$countR++;
$outputR .=  "<div class=\"or_box\"><input type=\"text\" class=\"or_name\" value=\"" . substr($row['first_name'],0,1) . ". " . $row['last_name'];
$outputR .=  "\" name=\"or_name" . $countR . "\"  id=\"or_name" . $countR . "\" disabled=\"disabled\" /><input type=\"text\" value=\"" . $row['address1'];
$outputR .=  "\" name=\"or_add" . $countR . "\" id=\"or_add" . $countR . "\" disabled=\"disabled\"";
if ($i != 0)
$outputR .= " /><input type=\"button\" value=\"up\" onClick=\" switchBx(" . $countR . "," . ($countR - 1) . ")\" onFocus=\"this.blur()\" class=\"btn\"";
else
$outputR.= "style=\"padding-right:35px\"";
$outputR .= " /><br /><input type=\"text\" value=\"";
$outputR .= $row['address2'] . "\" id=\"or_addb" . $countR . "\" name=\"or_addb" . $countR . "\" disabled=\"disabled\"";
if ($i < ($nMid - 1))
$outputR .= " /><input type=\"button\" value=\"dn\" onClick=\" switchBx(" . $countR . "," . ($countR + 1) . ")\" onFocus=\"this.blur()\" class=\"btn\"";
else
$outputR .= "style=\"padding-right:35px\"";
$outputR .= " /><input type=\"hidden\" name=\"or_mid" . $countR . "\" id=\"or_mid" . $countR . "\" value=\"" . $midArray[$i] . "\">";
$outputR .= "<input type=\"hidden\" name=\"or_stp" . $countR . "\" value=\"" . ($countR) . "\"></div>";
}
 ?>
<form name="clientedit" action="edit.php?&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><table cellpadding="0"
cellspacing="0" style="width:515px;border:0;padding:0;margin:0;"><tr><td
style="width:180px;padding:0;text-align:left;height:38px;"><div class="clName">Add Relationship</div></td><td
style="text-align:right;vertical-align:top;"><img src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table>
<div style="width:480px;padding-left:30px;height:275px;overflow:auto;"><?php echo $outputR; ?></div>
<input type="hidden" name="mid" value="<?php echo $cMid; ?>" /><input type="hidden" name="noStops" value="<?php echo $nMid; ?>">
<div style="float:right;padding-top:10px"><a href="#" onclick="hideEdit(); return false;"><img src="editor/cancel.png" alt="cancel"
title="CANCEL"  onmouseover="this.src = 'editor/cancel_over.png'" onmouseout="this.src = 'editor/cancel.png'"
/></a>&nbsp;<a
href="#" onclick="document.clientedit.submit(); return false;"><img src="editor/ok.png" alt="save"
title="OK"  onmouseover="this.src = 'editor/ok_over.png'" onmouseout="this.src = 'editor/ok.png'" /></a></div>

<?php
 } ?>


</form></div>
  </div>
</div><div id="screen"></div>
</body></html>
