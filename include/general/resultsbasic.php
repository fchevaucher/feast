<?php include "gtop1.php"; 

$volchk = "";
$clientchk = "";
$searchby="";
$qphone = "";
$qaddress = "";

if(isset($_POST['vol'])){
  $volchk = " checked=\"checked\"";
}
if(isset($_POST['client'])){
  $clientchk = " checked=\"checked\"";
  if(isset($_POST['vol']))
    $searchby = " AND (mClient=1 OR mVol=1)";
  else
    $searchby = " AND mClient=1";
} else {
  if(isset($_POST['vol']))
    $searchby = " AND mVol=1";
  else
    $searchby = " AND (mVol=0 AND mClient=0)";
}

if($_POST['qstyle'] == "phone"){
 $qphone = " selected=\"selected\"";
} elseif($_POST['qstyle'] == "address"){
 $qaddress = " selected=\"selected\"";
} 

?></div><br /><br />
<div id="fn" class="w8"><form autocomplete="off" name="mowquery" method="post" action="search.php?do=now"><table 
width="100%" 
border="0" cellpadding="0" cellspacing="0"><tr style="height:20px"><td class="ll" colspan="3">&nbsp;</td><td class="mg">&nbsp;</td>
<td class="rr" rowspan="3">Find members:<br />
&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="vol" value="1"<?php echo $volchk;?> id="chkvol" />&nbsp;&nbsp;<label for="chkvol">Volunteers</label>
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="checkbox" name="client" value="1"<?php echo $clientchk;?> id="chkclient" />&nbsp;&nbsp;<label for="chkclient">Client</label>
<br /><br />Search by:&nbsp;&nbsp;<select name="qstyle">
<option value="phone"<?php echo $qphone; ?>>Phone Number</option>
<option value="address"<?php echo $qaddress; ?>>Address</option>
</select>

</td></tr><tr id="sr"><td>&nbsp;</td><td class="rt"><img src="p1/sr_nd.gif" width="21" height="18" border="0" alt="" /></td>
<td id="sf"><div style="width:248px;height:18px;"><input type="text" id="mq_sr" name="mquery" size="10" value="<?php echo $_POST['mquery']; ?>" /></div>
</td><td class="mg"><img src="p1/arr_r.gif" width="9" height="18" border="0" alt="" /></td></tr>
<tr><td><img src="p1/apup.gif" width="161" height="74" border="0" alt="" /></td><td valign="top">&nbsp;</td><td class="rt"><img src="p1/fdbgr.gif" width="110" height="44" border="0" alt="" /></td><td class="mg">&nbsp;</td></tr></table></form></div><div id="sep" class="w8">&nbsp;</div>
<div id="cn" class="w8"><div style="width:700px"><img src="p1/aplo.gif" width="164" height="66" border="0" alt="" /><div style="float:right;padding:15px 30px 0 0; width:450px;text-align:left;"><?php
	include '/var/www/include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");


$count = 0;
$output = "<table style=\"width:600px\">\n";
if ($_POST['qstyle'] == "phone") {
		$output .= "<tr style=\"font-weight:bold\"><td>First Name</td><td>Last Name</td><td colspan=\"3\">Phone Numbers</td></tr>\n";
		$query = 'SELECT * FROM mowdata.member WHERE (phone LIKE "%' . mysql_real_escape_string($_POST['mquery'])  . '%" or phoneb LIKE "%' . mysql_real_escape_string($_POST['mquery'])  . '%") ' . $searchby . ' ORDER BY first_name';
		$r1 = mysql_query($query);
		while($row = mysql_fetch_array($r1)) {
			$count++;
			$member;
			$output .= "<tr><td>" . $row['first_name'] . "</td><td> " . $row['last_name']  . " </td><td>&nbsp;" . substr($row['phone'],0,3) . "-" . substr($row['phone'],3,3) . "-" . substr($row['phone'],6)   . "</td><td>&nbsp;";
			if (strlen($row['phoneb'])>4)
				$output .= substr($row['phoneb'],0,3) . "-" . substr($row['phoneb'],3,3) . "-" . substr($row['phoneb'],6);
			$output .= "</td><td>";
			if ($row['mVol']==1)
				$output .= "Vol";
			if ($row['mClient']==1){
				if ($row['mVol']==1)
					$output .= ",";
				$output .= "Client";
			}
			$output .= "</td></tr>\n";
		}
		$output .= "<tr><td colspan=\"5\">&nbsp;</td></tr>";
		$output .= "<tr style=\"font-weight:bold\"><td colspan=\"4\" style=\"text-align:right\">Total: </td><td>" . $count . "</td></tr>";
		$output .= "</table>";
} elseif ($_POST['qstyle'] == "address") {
		$output .= "<tr style=\"font-weight:bold\"><td>First Name</td><td>Last Name</td><td>Address</td><td>&nbsp;</td></tr>\n";
		$query = 'SELECT * FROM mowdata.member WHERE (address1 LIKE "%' . mysql_real_escape_string($_POST['mquery'])  . '%" OR address2 LIKE "%' . mysql_real_escape_string($_POST['mquery'])  . '%")' . $searchby . ' ORDER BY first_name';
		$r1 = mysql_query($query);
		while($row = mysql_fetch_array($r1)) {
			$count++;
			$output .= "<tr valign=\"top\"><td>" . $row['first_name'] . "</td><td> " . $row['last_name']  . " </td><td>&nbsp;" . $row['address1'] . "</br>" . $row['address2']   . "</td><td>";
			if ($row['mVol']==1)
				$output .= "Vol";
			if ($row['mClient']==1){
				if ($row['mVol']==1)
					$output .= ",";
				$output .= "Client";
			}
			$output .= "</td></tr>\n";
		}
		$output .= "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		$output .= "<tr style=\"font-weight:bold\"><td colspan=\"3\" style=\"text-align:right\">Total: </td><td>" . $count . "</td></tr>";
		$output .= "</table>";
}

		if($count >= 1)
			echo "<h3>Results:</h3>";
		else
			echo "This query yields no results. Please try a different query.";
?></div></div>
<div id"ct"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="clear:left">
<tr>
<td id="bp">&nbsp;</td>
<td id="cp"><?php
		if($count >= 1)
			echo $output;


?></td></tr></table><br />
</div></div><div class="fbt"><a href="http://www.fireboytech.com">2008 &copy; fireboy technologies</a></div>
</div></div></div>
</center></body></html>
