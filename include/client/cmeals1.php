<?php

// View Deliveries

$query = "SELECT * FROM client  WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );


// Print out the contents of the entry
$mPortion = $row['mPortion'];
$wNone = "<span>&nbsp;<br /></span>none";
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

if ($row['dType']=="R") {
$passWeek="";
$cType="R";
$wNone = "<span>&nbsp;<br /></span>none";
 if ($row['dMon']==1) {
  $wStyleM = " class=\"meal\"";
  $wNoneM = "&nbsp;";
  $wCheckM = " checked=\"checked\"";
 $passWeek .= "&dMon=1";    
 }else {
  $wStyleM = "";
  $wNoneM = $wNone;
  $wCheckM = "";
  $passWeek .= "&dMon=0";  
 }
 if ($row['dTue']==1) {
  $wStyleT = " class=\"meal\"";
  $wNoneT = "&nbsp;";
  $wCheckT = " checked=\"checked\"";
 $passWeek .= "&dTue=1";    
 }else {
  $wStyleT = "";
  $wNoneT  =  $wNone;
  $wCheckT = "";
 $passWeek .= "&dTue=0";    
 }
 if ($row['dWed']==1) {
  $wStyleW = " class=\"meal\"";
  $wNoneW = "&nbsp;";
  $wCheckW = " checked=\"checked\"";
  $passWeek .= "&dWed=1";    
 }else {
  $wStyleW = "";
  $wNoneW  =  $wNone;
  $wCheckW = "";
  $passWeek .= "&dWed=0";    
 }
 if ($row['dThu']==1) {
  $wStyleR = " class=\"meal\"";
  $wNoneR = "&nbsp;";
  $wCheckR = " checked=\"checked\"";
  $passWeek .= "&dThu=1";    
   }else {
  $wStyleR = "";
  $wNoneR =  $wNone;
  $wCheckR = "";
  $passWeek .= "&dThu=0";    
 }
 if ($row['dFri']==1) {
  $wStyleF = " class=\"meal\"";
  $wNoneF = "&nbsp;";
  $wCheckF = " checked=\"checked\"";
  $passWeek .= "&dFri=1";    
 }else {
  $wStyleF = "";
  $wNoneF =  $wNone;
  $wCheckF = "";
  $passWeek .= "&dFri=0";    
 }
 if ($row['dSat']==1) {
  $wStyleS = " class=\"meal\"";
  $wNoneS = "&nbsp;";
  $wCheckS = " checked=\"checked\"";
  $passWeek .= "&dSat=1";    
 }else {
  $wStyleS = "";
  $wNoneS =  $wNone;
  $wCheckS = "";
  $passWeek .= "&dSat=0";    
 }

$dWeek = "<div class=\"week\"><div><p class=\"g1\"><span>&nbsp;<br /></span>none</p><p class=\"g2\">sun</p></div><div";
$dWeek .= $wStyleM . "><p class=\"g1\">" . $wNoneM . "</p><p class=\"g2\">mon</p></div><div";
$dWeek .= $wStyleT . "><p class=\"g1\">" . $wNoneT . "</p><p class=\"g2\">tue</p></div><div";
$dWeek .= $wStyleW . "><p class=\"g1\">" . $wNoneW . "</p><p class=\"g2\">wed</p></div><div";
$dWeek .= $wStyleR . "><p class=\"g1\">" . $wNoneR . "</p><p class=\"g2\">thu</p></div><div";
$dWeek .= $wStyleF . "><p class=\"g1\">" . $wNoneF . "</p><p class=\"g2\">fri</p></div><div";
$dWeek .= $wStyleS . "><p class=\"g1\">" . $wNoneS . "</p><p class=\"g2\">sat</p></div></div>";
?><br /><div class="clName">Status</div>
<div style="padding-left:180px;height:14px;">
<?php echo "This " . $dStat . "client receives <b>ongoing</b> meal delivery on <b>" .  $dRoute . "</b>.";
?></div><div class="clName">Meal&nbsp;Days</div>
<div style="height:54px;padding-left:30px"><?php echo $dWeek; ?></div>
<div class="clName">Edit&nbsp;Deliveries</div><div style="padding-left:180px;">
<form name="mowStatus" action="edit.php?change=status&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><input type="button" value="Add or Suspend Deliveries" onClick="showEdit(); return false;" style="margin-left:10px;"/>
<input type="button" value="Change Client Status" onClick="editStatus();" style="margin-left:10px;" id="bStat"/>
<select style="display:none;margin-left:10px;"  id="sStat" onChange="mowStatus.submit()" name="newstatus">
<option value="<?php echo $row['mealstatus']; ?>">Currently: <?php echo $statNow; ?></option>
<option value="A">Active</option>
<option value="S">Stopped</option>
<option value="I">Inactive</option>
</select></form><form name="mowDType" action="edit.php?change=dtype&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><input type="button" value="Change Delivery Type" onClick="editDType();" style="margin-left:10px;" id="bDType"/>
<select style="display:none;margin-left:10px;"  id="sDType" onChange="mowDType.submit()" name="newdtype">
<option value="R">Ongoing</option>
<option value="E">Episodic</option>
</select></form>
</div>
<?php } else {
$cType="E";
	?><br /><div class="clName">Status</div>
	<div style="padding-left:180px;height:14px;">
<?php echo "This " . $dStat . "client receives <b>episodic</b> meal delivery on <b>" .  $dRoute . "</b>.";
?></div><div class="clName">Edit&nbsp;Deliveries</div><div style="padding-left:180px;">
<form name="mowStatus" action="edit.php?change=status&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><input type="button" value="Add or Suspend Deliveries" onClick="showEdit(); return false;" style="margin-left:10px;"/>
<input type="button" value="Change Client Status" onClick="editStatus();" style="margin-left:10px;" id="bStat"/>
<select style="display:none;margin-left:10px;"  id="sStat" onChange="mowStatus.submit()" name="newstatus">
<option value="<?php echo $row['mealstatus']; ?>">Currently: <?php echo $statNow; ?></option>
<option value="A">Active</option>
<option value="S">Stopped</option>
<option value="I">Inactive</option>
</select></form><form name="mowDType" action="edit.php?change=dtype&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><input type="button" value="Change Delivery Type" onClick="editDType();" style="margin-left:10px;" id="bDType"/>
<select style="display:none;margin-left:10px;"  id="sDType" onChange="mowDType.submit()" name="newdtype">
<option value="E">Episodic</option>
<option value="R">Ongoing</option>
</select></form>
</div>
<?php  } ?>
