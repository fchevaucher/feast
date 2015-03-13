<?php
session_start();

if (isset($_SESSION['f_user'])) { 
	//load MySQL Access
	include '../../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	$query = "SELECT * FROM mowdata.usr_settings WHERE usrname='" .	mysql_real_escape_string($_SESSION['f_user']) . "'";
	$result = mysql_query($query) or die("Was unabled to find user data.");
	if(!($usr_settings = mysql_fetch_array($result))){
		exit;
	}

	if($_SESSION['pass_status'] == $usr_settings['md5phash']) {
		//User Authenticated

	$hits = 0;
	$searchq = strip_tags($_GET['q']);
	if(strlen($searchq)>=3){
	$getRecord_sql	=	'SELECT * FROM contacts WHERE last_name LIKE "'.$searchq.'%"';
	$getRecord		=	mysql_query($getRecord_sql);
	while ($row = mysql_fetch_array($getRecord)) {
		if($row['prof'] == 1) {
			if($hits==0)
				echo "<small>Did you mean: </small>";
			else 
				echo "<br />";
			$hits++;
			?><small><a href="edit.php?spec=relate&cwid=<?php echo $row['rid']; ?>&mid=<?php echo $_GET['cMid']; ?>"><?php
			echo $row['first_name'] . " " . $row['last_name'];
			if (substr($row['organ'],0,4) == "CLSC")
				 echo " (CLSC)";?></a>?</small><?php
		}
	}
	//if ($hits == 0)

	// end if strlen > 3
		} 
	}
}
?>
