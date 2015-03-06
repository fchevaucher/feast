<?php
// Make a MySQL Connection
//include './config/mysql_login.php';
//mysql_connect("localhost", $mysqluser, $mysqlpass) or die(mysql_error());
//mysql_select_db("mowdata") or die(mysql_error());

// Create a MySQL table in the selected database
function mkMealTable($mtmonth,$mtyear){
if (isset($mtmonth)){
if (!isset($mtyear))
$mtyear = date('Y');
$query="CREATE TABLE meals" . $mtmonth . "_" . $mtyear . "(
mid MEDIUMINT,
mDate DATE,
mNumber TINYINT,
mPortion CHAR(1),
mSidefs TINYINT,
mSidegs TINYINT,
mSidedd TINYINT,
mSideds TINYINT,
mSidepd TINYINT,
mSidegz TINYINT,
mSidevz TINYINT,
mSidevb TINYINT,
mSuspend TINYINT(1),
last_name VARCHAR(20),
editor VARCHAR(20))";
mysql_query($query) or die(mysql_error());
}
}
?>

