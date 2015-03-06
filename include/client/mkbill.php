<?php
// Make a MySQL Connection
//include '../include/config/mysql_login.php';
//mysql_connect("localhost", $mysqluser, $mysqlpass) or die(mysql_error());
//mysql_select_db("mowdata") or die(mysql_error());
function chkBillingTable($month,$year){
	mysql_select_db("mowbilling") or die(mysql_error());
	$result = mysql_list_tables("mowbilling") or die(mysql_error());
	$table = "meals" . $month . "_20" . $year;
	while ($row = mysql_fetch_row($result)) {
		if($row[0]==$table)
			return 1;
	}
	return 0;
}


function mkBillingTable($btmonth,$btyear){
if ((isset($btyear))&(isset($btyear))){
	if (chkBillingTable($btmonth,$btyear)==1)
		exit;
// Create a MySQL table in the selected database
//note meal_x2 = double portion charge
$query = "CREATE TABLE mowbilling.meals" . $btmonth . "_20" . $btyear ." (
  date date  NOT NULL,
  mid mediumint(7) UNSIGNED NOT NULL,
  mNumber smallint(2) UNSIGNED,
  mSize varchar(1) ,
  mSidedd smallint(2) UNSIGNED,
  mSideds smallint(2) UNSIGNED,
  mSidefs smallint(2) UNSIGNED,
  mSidegs smallint(2) UNSIGNED,
  mSidepd smallint(2) UNSIGNED,
  mSidegz smallint(2) UNSIGNED,
  mSidevb smallint(2) UNSIGNED,
  mSidevz smallint(2) UNSIGNED,
  nocharge tinyint(1),
  reason varchar(80),
  editor varchar(20))";

//uncomment to test query output
//echo $query;
mysql_query($query) or die(mysql_error());
return true;
}
}
//example: for 2009, enter mkBillingTable("09");

?>
