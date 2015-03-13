<?php

include './gsession.php';

if(!isset($_GET['set']))
	$_GET['set'] == "user";

if ($_GET['set'] == "admin") {
    if ($usr_settings['usrlevel'] <= 1) {

	//User has insufficient privileges

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /><script type="text/javascript" src="clib/ajax.js"></script><script type="text/javascript" src="js/panel.js"></script><script type="text/javascript" src="editor/editor.js"></script><link type="text/css" rel="stylesheet" href="theme/default/c1.css" /><link type="text/css" rel="stylesheet" href="theme/default/alr3.css" />
</head>
<body bgcolor="#FFFFFF">
<?php include "../include/general/gtop.php";?>
</div></div>
<div class="w8"><table cellpadding="0" cellspacing="0" style="height:138px;margin:90px 0 0;width:374px;">
<tr><td style="vertical-align:top;width:273px;background: url(theme/default/img/alertleft.gif);padding:0;">
<center><br /><div style="padding: 15px 5px 0 5px; color:#fff; font-size:12px;">the user <b><?php echo $usr_settings['displayname']; ?></b> has insufficient<br />privileges to view this page.</b></div><br /><input type="button" value="ok" onClick="window.open('client.php', '_self', ''); return false; " /></center></td>
<td style="width:101px;background: url(theme/default/img/alertright.gif);">&nbsp;</td></tr>
</table></div></center>
</body></html>
<?php

	//halt
	exit;
	} 
}
  
include "../include/settings.php";

?>
