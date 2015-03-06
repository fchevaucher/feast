<?php

// View Deliveries

$query = "SELECT * FROM client  WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );


// Print out the contents of the entry
$mPortion = $row['mPortion'];
$dRoute = "unknown";
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
$statNow = "Active";
  break;
case "I":
$dStat = "<b>inactive</b> ";
$statNow = "Inactive";
break;
case "S":
$dStat = "<b>stopped</b> ";
$statNow = "Stopped";
}


?><br /><div class="clName">Monday</div>
<div style="padding-left:180px;height:14px;">
<?php 
function dailydefault($dd){
	mysql_select_db("mowdata");
	$query = "SELECT * FROM meals_default  WHERE mid = '" . $_GET["mid"] . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array( $result );
	echo $row['d' . $dd . 'Number'] . " " . $row['dPortion'] .  " meal";
	if ($row['d' . $dd . 'Number'] > 1)
		echo "s";
	if ($row['d' . $dd . 'Sideds'] > 0)
		echo "<br />" . $row['d' . $dd . 'Sideds'] . " desert";
	if ($row['d' . $dd . 'Sidedd'] > 0)
	        echo "<br />" . $row['d' . $dd . 'Sidedd'] . " diabetic desert";
	if ($row['d' . $dd . 'Sidefs'] > 0)
	        echo "<br />" . $row['d' . $dd . 'Sidefs'] . " fruit salad";
	if ($row['d' . $dd . 'Sidegs'] > 0)
	        echo "<br />" . $row['d' . $dd . 'Sidegs'] . " green salad";
	if ($row['d' . $dd . 'Sidepd'] > 0)
	        echo "<br />" . $row['d' . $dd . 'Sidepd'] . " pudding";
	if ($row['d' . $dd . 'Sidegz'] > 0)
	        echo $row['d' . $dd . 'Sidegz'] . " gazette";
}
dailydefault("Mon");
?></div><br /><div class="clName">Tuesday</div>
<div style="padding-left:180px;height:14px;">
<?php 
dailydefault("Tue");
?></div><br /><div class="clName">Wednesday</div>
<div style="padding-left:180px;height:14px;">
<?php
dailydefault("Wed");
?></div><br /><div class="clName">Thursday</div>
<div style="padding-left:180px;height:14px;">
No deliveries today.
</div><br /><div class="clName">Friday</div>
<div style="padding-left:180px;height:14px;">
<?php
dailydefault("Fri");
?></div><br /><div class="clName">Saturday</div>
<div style="padding-left:180px;height:14px;">
<?php
dailydefault("Sat");
?></div><br /><br />
</div>
</div>
