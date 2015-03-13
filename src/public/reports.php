<?php 
/*ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
/* */
include './gsession.php';

$panel=array();
$panel['currentdb'] = "client";
$panel['showbranches'] = FALSE; 

if (!isset($_GET['do']))
	$_GET['do'] = "";
//uncomment for debugging
if ($_GET['do'] == "touchbase"){
 if (isset($_POST['route']))
  if ($_POST['route'] == "ALL") {
	include "../include/client/touchbasecsv.php";
	exit;
	}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="editor/editor.js"></script>
<script type="text/javascript" src="js/panel.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
<link type="text/css" rel="stylesheet" href="editor/editor.css" />
<link type="text/css" rel="stylesheet" href="clib/ajax.css" />
<script type="text/javascript" src="clib/ncwid.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" /></head>
<body bgcolor="#FFFFFF">
<?php
include "../include/general/gtop.php";

if(isset($_GET['display'])) {  //function for sorting
		function cmp($a, $b){
			return strcmp($a["last_name"], $b["last_name"]);
		}
	//set some vars
	$yesimg = "<img src=\"\" />";
	$yesimg = "Y";
	$people = array();
	$Mon = 0;
	$Tue = 0;
	$Wed = 0;
	$Thu = 0;
	$Fri = 0;
	$Sat = 0;
	
	//setup mysql access
	include '../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	//find active clients on this route
	$query = "SELECT * FROM mowdata.client WHERE mealstatus= 'A' AND dRoute='" . $_POST['route'] . "'";
	$result = mysql_query($query);

	$i = 0;
	//add clients to an array and count them
	while($row = mysql_fetch_array( $result )){
		$i++;
		$q2 = "SELECT * FROM mowdata.member WHERE mid=" . $row['mid'] ;
		$r2 = mysql_query($q2);
		$person = mysql_fetch_array( $r2 );
		$tmid = $person['mid'];
		$people[$tmid]['first_name'] = $person['first_name'];
		$people[$tmid]['last_name'] = $person['last_name'];
		$people[$tmid]['phone'] = substr($person['phone'],0,3) . "-" . substr($person['phone'],3,3) . "-";
		$people[$tmid]['phone'] .= substr($person['phone'],6);
		$people[$tmid]['lang'] = $row['clang'];
		$people[$tmid]['dtype'] = $row['dType'];
		$people[$tmid]['Mon'] = $row['dMon'];
		$people[$tmid]['Tue'] = $row['dTue'];
		$people[$tmid]['Wed'] = $row['dWed'];
		$people[$tmid]['Thu'] = $row['dThu'];
		$people[$tmid]['Fri'] = $row['dFri'];
		$people[$tmid]['Sat'] = $row['dSat'];
	
		$q2 = "SELECT * FROM mowdata.meals_default WHERE mid=" . $row['mid'] ;
		$r2 = mysql_query($q2);
                $person = mysql_fetch_array( $r2 );
		if ($row['dMon'])
			$people[$tmid]['Mon']=$person['dMonNumber'];
		if ($row['dTue'])
			$people[$tmid]['Tue']=$person['dTueNumber'];
		if ($row['dWed'])
			$people[$tmid]['Wed']=$person['dWedNumber'];
		if ($row['dThu'])
			$people[$tmid]['Thu']=$person['dThuNumber'];
		if ($row['dFri'])
			$people[$tmid]['Fri']=$person['dFriNumber'];
		if ($row['dSat'])
			$people[$tmid]['Sat']=$person['dSatNumber'];
	}

	//sort the array alphabetically by last name
	uasort($people, 'cmp');

	//name route
	switch ($_POST['route']) {
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
		break;
		default:
		$dRoute = "";
	}
	if($dRoute != ""){
	if($i > 0){

		?><br /><br /><div id="cn" class="w8">
		<?php
		echo "There are " . $i . " active clients on " . $dRoute .".";

		echo "<table><tr style=\"background:#ABABAB;color:#fff\"><td style=\"width:150px;\">Last Name</td>";
		echo "<td style=\"width:150px;\">First Name</td><td style=\"width:110px;\">Phone</td><td>Lang</td>";
		echo "<td style=\"width:35px;\"> Mon</td><td style=\"width:35px;\"> Tue</td>";
		echo "<td style=\"width:35px;\"> Wed</td><td style=\"width:35px;\"> Thu</td>";
		echo "<td style=\"width:35px;\"> Fri</td><td style=\"width:35px;\"> Sat</td></tr>";
		while (list($key, $value) = each($people)) {
			echo "<tr><td>" . $people[$key]['last_name'] . "</td><td>" . $people[$key]['first_name'] . "</td><td>";
			echo $people[$key]['phone'] . "</td><td>" . $people[$key]['lang'] . "</td>";
			if($people[$key]['dtype'] != 'R')
				echo "<td colspan='6'><center>episodic delivery</center>";
			else {
				echo "<td style=\"width:35px;background:#EEE\">";
				if($people[$key]['Mon'])
					echo $people[$key]['Mon'];
				echo "</td><td>";
				if($people[$key]['Tue'])
					echo $people[$key]['Tue'];
				echo "</td><td style=\"width:35px;background:#EEE\">";
				if($people[$key]['Wed'])
					echo $people[$key]['Wed'];
				echo "</td><td>";
				//if($people[$key]['Thu'])
				//	echo $people[$key]['Thu'];
				echo "&nbsp;";			
				echo "</td><td style=\"width:35px;background:#EEE\">";
				if($people[$key]['Fri'])
					echo $people[$key]['Fri'];
				echo "</td><td>";
				if($people[$key]['Sat'])
					echo $people[$key]['Sat'];
				echo "</td></tr>";
				$Mon += $people[$key]['Mon'];
				$Tue += $people[$key]['Tue'];
				$Wed += $people[$key]['Wed'];
				//$Thu += $people[$key]['Thu'];
				$Fri += $people[$key]['Fri'];
				$Sat += $people[$key]['Sat'];
			}
			echo "</tr>";
		}
		echo "<tr style=\"background:#ABABAB;color:#fff\"><td colspan=\"4\">&nbsp;</td>";
		echo "<td>$Mon</td><td>$Tue</td><td>$Wed</td><td>$Thu</td><td>$Fri</td><td>$Sat</td></tr></table>";
	} else
		echo "The are no active clients on this route.";
	} else
		echo "ERROR: This route does not exist";
	?><br /><br /><a href="?do=touchbase">&laquo;back</a><?php

} else {
?><form action="?do=touchbase&display=1" method="post">
Select Route: <select name="route">
<option value="CDN">Cotes Des Neiges</option>
<option value="CS">Centre-Sud</option>
<option value="CV">Downtown</option>
<option value="ME">Mile End</option>
<option value="MG">McGill</option>
<option value="MGW">McGill West</option>
<option value="NDG">Notre Dame de Grace</option>
<option value="WM">Westmount</option>
<option value="ALL"> -----------</option>
<option value="ALL">EXPORT ALL AS .CSV</option>
</select>    <input type="submit" value="Display" />
</form><?php
}
?>
 </div>
<div id="screen"></div>
</body></html><?php 
} else {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="editor/editor.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
<link type="text/css" rel="stylesheet" href="editor/editor.css" />
<link type="text/css" rel="stylesheet" href="clib/ajax.css" />
<script type="text/javascript" src="clib/ncwid.js"></script>
<script type="text/javascript" src="js/panel.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" /></head>
<body bgcolor="#FFFFFF">
<?php
include "../include/general/gtop.php";
?><br /><br /><div id="cn" class="w8">
&nbsp;&nbsp;&nbsp;<a href="client.php?do=routesheet">Print Route Sheet</a><br />
&nbsp;&nbsp;&nbsp;<a href="client.php?do=kitchencount">Print Kitchen Count</a><br />
&nbsp;&nbsp;&nbsp;<a href="client.php?do=printlabels">Print Labels</a><br />
&nbsp;&nbsp;&nbsp;<a href="billing.php">Print Monthly Billing Summary</a><br />
&nbsp;&nbsp;&nbsp;<a href="reports.php?do=touchbase">Touch-Base</a><br />
  </div>
<div id="screen"></div>
</body></html><?php 
}
?>
