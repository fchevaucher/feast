<?php
include '../include/lib/functions.php';

//easily change important vars (list them here)
$bcurateur_address = "600 Boul. René Lévesque Ouest, ";
$bcurateur_address2 = "étage";
$bcurateur_address3 = "Montréal, Québec  H3B 4W9";
$bbluecross_sal = "National Provider Center";
$bbluecross_address = "Provider Reimbursement Claims<br />C.P. 6200<br />STANLCD1<br />Moncton, NB  E1C 8R2";
$bprovider = "SR 20922";

?><div id="ut"><div id="us"><ul><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="bio.php"><span class="h6"> <br></span>adv. search</a></li><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
class="pg"><span class="h6"> <br></span>clients</a></li><li 
class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="?do=new"><span class="h6"> <br></span>create new</a></li><li class="sp"><b><span> <br></span> </b></li><li class="df"><a
href="?go=search"><span class="h6"> <br></span>search</a></li></ul></div></div></div><?php
//
if (isset($_GET['cc'])) {
   //calculate progress in creation of new client
   $cprg = $_GET['cc'];

   if  ($cprg == 1) {

//see if client already exist in database
$query = "SELECT * FROM member WHERE last_name LIKE '" . $_POST['lname'] . "'";
$result = mysql_query($query);
//print out results
$hits = 0;
$output = "";
while($row = mysql_fetch_array( $result )) {
  if ($row['first_name']==$_POST['fname']) {
  $hits++; 
  $output .= "<input onClick=\"enableSub('cnewhide','hide')\"  type=\"radio\" value=\"" . $row['mid'] . "\" name=\"slectNew\" /><a href=\"?do=show&mid=" . $row['mid'] . "\"><b>" .  $row['first_name'] . " " . $row['last_name'] . "</b></a><br />";
  }
}
$output .= "<input onClick=\"enableSub('cnewhide','unhide')\" type=\"radio\" value=\"NEW\" name=\"slectNew\" id=\"slectNew\" 
/>Create a new client...";


?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=2" method="post" onSubmit="chkValue('slectNew')"><table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:210px;color:#BBBBBB;"><?php if ($hits < 1) {
?>There are no existing entries for a client by this name. Let's proceed.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">
How can the client be contacted?<input type="hidden" name="slectNew" value="NEW"></div>
<div><table class="inpt">
<?php } else { ?>There are entries in the database for clients with that name.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Do you mean one of these people?<div 
style="width:260px;float:right;clear:both;"><?php echo $output; ?></div></div>
<div style="height:220px"><div style="display:none" id="cnewhide"><table class="inpt">
<tr><td colspan="2"><div style="width:350px;padding:30px 0 20px 20px;clear:both;">If not, let's continue and add a new 
client.</div></td></tr><?php
 } ?><tr><td class="rt">name:</td><td><input class="i9" type="text" name="f_name" value="<?php echo $_POST['fname']; ?>" maxlength="20" size="10" /><input class="i13" type="text" name="m_name" maxlength="20" size="10" style="margin:0 2px" /><input class="i13" type="text" name="l_name" id="Lname" maxlength="20" size="10" value="<?php echo $_POST['lname']; ?>" /></td></tr>
<tr><td class="rt" rowspan="2">address:</td><td><input class="i25" type="text" name="add1" maxlength="35" size="35" 
/></td></tr><tr><td><input class="i25" type="text" name="add2" maxlength="35" size="35" />
</td></tr><tr><td class="rt">city:</td><td><input class="i13" type="text" name="city" maxlength="25" size="25"
/>&nbsp;province/state: <input class="i2" type="text" name="prov" maxlength="2" size="2" value="QC" />&nbsp; postal code: <input
class="i5" type="text" name="post" maxlength="7" size="7" style="text-transform: uppercase;" /></td></tr><tr><td 
class="rt">email:</td><td><input class="i25" type="text" name="email" maxlength="45" size="10" /></td></tr><tr><td class="rt">home&nbsp;phone:</td><td><input
class="i2" type="text" name="phone1" maxlength="3" size="3"  value="514" /> <input class="i7" type="text"
name="phone2" maxlength="10" size="10" />secondary phone:<input class="i2" type="text" name="phoneb1"
maxlength="3" size="3"  value="514" />
<input class="i7" type="text" name="phoneb2" maxlength="10" size="10" /></td></tr></table></div>
</div></div><?php if (!($hits < 1)) { ?></div><div class="snd" style="clear:both;"><input id="subB" type="submit" value="Continue &raquo;" disabled="true" /></div><?php
 } else { ?><div class="snd" style="clear:both;"><input id="subB" type="submit" value="Continue &raquo;" /></div>
<?php }
} elseif ($cprg == 2) { 

if ($_POST['slectNew']=="NEW"){

//setup database entry info
if (isset($_POST['email']))
$psemail = mysql_real_escape_string($_POST['email']);
else
$psemail = "";
$cPhoneA = mysql_real_escape_string($_POST['phone1']) . str_replace("-","",mysql_real_escape_string($_POST['phone2']));
$cPhoneB = mysql_real_escape_string($_POST['phoneb1']) . str_replace("-","",mysql_real_escape_string($_POST['phoneb2']));
$query = "INSERT INTO member (first_name,m_name,last_name,address1,address2,city,prov,post,phone,phoneb,email,mvol,mclient) ";
$query .= " VALUES ('" . convertFrench($_POST['f_name']) . "','" . convertFrench($_POST['m_name']) . "','" . convertFrench($_POST['l_name']) . "','" . mysql_real_escape_string($_POST['add1']) . "','" .  mysql_real_escape_string($_POST['add2']) . "','" . mysql_real_escape_string($_POST['city']) . "','" . mysql_real_escape_string($_POST['prov']) . "','" . mysql_real_escape_string(strtoupper($_POST['post'])) . "','";
$query .= $cPhoneA . "','" . $cPhoneB . "','" . $psemail . "',0,1)";

//Add the client to member database
mysql_query($query) or die(mysql_error());

//and then get the Member ID
$query = "SELECT MAX(mid) AS mid FROM mowdata.member";
$result = mysql_query($query) or die(mysql_error());
$midCl ="";
$row = mysql_fetch_array($result);

$midCl = $row['mid'] ;
//if there are other people with the same name, we'll get the last entry, which should be ours

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=3" method="post"><table width="100%" border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Next, let's enter information that 
may be useful when contacting the client.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">What is the client's first language?</div><div class="cntr4">
<select style="width:100px;margin-right:2px" name="lang" id="lang" onChange="en_lang()">
<option value="EN">English</option>
<option value="FR" >French</option>
<option value="ES" >Spanish</option>
<option value="DE" >German</option>
<option value="PG" >Portuguese</option>
<option value="JP" >Japanese</option>
<option value="RS" >Russian</option>
<option value="other" >other...</option>
</select></div><div class="gtle">What language should be used for correspondance?</div><div class="cntr4"><select 
style="width:100px;margin-right:2px" name="clang">
<option value="EN">English</option>
<option value="FR" >French</option>
<option value="EF" >Either</option>
</select></div><div class="gtle">What is the client's gender?</div><div class="cntr4">
<select style="width:80px;margin-right:2px" name="gender">
<option value="M" >Male</option>
<option value="F" >Female</option>
<option value="O" >Other</option>
</select></div><div class="gtle">When is the client's birthday?</div><div class="cntr4">
<select style="width:31px;margin-right:2px" name="bdayd">
<option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option>
<option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option>
<option>20</option><option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option>
<option>30</option><option>31</option>
</select>
<select style="width:45px;margin-right:2px" name="bdaym">
<option value="01">Jan</option><option value="02">Feb</option><option value="03" >Mar</option><option value="04" >Apr</option>
<option value="05" >May</option><option value="06">Jun</option><option value="07" >Jul</option><option value="08" >Aug</option>
<option value="09" >Sep</option><option value="10">Oct</option><option value="11" >Nov</option><option value="12" >Dec</option>
</select> year: <input class="i3" type="text" name="bdayy" maxlength="4" size="4" />
</div><div 
class="gtle">Is there anything that could 
hinder correspondance?</div><div style="padding:4px 0 9px 120px;"><div
style="text-align:left;"><input	type="checkbox" name="cdiff1" value="1">Expressive Difficulty<br/><input type="checkbox" name="cdiff2" 
value="1">Hard of Hearing</div>
</div></div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $midCl; ?>"><input type="submit" value="Continue &raquo;" /></div><?php
} else { ?><div id="fn" class="w8"><form name="mowcreate" action="?do=show&mid=<?php echo $_POST['slectNew']; ?>" method="post"><table width="100%" border="0" cellpadding="0"cellspacing="0"><tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:235px;color:#BBBBBB;">This client exists already.<br />Client creation will be cancelled.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Continue to the existing client profile 
for <b><?php echo $_POST['f_name'] . " " . $_POST['l_name']; ?>.</b></div><div 
style="height:90px;width:350px;padding-top:40px;clear:both;text-align:right;">
&nbsp;</div></div></div><div class="snd"><input type="submit" value="Continue &raquo;" /></div><?php
}

     } elseif ($cprg == 3) {	
//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//prepare certain variables
if ($_POST['lang'] == "other")
$lang1 = $_POST['lang_oth'];
else
$lang1 = $_POST['lang'];
if ($_POST['bdayy'] >= 1900)
$bdayCl = $_POST['bdayy'] . "-" . $_POST['bdaym'] . "-" . $_POST['bdayd'];
else
$bdayCl = '0000-00-00';

$query = "INSERT INTO client
(mid,mlang,clang,gender,cdif_exd,cdif_hoh,bday)";
$query .= " VALUES ('" . $pass_mid . "','" . $lang1 . "','" . $_POST['clang'] .  "','" . $_POST['gender'] . "','" . $_POST['cdiff1'] . "','" . $_POST['cdiff2'] . "','" . $bdayCl . "')";

//Add the info from the last page to the client database
mysql_query($query);//  or echo(mysql_error());

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=4" method="post"><table width="100%" border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Next, we'll enter information 
about the 
referral.<br 
/>&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Why was the client referred?</div><table class="inpt">
<tr>
<td style="padding-left:10px;width:185px;"><input type="checkbox" name="rref1" value="1">Loss of Autonomy<br />
<input type="checkbox" name="rref2" value="1">Social Isolation<br />
<input type="checkbox" name="rref3" value="1">Financial Difficulty<br />
<input type="checkbox" name="rref4" value="1">Malnutrition<br />
<input type="checkbox" name="rref5" value="1">Cognitive Problems<br />
<input type="checkbox" name="rref6" value="1">Reduced Mobility<br />
<input type="checkbox" name="rref7" value="1">Visually Impaired<br />
<input type="checkbox" name="rref8" value="1">Lives Alone<br />
</td>
<td><textarea rows="3" cols="20" style="height:160px;width:280px;" name="rNotes"></textarea>
<br /><br />
</td>
</tr></table>
<div class="gtle">Are there an IMPORTANT alerts for this client?</div><div style="padding-left:50px;clear:both;">
<div id="rAlert" style="display:none;width:370px;float:right;">
<textarea rows="3" cols="2" style="height:40px;width:260px;" name="rAlertMsg"></textarea><br />
</div>
<input onClick="enableSub('rAlert','hide')" type="radio" value="no" name="rAlert" checked="checked" />No<br />
<input onClick="enableSub('rAlert','unhide')" type="radio" value="YES" name="rAlert" />Yes
</div>
</div><div class="snd" style="clear:both;"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Continue &raquo;" /></div><?php
   } elseif ($cprg == 4) {
//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//prepare certain variables
if ($_POST['rAlert'] == "YES") 
$rAlert = 1;
else
$rAlert = 0;
$query = "UPDATE client SET rfref_loa='" . $_POST['rref1'] . "', rfref_iso='" . $_POST['rref2'] . "', rfref_fin='" . $_POST['rref3'];
$query .= "', rfref_nut='" . $_POST['rref4'] . "', rfref_cog='" . $_POST['rref5'] . "', rfref_mob='" . $_POST['rref6'] . "', rfref_vis='";
$query .= $_POST['rref7'] . "', rfref_aln='" . $_POST['rref8'] . "', rNotes='" . mysql_real_escape_string($_POST['rNotes']) . "', alert='" . $rAlert;
$query .= "', alertmsg='" . mysql_real_escape_string($_POST['rAlertMsg']) . "' WHERE mid='" . $pass_mid . "'";


//Add the info from the last page to the client database
mysql_query($query); //  or echo(mysql_error());

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=5" method="post"><table width="100%" border="0" cellpadding="0"cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Alright. Next, we'll setup meal
delivery.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Will the client have meals delivered on schedule? <span 
style="font-size:10px">(Ongoing Delivery)</span></div><div class="cntr4">
<select style="width:100px;margin-right:2px" name="dtype" id="EpiReg" onChange="dropdnChk('EpiReg','reg','rDays')">
<option value="reg">Yes (Ongoing)</option>
<option value="epi">No  (Episodic)</option>
</select></div><div id="rDays"><div class="gtle">On what days should the client receive meals?</div><div style="padding:0 0 10px 50px;">
<input type="checkbox" name="dlvMon" value="1">Monday<br />
<input type="checkbox" name="dlvTue" value="1">Tuesday<br />
<input type="checkbox" name="dlvWed" value="1">Wednesday<br />
<?php // <input type="checkbox" name="dlvMon" value="1">Thursday ?><br />
<input type="checkbox" name="dlvFri" value="1">Friday<br />
<input type="checkbox" name="dlvSat" value="1">Saturday
</div></div><div class="gtle">When should the client start receiving meals?</div><div class="cntr4">
<select style="width:31px;margin-right:2px" name="mdayd">
<option value="01">1</option><option value="02">2</option><option value="03">3</option><option value="04">4</option><option value="05">5</option><option value="06">6</option><option value="07">7</option><option value="08">8</option><option value="09">9</option><option>10</option>
<option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option>
<option>21</option><option>22</option><option>23</option><option>24</option><option>25</option><option>26</option><option>27</option><option>28</option><option>29</option>
<option>30</option><option>31</option>
</select>
<select style="width:45px;margin-right:2px" name="mdaym">
<option value="01">Jan</option><option value="02">Feb</option><option value="03" >Mar</option><option value="04" >Apr</option>
<option value="05" >May</option><option value="06">Jun</option><option value="07" >Jul</option><option value="08" >Aug</option>
<option value="09" >Sep</option><option value="10">Oct</option><option value="11" >Nov</option><option value="12" >Dec</option>
</select> year: <input class="i3" type="text" name="mdayy" maxlength="4" size="4" value="<?php echo date('Y'); ?>"/>
</div>
</div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Continue &raquo;" /></div><?php
   } elseif ($cprg == 5) {

//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//prepare certain variables
if ($_POST['mdayy'] >= 1900)
$mFday = $_POST['mdayy'] . "-" . $_POST['mdaym'] . "-" . $_POST['mdayd'];
else
$mFday = '0000-00-00';
if ($_POST['dtype'] == "reg")
$dType = "R";
else
$dType = "E";
$query = "UPDATE client SET dType='" . $dType . "', dMon='" . $_POST['dlvMon'] . "', dTue='" . $_POST['dlvTue'] . "', dWed='";
$query .= $_POST['dlvWed'] . "', dFri='" . $_POST['dlvFri'] . "', dSat='" . $_POST['dlvSat'] . "', firstmealdate='" . $mFday . "', mealstatus='A'  WHERE mid='" . $pass_mid . "'";

//Add the info from the last page to the client database
mysql_query($query);//  or echo(mysql_error());

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=6" method="post"><table width="100%" 
border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Lets enter information that will help when 
delivering the meals.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Which route will this client be on?</div><div class="cntr4">
<select style="width:135px;margin-right:2px" name="routen">
<option value="CS">Centre Sud</option>
<option value="CDN">Cote De Neiges</option>
<option value="ME">Mile End</option>
<option value="MG">McGill</option>
<option value="MGW">McGill West</option>
<option value="NDG">Notre Dame de Grace</option>
<option value="CV">Downtown</option>
<option value="WM">Westmount</option>
</select></div>
<div class="gtle">Please enter any directions which 
may be helpful in finding the client's residence.</div><div 
style="padding:2px 0 4px 80px"><textarea rows="3" cols="20" style="width:270px;" name="directions"></textarea>
</div></div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Continue &raquo;" /></div><?php
   } elseif ($cprg == 6) {

//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

$query = "UPDATE client SET dRoute='" . $_POST['routen'] . "', dStop='" . $_POST['dStop']  . "', dDirections='" . 
mysql_real_escape_string($_POST['directions']) . "'  WHERE mid='" . $pass_mid . "'";

//Add the info from the last page to the client database
mysql_query($query);//  or echo(mysql_error());

//Find any one else on the same route
$query = "SELECT * FROM client WHERE dRoute LIKE '" . $_POST['routen'] . "' AND mealstatus='A' ORDER BY dStop ASC";
$result = mysql_query($query);// or echo(mysql_error());
$outputR = "";
$countR = 0;
$midArray = array();
$i=0;
while($row = mysql_fetch_array($result)){
$midArray[$i] = $row['mid'];
$i++;
}

$nMid = count($midArray);
for ($i = 0; $i < $nMid; $i++) {
//use the the Member IDs to get the name and address.
$query = "SELECT * FROM member WHERE mid='" . $midArray[$i] . "'";
$result = mysql_query($query);// or echo(mysql_error());
$row = mysql_fetch_array($result);
$countR++;
$outputR .=  "<div class=\"or_box\"><input type=\"text\" class=\"or_name\" value=\"" . substr($row['first_name'],0,1) . ". " . $row['last_name'];
$outputR .=  "\" name=\"or_name" . $countR . "\"  id=\"or_name" . $countR . "\" disabled=\"disabled\" /><input type=\"text\" value=\"" . $row['address1'];
$outputR .=  "\" name=\"or_add" . $countR . "\" id=\"or_add" . $countR . "\" disabled=\"disabled\"";
if ($i != 0)
$outputR .= " /><input type=\"button\" value=\"up\" onClick=\" switchBx(" . $countR . "," . ($countR - 1) . ")\" onFocus=\"this.blur()\" class=\"btn\"";
else
$outputR.= "style=\"padding-right:35px\"";
$outputR .= " /><br /><input type=\"text\" value=\"";
$outputR .= $row['address2'] . "\" id=\"or_addb" . $countR . "\" name=\"or_addb" . $countR . "\" disabled=\"disabled\"";
if ($i < ($nMid - 1))
$outputR .= " /><input type=\"button\" value=\"dn\" onClick=\" switchBx(" . $countR . "," . ($countR + 1) . ")\" onFocus=\"this.blur()\" class=\"btn\"";
else
$outputR .= "style=\"padding-right:35px\"";
$outputR .= " /><input type=\"hidden\" name=\"or_mid" . $countR . "\" id=\"or_mid" . $countR . "\" value=\"" . $midArray[$i] . "\">";
$outputR .= "<input type=\"hidden\" name=\"or_stp" . $countR . "\" value=\"" . ($countR) . "\"></div>";
}
?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=7" method="post"><table width="100%"
border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Lets enter information that will help when
delivering the meals.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Adjust the route order to accomadate this client.</div></div><div 
style="padding-left:39px">
<?php echo $outputR; ?><br /></div>
<div class="snd"><input type="hidden" name="noStops" value="<?php echo $nMid; ?>">
<input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Continue &raquo;" /></div><?php
   } elseif ($cprg == 7) {


//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//update stop number for each client
for ($i = 1; $i <= $_POST['noStops']; $i++) {
$query = "UPDATE client SET dStop='" . $_POST['or_stp' . $i] . "' WHERE mid='" . $_POST['or_mid' . $i] . "'";
//line for debugging
//echo $_POST['or_stp' . $i] . "-$i" . $_POST['or_mid' . $i] . "<br />";
mysql_query($query);//  or echo(mysql_error());
}

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=8" method="post"><table width="100%" border="0" cellpadding="0" 
cellspacing="0">
<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:340px;color:#BBBBBB;">Next, we'll enter meal restrictions 
and preferences.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">What size of meal will the client normally want?</div>
<div style="padding:0 0 0 85px;"><div style="width:120px;float:left;">
<input type="radio" name="dportion" value="H" />half<br />
<input type="radio" name="dportion" value="R" checked="checked" />regular</div><div style="width:120px;float:left;">
<input type="radio" name="dportion" value="L" />large<br />

<input type="radio" name="dportion" value="D" />double</div></div>
<div class="gtle" style="clear:both;">What special preparations need to be done for this client?</div><div 
style="padding:0 0 10px 85px"><div style="width:120px;float:left;">
<input type="checkbox" name="dietr_pr1" value="1" id="pr1" onClick="addText('label', 'cut up food','pr1')" />Cut Up<br />
<input type="checkbox" name="dietr_pr2" value="1" id="pr2" onClick="addText('label', 'puree','pr2')" />Puree</div><div style="width:120px;float:left;">
<input type="checkbox" name="dietr_pr3" value="1" id="pr3" onClick="addText('label', 'date','pr3')" />Print Date<br /></div></div>
<div class="gtle" style="clear:both;">What ingredient restrictions does the client have?</div><div style="padding:0 0 10px 60px">
<table cellspacing="0" style="border:1px solid #456F06;width:80%;padding:4px;margin:2px;clear:both;">
<tr><td>
<input type="checkbox" name="dietr_i1" id="di1" value="1" onClick="addText('label', 'no salt','di1')" />salt<br />
<input type="checkbox" name="dietr_i2" value="1" id="di2" onClick="addText('label', 'no spicy','di2')" />spicy<br />
<input type="checkbox" name="dietr_i3" value="1" id="di3" onClick="addText('label', 'no chocolate','di3')" />chocolate<br />
<input type="checkbox" name="dietr_i4" value="1" id="di4" onClick="addText('label', 'no dairy','di4')" />dairy<br />
<input type="checkbox" name="dietr_i5" value="1" id="di5" onClick="addText('label', 'no lactose','di5')" />lactose<br />
<input type="checkbox" name="dietr_i6" value="1" id="di6" onClick="addText('label', 'no MSG','di6')" />MSG<br />
<input type="checkbox" name="dietr_i7" value="1" id="di7" onClick="addText('label', 'no rice','di7')" />rice<br />
<input type="checkbox" name="dietr_i8" value="1" id="di8" onClick="addText('label', 'no potato','di8')" />potato<br />
</td><td style="vertical-align:top;">
<input type="checkbox" name="dietr_i9" value="1" id="di9" onClick="addText('label', 'no nuts','di9')" />nuts<br />
<input type="checkbox" name="dietr_i10" value="1" id="di10" onClick="addText('label', 'no pasta','di10')" />pasta<br />
<input type="checkbox" name="dietr_i11" value="1" id="di11" onClick="addText('label', 'no poultry','di11')" />poultry<br />
<input type="checkbox" name="dietr_i12" value="1" id="di12" onClick="addText('label', 'no ham','di12')" />ham<br />
<input type="checkbox" name="dietr_i13" value="1" id="di13" onClick="addText('label', 'no pork','di13')" />pork<br />
<input type="checkbox" name="dietr_i14" value="1" id="di14" onClick="addText('label', 'no beef','di14')" />beef<br />
<input type="checkbox" name="dietr_i15" value="1" id="di15" onClick="addText('label', 'no veal','di15')" />veal<br />
<input type="checkbox" name="dietr_i16" value="1" id="di16" onClick="addText('label', 'no fish','di16')" />fish<br />
</td></tr></table></div><div class="gtle" style="clear:both;">What special restrictions does the client have?</div><div 
style="padding:0 0 10px 60px"><table cellspacing="0" style="border:1px solid #456F06;width:80%;padding:4px;margin:2px;">
<tr><td style="vertical-align:top;">
<input type="checkbox" name="dDiabetic" value="1" id="ds1" onClick="addText('label', 'Diabetic','ds1')" />diabetic<br />
<input type="checkbox" name="dAllergy" value="1" id="ds2" onClick="addText('label', 'ALLERGY:','ds2')" />allergy<br />
<input type="checkbox" name="dGluten" value="1" id="ds3" onClick="addText('label', 'gluten','ds3')" />gluten intolerent<br />
</td></tr></table></div><div class="gtle" style="clear:both;">Does the client have any restrictions not categorized above?</div><div
class="cntr4"><input type="checkbox" name="dDiv" value="1" id="dDiv" />Yes (specialized label will always be printed)</div>
<div class="gtle" style="clear:both;">Verify and add any remaining specifications for the label.</div><div
class="cntr4"><textarea rows="3" cols="20" style="height:70px;width:280px;" name="dLabel" id="label"></textarea><br />
</div>
</div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Continue &raquo;" /></div><?php
   } elseif ($cprg == 8) {

//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//prepare certain variables
$diDairy = 0;
if ($_POST['dietr_i4'] == "1")
$diDairy = 1;
if ($_POST['dietr_i5'] == "1")
$diDairy = 1;

//prepare query 
$query = "UPDATE client SET mPortion='" . $_POST['dportion'] . "', mMealmod_cut='" . $_POST['dietr_pr1'] . "', mMealmod_dat='" . $_POST['dietr_pr3'] . "', ";
$query .= "mMealmod_pur='" . $_POST['dietr_pr2'] . "', mMealallergy='" . $_POST['dAllergy'] . "', mMealdiabete='" . $_POST['dDiabetic'] . "', mDiet_salt='" . $_POST['dietr_i1'] . "', ";
$query .= "mDiet_milk='" . $diDairy . "', mDiet_fish='" . $_POST['dietr_i16'] . "', mDiet_ham='" . $_POST['dietr_i12'] . "', mDiet_poul='" . $_POST['dietr_i11'] . "', ";
$query .= "mDiet_beef='" . $_POST['dietr_i14'] . "', mDiet_pork='" . $_POST['dietr_i13'] . "', mDiet_veal='" . $_POST['dietr_i15'] . "', mDiet_spicy='" . $_POST['dietr_i2'] . "', ";
$query .= "mDiet_nuts='" . $_POST['dietr_i9'] . "',  mDiet_choc='" . $_POST['dietr_i3'] . "', mDiet_rice='" . $_POST['dietr_i7'] . "', mDiet_ptat='" . $_POST['dietr_i8'] . "', mDiet_past='" . $_POST['dietr_i10'] . "', ";
$query .= "mDiet_msg='" . $_POST['dietr_i6'] . "', mDiet_glut='" . $_POST['dGluten'] . "', mDiet_div='" . $_POST['dDiv'] . "', mLabel='" . $_POST['dLabel'] . "'  WHERE mid='" . $pass_mid . "'";

//Add the info from the last page to the client database
mysql_query($query);//  or echo(mysql_error());

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=9" method="post"><table width="100%"
border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Now, setup the selected meal options and 
side dishes.<br 
/>&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle"><table class="inpt">
<tr><td>How many meals (by default) should be delivered?</td>
<td style="width:135px"><select style="width:35px;margin-right:2px" name="nmeals">
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select></td></tr>
<tr><td>How many fruit salads?</td>     
<td><select style="width:35px;margin-right:2px" name="nsf">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select></td></tr>
<tr><td>How many green salads?</td>
<td><select style="width:35px;margin-right:2px" name="ngs">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select></td></tr>
<tr><td>How many deserts?</td>
<td><select style="width:35px;margin-right:2px" name="nds">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select></td></tr>
<tr><td>How many diabetic deserts?</td>
<td><select style="width:35px;margin-right:2px" name="ndd">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select></td></tr>
<tr><td>How many puddings?</td>
<td><select style="width:35px;margin-right:2px" name="npd">
<option>0</option>
<option>1</option>
<option>2</option>
<option>3</option>
<option>4</option>
</select></td></tr>
<tr><td>Should the client receive the Gazette?</td>
<td><select style="width:45px;margin-right:2px" name="ngz">
<option value="0">no</option>
<option value="1">yes</option>
</select></td></tr>
<tr><td>Does the client receive vegetable baskets?</td>
<td><select style="width:45px;margin-right:2px" name="nvb">
<option value="0">no</option>
<option value="1">yes</option>
</select></td></tr>
</table></div></div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Continue &raquo;" /></div>
<?php 
   } elseif ($cprg == 9) {

//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//prepare certain variables
$diDairy = 0;
if ($_POST['dietr_i4'] == "1")
$diDairy = 1;
if ($_POST['dietr_i5'] == "1")
$diDairy = 1;

$query = "INSERT INTO meals_default (mid) VALUES (". $pass_mid . ")";
$result = mysql_query($query);
$query = "SELECT * FROM client WHERE mid='" . $pass_mid . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
$portionD = $row['mPortion'];
//prepare query
$query = "UPDATE meals_default set dMonNumber='" . $_POST['nmeals'] . "', dMonPortion='" . $portionD . "', dMonSideds='";
$query .= $_POST['nds'] . "', dMonSidedd='" . $_POST['ndd'] . "', dMonSidefs='" . $_POST['nsf'] . "', dMonSidegs='" . $_POST['ngs'] . "', dMonSidepd='" . $_POST['npd'] . "', dMonSidegz='" . $_POST['ngz'] . "', dMonSidevb='" . $_POST['nvb'] . "', dMonSidevz='" . $_POST['nvz'] . "', dTueNumber='" . $_POST['nmeals'] . "', dTuePortion='" . $portionD . "', dTueSideds='" . $_POST['nds'] . "', dTueSidedd='" . $_POST['ndd'] . "', dTueSidefs='" . $_POST['nsf'] . "', dTueSidegs='" . $_POST['ngs'] . "', dTueSidepd='" . $_POST['npd'] . "', dTueSidegz='" . $_POST['ngz'] . "', dTueSidevb='" . $_POST['nvb'] . "', dTueSidevz='" . $_POST['ngz'] . "', dWedNumber='" . $_POST['nmeals'] . "', dWedPortion='" . $portionD . "', dWedSideds='" . $_POST['nds'] . "', dWedSidedd='" . $_POST['ndd'] . "', dWedSidefs='" . $_POST['nsf'] . "', dWedSidegs='" . $_POST['ngs'] . "', dWedSidepd='" . $_POST['npd'] . "', dWedSidegz='" . $_POST['ngz'] . "', dWedSidevb='" . $_POST['nvb'] . "', dWedSidevz='" . $_POST['ngz'] . "', dFriNumber='" . $_POST['nmeals'] . "', dFriPortion='" . $portionD . "', dFriSideds='" . $_POST['nds'] . "', dFriSidedd='" . $_POST['ndd'] . "', dFriSidefs='" . $_POST['nsf'] . "', dFriSidegs='" . $_POST['ngs'] . "', dFriSidepd='" . $_POST['npd'] . "', dFriSidegz='" . $_POST['ngz'] . "', dFriSidevb='" . $_POST['nvb'] . "', dFriSidevz='" . $_POST['ngz'] . "', dSatNumber='" . $_POST['nmeals'] . "', dSatPortion='" . $portionD . "', dSatSideds='" . $_POST['nds'] . "', dSatSidedd='" . $_POST['ndd'] . "', dSatSidefs='" . $_POST['nsf'] . "', dSatSidegs='" . $_POST['ngs'] . "', dSatSidepd='" . $_POST['npd'] . "', dSatSidegz='" . $_POST['ngz'] . "', dSatSidevb='" . $_POST['nvb'] . "', dSatSidevz='" . $_POST['ngz']  . "' WHERE mid = " . $pass_mid;
//Add the info from the last page to the client database
mysql_query($query);//  or echo(mysql_error());

?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=10" method="post"><table width="100%" border="0" cellpadding="0"cellspacing="0">
<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:250px;color:#BBBBBB;">Next, enter some contacts for this client.<br 
/>&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Enter a third party contact for the client.</div>
<div class="gtle" id="cworkers" style="display:none;">&nbsp;</div>
<table class="inpt"><tbody><tr>
<td class="rt">first&nbsp;name:</td><td><input class="i13" name="relf_name" maxlength="20" size="10" type="text">
&nbsp;last&nbsp;name:&nbsp;<input class="i13" name="rell_name" id="rell_name" maxlength="20" size="10" type="text" onkeyup="javascript:autocw('<?php echo $pass_mid; ?>')">
</td></tr><tr><td class="rt">relationship:<div id="relOdiv" style="padding-top: 2px;">organization:</div></td><td><select 
name="slctRel" id="slctRel" onchange="relDiv()">
<option>case worker</option><option>nurse</option><option>dietician</option><option>physiotherapist</option><option>doctor</option>
<option>next of kin</option><option>husband</option><option>grandchild</option><option>wife</option><option>mother</option>
<option>father</option><option>brother</option><option>sister</option><option>friend</option><option>guardian</option><option>daughter</option>
<option>son</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_refr" class="chkbx" style="padding-left: 10px;" type="checkbox" value="1" />&nbsp;Referring&nbsp;Party&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_emrg" class="chkbx" type="checkbox" value="1" />&nbsp;Emergency&nbsp;Contact<br>
<div id="relOfdiv" style="padding-top: 2px;"><input class="i25" name="relorg" id="relOrg" maxlength="30" size="30" type="text"></div>
</td></tr><tr><td class="rt" rowspan="2">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" 
type="text"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text">
</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" 
type="text">&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="QC" 
type="text">&nbsp;&nbsp;postal&nbsp;code:&nbsp;<input class="i5" name="post" maxlength="7" size="7" type="text" style="text-transform: uppercase;"></td></tr><tr><td 
class="rt">email:</td><td><input class="i25" name="email" maxlength="45" size="10" type="text"></td></tr><tr><td class="rt"><div 
id="relHphone" style="padding-bottom: 2px; display: none;">home&nbsp;phone:</div>cell&nbsp;phone:</td><td><div
id="relHfphone" style="display: none; padding-bottom: 2px;"><input class="i2" name="phone1" maxlength="3" size="3" value="514"
type="text">&nbsp;<input class="i7" name="phone2" maxlength="10" size="10" type="text"><br /></div><input class="i2" name="phoneb1" 
maxlength="3" size="3" value="514" type="text">&nbsp;<input class="i7" name="phoneb2" maxlength="10" size="10" 
type="text"></td></tr><tr><td class="rt">work:</td><td><input class="i2" name="phonec1" maxlength="3" size="3" value="514" 
type="text">&nbsp;<input class="i7" name="phonec2" maxlength="10" size="10" type="text"> ext. <input class="i3" name="phonec3" maxlength="6" size="6" type="text">
</td></tr></table>
</div><div class="snd"><input type="hidden" name="relDo" value="add">
<input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Add Relationship &raquo;" /></div><?php
  } elseif ($cprg == 10) {
//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

if ($_POST['relDo'] == "add") {

//prepare certain variables
        switch ($_POST['slctRel']) {
       	case "case worker":
        case "nurse":
        case "doctor":
        case "dietician":
       	case "physiotherapist":
        $isProf = 1;
				break;
        default:
        $isProf = 0;
        }
        if (isset($_POST['email']))
        $psemail = $_POST['email'];
        else
		$psemail = "";
        $cPhoneA = $_POST['phone1'] . str_replace("-","",$_POST['phone2']);
        $cPhoneB = $_POST['phoneb1'] . str_replace("-","",$_POST['phoneb2']);
        $cPhoneC = $_POST['phonec1'] . str_replace("-","",$_POST['phonec2']);
        $query = "INSERT INTO contacts (first_name, last_name,organ,relate, address1, address2, city, prov,";
        $query .= "post, email, phone1, phone2, phone3, phone3ext, editor) Values ('";
        $query .= mysql_real_escape_string(trim($_POST['relf_name']))  . "','" . mysql_real_escape_string(trim($_POST['rell_name']));
        $query .=  "','" . $_POST['relorg'] . "','" . $_POST['slctRel'] . "','";
        $query .= mysql_real_escape_string($_POST['add1']) . "','" . mysql_real_escape_string($_POST['add2']) . "','" . $_POST['city'] . "','" . $_POST['prov'] . "','" . $_POST['post'];
        $query .= "','" . $psemail . "','" . $cPhoneA . "','"  . $cPhoneB . "','" . $cPhoneC . "','" . $_POST['phonec3'] . "','" . $f_user . "')";

        //add the entry 
	mysql_query($query)  or die(mysql_error());
	//and then get the Member ID
	$query = "SELECT MAX(rid) AS rid FROM contacts";
	$result = mysql_query($query) or die(mysql_error());
	$rid ="";

	$row = mysql_fetch_array($result);
	$rid = $row['rid'] ;	

	//set vars for relationship table
	$rel_refr = 0;
	$rel_emrg = 0;
	if (isset($_POST['rel_refr']))
        $rel_refr = 1;//$_POST['rel_refr'];
	if (isset($_POST['rel_emrg']))
        $rel_emrg = 1;//$_POST['rel_emrg'];

	$query = "INSERT INTO client_relationships (mid,rid,emerge,refer) Values (";
	$query .= $pass_mid . "," . $rid . "," . $rel_emrg . "," . $rel_refr . ")";
            //add the entry 
	mysql_query($query)  or die(mysql_error());
	
?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=10" method="post"><table width="100%"
border="0" cellpadding="0"
cellspacing="0">

<tr id="ft">
<td style="width:300px;border-top:1px solid #000;"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td><div style="font-size:13px;padding:0 25px; float:right; width:250px;color:#BBBBBB;">Next, enter some contacts for this client.<br 
/>&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle"><center><table cellpadding="0" cellspacing="0" class="relshw"><tr style="font-size:80%;font-style:italic;font-weight:bold;">
<td>name</td><td>relationship</td><td>organization</td><td>phone</td><td>emerg</td><td>refered</td></tr><?php

$i=0;
$query = "SELECT * FROM client_relationships WHERE mid='" . $pass_mid . "'";
$result = mysql_query($query);
while($person =  mysql_fetch_array( $result )) {

//set some vars
$i++;
$isOdd = "";

$query = "SELECT * FROM contacts WHERE rid='" . $person['rid'] . "'";
$result = mysql_query($query);
$row =  mysql_fetch_array( $result );
$rPhone	= $row['phone1'];
$isRefer = "&nbsp;";
$isEmrg = "&nbsp;";
//is the row an odd number - vary colour
if ($person['emerge'] == 1)
$isEmrg = "<img src=\"checksm.gif\" border=\"0\" style=\"padding-top:4px\">";
if ($person['refer'] == 1)
$isRefer = "<img src=\"checksm.gif\" border=\"0\" style=\"padding-top:4px\">";
if ( $i&1 )
$isOdd = " class=\"odd\"";
if ($row['prof'] == 1 )
$rPhone = $row['phone3'] . " ext. " . $row['phone3ext'];
echo "<tr" .$isOdd . "><td>".$row['first_name'] . " " . $row['last_name'] . "</td><td>" . $row['relate'] . "</td>
<td>" .  $row['organ'] . "</td><td>" . $rPhone . "</td><td>" . $isEmrg . "</td><td>" . $isRefer . "</td></tr>";
 }

?></table></center>Enter a third party contact for the client.</div>
<div class="gtle" id="cworkers" style="display:none;">&nbsp;</div>
<table class="inpt"><tbody><tr>
<td class="rt">first&nbsp;name:</td><td><input class="i13" name="relf_name" maxlength="20" size="10" type="text">

&nbsp;last&nbsp;name:&nbsp;<input class="i13" name="rell_name" id="rell_name" maxlength="20" size="10" type="text" onkeyup="javascript:autocw('<?php echo $pass_mid; ?>')">
</td></tr><tr><td class="rt">relationship:<div id="relOdiv" style="padding-top: 2px;">organization:</div></td><td><select 
name="slctRel" id="slctRel" onchange="relDiv()">
<option>case worker</option><option>nurse</option><option>dietician</option><option>physiotherapist</option><option>doctor</option>
<option>next of kin</option><option>husband</option><option>grandchild</option><option>wife</option><option>mother</option>

<option>father</option><option>brother</option><option>sister</option><option>friend</option><option>guardian</option><option>daughter</option>
<option>son</option></select>&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_refr" class="chkbx" style="padding-left: 10px;" 
type="checkbox" value="1" />&nbsp;Referring&nbsp;Party&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_emrg" class="chkbx" 
type="checkbox" value="1" />&nbsp;Emergency&nbsp;Contact<br>
<div id="relOfdiv" style="padding-top: 2px;"><input class="i25" name="relorg" id="relOrg" maxlength="30" size="30" type="text"></div>
</td></tr><tr><td class="rt" rowspan="2">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" 
type="text"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text">
</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" 
type="text">&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="QC" 
type="text">&nbsp;&nbsp;postal&nbsp;code:&nbsp;<input class="i5" name="post" maxlength="7" size="7" type="text" style="text-transform: uppercase;"></td></tr><tr><td 
class="rt">email:</td><td><input class="i25" name="email" maxlength="45" size="10" type="text"></td></tr><tr><td class="rt"><div 
id="relHphone" style="padding-bottom: 2px; display: none;">home&nbsp;phone:</div>cell&nbsp;phone:</td><td><div
id="relHfphone" style="display: none; padding-bottom: 2px;"><input class="i2" name="phone1" maxlength="3" size="3" value="514"
type="text">&nbsp;<input class="i7" name="phone2" maxlength="10" size="10" type="text"><br /></div><input class="i2" name="phoneb1" 
maxlength="3" size="3" value="514" type="text">&nbsp;<input class="i7" name="phoneb2" maxlength="10" size="10" 
type="text"></td></tr><tr><td class="rt">work:</td><td><input class="i2" name="phonec1" maxlength="3" size="3" value="514" 
type="text">&nbsp;<input class="i7" name="phonec2" maxlength="10" size="10" type="text"> ext. <input class="i3" name="phonec3" 
maxlength="6" size="6" type="text">
</td></tr></table>
</div><div class="snd"><input type="hidden" name="relDo" id="relDo" value="add"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Add Relationship &raquo;" /><input type="button" onClick="document.getElementById('relDo').value='done';document.mowcreate.submit(); return false;" value="No More Relationships&raquo;" /></div><?php
} else {
//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//get client's name
$query = "SELECT * FROM member WHERE mid = '" . $pass_mid . "'";
$result = mysql_query($query) or die ('Error: '.mysql_error ());
$row = mysql_fetch_array( $result );
//$row = mysql_fetch_array( $result );
//echo $query . "III";
$billName = strtoupper($row['last_name'] . ", " . $row['first_name'] . "  - ");

$i=0;
$relBill = "";
$relHidden = "";
$query = "SELECT * FROM client_relationships WHERE mid='" . $pass_mid . "'";
$result = mysql_query($query);
while($row = mysql_fetch_array( $result )) {
	$query2 = "SELECT * FROM contacts WHERE rid='" . $row['rid'] . "'";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array( $result2 );

//only family are likely to be billed for the meals
 //if ($row['prof'] != 1 ){
 $i++;
$relBill .= "<option value=\"rel" . $row['rid'] . "\">" . $row2['first_name'] . " " . $row2['last_name'] . "</option>";
//$relHidden .= "<input type=\"hidden\" name=\"rel" . $i . "\" value=\"" . $row['rid'] . "\" />";
 //} 
}
?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=11" method="post"><table width="100%"
border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:250px;color:#BBBBBB;">Finally, enter any information to 
share with others when they work with this client.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Select the party to be billed for the meals service.<div
 style="padding: 10px 0 0 10px">
<select name="billTo" id="billTo" onChange="billSlct()">
<option value="slf">Self Funded</option>
<?php echo $relBill; ?>
<option value="cur">Curateur Public</option>
<option value="blu">Blue Cross</option>
<option value="oth">Other</option>
</select><?php echo $relHidden; ?>
</div>
<div id="bdivoth" style="clear:both;display:none">
<table class="inpt"><tr><td class="rt">salutation:</td><td>
<input class="i25" name="salut" maxlength="30" size="30" type="text"></td></tr><tr><td class="rt" rowspan="3">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" 
type="text"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text">
</td></tr><tr><td><input class="i25" name="add3" maxlength="35" size="35" type="text">
</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" 
type="text" value="Montreal">&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="QC" 
type="text"></td></tr><tr><td class="rt">postal&nbsp;code:</td><td><input class="i5" name="post" maxlength="7" size="7" type="text" style="text-transform: uppercase;"></td></tr>
<tr><td class="rt">phone:</td><td><input class="i2" name="phone1" maxlength="3" size="3" value="514" 
type="text">&nbsp;<input class="i7" name="phone2" maxlength="10" size="10" type="text"> ext. <input class="i3" name="ext" maxlength="6" size="6" type="text">
</td></tr></table>
</div>
<div id="bdivcur" style="display:none;"><?php 
echo $billName . "#<input type=\"text\" style=\"width:50px\" name=\"baccount\" maxlength=\"12\"><br />";
echo $bcurateur_address . "<input type=\"text\" style=\"width:18px;\" value=\"12\" name=\"betage\" maxlength=\"3\" /><sup>e</sup> " . $bcurateur_address2 . "<br />" . $bcurateur_address3; 
?></div>
<div id="bdivblu" style="display:none;"><?php 
echo $bbluecross_sal . "<br />" . $bbluecross_address;
?><br />client # <input type="text" style="width:80px" name="bacc" maxlength="12"><br />
authorization # <input type="text" style="width:80px" name="bauth" maxlength="15"><br />
provider # <?php echo $bprovider; ?>
</div>
</div></div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Finish &raquo;" /></div>
<?php
 }
} elseif ($cprg == 11) { 
//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

$output="";
$bTo= $_POST['billTo'];
if ($bTo == "slf") {
$query = "INSERT INTO client_billing (mid, billto) Values ('" . $pass_mid . "','" . $bTo. "')";
mysql_query($query)  or die(mysql_error());
}elseif ($bTo == "cur") {
$query = "INSERT INTO client_billing (mid, billto, accountno, address1) Values ('" . $pass_mid;
$query .= "','" . $bTo. "','" . $_POST['baccount'] . "','" . $_POST['betage'] . "')";
mysql_query($query)  or die(mysql_error());
} elseif ($bTo == "blu") {
$query = "INSERT INTO client_billing (mid, billto, accountno, authno) Values ('" . $pass_mid;
$query .= "','" . $bTo. "','" . $_POST['bacc'] . "','" . $_POST['bauth'] . "')";
mysql_query($query)  or die(mysql_error());
} elseif ($bTo == "oth") {
$query = "INSERT INTO client_billing (mid, billto, salutation, address1, address2, address3, city, prov, post, phone, ext) Values ('" . $pass_mid;
$query .= "','" . $bTo. "','" . $_POST['salut'] . "','" . $_POST['add1'] . "','" . $_POST['add2'] . "','" . $_POST['add3'];
$query .= "','" . $_POST['city'] . "','" . $_POST['prov'] . "','" . strtoupper($_POST['post']) . "','" . $_POST['phone1'] . $_POST['phone2'] . "','" . $_POST['ext'] . "')";
mysql_query($query)  or die(mysql_error());
} else {
$relno = substr($_POST['billTo'],3);
 	$query = "INSERT INTO client_billing (mid, billto) Values ('" . $pass_mid . "','r" .  $relno . "')";
	mysql_query($query)  or die(mysql_error());
 $query = "SELECT * FROM client_relationships WHERE mid='" . $pass_mid . "' and rid='" . $relno . "'";
 $result = mysql_query($query) or die ('Error: '.mysql_error ());
 while($row = mysql_fetch_array( $result )) {
	$query = "UPDATE client_relationships SET billto='1' WHERE mid='" . $pass_mid . "' AND rid='" .$row['rid'] . "'";
mysql_query($query)  or die(mysql_error());
	}
  }
?><div id="fn" class="w8"><form name="mowcreate" action="?do=new&cc=done" method="post"><table width="100%"
border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:250px;color:#BBBBBB;">Enter information needed for billing.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Enter any shared notes for this client's file.<div
 style="height:150px;padding: 10px 0 0 10px"><textarea 
rows="3" cols="20" style="height:70px;width:280px;" name="sharedNotes"></textarea></div>
</div></div><div class="snd"><input type="hidden" name="pass_mid" value="<?php echo $pass_mid; ?>"><input type="submit" value="Finish &raquo;" /></div>
<?php
} elseif ($cprg =="done") {
//keep passing along our member's ID number
$pass_mid = $_POST['pass_mid'];

//prepare query
//$query = "SELECT * FROM member WHERE last_name LIKE '" . $_POST['lname'] . "'";

//Add the info from the last page to the client database
//mysql_query($query)  or die(mysql_error());

?><div id="fn" class="w8"><form><table width="100%"
border="0" cellpadding="0"
cellspacing="0">
<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:250px;color:#BBBBBB;">Creation of a new client has 
finished.<br />&nbsp;</div></td>
<td class="gr"><img src="theme/default/p1/arw.gif" width="7" height="15" border="0" alt="" /></td>
<th class="gd" rowspan="2" colspan="2"><div id="nf"><div class="gtle">Done!</div><div
 style="height:150px;padding: 10px 10px 0 50px;">You may now navigate away from this page or press 'Go' to continue to the clients 
file.</div>
</div></div><div class="snd"><input type="button" onClick="window.open('?do=show&mid=<?php echo $pass_mid; ?>', '_self', ''); return false; " value="Go &raquo;"></div><?php

} else {
 include "../include/client/cnew1.php";
 }

} else { 
include "../include/client/cnew1.php";
 }

?></th></tr><tr>
<td rowspan="2"><img src="theme/default/p1/apl.gif" width="138"height="150" border="0"alt="FeastDB" /></td>
<td class="gr"> </td></tr></table></form></div><div class="fbt"><a 
href="http://www.fireboytech.com">2008 © fireboy technologies</a></div>
</div></div></div></center></body></html>
