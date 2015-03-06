<?php
session_start();

if (isset($_SESSION['f_user'])) { 
	//load MySQL Access
	include '../../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	$query = "SELECT * FROM mowdata.usr_settings WHERE usrname='" .	mysql_real_escape_string($_SESSION['f_user']) . "'";
	$result = mysql_query($query) or die("Was unabled to find user data.");
	if(!($usr_settings = mysql_fetch_array($result))){
		echo "Authentication failed.";
		exit;
	}

	if($_SESSION['pass_status'] == $usr_settings['md5phash']) {
		//User Authenticated

//set some variables
$cMid = $_GET['cMid'];
if ($_GET['month'] == "nxt") {
$thisTimeStamp = mktime(0, 0, 0, ($_GET['thisMonth'] + 1), 1, $_GET['thisYear']);
} else
$thisTimeStamp = mktime(0, 0, 0, ($_GET['thisMonth'] - 1), 1, $_GET['thisYear']);
$thisMonth = date('m' , $thisTimeStamp);
$thisYear = date('y' , $thisTimeStamp);
$thisTable = "meals" . $thisMonth . "_" . $thisYear;
$mDays = array();
$thisFirstDay = date('w',$thisTimeStamp);
$thisMonthDays = date('t', $thisTimeStamp);

if ($_GET['dType']=="R") {
$cType="R";
$passWeek = "";
if ($_GET['dMon'] > 0) {
  $wStyleM = " class=\"meal\"";
  $wCheckM = " checked=\"checked\"";
 $passWeek .= "&dMon=1";  
 }else {
  $wStyleM = "";
  $wCheckM = "";
 $passWeek .= "&dMon=0";  
 }
if ($_GET['dTue'] > 0) {
  $wStyleT = " class=\"meal\"";
  $wCheckT = " checked=\"checked\"";
 $passWeek .= "&dTue=1";  
 }else {
  $wStyleT = "";
  $wCheckT = "";
 $passWeek .= "&dTue=0";  
 }
if ($_GET['dWed'] > 0) {
  $wStyleW = " class=\"meal\"";
  $wCheckW = " checked=\"checked\"";
 $passWeek .= "&dWed=1";  
 }else {
  $wStyleW = "";
  $wCheckW = "";
 $passWeek .= "&dWed=0";  
 }
if ($_GET['dThu'] > 0) {
  $wStyleR = " class=\"meal\"";
  $wCheckR = " checked=\"checked\"";
 $passWeek .= "&dThu=1";  
 }else {
  $wStyleR = "";
  $wCheckR = "";
 $passWeek .= "&dThu=0";  
 }
if ($_GET['dFri'] > 0) {
  $wStyleF = " class=\"meal\"";
  $wCheckF = " checked=\"checked\"";
 $passWeek .= "&dFri=1";  
 }else {
  $wStyleF = "";
  $wCheckF = "";
 $passWeek .= "&dFri=0";  
 }
if ($_GET['dSat'] > 0) {
  $wStyleS = " class=\"meal\"";
  $wCheckS = " checked=\"checked\"";
 $passWeek .= "&dSat=1";  
 }else {
  $wStyleS = "";
  $wCheckS = "";
 $passWeek .= "&dSat=0";  
 }
}
?><table cellpadding="0" cellspacing="0" style="width:515px;border:0;padding:0;margin:0;"><tr><td style="width:180px;padding:0;text-align:left;height:38px;">
<div class="clName"><?php echo date('F Y',$thisTimeStamp); ?>&nbsp;</div></td><td style="text-align:right;vertical-align:top;"><img 
src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table>
<table cellpadding="0" cellspacing="0" class="inpte">
<tr><td><a href="javascript:void(0);" onclick="getdata('clib/month.php<?php
echo "?cMid=" . $cMid . "&month=prv&thisMonth=" . $thisMonth . "&thisYear=" . $thisYear . "&dType=" . $cType . $passWeek;
?>','thsMonth');">&lt;</a></td><td><center><table cellpadding="0" cellspacing="1" class="month">
<?php 
if ($cType == "R") {
$chkAdd1 = "<input type=\"checkbox\" name=\"chk";
$chkAdd2 = " onChange=\"updateMonth(";
$chkAdd3 = ")\" id=\"chk";
echo "<tr class=\"top\"><td>&nbsp;</td><td id=\"c2\"";
echo $wStyleM . ">" . $chkAdd1 . "M\"" .  $wCheckM . $chkAdd2 . "2" .  $chkAdd3 . "2\" />&nbsp;</td><td id=\"c3\"";
echo $wStyleT . ">"  . $chkAdd1 . "T\"" .  $wCheckT  . $chkAdd2 . "3" .  $chkAdd3 . "3\" />&nbsp;</td><td id=\"c4\"";
echo $wStyleW . ">"  . $chkAdd1 . "W\"" .  $wCheckW  . $chkAdd2 . "4" .  $chkAdd3 . "4\" />&nbsp;</td><td id=\"c5\"";
echo $wStyleR . ">&nbsp;</td><td id=\"c6\"";
echo $wStyleF . ">"  . $chkAdd1 . "F\"" .  $wCheckF  . $chkAdd2 . "6" .  $chkAdd3 . "6\" />&nbsp;</td><td id=\"c7\"";
echo $wStyleS . ">" . $chkAdd1 . "S\"" .  $wCheckS  . $chkAdd2 . "7" .  $chkAdd3 . "7\" />&nbsp;</td></tr>";
echo "<tr class=\"hed\"><td>SUN</td><td" . $wStyleM . " id=\"d02\">MON</td>";
echo "<td" . $wStyleT . " id=\"d03\">TUE</td><td" . $wStyleW . " id=\"d04\">WED</td>";
echo "<td" . $wStyleR . " id=\"d05\">THU</td><td" . $wStyleF . " id=\"d06\">FRI</td>";
echo "<td" . $wStyleS . " id=\"d07\">SAT</td></tr>";
} else {
	?><tr class="hed">
<td>SUN</td>
<td>MON</td>
<td>TUE</td>
<td>WED</td>
<td>THU</td>
<td>FRI</td>
<td>SAT</td>
</tr><?php
	}
//check if the table exists


$query = "SELECT * FROM meals_scheduled  WHERE mid = '" . $cMid . "' and mDate like '20" . $thisYear . "-" . $thisMonth . "%'";
$result = mysql_query($query);
	while($row = mysql_fetch_array( $result )) {
	 if (substr($row['mDate'],2,2) == $thisYear) {
	 $mdays[substr($row['mDate'],-2)] = " class=\"meal\"";
	 }
	}

//if the client receives regular deliveries,
//add all those days

if ($cType=="R"){
$thisDay = 1;
while($thisDay <= $thisMonthDays) {
		switch(($thisDay+$thisFirstDay+6)%7) {
		case 0:
		//sun
		$mdays[sprintf("%02d", $thisDay)] = " class=\"thur\"";
		break;
		case 1:
		//mon
			if($wStyleM != "")
			$mdays[sprintf("%02d", $thisDay)] = " class=\"meal\"";
		break;
		case 2:
		//tues
			if($wStyleT != "")
			$mdays[sprintf("%02d", $thisDay)] = " class=\"meal\"";
		break;
		case 3:
		//wed
			if($wStyleW != "")
			$mdays[sprintf("%02d", $thisDay)] = " class=\"meal\"";
		break;
		case 4:
		//thur
			$mdays[sprintf("%02d", $thisDay)] = " class=\"thur\"";
		break;
		case 5:
		//fri
			if($wStyleF != "")
			$mdays[sprintf("%02d", $thisDay)] = " class=\"meal\"";
		break;
		case 6:
		//sat
			if($wStyleS != "")
			$mdays[sprintf("%02d", $thisDay)] = " class=\"meal\"";
		break;
		}
		$thisDay++;
	   }
}
//for debugging
//$query = "INSERT INTO " . $thisTable ." (mid, mDate, mNumber) Values ('373','2009-07-15','3')";
//$result = mysql_query($query);

$thisDay = 1;
$thisVar=0;
while($thisDay <= $thisMonthDays) {
$thisVar++;
echo "<tr>";
for ($i = 0; $i < 7; $i++) {
$thisID = "d" . $thisVar . ($i+1);
 if(($i >= $thisFirstDay) || (($thisDay + $thisFirstDay) > 7)){
  if ($thisDay <= $thisMonthDays) {
	  echo "<td" . $mdays[sprintf("%02d", $thisDay)]  ." id=\"" . $thisID . "\">" . $thisDay . "</td>";
  } else
  echo "<td class=\"gray\">&nbsp;</td>";
  $thisDay++;
 } else
 echo "<td class=\"gray\">&nbsp;</td>";
 }
echo "</tr>";
} 
?></table></center>
</td><td><a href="javascript:void(0);" onclick="getdata('clib/month.php<?php
echo "?cMid=" . $cMid . "&month=nxt&thisMonth=" . $thisMonth . "&thisYear=" . $thisYear . "&dType=" . $cType . $passWeek;
?>','thsMonth');">&gt;</a></td></tr></table><?php

	}
}
?>
