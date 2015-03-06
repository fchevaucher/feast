<?php session_start(); ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link type="text/css" rel="stylesheet" href="theme/default/log.css" /></head>
<body bgcolor="#FFFFFF"><center>
<div style="height:100%;overflow:auto;"><div style="position:absolute; top:50%;left:50%;margin:-165px 0 0 -260px;width:529px;height:317px;background: url(theme/default/img/login.jpg);"><form action="index.php" method="post">
<div style="padding:193px 0 0 355px;text-align:right;"><input type="text" name="f_user" tabindex="1" 
value="" class="txt"><br /><input type="password" tabindex="2" name="mdp" class="txt"><br /><br /><center><input type="submit" value="login" class="fb" /></center></div></form></div></div></center>
<!--[nudlbrain:up]-->
</body></html><?php
session_unset();
session_destroy();  ?>
