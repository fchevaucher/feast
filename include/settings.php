<?php
$panel=array();
$panel['showbranches'] = FALSE; 

if (!isset($_GET['apply']))
	$_GET['apply'] == "";

if ($_GET['apply'] == "admin") {
    if ($usr_settings['usrlevel'] == 1) {
	$ok_url="settings.php?set=user";
	$ok_go="OK";
	$ok_msg="the user <b>" . $usr_settings['displayname'] . "</b> has insufficient<br />privileges to view this page.</b>";
    } elseif ($usr_settings['usrlevel'] < 1) {
	$ok_url="index.php";
	$ok_go="OK";
	$ok_msg="the user <b>" . $usr_settings['displayname'] . "</b> has insufficient<br />privileges to view this page.</b>";
   } else {

   }
} elseif ($_GET['apply'] == "usradm") {
   if ($usr_settings['usrlevel'] <= 1) {
	$ok_url="index.php";
	$ok_go="OK";
	$ok_msg="the user <b>" . $usr_settings['displayname'] . "</b> has insufficient<br />change these settings.</b>";
   } /*elseif ( (isset($_POST['cl1name'])) && (isset($_POST['customlink1']))) {
	$query = "UPDATE usr_settings set cl1name='" . mysql_real_escape_string($_POST['cl1name']) . "', customlink1='" . mysql_real_escape_string($_POST['customlink1']) . "', cl2name='" . mysql_real_escape_string($_POST['cl2name']) . "', customlink2='" . mysql_real_escape_string($_POST['customlink2']) . "', cl3name='" . mysql_real_escape_string($_POST['cl3name']) . "', customlink3='" . mysql_real_escape_string($_POST['customlink3']) . "' WHERE uid='" . $usr_settings['uid'] . "'";
	if(mysql_query($query)) {
		$ok_url="settings.php?set=user";
		$ok_go="OK";
		$ok_msg="Your changes have been<br /><b>successfully</b> saved.";
	} else {
		$ok_url="settings.php?set=user";
		$ok_go="OK";
		$ok_msg="<b>Feast</b>DB was unable to<br /> save your settings.";
	}
   } elseif ( (isset($_POST['newpwd'])) && (isset($_POST['retypepwd'])) && (isset($_POST['oldpwd']))) {

	if (md5($_POST['oldpwd']) != $usr_settings['md5phash']){
		$ok_url="settings.php?set=user";
		$ok_go="OK";
		$ok_msg="your current password was <br /><b>incorrect</b>. no changes were made.";

	} elseif ($_POST['newpwd'] != $_POST['retypepwd']) {
		$ok_url="settings.php?set=user";
		$ok_go="return &raquo;";
		$ok_msg="your new passwords <b>did not<br /> match.</b> please try again.";

	} elseif (strlen($_POST['newpwd']) < 6) {
		$ok_url="settings.php?set=user";
		$ok_go="OK";
		$ok_msg="your new password must be <br /><b>at least 6 characters</b> in length.";

	} else {
		$query = "UPDATE usr_settings set md5phash='" . md5($_POST['newpwd']) . "' WHERE uid='" . $usr_settings['uid'] . "'";
		if(mysql_query($query)) {
			$ok_url="settings.php?set=user";
			$ok_go="OK";
			$ok_msg="Your password was <br /><b>successfully</b> changed.";
		} else {
			$ok_url="settings.php?set=user";
			$ok_go="OK";
			$ok_msg="<b>Feast</b>DB was unable to<br /> change your password.";
		}
	}
   } else {
	$ok_url="settings.php?set=user";
	$ok_go="OK";
	$ok_msg="at least one field was left blank.<br />Please <b>complete all fields</b><br /> and submit again.";
   }*/
} elseif ($_GET['apply'] == "user") {
   if ($usr_settings['usrlevel'] < 1) {
	$ok_url="index.php";
	$ok_go="OK";
	$ok_msg="the user <b>" . $usr_settings['displayname'] . "</b> has insufficient<br />privileges to view this page.</b>";
   } elseif ( (isset($_POST['displayname'])) && (isset($_POST['email'])) && (isset($_POST['language']))) {
	if (strlen($_POST['displayname']) < 3) {
		$ok_url="settings.php?set=user";
		$ok_go="Try Again";
		$ok_msg="you must enter a display name that is<br /><b>at least 3 characters</b> in length.";

	} else {
		$query = "UPDATE usr_settings set displayname='" . mysql_real_escape_string($_POST['displayname']) . "', email='" . mysql_real_escape_string($_POST['email']) . "', lang='" . mysql_real_escape_string($_POST['language']) .  "',  cl1name='" . mysql_real_escape_string($_POST['cl1name']) . "', customlink1='" . mysql_real_escape_string($_POST['customlink1']) . "', cl2name='" . mysql_real_escape_string($_POST['cl2name']) . "', customlink2='" . mysql_real_escape_string($_POST['customlink2']) . "', cl3name='" . mysql_real_escape_string($_POST['cl3name']) . "', customlink3='" . mysql_real_escape_string($_POST['customlink3']) . "' WHERE uid='" . $usr_settings['uid'] . "'";
		if(mysql_query($query)) {
			$ok_url="settings.php?set=user";
			$ok_go="OK";
			$ok_msg="Your changes have been<br /><b>successfully</b> saved.";
		} else {
			$ok_url="settings.php?set=user";
			$ok_go="OK";
			$ok_msg="<b>Feast</b>DB was unable to<br /> save your settings.";
		}
	}
   } elseif ( (isset($_POST['newpwd'])) && (isset($_POST['retypepwd'])) && (isset($_POST['oldpwd']))) {

	if (md5($_POST['oldpwd']) != $usr_settings['md5phash']){
		$ok_url="settings.php?set=user";
		$ok_go="OK";
		$ok_msg="your current password was <br /><b>incorrect</b>. no changes were made.";

	} elseif ($_POST['newpwd'] != $_POST['retypepwd']) {
		$ok_url="settings.php?set=user";
		$ok_go="return &raquo;";
		$ok_msg="your new passwords <b>did not<br /> match.</b> please try again.";

	} elseif (strlen($_POST['newpwd']) < 6) {
		$ok_url="settings.php?set=user";
		$ok_go="OK";
		$ok_msg="your new password must be <br /><b>at least 6 characters</b> in length.";

	} else {
		$query = "UPDATE usr_settings set md5phash='" . md5($_POST['newpwd']) . "' WHERE uid='" . $usr_settings['uid'] . "'";
		if(mysql_query($query)) {
			$ok_url="settings.php?set=user";
			$ok_go="OK";
			$ok_msg="Your password was <br /><b>successfully</b> changed.";
		} else {
			$ok_url="settings.php?set=user";
			$ok_go="OK";
			$ok_msg="<b>Feast</b>DB was unable to<br /> change your password.";
		}
	}
   } else {
	$ok_url="settings.php?set=user";
	$ok_go="OK";
	$ok_msg="at least one field was left blank.<br />Please <b>complete all fields</b><br /> and submit again.";
   }
} elseif ($_GET['set'] == "admin") {
    if ($usr_settings['usrlevel'] == 1) {
	$ok_url="settings.php?set=user";
	$ok_go="OK";
	$ok_msg="the user <b>" . $usr_settings['displayname'] . "</b> has insufficient<br />privileges to view this page.</b>";
    } elseif ($usr_settings['usrlevel'] < 1) {
	$ok_url="index.php";
	$ok_go="OK";
	$ok_msg="the user <b>" . $usr_settings['displayname'] . "</b> has insufficient<br />privileges to view this page.</b>";
   } else {
	$ok_url="index.php";
	$ok_go="OK";
	$ok_msg="this feature has been <b>disabled</b> <br/> until it has been fully developed.</b>";
   }
} elseif ($_GET['set'] == "usradm") {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/panel.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
</head>
<body bgcolor="#FFFFFF">
<?php
	include "../include/general/gtop.php";
 ?><br /><br />
<div id="fn" class="w8"><form autocomplete="off" name="usrsettings" method="post" action="settings.php?apply=links"><table 
width="100%" 
border="0" cellpadding="0" cellspacing="0"><tr style="height:20px"><td>&nbsp;</td></tr>
<tr id="sr"><td colspan="3"><center>Add &amp; Delete Users<br /><br /></center></td></tr>
<tr><td valign="bottom"><img src="theme/default/p1/apup.gif" width="161" height="74" border="0" alt="" /></td><td valign="top" style="padding: 0 5px 20px">
User Administration is currently disabled.</td>
</tr></table></form></div><div id="sep" class="w8">&nbsp;</div>
<div id="cn" class="w8"><div id="ca"><img src="theme/default/p1/aplo.gif" width="164" height="66" border="0" alt="" /></div>
<center><form autocomplete="off"><?php
//temporarily disable submission until feature has been added
//<input type="button" value="Save &raquo;" style="position:relative; top:-40px; margin-bottom:-20px" onClick="document.forms['usrsettings'].submit();" />
?></form></center>
</div><div class="fbt"><a href="http://www.fireboytech.com">2008 &copy; fireboy technologies</a></div>
</div></div></div>
</center></body></html><?php
	exit;
} else {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/panel.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
</head>
<body bgcolor="#FFFFFF">
<?php
	include "../include/general/gtop.php";
 ?><br /><br />
<div id="fn" class="w8"><form autocomplete="off" name="usrsettings" method="post" action="settings.php?apply=user"><table 
width="100%" 
border="0" cellpadding="0" cellspacing="0"><tr style="height:20px"><td>&nbsp;</td></tr>
<tr id="sr"><td colspan="3"><center>General Settings<br /><br /></center></td></tr>
<tr><td valign="bottom"><img src="theme/default/p1/apup.gif" width="161" height="74" border="0" alt="" /></td><td valign="top" style="padding: 0 5px 20px">
Display Name: <input type="text" name="displayname" value="<?php echo $usr_settings['displayname']; ?>" /><br />
Email Address: <input type="text" name="email" value="<?php echo $usr_settings['email']; ?>" /><br />
Language: <select name="language"><option value="EN">EN</option></select><br /><br />
Custom Link Name: <input type="text" name="cl1name" value="<?php echo $usr_settings['cl1name']; ?>" /> Custom URL: <input type="text" name="customlink1" value="<?php echo $usr_settings['customlink1']; ?>" /><br />
Custom Link Name: <input type="text" name="cl2name" value="<?php echo $usr_settings['cl2name']; ?>" /> Custom URL: <input type="text" name="customlink2" value="<?php echo $usr_settings['customlink2']; ?>" /><br />
Custom Link Name: <input type="text" name="cl3name" value="<?php echo $usr_settings['cl3name']; ?>" /> Custom URL: <input type="text" name="customlink3" value="<?php echo $usr_settings['customlink3']; ?>" /><br />
<br/><div style="width:100px;float:right;"><input type="submit" value="Save &raquo;" /></div>
</td></tr></table></form></div><div id="sep" class="w8">&nbsp;</div>
<div id="cn" class="w8"><div id="ca"><img src="theme/default/p1/aplo.gif" width="164" height="66" border="0" alt="" /></div>
<center><div style="width:120px;position:relative;top:-50px;margin-bottom:-20px;">&nbsp;Change Password</div></center>
<div id"ct"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="clear:left">
<tr>
<td id="bp">&nbsp;</td>
<td id="cp"><center><form autocomplete="off" name="usrsettings" method="post" action="settings.php?apply=user" style="width:400px;text-align:right;margin-left:-190px">
Old Password: <input type="password" name="oldpwd" /><br />
New Password: <input type="password" name="newpwd" /><br />
Retype New Password: <input type="password" name="retypepwd" /><br /><br /><input type="submit" value="Apply &raquo;" style="position:relative; left:80px;" />
</form></center>
</td></tr></table><br />
</div></div><div class="fbt"><a href="http://www.fireboytech.com">2008 &copy; fireboy technologies</a></div>
</div></div></div>
</center></body></html><?php
	exit;
} 

if ((!isset($ok_msg)) || ($ok_msg == "")) {
	$ok_url="index.php";
	$ok_go="OK";
	$ok_msg="The URL entered was not valid or<br />did not contain an appropriate request.";
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/panel.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/alr3.css" />
</head>
<body bgcolor="#FFFFFF">
<?php
	$panel['showbranches'] = TRUE; 
 	include "../include/general/gtop.php";
?></div></div>
<div class="w8"><table cellpadding="0" cellspacing="0" style="height:138px;margin:90px 0 0;width:374px;">
<tr><td style="vertical-align:top;width:273px;background: url(theme/default/img/alertleft.gif);padding:0;">
<center><br /><div style="padding: 15px 5px 0 5px; color:#fff; font-size:12px;"><?php echo $ok_msg; ?></div><br /><input type="button" value="<?php echo $ok_go; ?>" onClick="window.open('<?php echo $ok_url; ?>', '_self', ''); return false; " /></center></td>
<td style="width:101px;background: url(theme/default/img/alertright.gif);">&nbsp;</td></tr>
</table></div></center>
</body></html>

