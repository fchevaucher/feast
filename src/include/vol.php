<?php
/*
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);
/* */
$panel=array();
$panel['currentdb'] = "vol";
$panel['showbranches'] = TRUE; 


$getDo = "home";
if (isset($_GET['do']))
   if ((stripos($getDo,"/") === FALSE) && (stripos($getDo,".") === FALSE))
	$getDo = $_GET['do'];



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="js/panel.js"></script>
<?php
if (($getDo == "home")||($getDo == "show")){
?><script type="text/javascript" src="vlib/ajax.js"></script><link type="text/css" rel="stylesheet" href="theme/default/p1.css" /><link type="text/css" rel="stylesheet" href="vlib/ajax.css" /><?php
}elseif (($getDo == "stats")){
?><script type="text/javascript" src="vlib/stats.js"></script><link type="text/css" rel="stylesheet" href="theme/default/p2.css" /><link type="text/css" rel="stylesheet" href="theme/default/stats.css" /><link type="text/css" rel="stylesheet" href="vlib/ajax.css" /><?php

} elseif (($getDo == "insert") ||($getDo == "modify")){

  //Special Pages

  //These pages show just a dialog box. They have custom branches.
 	$panel['showbranches'] = FALSE;

 ?><link type="text/css" rel="stylesheet" href="theme/default/alr3.css" /><?php
} else {
?><link type="text/css" rel="stylesheet" href="theme/default/p2.css" />
<script type="text/javascript">
function en_drive(){
if (document.all || document.getElementById){
if (document.mowcreate.drvr.checked==true){
document.mowcreate.dlname.disabled=false;
document.mowcreate.dlno.disabled=false;
document.mowcreate.dlexm.disabled=false;
document.mowcreate.dlexy.disabled=false;
document.mowcreate.dlprov.disabled=false;
document.mowcreate.dlname.focus();
} else {
document.mowcreate.dlname.disabled=true;
document.mowcreate.dlno.disabled=true;
document.mowcreate.dlexm.disabled=true;
document.mowcreate.dlexy.disabled=true;
document.mowcreate.dlprov.disabled=true;
}
}
return true;
}
function en_lang(){
if (document.all || document.getElementById){
if (document.mowcreate.lang.value == "other"){
document.mowcreate.lang2.disabled=false;
document.mowcreate.lang2.focus();
} else {
document.mowcreate.lang2.disabled=true;
}
}
return true;
}

</script><?php
}
?></head>
<body bgcolor="#FFFFFF"<?php if (($getDo == "create")||($getDo == "edit")) { echo " onLoad=\"en_drive()\""; } ?>>
<?php

include "../include/general/gtop.php"; 

if (is_readable("../include/vol/v" . $getDo . ".php"))
	include "../include/vol/v" . $getDo . ".php";
 else
	include '../include/vol/vhome.php';


?>
