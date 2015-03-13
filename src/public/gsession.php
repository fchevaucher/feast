<?php
//This file is included in every requested page. It ensures the user is authenticated.

//ensure we have the right timezone
// aka. make PHP interpreter happy
date_default_timezone_set('America/Montreal');

session_start();

if (isset($_SESSION['f_user'])) {
	//A session is already open. Authenticate the stated user.

	//DEL!
	//(eventually delete the following variable since it is unnecessary)
	$f_user = $_SESSION['f_user'];

	//load MySQL Access
    include '../include/config/mysql_login.php';
	mysql_connect(MYSQL_HOST, $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	$query = "SELECT * FROM mowdata.usr_settings WHERE usrname='" .	mysql_real_escape_string($_SESSION['f_user']) . "'";
	$result = mysql_query($query) or die(mysql_error());
	if(!($usr_settings = mysql_fetch_array($result))){
		include "login_fail.php";
		exit;
	}

	if($_SESSION['pass_status'] == $usr_settings['md5phash']) {
		//User Authenticated
		include "../include/lang/" . $usr_settings['lang'] . ".php";
	} else {
		include "login_fail.php";
	exit;
	}
} elseif (isset($_POST['f_user'])) {
	//A session is not open but and authentication attempt is in progress. Authenticate the user.

	//DEL!
	//(eventually delete the following variable since it is unnecessary)
	$f_user = $_POST['f_user'];

	//load MySQL Access
	include '../include/config/mysql_login.php';
	mysql_connect(MYSQL_HOST, $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");

	$query = "SELECT * FROM mowdata.usr_settings WHERE usrname='" .	mysql_real_escape_string($_POST['f_user']) . "'";
	$result = mysql_query($query) or die(mysql_error());

	if(!($usr_settings = mysql_fetch_array($result))){

		include "login_fail.php";
		exit;
	}

	if((md5($_POST['mdp']) == $usr_settings['md5phash']) && (isset($usr_settings['md5phash']))) {

	   //The user was authenticated successfully.
	   //Set up session data.
	   $_SESSION['f_user'] = $f_user;
 	   $_SESSION['pass_status'] = md5($_POST['mdp']);


		//DEL!
		//(eventually delete the following variable since the array is sufficient)
        	$f_user_name=$fullname[$f_user];

		include "../include/lang/" . $usr_settings['lang'] . ".php";

 	} else {
	   include "login_fail.php";
	   exit;
	}
} elseif (isset($_GET['p']) && ($_GET['p']=="login")) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link type="text/css" rel="stylesheet" href="alr3.css" /></head>
<body bgcolor="#FFFFFF">
<center>
<div id="center"><div id="idgroup"><div style="float:left; margin: 0;width:273px; height:138px;background: url(img/alertleft.gif)"><div id="infoalign"><form action="index.php" method="post">
<div id="sur"><input type="text" name="f_user" tabindex="1" value="" class="txt"><input type="password" tabindex="2" name="f_pwrd" class="txt"><br /><br />
<input type="submit" value="login" /></form></div></div><div style="float:left; margin: 0;width:101px; height:138px;background:
url(img/alertright.gif)"> </div></div>
</div></center>
<!-- Following tag included for uptime monitoring -->
<!--[nudlbrain:up]-->
</body></html><?php
	//Exit since the original page that was accessed needs to be blocked.
	exit;
} else {
	//fail
	include "login_fail.php";
	exit;
}
?>
