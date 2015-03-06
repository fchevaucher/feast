<?php
//variables for new entry creation

//address due curateur public
$bcurateur_address = "600 Boul. René Lévesque Ouest, ";
$bcurateur_address2 = "étage";
$bcurateur_address3 = "Montréal, Québec  H3B 4W9";

//dropdown menu of relative types
$select_relative = '
<option>case worker</option>
<option>nurse</option>
<option>dietician</option>
<option>physiotherapist</option>
<option>doctor</option>
<option>next of kin</option>
<option>husband</option>
<option>grandchild</option>
<option>wife</option>
<option>mother</option>
<option>father</option>
<option>brother</option>
<option>sister</option>
<option>friend</option>
<option>guardian</option>
<option>daughter</option>
<option>son</option>';

?><center><div><div id="tp" class="w8"><div id="tu"><div class="s15"> </div><b>Patrick </b>  EN  FR  <a 
href="logout.php">log out</a></div><div id="tt"><img src="theme/default/p1/fdbsm.gif" width="67" height="31" border="0" alt="FeastDB" /></div><div id="tb"> </div></div>
<div class="w8"><div id="ul"><img src="theme/default/p1/brnch1.gif" width="345" height="111" border="0" alt="" / align="left"></div><div id="ur"><img src="theme/default/p1/brnch2.gif" width="184" height="72" border="0" alt="" /></div><div id="ut"><div id="us"><ul><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="bio.php"><span class="h6"> <br></span>adv. search</a></li><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
class="pg" href="resources.php"><span class="h6"> <br></span>clients</a></li><li 
class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="resources.php"><span class="h6"> <br></span>create new</a></li><li class="sp"><b><span> <br></span> </b></li><li class="df"><a
href="?go=search"><span class="h6"> <br></span>search</a></li></ul></div></div></div>
<div id="fn" class="w8"><form name="mowcreate" onReset="return confirm('Do you really want to reset the form?')"  action="?do=create" method="post"><table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr>
<tr id="sr">
<td class="ll"><div style="padding:0 0 0 15px;color:#CCCCCC;"><span id="stg1" style="color:#000000;">1. Biography</span><br /><span 
id="stg2">2. Service Details</span><br /><span id="stg3">3. Relationship</span><br /><span id="stg4">4. Diet</span><br /><span 
id="stg5">5. Billing</span><br /><span id="stg6">6.  Notes/Alerts</span><br /><span id="stg6">&raquo; Create Account<br 
/><br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div id="cin1">
 first name: <input class="i13" type="text" name="f_name" maxlength="20" size="10" id="firstName" />
 middle: <input class="i13" type="text" name="m_name" maxlength="20" size="10" />
 last name: <input class="i13" type="text" name="l_name" id="lastName" maxlength="20" size="10" />
<br />
 address1: <input class="i25" type="text" name="add1" maxlength="35" size="35" /> address2: <input class="i25" type="text" name="add2" maxlength="35" size="35" />
<br />
 city: <input class="i25" type="text" name="city" maxlength="25" size="25" />
<br />
 province/state: <input class="i2" type="text" name="prov" maxlength="2" size="2" value="QC" />
  postal code: <input class="i5" type="text" 
name="post" maxlength="7" size="7" /><br />
 email: <input class="i25" type="text" name="email" maxlength="45" size="10" />
<br />
 phone <input class="i2" type="text" name="phone1" maxlength="3" size="3"  value="514" /> <input class="i7" type="text" name="phone2" maxlength="10" size="10" />    phone 2 <input class="i2" type="text" name="phoneb1" maxlength="3" size="3"  value="514" /> <input class="i7" type="text" name="phoneb2" maxlength="10" size="10" />
<br />
Gender: <select style="width:45px;margin-right:2px" name="dlexpm" id="dlexpm">
<option value="F">Female</option>
<option value="M" >Male</option>
<option value="U" >Unknown</option>
</select><br />Birthday:
<select style="width:31px;margin-right:2px" name="bdayd">
<option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option>
<option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option>
<option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option>
<option>30</option><option>31</option>
</select>
<select style="width:45px;margin-right:2px" name="bdaym">
<option value="01">Jan</option><option value="02" >Feb</option><option value="03" >Mar</option><option value="04" >Apr</option>
<option value="05" >May</option><option value="06" >Jun</option><option value="07" >Jul</option><option value="08" >Aug</option>
<option value="09" >Sep</option><option value="10" >Oct</option><option value="11" >Nov</option><option value="12" >Dec</option>
</select> year: <input class="i3" type="text" name="bdayy" maxlength="4" size="4" />
<br />intake date:<select style="width:31px;margin-right:2px" name="odayd">
<option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option>
<option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option>
<option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option>
<option>30</option><option>31</option>
</select>
<select style="width:45px;margin-right:2px" name="odaym">
<option value="01">Jan</option><option value="02" >Feb</option><option value="03" >Mar</option><option value="04" >Apr</option>
<option value="05" >May</option><option value="06" >Jun</option><option value="07" >Jul</option><option value="08" >Aug</option>
<option value="09" >Sep</option><option value="10" >Oct</option><option value="11" >Nov</option><option value="12" >Dec</option>
</select> year: <input class="i3" type="text" name="odayy" maxlength="4" size="4" value="<?php echo date('Y'); ?>" /><br />
 First language: 
<select style="width:60px;margin-right:2px" name="lang" id="lang" onChange="en_lang()">
<option value="EN">English</option>
<option value="FR" >French</option>
<option value="ES" >Spanish</option>
<option value="DE" >German</option>
<option value="PG" >Portuguese</option>
<option value="JP" >Japanese</option>
<option value="RS" >Russian</option>
<option value="other" >other...</option>
</select><br />
 Language of correspondance: <select style="width:60px;margin-right:2px" name="olang" id="olang">
<option value="EN">English</option>
<option value="FR" >French</option>
<option value="EF" >Either</option>
</select><br /><input type="checkbox" name="cdiff1" value="ed">Expressive Difficulty<input type="checkbox" name="cdiff2" value="hh">Hard 
of 
Hearing<br/>
<div id="snd"><input type="button" class="nxt" value="Next »" onClick="cinNext(1)" /></div>
</div>
<div id="cin2" style="display:none;"><br />
 Reason for referral:<br />
<input type="checkbox" name="rref1" value="loa">Loss of Autonomy<br />
<input type="checkbox" name="rref2" value="iso">Social Isolation<br />
<input type="checkbox" name="rref3" value="fin">Financial Difficulty<br />
<input type="checkbox" name="rref4" value="mal">Malnutrition<br />
<input type="checkbox" name="rref5" value="cog">Cognitive Problems<br />
<input type="checkbox" name="rref6" value="mob">Reduced Mobility<br />
<input type="checkbox" name="rref7" value="vis">Visually Impaired<br />
<input type="checkbox" name="rref8" value="lva">Lives Alone<br />
<br />
Refferal Notes: <br /><textarea rows="3" cols="20" style="width:270px;" name="notes"></textarea>
<br />Delivery  Type: <select style="width:85px;margin-right:2px" name="dtype">
<option value="">Episodic</option>
<option value="">Regular</option>
</select><br/>Delivery Route: <select style="width:85px;margin-right:2px" name="routen">
<option>Centre Sud</option>
<option>Cote De Neiges</option>
<option>Mile End</option>
<option>McGill</option>
<option>McGill West</option>
<option>Notre Dame de Grace</option>
<option>Downtown</option>
<option>Westmount</option>
</select><br />
Directions: <textarea rows="3" cols="20" style="width:270px;" name="directions"></textarea>
<br />
<div id="snd"><input type="button" class="nxt" value="« Previous" onClick="cinPrev(2)" /> <input type="button" value="Next »" onClick="cinNext(2)" /></div></div>
<div id="cin3" style="display:none;">
<div style="width:630px; margin:1px 5px; border: 1px solid #456F06;clear:both;display:none" id="rel_sumparent"><?php
//make the relationships summary bars
for ($i = 1; $i < 4; $i++) {
?><div id="rel_sum<?php echo $i; ?>" style="padding:3px 5px;display:none;<?php
if ( $i&1 ) {
echo "background:none;";
} else {
echo "background:#456F06;";
} ?>"><input type="text" disabled="disabled" 
style="border:0;background:none;color:#fff;font-size:10px;padding:0;margin:0;width:100px;"
id="sumshowR<?php echo $i; ?>" />
<input type="text" disabled="disabled" style="border:0;background:none;color:#fff;font-size:10px;padding:0;margin:0;width:130px;" 
id="sumshowN<?php echo $i; ?>" />
<input type="text" disabled="disabled" style="border:0;background:none;color:#fff;font-size:10px;padding:0;margin:0;width:0px;"
id="sumshowO<?php echo $i; ?>" /><input type="button" value="edit" onClick="relsReopen(<?php echo $i; ?>)" />
</div>
<?php
}
// end make summary bars ?></div><?php
// make relationship forms 
for ($i = 1; $i < 4; $i++) {
?><div style="width:630px; margin:0 5px 2px; border:0;clear:both<?php
if($i != 1 ) echo ";display:none";
?>" id="relform<?php echo $i; ?>"><div style="padding:5px;"><table class="inpt"><tr>
<td class="rt">first name:</td><td><input class="i13" type="text" name="relf_name<?php echo $i; ?>" maxlength="20" size="10" 
id="relFname<?php echo $i; ?>" />
 last name: <input class="i13" type="text" name="rell_name<?php echo $i; ?>" id="relLname<?php echo $i; ?>" maxlength="20" size="10" />
</tr><tr><td class="rt">relationship:<div id="relOdiv<?php echo $i; ?>"  
style="padding-top:2px;">organization:</div></td><td><select 
name="relateSl<?php echo $i; ?>" id="relateSl<?php echo $i; ?>" onChange="orgDiv(<?php echo $i; ?>)"><?php echo $select_relative; ?>
</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="chkbx" style="padding-left:10px;" 
/>&nbsp;Referring&nbsp;Party&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" class="chkbx" />&nbsp;Emergency&nbsp;Contact<br />
<div id="relOfdiv<?php echo $i; ?>"  style="padding-top:2px;"><input class="i25" type="text" name="relorg<?php echo $i; ?>" 
id="relOrg<?php echo $i; ?>" maxlength="30" size="30" /></div>
</td></tr><tr><td class="rt" rowspan="2">address:</td><td><input class="i25" type="text" name="add1" maxlength="35" size="35" /></td></tr><tr><td><input 
class="i25" type="text" name="add2" maxlength="35" size="35" />
</td></tr><tr><td class="rt">city:</td><td><input class="i13" type="text" name="city" maxlength="25" size="25" 
/>&nbsp;province/state: <input class="i2" type="text" name="prov" maxlength="2" size="2" value="QC" />&nbsp; postal code: <input 
class="i5" type="text" name="post" maxlength="7" size="7" /></td></tr><tr><td class="rt">email:</td><td><input class="i25" type="text" 
name="email" maxlength="45" size="10" /></td></tr><tr><td class="rt"><div id="relHphone<?php
echo $i; ?>" style="padding-top:2px;display:none;">home&nbsp;phone:</div>cell&nbsp;phone:</td><td><input 
class="i2" type="text" name="phone1" maxlength="3" size="3"  value="514" /> <input class="i7" type="text" 
name="phoneb2" maxlength="10" size="10" />&nbsp;work&nbsp;<input class="i2" type="text" name="phone1" maxlength="3" size="3"  
value="514" /> <input class="i7" type="text" name="phoneb2" maxlength="10" size="10" /> ext. <input class="i3" 
type="text"name="phoneb2" maxlength="6"
size="6" /><div id="relHfphone<?php echo $i; ?>" style="display:none;padding-top:2px;"><input class="i2" type="text" name="phone1" 
maxlength="3" size="3"  value="514" />
<input class="i7" type="text" name="phoneb2" maxlength="10" size="10" /></div><input type="checkbox" />Referrer&nbsp;<input type="checkbox" />Emergency&nbsp;Contact</td></tr><tr><td 
colspan="2" style="text-align:right;"><input type="button" value="done" onClick="relSummary(<?php echo $i; ?>)" 
/></td></tr></table>
</div></div><?php
}
// end make relationship forms
?><div style="width:630px; margin:1px 5px; border: 1px solid #456F06;clear:both;" id="nwrelateparent"><div style="padding:5px;">
add another new relationship: <select onChange="Select_Value_Set('relateSl', document.mowcreate.nrelate.value, 
document.mowcreate.nwrelate.value);"
name="nwrelate" id="nwrelate"><option value="none">select one...</option><?php echo $select_relative; ?></select><input type="text" 
name="nrelate"
id="nrelate" value="1" disabled="disabled" 
style="border:0;background:none;color:#fff;font-size:10px;padding:0;margin:0;text-align:right;width:20px;"/> being added (of 3).
</div></div>
<div id="snd"><input type="button" value="« Previous" onClick="cinPrev(3)" /> <input type="button" class="nxt" 
value="Next »" onClick="cinNext(3)" /></div></div>
<div id="cin4" style="display:none;">
<?php
/*
$dietr_n = array("lactose","MSG","rice");
$dietrcount = count($dietr_n);
for ($i = 0; $i < $dietrcount; $i++) {
echo "<input type=\"checkbox\" name=\"dietr_n$i\" value=\"1\">" . dietr_n[$i] ."<br />";
}
*/
?>
<table class="inpt">
<tr>
<td>
<b>Portion Size:</b><br />
<input type="radio" name="dportion" value="H" />half<br />
<input type="radio" name="dportion" value="R" checked="checked" />regular<br />
<input type="radio" name="dportion" value="L" />large<br />
<input type="radio" name="dportion" value="D" />double<br />
<br /><b>Allergies</b><br />
<input type="checkbox" name="dietr_veal" value="1" />gluten<br />
<input type="checkbox" name="dietr_fish" value="1" />dairy<br />
<input type="checkbox" name="dietr" value="1" />other:<input type="text" name="all_other" style="width:40px;" /><br />
<br />      
<b>Meal Modifications</b><br />
<input type="checkbox" name="dietr" value="1" />Cut Up<br />
<input type="checkbox" name="dietr" value="1" />Print Date<br />
<input type="checkbox" name="dietr" value="1" />Puree<br />
<input type="checkbox" name="dietr" value="1" />Other:<input type="text" name="all_other" style="width:40px;" /><br />
</td><td  style="vertical-align:top;width:50%"><b>Dietary Restrictions</b><br />
<table cellspacing="0" style="border:1px solid #456F06;width:80%;padding:4px;margin:2px;">
<tr><td>
<input type="checkbox" name="dietr_pat" value="1" />salt<br />
<input type="checkbox" name="dietr_pat" value="1" />spicy<br />
<input type="checkbox" name="dietr_pat" value="1" />nuts/chocolate<br />
<input type="checkbox" name="dietr_pat" value="1" />rice<br />
<input type="checkbox" name="dietr_pat" value="1" />lactose<br />
<input type="checkbox" name="dietr_pat" value="1" />MSG<br />
<input type="checkbox" name="dietr_pat" value="1" />potato<br />
</td><td style="vertical-align:top;">
<input type="checkbox" name="dietr_pasta" value="1" />pasta<br />
<input type="checkbox" name="dietr_poul" value="1" />poultry<br />
<input type="checkbox" name="dietr_ham" value="1" />ham<br />
<input type="checkbox" name="dietr_pork" value="1" />pork<br />
<input type="checkbox" name="dietr_beef" value="1" />beef<br />
<input type="checkbox" name="dietr_veal" value="1" />veal<br />
<input type="checkbox" name="dietr_fish" value="1" />fish<br />

</td></tr></table><br /><b>Categorical Restrictions</b><br />
<table cellspacing="0" style="border:1px solid #456F06;width:80%;padding:4px;margin:2px;">
<tr><td style="vertical-align:top;">
<input type="checkbox" name="dietr" value="1" />diabetic<br />
<input type="checkbox" name="dietr_pat" value="1" />vegetarian<br />
<input type="checkbox" name="dietr_pat" value="1" />no red meat<br />
<input type="checkbox" name="dietr_glu" value="1" />gluten intolerent<br />
</td></tr></table>
</td></tr></table>
<div id="snd"><input type="button" value="« Previous" onClick="cinPrev(4)" /> <input type="button" class="nxt" 
value="Next »" onClick="cinNext(4)" /></div></div>
<div id="cin5" style="display:none;">Bill&nbsp;to:&nbsp;&nbsp;<select style="width:110px;margin-right:2px" name="billto" id="billto" 
onChange="billShow()">
<option value="self">Client</option>
<option value="cur">Curateur public</option>
<option value="oth">Other</option>
<option value="rel">Relative</option>
</select> <br /><br /><div style="padding-left:15px;height:220px">
<div id="bdivself" style="display:none;">&nbsp;</div>
<div id="bdivcur" style="display:none;"><input type="text" id="nobx" name="nobx" 
disabled="disabled" style="border:0;background:none;color:#fff;font-size:10px;padding:0;margin:0;text-align:right;width:134px;" />, 
#<input 
type="text" class="i5"><br 
/><?php
echo $bcurateur_address . "<input type=\"text\" style=\"width:18px;\" value=\"12\"/><sup>e</sup> " . $bcurateur_address2 . "<br />" . 
$bcurateur_address3; 
?></div>
<div id="bdivoth" style="display:none;">3</div>
<div id="bdivrel" style="display:none;">4</div>
</div>
<div id="snd"><input type="button" value="« Previous" onClick="cinPrev(5)" /> <input type="button" class="nxt"
value="Next »" onClick="cinNext(5)" /></div>
</div><div id="cin6" style="display:none;">
Shared notes: <br 
/><textarea rows="3" cols="20" style="width:270px;" name="notes"></textarea>
<br />Alert: <input type="checkbox" name="alert" value="true"><input class="i25" type="text" name="alertmsg" id="alertmsg" maxlength="50" size="10" />
<br /><br />
<div id="snd"><div style="width:100px;float:left;text-align:left;"><input type="button" value="« Previous" onClick="cinPrev(6)" /></div><div id="snd"><input type="submit" value="Create Entry" /><input type="reset" value="Reset Form" /></div>
</div>
</div>
</div>
</div></th>
</tr>
<tr>
<td class="ll" rowspan="2"><img src="theme/default/p1/apl.gif" width="138"height="150" border="0"alt="FeastDB" /></td>
<td class="gr"> </td></tr></table></form></div><div class="fbt"><a 
href="http://www.fireboytech.com">2008 © fireboy technologies</a></div>
</div></div></div></center></body></html>
