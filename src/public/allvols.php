<?php

header("Content-type:application/csv");
header("Content-Disposition:inline;filename=vol_list.csv");

//setup mysql access
	include '../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	$query = "SELECT * FROM mowdata.member where mVol =1";
        $result = mysql_query($query);

		echo "Last Name, First Name, email, phone,
";
  
	while($row = mysql_fetch_array( $result )){
		echo $row["last_name"] . "," . $row["first_name"] . "," . $row["email"] . "," . $row["phone"] . ",
";
	}
?>
