<center><table cellpadding="0" cellspacing="1" class="month">
<tr class="hed">
<td>SUN<input type="hidden" id="chk1"></td>
<td>MON<input type="hidden" id="chk2"></td>
<td>TUE<input type="hidden" id="chk3"></td>
<td>WED<input type="hidden" id="chk4"></td>
<td>THU<input type="hidden" id="chk5"></td>
<td>FRI<input type="hidden" id="chk6"></td>
<td>SAT<input type="hidden" id="chk7"></td>
</tr><?php

			$thisMonth = substr($_POST['period'],5,2);
			$thisYear = substr($_POST['period'],0,4);
			$thisTimeStamp = mktime(0, 0, 0, $thisMonth, 1, $thisYear);
			$todTimeStamp = mktime(0, 0, 0, $thisMonth, date('d'), $thisYear);
			$mDays = array();
			$thisFirstDay = date('w',$thisTimeStamp);
			$thisMonthDays = date('t',$thisTimeStamp);

$thisDay = 1;
while($thisDay <= $thisMonthDays) {
		$mdays[sprintf("%02d", $thisDay)] = " class=\"thur\"";
		$thisDay++;
	   }

//next add special days
$query = "SELECT * FROM mowdata.meals_billed where mid=" . $cmid . " ORDER BY date ASC";
$result = mysql_query($query);
while($row = mysql_fetch_array( $result )) {
     if (substr($row['date'],0,7) == $_POST['period'])
	$mdays[substr($row['date'],-2)] = " class=\"meal\"";	
}

$thisDay = 1;
$thisVar=0;
while($thisDay <= $thisMonthDays) {
$thisVar++;
echo "<tr>";
for ($i = 0; $i < 7; $i++) {
$thisID = "d" . $thisVar . ($i+1);
 if(($i >= $thisFirstDay) || (($thisDay + $thisFirstDay) > 7)){
  if ($thisDay <= $thisMonthDays) {
	  echo "<td" . $mdays[sprintf("%02d", $thisDay)]  . "  onClick=\"window.open('billing.php?do=edit&mid=" . $cmid . "&date=" . $thisYear . "-" . $thisMonth . "-" .  sprintf("%02d", $thisDay) . "', '_self', ''); return false; \" id=\"" . $thisID . "\">" . $thisDay . "</td>\n";
  } else
  echo "<td class=\"gray\">&nbsp;</td>";
  $thisDay++;
 } else
 echo "<td class=\"gray\">&nbsp;</td>";
 }
echo "</tr>";
} 
?></table></center>
