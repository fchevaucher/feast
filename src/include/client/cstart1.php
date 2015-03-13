<?php

?></div><br /><br />
<div id="fn" class="w8"><form autocomplete="off" name="mowquery"><table 
width="100%" 
border="0" cellpadding="0" cellspacing="0"><tr style="height:20px"><td class="ll" colspan="3">&nbsp;</td><td class="mg">&nbsp;</td>
<td class="rr" rowspan="3">
<ul style="list-style: none;">
<li>&nbsp;&nbsp;&nbsp;<a href="client.php?do=new">add new client</a></li>
<li>&nbsp;&nbsp;&nbsp;<a href="reports.php">generate reports</a></li>
<li>&nbsp;&nbsp;&nbsp;<a href="search.php">special database search</a></li>
</ul>
</td></tr><tr id="sr"><td>&nbsp;</td><td class="rt"><img src="theme/default/p1/sr_nd.gif" width="21" height="18" border="0" alt="" /></td>
<td id="sf"><div style="width:248px;height:18px;"><input type="text" id="mq_sr" name="mquery" size="10"  onkeyup="javascript:autosuggest()"/><div id="mq_ac"></div></div>
</td><td class="mg"><img src="theme/default/p1/arr_r.gif" width="9" height="18" border="0" alt="" /></td></tr>
<tr><td><img src="theme/default/p1/apup.gif" width="161" height="74" border="0" alt="" /></td><td valign="top">&nbsp;</td><td class="rt"><img src="theme/default/p1/fdbgr.gif" width="110" height="44" border="0" alt="" /></td><td class="mg">&nbsp;</td></tr></table></form></div><div id="sep" class="w8">&nbsp;</div>
<div id="cn" class="w8"><div id="ca"><img src="theme/default/p1/aplo.gif" width="164" height="66" border="0" alt="" /></div>
<div id="ct"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="clear:left">
<tr>
<td id="bp">&nbsp;</td>
<td id="cp"><?php
$boutput = "This week's birthdays:<br />";
$currentDay = date('d');
//$currentDay = "13";
$currentMonth = date('m');
//$currentMonth="4";
$gnobdays = 0;
for ($i = 0; $i <= 6; $i++) {
include '/var/www/feastdb/include/config/mysql_login.php';
mysql_connect("localhost", $mysqluser, $mysqlpass);
mysql_select_db("mowdata");
$query = "SELECT * FROM client WHERE (mealstatus='A' or mealstatus='S') AND bday LIKE '%" . 
$currentMonth . "-" . $currentDay . "'";
$result = mysql_query($query);
//date w-day of the week
// store the record of the "example" table into $row
//$row = mysql_fetch_array( $result );
// Print out the contents of the entry
$temp = mktime(0, 0, 0, $currentMonth, $currentDay, date('Y'));
//setlocale(LC_TIME, "fr_FR");
//echo strftime("%A %e %B",$temp);

$nobdays = 0;
$bdays=array();
while($row = mysql_fetch_array( $result )) {
$bdays[$nobdays] = $row['mid'];
$nobdays++;
$gnobdays++;
}
if ($nobdays > 0) {
setlocale(LC_TIME, "C");
$boutput .= strftime("%A %e %B",$temp) . "</br>";
}
for ($j = 0;$j<$nobdays;$j++) {
$query = "SELECT * FROM member WHERE mid = '" . $bdays[$j] . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
$boutput .= "&nbsp;&nbsp;<b>" . $row['first_name'] . " " .  
$row['last_name'] . "</b><br />";
}
$currentDay ++;
}
if ($gnobdays == 0)
$boutput = $l_nocbday;
echo $boutput;
?></td></tr></table><br />
</div></div><div class="fbt"><a href="http://www.fireboytech.com">2008 &copy; fireboy technologies</a></div>
</div></div></div>
</center></body></html>
