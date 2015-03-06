<?php
//uncomment to debug
//include "../include/showerror.php";

include './gsession.php';
if (isset($_GET['rid'])){
	
	$cRid = $_GET['rid'];
	$cMid = 0;
	if (isset($_GET['mid']))
			$cMid = $_GET['mid'];
	//setup mysql vars
	include '../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");
		
	//save changes
	if(isset($_POST['relf_name'])) {
		switch ($_POST['slctRel']) {
			case "case worker":
			case "nurse":
			case "doctor":
			case "dietician":
			case "physiotherapist":
				$isProf = 1;
				//get number of next caseworker
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
        
		$query = "UPDATE mowdata.contacts SET first_name = '" . trim($_POST['relf_name']);
		$query .= "', last_name = '" . trim($_POST['rell_name']) . "',relate = '" . $_POST['slctRel'];
		$query .= "',prof = '" .$isProf  . "', organ = '" .$_POST['relorg']  . "', address1 = '" .$_POST['add1'];
		$query .= "', address2 = '" . $_POST['add2'] . "', city = '" . $_POST['city'] . "', prov = '" . $_POST['prov'];
		$query .= "', post = '" . $_POST['post'] . "', email = '" . $psemail . "', phone1 = '" . $cPhoneA;
		$query .= "', phone2 = '" . $cPhoneB . "', phone3 = '" . $cPhoneC . "', phone3ext = '";
		$query .= $_POST['phonec3'] . "', editor = '" . $f_user . "' WHERE rid = " . $cRid ;
		mysql_query($query)  or die(mysql_error());
		
		//update member info if present
		
		if (isset($_GET['mid'])) {
			$emrg = 0;
			if(isset($_POST["rel_emrg"]))
				$emrg = 1;
			$refr = 0;
			if(isset($_POST["rel_refr"]))
				$refr = 1;
	
			$query = "UPDATE mowdata.client_relationships SET emerge='" . $emrg . "',refer='" . $refr . "',editor ='" . $f_user .  "' WHERE mid='" . $cMid . "' AND rid='" . $cRid . "'";
			mysql_query($query)  or die(mysql_error());
		}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<?php echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"5; url=client.php?do=show&spec=relate&mid=". $cMid . "\">"; ?>
<script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="editor/editor.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" />
<link type="text/css" rel="stylesheet" href="theme/default/alr3.css" />
</head>
<body bgcolor="#FFFFFF">
<?php include "../include/general/gtop.php";?>
</div></div>
<div class="w8"><table cellpadding="0" cellspacing="0" style="height:138px;margin:90px 0 0;width:374px;">
<tr><td style="vertical-align:top;width:273px;background: url(theme/default/img/alertleft.gif);padding:0;">
<center><br /><div style="padding: 15px 5px 0 5px; color:#fff; font-size:12px;">changes to entry for contact<b> <br /><?php echo $_POST['relf_name'] . " " . $_POST['rell_name']; ?> </b>were saved.</b></div><br /><input type="button" value="ok" onClick="window.open('client.php<?php echo "?do=show&spec=relate&mid=" . $cMid; ?>', '_self', ''); return false; " /></center></td>
<td style="width:101px;background: url(img/alertright.gif);">&nbsp;</td></tr>
</table></div></center>
</body></html><?php 
		} else {
		
			//setup to make changes
			$query = "SELECT * FROM mowdata.contacts WHERE rid='" . $cRid ."'";
			$result = mysql_query($query)  or die(mysql_error());
			$row = mysql_fetch_array($result);
		
			//define empty vars for select tag
			$r_list = array(0 => "case worker","nurse","dietician","physiotherapist","doctor","next of kin","husband","grandchild","wife","mother","father","brother","sister","friend","guardian","daughter","son","bill-to");
			
			$rno = count($r_list);
			
			$phone1a = substr($row['phone1'],0,3);
			$phone1b= "";
			if (strlen($row['phone1'] > 3))
				$phone1b= substr($row['phone1'],3);
			$phone2a = substr($row['phone2'],0,3);
			$phone2b= "";
			if (strlen($row['phone2'] > 3))
				$phone2b= substr($row['phone2'],3);
			$phone3a = substr($row['phone3'],0,3);
			$phone3b= "";
			if (strlen($row['phone3'] > 3))
				$phone3b= substr($row['phone3'],3);
			$phone3ext = $row['phone3ext'];
					
			
		switch ($row['relate']) {
			case "case worker":
			case "nurse":
			case "doctor":
			case "dietician":
			case "physiotherapist":
				$isProf = 1;
				//get number of next caseworker
				break;
			default:
				$isProf = 0;
		}	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="clib/ajax.js"></script>
<script type="text/javascript" src="js/sld.js"></script>
<script type="text/javascript" src="editor/editor.js"></script>
<script type="text/javascript">
function relDiv() {
  if (document.getElementById('slctRel').selectedIndex < 5) {
        document.getElementById('relOdiv').style.display = 'block';
        document.getElementById('relOfdiv').style.display = 'block';
        document.getElementById('relHphone').style.display = 'none';
        document.getElementById('relHfphone').style.display = 'none';
  } else {
	document.getElementById('relOdiv').style.display = 'none';
        document.getElementById('relOfdiv').style.display = 'none';
        document.getElementById('relHphone').style.display = 'block';
        document.getElementById('relHfphone').style.display = 'block';
  }
}
</script>
<link type="text/css" rel="stylesheet" href="c1.css" />
<link type="text/css" rel="stylesheet" href="editor/editor.css" />
</head>
<body bgcolor="#FFFFFF">
<?php include "../include/general/gtop.php";?>
</div></div>
<div class="w8">
<center><br />
<form name="contactedit" action="contacts.php?&rid=<?php
echo $cRid;
if (isset($cMid))
	echo "&mid=" . $cMid; ?>" method="post" style="border:1px solid #000;"><table style="border: none; margin: 0pt; padding: 0pt; width: 515px;" cellpadding="0" cellspacing="0"><tbody><tr><td style="padding: 0pt; width: 180px; text-align: left; height: 38px;"><div class="clName" style="width:450px;">Please note that you are editing the contact information for <b><?php echo $row['first_name'] . "  " .$row['last_name'] ; ?></b>. Any information changed here will be updated for <b>ALL OTHER CLIENTS for whom this person is also a contact.<br/><br/></b></div></td><td style="overflow: hidden; height: 38px; vertical-align: top;"><div id="cworkers" style="padding-top: 15px;"></div></td><td style="text-align: right; vertical-align: top;"><img src="theme/default/fdbsm.gif" alt="FeastDB" border="0" height="31" width="67"></td></tr></tbody></table>
<table class="inpte" cellpadding="0" cellspacing="0">
<tbody><tr>
<td class="rt">first&nbsp;name:</td><td><input class="i13" name="relf_name" maxlength="20" size="10" type="text" value="<?php echo $row['first_name']; ?>" />
&nbsp;last&nbsp;name:&nbsp;<input class="i13" name="rell_name" maxlength="20" size="10" id="rell_name" type="text" value="<?php echo $row['last_name']; ?>" />
</td></tr><tr><td class="rt">relationship:<div id="relOdiv" style="padding-top: 2px;<?php if(!$isProf)
echo "display:none;"; ?>">organization:</div></td><td><select name="slctRel" id="slctRel" onchange="relDiv()"><?php
for($i=0;$i<$rno;$i++) {
				echo "<option";
			if($r_list[$i] == $row['relate'])
				echo " selected=\"selected\"";
				echo ">" . $r_list[$i] . "</option>\n";
			}
			?></select>&nbsp;&nbsp;&nbsp;&nbsp;<br />
<div id="relOfdiv" style="padding-top: 2px;<?php if(!$isProf)
echo "display:none;"; ?>"><input class="i25" name="relorg" id="relOrg" maxlength="30" size="30" type="text" value="<?php echo $row['organ']; ?>" /></div>
</td></tr><tr><td class="rt" rowspan="2">address:</td><td><input class="i25" name="add1" maxlength="35" size="35" type="text" value="<?php echo $row['address1']; ?>"></td></tr><tr><td><input class="i25" name="add2" maxlength="35" size="35" type="text"value="<?php echo $row['address2']; ?>">

</td></tr><tr><td class="rt">city:</td><td><input class="i13" name="city" maxlength="25" size="25" value="<?php echo $row['city']; ?>" type="text">&nbsp;province/state:&nbsp;<input class="i2" name="prov" maxlength="2" size="2" value="<?php echo $row['prov']; ?>" type="text">&nbsp;&nbsp;postal&nbsp;code:&nbsp;<input class="i5" name="post" maxlength="7" size="7" style="text-transform: uppercase;" type="text" value="<?php echo $row['post']; ?>"></td></tr>
<tr><td colspan="2" style="vertical-align:top;"><div class="clName">Contact Info</div></td></tr><tr><td class="rt">email:</td><td><input class="i25" name="email" maxlength="45" size="10" type="text" value="<?php echo $row['email']; ?>"></td></tr><tr><td class="rt"><div id="relHphone" style="padding-bottom: 2px; <?php if($isProf)
echo "display:none;"; ?>">home:</div>work:</td><td><div id="relHfphone" style="<?php if($isProf)
echo "display:none;"; ?> padding-bottom: 2px;"><input class="i2" name="phone1" maxlength="3" size="3" value="<?php echo $phone1a; ?>" type="text">-<input class="i7" name="phone2" maxlength="10" size="10" type="text" value="<?php echo $phone1b; ?>" /><br></div><input class="i2" name="phonec1" maxlength="3" size="3" value="<?php echo $phone3a; ?>" type="text">-<input class="i7" name="phonec2" maxlength="10" size="10" type="text"  value="<?php echo $phone3b; ?>" > ext. <input class="i3" name="phonec3" maxlength="6" size="6" type="text" value="<?php echo $phone3ext; ?>" ></td></tr><tr><td class="rt">cell:</td><td><input class="i2" name="phoneb1" maxlength="3" size="3"  value="<?php echo $phone2a; ?>"  type="text">-<input class="i7" name="phoneb2" maxlength="10" size="10" type="text" value="<?php echo $phone2b; ?>" />

</td></tr><tr><td colspan="2"><br/><?php
			if (isset($_GET['mid'])) {
				
			//get emergency contact/refferal status
			$e_check = "";
			$r_check = "";
			
			$query = "SELECT * FROM mowdata.client_relationships WHERE mid='" . $cMid . "' AND rid='" . $cRid ."'";
			$result = mysql_query($query)  or die(mysql_error());
			$member = mysql_fetch_array($result);
			if ($member['emerge'] == 1)
				$e_check=" checked=\"checked\"";
			if ($member['refer'] == 1)
				$r_check=" checked=\"checked\"";
			
			//get member name
			$query = "SELECT * FROM mowdata.member WHERE mid='" . $cMid ."'";
			$result = mysql_query($query)  or die(mysql_error());
			$member = mysql_fetch_array($result);
			
		
echo "The following information is specific to " . $row['first_name'] . "  " . $row['last_name'] . "'s relationship with <b>" .  $member['first_name'] . "  " .$member['last_name']  .  "</b>:<br />"; 
?>&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_refr" class="chkbx" style="padding-left: 10px;" 
type="checkbox" value="1"<?php echo $r_check; ?> />&nbsp;Referring&nbsp;Party&nbsp;&nbsp;&nbsp;&nbsp;<input name="rel_emrg" class="chkbx" value="1"
type="checkbox"<?php echo $e_check; ?> />&nbsp;Emergency&nbsp;Contact<br /><br />
<?php

}

?>
</td></tbody></table>
<div style="float: right; padding-top: 10px;"><a href="client.php?do=show&spec=relate&mid=<?php echo $cMid; ?>" ><img src="editor/cancel.png" alt="cancel" title="CANCEL" onmouseover="this.src = 'editor/cancel_over.png'" onmouseout="this.src = 'editor/cancel.png'"></a>&nbsp;<a href="#" onclick="document.contactedit.submit(); return false;"><img src="editor/ok.png" alt="save" title="OK" onmouseover="this.src = 'editor/ok_over.png'" onmouseout="this.src = 'editor/ok.png'"></a></div>


</form>
</center></div></center>
</body></html><?php

	}
}
?>
