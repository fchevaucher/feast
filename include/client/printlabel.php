<?php
$printNow = 0;
if (isset($_GET['print']))
$printNow = 1;

if ($printNow == 1)
include '../include/client/labelpdf.php';
else {

$panel=array();
$panel['currentdb'] = "client";
$panel['showbranches'] = TRUE; 

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="clib/ncwid.js"></script>
<script type="text/javascript" src="js/panel.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" /></head>
<body bgcolor="#FFFFFF">
<?php include "../include/general/gtop.php";?><div id="ut"><div id="us"><ul><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
class="pg"><span class="h6"> <br></span>clients</a></li><li 
class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="?do=new"><span class="h6"> <br></span>create new</a></li><li class="sp"><b><span> <br></span> </b></li><li class="df"><a
href="?go=search"><span class="h6"> <br></span>search</a></li></ul></div></div></div><div id="fn" class="w8"><form name="mowcreate" 
action="?do=printlabels&print=now" method="post"><table width="100%" border="0" cellpadding="0"
cellspacing="0">

<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Let's print off the meal labels.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Please select today's meal ingredients:</div><div
style="width:350px;clear:both;text-align:right;">
<table cellspacing="0" style="width:100%;padding:4px;margin:2px;">
<tr><td style="vertical-align:top;">
<input type="checkbox" name="dietr_i1" value="salt" />salt<br />
<input type="checkbox" name="dietr_i2" value="spicy" />spicy<br />
<input type="checkbox" name="dietr_i3" value="choc" />chocolate<br />
<input type="checkbox" name="dietr_i4" value="milk" />dairy<br />
<input type="checkbox" name="dietr_i5" value="msg" />MSG<br />
<input type="checkbox" name="dietr_i6" value="rice" />rice<br />
<input type="checkbox" name="dietr_i7" value="ptat" />potato<br />
</td><td style="vertical-align:top;">
<input type="checkbox" name="dietr_i8" value="nuts" />nuts<br />
<input type="checkbox" name="dietr_i9" value="past" />pasta<br />

<input type="checkbox" name="dietr_i10" value="poul" />poultry<br />
<input type="checkbox" name="dietr_i11" value="ham" />ham<br />
<input type="checkbox" name="dietr_i12" value="pork" />pork<br />
<input type="checkbox" name="dietr_i13" value="beef" />beef<br />
<input type="checkbox" name="dietr_i14" value="veal" />veal<br />
<input type="checkbox" name="dietr_i15" value="fish" />fish<br />
</td></tr></table></div>
</div></div><div class="snd"><input type="submit" value="Make Meal Labels &raquo;" /></div>
</th></tr><tr>
<td rowspan="2"><img src="theme/default/p1/apl.gif" width="138"height="150" border="0"alt="FeastDB" /></td>
<td class="gr"> </td></tr></table></form></div><div class="fbt"><a 
href="http://www.fireboytech.com">2008 © fireboy technologies</a></div>
</div></div></div></center></body></html><?php } ?>
