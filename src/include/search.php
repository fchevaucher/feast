<?php 
//uncomment for debugging
//include	"../include/showerror.php";

if (!(isset($_GET['do']))){
$getDo="unset";
} else {
$getDo =$_GET['do'];
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<?php if (($getDo == "unset")||($getDo == "show")){
?><script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="editor/editor.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/nx1.css" />
<link type="text/css" rel="stylesheet" href="editor/editor.css" />
<?php } else {
  ?><link type="text/css" rel="stylesheet" href="theme/default/nx1.css" /><?php
} ?>
</head>
<body bgcolor="#FFFFFF">
<?php
if ($getDo == "unset"){
  include '../include/general/searchhome.php';
} else {
  include '../include/general/resultsbasic.php';
}
?>
