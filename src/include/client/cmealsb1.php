<?php
//set some variables
$thisMonth = date('m');
$thisYear = date('y');
$thisTable = "meals" . $thisMonth . "_" . $thisYear;
$thisTimeStamp = mktime(0, 0, 0, $thisMonth, 1, $thisYear);
$todTimeStamp = mktime(0, 0, 0, $thisMonth, date('d'), $thisYear);
$mDays = array();
$thisFirstDay = date('w',$thisTimeStamp);
$thisMonthDays = date('t');

?><form name="clientedit" action="edit.php?&spec=<?php echo $cSpec . "&mid=" . $cMid; ?>" method="post"><div id="thsMonth" style="height:320px"><table cellpadding="0"
cellspacing="0" style="width:515px;border:0;padding:0;margin:0;"><tr><td style="width:180px;padding:0;text-align:left;height:38px;">
<div class="clName"><?php echo date('F Y',$thisTimeStamp); ?>&nbsp;</div></td><td style="text-align:right;vertical-align:top;"><img 
src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table>
<table cellpadding="0" cellspacing="0" class="inpte">
<tr><td><a href="javascript:void(0);" onclick="getdata('clib/month.php<?php
echo "?cMid=" . $cMid . "&month=prv&thisMonth=" . $thisMonth . "&thisYear=" . $thisYear . "&dType=" . $cType . $passWeek;
?>','thsMonth');">&lt;</a></td><td><center>
<table cellpadding="0" cellspacing="1" class="month">
<?php 
if ($cType == "R") {
$chkAdd1 = "<input type=\"checkbox\" value=\"1\" name=\"chk";
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
<td>SUN<input type="hidden" id="chk1"></td>
<td>MON<input type="hidden" id="chk2"></td>
<td>TUE<input type="hidden" id="chk3"></td>
<td>WED<input type="hidden" id="chk4"></td>
<td>THU<input type="hidden" id="chk5"></td>
<td>FRI<input type="hidden" id="chk6"></td>
<td>SAT<input type="hidden" id="chk7"></td>
</tr><?php
	}

/*//check if the table exists
$query = "SHOW TABLES FROM mowdata";
$result = mysql_query($query) or die ('error reading database');
$notable  = true;
  while($t = mysql_fetch_assoc($result)){
       foreach($t as $k=>$v){
           if($v == $thisTable){
                $notable = false;
                break;
            }
        }
    }
*/

//if the table doesn't exist make it
//if($notable) {
//if the table doesn't exist make it
//include '../include/client/mkmonth.php';
//mkMealTable($thisMonth,$thisYear);
//} else {
//if the client receives regular deliveries,
//add all those days

if ($cType=="R"){
$thisDay = 1;
//$epiDay = " onClick=\"editMeal(";
//$regDay = " onClick=\"addMeal('";
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

//next add special days
mysql_select_db("mowdata");
$query = "SELECT * FROM meals_scheduled WHERE mid = '" . $cMid . "' and mDate like '20" . $thisYear . "-" . $thisMonth . "-%'";
$result = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array( $result )) {
	if($row['mSuspend']=="1")
	$mdays[substr($row['mDate'],-2)] = " class=\"nomeal\"";
	else
	$mdays[substr($row['mDate'],-2)] = " class=\"meal\"";
	}
//}
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
	  echo "<td" . $mdays[sprintf("%02d", $thisDay)]  . " onClick=\"addMeal('chk" . ($i + 1) . "','" . $thisID . "','" . $thisDay . "')\" id=\"" . $thisID . "\">" . $thisDay . "</td>";
  } else
  echo "<td class=\"gray\">&nbsp;</td>";
  $thisDay++;
 } else
 echo "<td class=\"gray\">&nbsp;</td>";
 }
echo "</tr>";
} 

mysql_select_db("mowdata");
$query = "SELECT * FROM meals_default  WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
$thRow = date('D',$thisTimeStamp);
$dnum = $row['d' . date('D',$todTimeStamp) . 'Number'];

?></table></center>
</td><td><a href="javascript:void(0);" onclick="getdata('clib/month.php<?php
echo "?cMid=" . $cMid . "&month=nxt&thisMonth=" . $thisMonth . "&thisYear=" . $thisYear . "&dType=" . $cType . $passWeek;
?>','thsMonth');">&gt;</a></td></tr></table></div><div id="thsDay" style="height:320px;display:none;"><table cellpadding="0"
cellspacing="0" style="width:515px;border:0;padding:0;margin:0;"><tr><td style="width:180px;padding:0;text-align:left;height:38px;">
<div class="clName"><?php echo date('F',$thisTimeStamp) . "&nbsp;<span id=\"thsDate\">&nbsp;</span>" . date('Y',$thisTimeStamp); ?>&nbsp;</div></td><td style="text-align:right;vertical-align:top;"><img 
src="theme/default/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></td></tr></table><input type="hidden" name="changeType" id="changeType" value="add" /><input type="hidden" name="mDay" id="mDay" value="" /><input type="hidden" name="mMonth" value="<?php echo $thisMonth; ?>" /><input type="hidden" name="mYear" value="<?php echo $thisYear; ?>" />
<div id="thsDemeal" style="padding-left:35px;display:none;">Meal service for this day will be suspended.<br /><div id="spcMeal" style="clear:both;"><input type="button" value="Special Order" onClick="suspMeal()" style="margin:12px 0 0 40px;"/></div></div>
<div id="thsUnmeal" style="padding-left:35px;display:none;">Meal delivery will by cancelled for this day.</div><div id="thsMeal">
<div class="row"><div class="num"><select name="mnumber">
<option<?php
if ($dnum == 1)
echo " selected=\"selected\"";
?>>1</option>
<option<?php
if ($dnum == 2)
echo " selected=\"selected\"";
?>>2</option>
<option<?php
if ($dnum == 3)
echo " selected=\"selected\"";
?>>3</option>
<option<?php
if ($dnum == 4)
echo " selected=\"selected\"";
?>>4</option>
</select></div><div><select class="in8" id="ismeal" name="ismeal" onChange="isMeal()">
<?php
if ($dnum == 0) {
?><option>meal</option>
<option selected="selected">visit</option><?php
} else { 
?><option selected="selected">meal</option>
<option>visit</option><?php
 } ?>
</select></div><div class="mid"<?php
if ($dnum == 0)
echo " style=\"display:none;\"";
$outPortion = '<option value="H">half</option>
<option selected="selected" value="R">regular</option>
<option value="L">large</option>
<option value="D">double</option>';
if ($mPortion == 'H')
$outPortion = '<option value="H" selected="selected">half</option>
<option value="R">regular</option>
<option value="L">large</option>
<option value="D">double</option>';
if ($mPortion == 'L')
$outPortion = '<option value="H">half</option>
<option value="R">regular</option>
<option value="L" selected="selected">large</option>
<option value="D">double</option>';
if ($mPortion == 'D')
$outPortion = '<option value="H">half</option>
<option value="R">regular</option>
<option value="L">large</option>
<option value="D" selected="selected">double</option>';
?>><select class="in6" name="msize" id="msize">
<?php echo $outPortion; ?>
</select>&nbsp;</div></div><?php
$cnt = 0;
for ($i = 1; $i <= 5; $i++) {
switch ($i) {
case 1:
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sideds'];
break;
case 2:
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sidedd'];
break;
case 3:
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sidefs'];
break;
case 4:
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sidegs'];
break;
case 5:
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sidepd'];
break;
default:
$thisVar = "";
$thSel = "";
}
if ($thisVar > 0){
	$cnt++;
?><div class="row" style="clear:both;" id="sd<?php echo $cnt; ?>">
<div class="num"><select name="nosd<?php echo $cnt; ?>"><option <?php
if ($thisVar == 1) echo " selected=\"selected\""; ?>>1</option>
<option<?php if ($thisVar == 2) echo " selected=\"selected\""; ?>>2</option>
<option<?php if ($thisVar == 3) echo " selected=\"selected\""; ?>>3</option>
<option<?php if ($thisVar == 4) echo " selected=\"selected\""; ?>>4</option></select></div><div>
<select class="in8" name="slct<?php echo $cnt; ?>" id="slct<?php echo $cnt; ?>" onChange="changeSide('<?php echo $cnt; ?>')"><option value="sd">side dish</option><option value="gz">newspaper</option><option value="vb">garden basket</option></select></div><div class="mid"><select class="in6" id="dsh<?php echo $cnt; ?>" name="dsh<?php echo $cnt; ?>">
<option value="ds"<?php if ($i == 1) echo " selected=\"selected\""; ?>>dessert</option>
<option value="dd"<?php if ($i == 2) echo " selected=\"selected\""; ?>>diabetic dessert</option>
<option value="fs"<?php if ($i == 3) echo " selected=\"selected\""; ?>>fruit salad</option>
<option value="gs"<?php if ($i == 4) echo " selected=\"selected\""; ?>>green salad</option>
<option value="pd"<?php if ($i == 5) echo " selected=\"selected\""; ?>>pudding</option>
</select>&nbsp;</div><div class="mid"><input type="button" value="remove" onClick="rmvRow('<?php echo $cnt; ?>')" /><input type="hidden" name="skip<?php echo $cnt; ?>" id="skip<?php echo $cnt; ?>" value=""></div>
</div><?php
  }
}
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sidegz'];
if ($thisVar > 0){
	$cnt++;
?><div class="row" style="clear:both;" id="sd<?php echo $cnt; ?>">
<div class="num"><select name="nosd<?php echo $cnt; ?>"><option <?php
if ($thisVar == 1)
echo " selected=\"selected\"";
?>>1</option>
<option<?php
if ($thisVar == 2)
echo " selected=\"selected\"";
?>>2</option>
<option<?php
if ($thisVar == 3)
echo " selected=\"selected\"";
?>>3</option>
<option<?php
if ($thisVar == 4)
echo " selected=\"selected\"";
?>>4</option></select></div><div>
<select class="in8" name="slct<?php echo $cnt; ?>" id="slct<?php echo $cnt; ?>" onChange="changeSide('<?php echo $cnt; ?>')">
<option  value="sd">side dish</option><option selected="selected"  value="gz">newspaper</option><option  value='vb'>garden basket</option></select></div><div class="mid">
<select style="display:none;" class="in6" id="dsh<?php echo $cnt; ?>" name="dsh<?php echo $cnt; ?>"><option  value="ds">dessert</option><option value="dd">diabetic dessert</option><option selected="selected"  value="fs">fruit salad</option><option value="gs">green salad</option><option value="pd">pudding</option></select>&nbsp;</div><div class="mid"><input type="button" value="remove" onClick="rmvRow('<?php echo $cnt; ?>')" /><input type="hidden" name="skip<?php echo $cnt; ?>" id="skip<?php echo $cnt; ?>" value=""></div>
</div><?php
  }
$thisVar = $row['d' . date('D',$todTimeStamp) . 'Sidevb'];
if ($thisVar > 0){
	$cnt++;
?><div class="row" style="clear:both;" id="sd<?php echo $cnt; ?>">
<div class="num"><select name="nosd<?php echo $cnt; ?>"><option <?php
if ($thisVar == 1)
echo " selected=\"selected\"";
?>>1</option>
<option<?php
if ($thisVar == 2)
echo " selected=\"selected\"";
?>>2</option>
<option<?php
if ($thisVar == 3)
echo " selected=\"selected\"";
?>>3</option>
<option<?php
if ($thisVar == 4)
echo " selected=\"selected\"";
?>>4</option></select></div><div>
<select class="in8" name="slct<?php echo $cnt; ?>" id="slct<?php echo $cnt; ?>" onChange="changeSide('<?php echo $cnt; ?>')"><option value="sd">side dish</option><option value="gz">newspaper</option><option value="vb" selected="selected">garden basket</option></select></div><div class="mid"><select class="in6"  style="display:none;" id="dsh<?php echo $cnt; ?>" name="dsh<?php echo $cnt; ?>"><option  value="ds">dessert</option><option value="dd">diabetic dessert</option><option selected="selected"  value="fs">fruit salad</option><option value="gs">green salad</option><option value="pd">pudding</option></select>&nbsp;</div><div class="mid"><input type="button" value="remove" onClick="rmvRow('<?php echo $cnt; ?>')" /><input type="hidden" name="skip<?php echo $cnt; ?>" id="skip<?php echo $cnt; ?>" value=""></div>
</div><?php
  }
$cnt++;  
for ($i = $cnt; $i < 9; $i++) {
	echo "<div class=\"row\" style=\"clear:both;\" id=\"sd" . $cnt . "\"></div>";
}
?><div class="row" style="clear:both;" id="sd2"></div><div class="row" style="clear:both;" id="sd3"></div><div class="row" style="clear:both;" id="sd4"></div><div class="row" style="clear:both;" id="sd5"></div><div class="row" style="clear:both;" id="sd6"></div><div class="row" style="clear:both;" id="sd7"></div><div class="row" style="clear:both;" id="sd8"></div><div class="row" style="clear:both;" id="sd9"></div>
<div style="clear:both;padding:20px 0 0 40px;"><select id="adSide" class="in8" onChange="addSide()">
<option>add item...</option>
<option>side dish</option>
<option>newspaper</option>
<option>garden basket</option>
</select><span style="line-height:7px;"><br /><br /></span><span style="color:#999; padding-right:10px;">make default:</span>
<span style="color:#777; padding-right:10px;">
<input type="checkbox" name="defM" value="1" id="defM" /><label for="defM">Mon</label>
<input type="checkbox" name="defT" value="1" id="defT" /><label for="defT">Tue</label>
<input type="checkbox" name="defW" value="1" id="defW" /><label for="defW">Wed</label>
<input type="checkbox" name="defF" value="1" id="defF" /><label for="defF">Fri</label>
<input type="checkbox" name="defS" value="1" id="defS" /><label for="defS">Sat</label></span>
</div></div></div><input type="hidden" name="mid" value="<?php echo $cMid; ?>" />
<div style="float:right;padding-top:10px"><a href="#" onclick="cancelChange()"><img src="editor/cancel.png"
alt="cancel"
title="CANCEL"  onmouseover="this.src = 'editor/cancel_over.png'" onmouseout="this.src = 'editor/cancel.png'"
/></a>&nbsp;<a
href="#" onclick="document.clientedit.submit(); return false;"><img src="editor/ok.png" alt="save"
title="OK"  onmouseover="this.src = 'editor/ok_over.png'" onmouseout="this.src = 'editor/ok.png'" /></a></div>
<script type="text/javascript">
var noSides = <?php echo $cnt; ?>;
</script>
