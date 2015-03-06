<?php 
//uncomment for debugging
//include	"../include/showerror.php";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="js/panel.js"></script>
<script type="text/javascript" src="theme/default/editor/editor.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
<link type="text/css" rel="stylesheet" href="editor/editor.css" />
<link type="text/css" rel="stylesheet" href="clib/ajax.css" />
<script type="text/javascript" src="clib/ncwid.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" /></head>
<body bgcolor="#FFFFFF">
<?php
include "../include/general/gtop.php";

	if($_GET['do']=="edit") {
		if($_GET['mid'] > 1) {

			$cmid = mysql_real_escape_string($_GET['mid']);
			//is the month and year set?
			if(isset($_POST['period'])) {
				$query = "SELECT * FROM mowdata.member where mid=" . $cmid;
				$result = mysql_query($query);
				$row = mysql_fetch_array( $result );
				$firstname=$row['first_name'];
				$lastname=$row['last_name'];
				echo "Edit billing info for " . $firstname . " " . $lastname . ":";
				
				include '../include/client/bill_calendar.php';

			} elseif(isset($_GET['date'])) {
				$query = "SELECT * FROM mowdata.member where mid=" . $cmid ;
				$result = mysql_query($query);
				$row = mysql_fetch_array( $result );
				$firstname=$row['first_name'];
				$lastname=$row['last_name'];
				$edate = mysql_real_escape_string($_GET['date']); 
			
				if(isset($_POST['change'])) {
					$cReason = mysql_real_escape_string($_POST['reason']);
					if($_POST['change']=="nocharge") {
						$query = "UPDATE mowdata.meals_billed SET nocharge=1,mNumber=0,mSidedd=0,mSideds=0,mSidefs=0,mSidegs=0,mSidepd=0,mSidegz=0,mSidevb=0,mSidevz=0,reason=\"" . $cReason . "\",editor=\"" . $f_user . "\" where mid=" . $cmid . " and date=\"" . $edate . "\"";
						$result = mysql_query($query);
						echo "Update success. Client will not be charged for this day.";
					} elseif($_POST['change']=="delete") {
						if (strlen($cReason) < 3)
							$cReason = "No meal was delivered.";
						$query = "UPDATE mowdata.meals_billed SET mNumber=0,mSidedd=0,mSideds=0,mSidefs=0,mSidegs=0,mSidepd=0,mSidegz=0,mSidevb=0,mSidevz=0,reason=\"" . $cReason . "\",editor=\"" . $f_user . "\" where mid=" . $cmid . " and date=\"" . $edate . "\"";
						$result = mysql_query($query);
						echo "Update success. Client did not receive any delivery for this day and will not be charged.";
					} elseif($_POST['change']=="modify") {
						$query = "UPDATE mowdata.meals_billed SET mNumber=" . mysql_real_escape_string($_POST['mealno']) . ",mSidedd=" . mysql_real_escape_string($_POST['sdd']) . ",mSideds=" . mysql_real_escape_string($_POST['sds']) . ",mSidefs=" . mysql_real_escape_string($_POST['sfs']) . ",mSidegs=" . mysql_real_escape_string($_POST['sgs']) . ",mSidepd=" . mysql_real_escape_string($_POST['spd']) . ",mSidegz=" . mysql_real_escape_string($_POST['sgz']) . ",mSidevb=" . mysql_real_escape_string($_POST['svb']) . ",reason=\"" . $cReason . "\",editor=\"" . $f_user . "\" where mid=" . $cmid . " and date=\"" . $edate . "\"";
						$result = mysql_query($query);
						echo "Feature is not enabled.";
					} else {
						echo "The type of change to make was not specified.";
					}
					echo "<br /><a href=\"client.php?do=show&mid=" . $cmid . "\">&raquo; return</a> to member profile.";
				} else {

					$query = "SELECT * FROM mowdata.meals_billed where mid=" . $cmid . " and date=\"" . $edate . "\"";
					$result = mysql_query($query);
					if ($row = mysql_fetch_array( $result )) {
						echo "Edit billing info for " . $firstname . " " . $lastname . ":<br /><br />";
						echo "<form name=\"editnc\" action=\"billing.php?do=edit&mid=" . $cmid . "&date=" . $edate . "\" method=\"post\">Reason: <textarea id=\"rchange1\" name=\"reason\" onBlur=\"rchange2.value=rchange1.value; rchange3.value=rchange1.value;\" maxlength=\"80\" ></textarea><br /><br /><input type=\"hidden\" name=\"change\" value=\"nocharge\" /><input type=\"submit\" value=\"No Charge &raquo;\" /></form><br />";
						echo "<form name=\"editnm\" action=\"billing.php?do=edit&mid=" . $cmid . "&date=" . $edate . "\" method=\"post\"><input type=\"hidden\" id=\"rchange2\" name=\"reason\" value=\"\" /><input type=\"hidden\" name=\"change\" value=\"delete\" /><input type=\"submit\" value=\"No Meal Delivered &raquo;\" /></form><br />";
						echo "<form name=\"editch\" action=\"billing.php?do=edit&mid=" . $cmid . "&date=" . $edate . "\" method=\"post\" style=\"border:1px soldi #000\"><input type=\"hidden\" id=\"rchange3\" name=\"reason\" value=\"\" /><input type=\"hidden\" name=\"change\" value=\"modify\" />";
						echo "<div style=\"width:190px;text-align:left;\"><u>Meals</u><br />&nbsp;&nbsp;&nbsp;Number: &nbsp;<input type=\"text\" value=\"" . $row['mNumber'] . "\" name=\"mealno\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "<br /><u>Sides</u><br />&nbsp;&nbsp;&nbsp;Desserts: &nbsp;<input type=\"text\" value=\"" . $row['mSideds'] . "\" name=\"sds\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "&nbsp;&nbsp;&nbsp;Diabetic Desserts: &nbsp;<input type=\"text\" value=\"" . $row['mSidedd'] . "\" name=\"sdd\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "&nbsp;&nbsp;&nbsp;Fruit Salads: &nbsp;<input type=\"text\" value=\"" . $row['mSidefs']. "\" name=\"sfs\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "&nbsp;&nbsp;&nbsp;Green Salads: &nbsp;<input type=\"text\" value=\"" . $row['mSidegs'] . "\" name=\"sgs\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "&nbsp;&nbsp;&nbsp;Puddings: &nbsp;<input type=\"text\" value=\"" . $row['mSidepd'] . "\" name=\"spd\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "&nbsp;&nbsp;&nbsp;Gazette: &nbsp;<input type=\"text\" value=\"" . $row['mSidegz'] . "\" name=\"sgz\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "&nbsp;&nbsp;&nbsp;Vege Basket: &nbsp;<input type=\"text\" value=\"" . $row['mSidevb'] . "\" name=\"svb\" maxlength=\"2\" style=\"width:20px\" /><br />";
						echo "</div><input type=\"submit\" value=\"Modify Record &raquo;\" /></form><br />";
	
					} else 
						echo "There is no entry for this day."; 
				}

			} else {
				?><br /><br /><div id="cn" class="w8">
				<form action="billing.php?do=edit&mid=<?php echo $cmid; ?>" method="post">
				Edit Billing History for: <select name="period"><?php
				  mysql_select_db("mowdata");

				$month_list=array(1 => "January",
											2 => "February",
											3 => "March",
											4 => "April",
											5 => "May",
											6 => "June",
											7 => "July",
											8 => "August",
											9 => "September",
											10 => "October",
											11 => "November",
											12 => "December");
						
				// ie. latest meal
				$query = "SELECT * FROM meals_billed ORDER BY date DESC LIMIT 0,1";
				$row = mysql_fetch_array(mysql_query($query));
				$thsmonth = intval(substr($row['date'],5,2));
				$thsyear = intval(substr($row['date'],0,4));

				// ie. earliest meal
				$query = "SELECT * FROM meals_billed ORDER BY date ASC LIMIT 0,1";
				$row = mysql_fetch_array(mysql_query($query));
				$endmonth = intval(substr($row['date'],5,2));
				$endyear = intval(substr($row['date'],0,4));

				$error_catch = 0;

				// loop from current month backwards
				while($endyear <= $thsyear){

					$addzero = ($thsmonth < 10) ? "0" : "";
					echo "<option value=\"" . $thsyear ."-" . $addzero . $thsmonth . "\">";
					echo $month_list[$thsmonth] . " " . $thsyear;
					echo "</option>\n";

					$thsmonth--;

					$error_catch++;
				        if (($endyear == $thsyear) && ($endmonth > $thsmonth))
						break;
					if ($thsmonth == 0) {
						$thsmonth=12;
						$thsyear--;
					}
					if ($error_catch > 1000)
						die("Encountered a critical error. ERR: 2VK1");

				}

				?>
				</select>    <input type="submit" value="Edit" /></form>
				  </div>
				<div id="screen"></div>
				</body></html><?php
			}
		} else 
		   echo "Error no client selected.";

	} else {
?><br /><br /><div id="cn" class="w8">
<form action="billing.php?do=print" method="post">
Print Billing Summary for: <select name="month"><?php
  mysql_select_db("mowdata");
				$month_list=array(1 => "January",
											2 => "February",
											3 => "March",
											4 => "April",
											5 => "May",
											6 => "June",
											7 => "July",
											8 => "August",
											9 => "September",
											10 => "October",
											11 => "November",
											12 => "December");
						
				$query = "SELECT * FROM meals_billed ORDER BY date ASC LIMIT 0,1";
				$row = mysql_fetch_array(mysql_query($query));
				$thsmonth = intval(substr($row['date'],5,2));
				$thsyear = intval(substr($row['date'],0,4));

				$query = "SELECT * FROM meals_billed ORDER BY date DESC LIMIT 0,1";
				$row = mysql_fetch_array(mysql_query($query));
				$endmonth = intval(substr($row['date'],5,2));
				$endyear = intval(substr($row['date'],0,4));

				$error_catch = 0;

				while($endyear >= $thsyear){

					$addzero = ($thsmonth < 10) ? "0" : "";
					echo "<option value=\"" . $thsyear ."-" . $addzero . $thsmonth . "\">";
					echo $month_list[$thsmonth] . " " . $thsyear;
					echo "</option>\n";
					$thsmonth++;
					$error_catch++;
				        if (($endyear == $thsyear) && ($endmonth < $thsmonth))
						break;
					if ($thsmonth > 12) {
						$thsmonth=1;
						$thsyear++;
					}
					if ($error_catch > 1000)
						die("Encountered a critical error. ERR: 2VK1");

				}

?>
</select>    <input type="submit" value="Print" /></form>
  </div>
<div id="screen"></div>
</body></html><?php } ?>
