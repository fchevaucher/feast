<?php 

//Top Panel

?><center><div><div id="tp" class="w8" <?php

//echo 'onClick="vPanelDown()"';

echo 'onMouseOver="vPanelOver()" onMouseOut="vPanelOut()"';

?>><div id="fpanel" class="w8" style="height:1px;clear:both;overflow:hidden;">
<div style="text-align:left;width:200px; float:left; padding:8px 0 0 11px; color: #507F08;"><b>Custom Links</b><br /><?php

    if (trim($usr_settings['cl1name']) != "")
	echo "<a href=\"" . $usr_settings['customlink1'] . "\" style=\"padding-left:10px;\">" . $usr_settings['cl1name'] . "</a><br />";
    if (trim($usr_settings['cl2name']) != "")
	echo "<a href=\"" . $usr_settings['customlink2'] . "\" style=\"padding-left:10px;\">" . $usr_settings['cl2name'] . "</a><br />";
    if (trim($usr_settings['cl3name']) != "")
	echo "<a href=\"" . $usr_settings['customlink3'] . "\" style=\"padding-left:10px;\">" . $usr_settings['cl3name'] . "</a><br />";
	echo "<a href=\"/hack/index.php\" style=\"padding-left:10px;\">Dan's Other</a><br />";
 ?></div><div style="text-align:left;width:200px; float:left; padding:8px 0 0 11px; color: #507F08;"><b>Databases</b><br /><?php

	echo "<a href=\"client.php\" style=\"padding-left:10px;\">" . "ClientDB" . "</a><br />";
	echo "<a href=\"vol.php\" style=\"padding-left:10px;\">" . "VolunteerDB" . "</a><br />";

 ?></div><div style="text-align:left;width:200px; float:right; padding:8px 0 0 11px; color: #507F08;"><b><?php echo $l_settings; ?></b><br /><?php

    if ($usr_settings['usrlevel'] > 1)
	echo "<a href=\"settings.php?set=admin\" style=\"padding-left:10px;\">" . $p_adminset . "</a><br />";
    if ($usr_settings['usrlevel'] > 1)
	echo "<a href=\"settings.php?set=usradm\" style=\"padding-left:10px;\">" . $p_usradm . "</a><br />";
    if ($usr_settings['usrlevel'] > 0)
	echo "<a href=\"settings.php?set=user\" style=\"padding-left:10px;\">" . $p_usrset . "</a><br />";
    echo "<a href=\"logout.php\" style=\"padding-left:10px;\">" . $l_logout . "</a>";

 ?></div>
</div><div id="tu"><div 
class="s15">&nbsp;</div><?php echo $p_currentuser . "<b>" . $usr_settings['displayname'] . "&nbsp;</b>"; 
?><?php
	//echo "&nbsp;&nbsp;&nbsp;" . strtoupper($l_langshort) . "&nbsp;&nbsp;&nbsp;";
?></div><div 
id="tt"><a href="/"><img src="theme/default/p1/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></a></div><div id="tb">&nbsp;</div><?php

?></div><?php

if(!isset($panel)){
	$panel=array();
	$panel['showbranches'] = TRUE;
}

if($panel['showbranches']){
  if($panel['bstyle'] == "light") {
    ?><div class="w8"><div id="ul">&nbsp;</div><div id="ur"><img src="theme/default/branche.gif" width="179" height="64" border="0" alt="" /></div><?php
   } else {
    ?><div class="w8"><div id="ul"><img src="theme/default/p1/brnch1.gif" width="345" 
height="111" border="0" alt="" / align="left"></div><div id="ur"><img 
src="theme/default/p1/brnch2.gif" width="184" height="72" border="0" alt="" 
/></div><?php
   }
 }

?>

