<?php

header("Content-type:application/csv");
header("Content-Disposition:inline;filename=bday_years.csv");

//setup mysql access
	include '../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

$clientlist = array();
$clientage = array();
$clientlang = array();

for($i=1;$i<=12;$i++){
	if ($i < 10)
		$no = "0" . $i;
	else
		$no = $i;
	$query = "SELECT * FROM mowdata.meals" . $no . "_10";
        $result = mysql_query($query);

        //add clients to an array and count them
        while($row = mysql_fetch_array( $result )){
		if(!in_array($row['mid'], $clientlist)){
			$clientlist[] = $row['mid'];
			$q2 = "SELECT * FROM mowdata.client WHERE mid='" . $row['mid']  . "'";
			$r2 = mysql_fetch_array(mysql_query($q2));
			$clientage[$row['mid']] = substr($r2['bday'],0,4);
			$clientlang[$row['mid']] = $r2['clang'];
		}
	}
}

$zero = 0;
$xtra_en=0;
$xtra_fr=0;

echo "YOB,Age,EN,FR,Errors
";
for($i=0;$i < count($clientlist);$i++){
	$year = $clientage[$clientlist[$i]];
	if (($year != "0000") && ($year != "0") && ($year != "2010")) {
		echo $year . "," . (2010 - intval($year)) . ",";
	if ($clientlang[$clientlist[$i]]=="EN")
		echo "1,0";
	else
		echo "0,1";
	echo ",
";
	} else {
		$zero++;
	if ($clientlang[$clientlist[$i]]=="EN")
		$xtra_en++;
	else
		$xtra_fr++;
	}
}
if ($zero){
	$was = "were";
	$eses = "s";
	if ($zero == 1) {
	$was = "was";
        $eses = "";
	}
	echo ",,,,There $was " . $zero . " birthdate$eses that $was invalid!,
              ,,,,$xtra_en excluded individuals spoke primarily English,
              ,,,,$xtra_fr excluded individuals spoke primarily French,";
}
?>
