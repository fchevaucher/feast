<?php
//uncomment to debug
//include "../include/showerror.php";

include './gsession.php';
if(isset($_GET['client'])){
if ($_GET['client']=="del") {
	$cMid = $_GET['mid'];
	$rid_to_del = 0;
	if (strlen($_GET['rid']) > 1) 
	$rid_to_del = $_GET['rid'];
	  include '../include/config/mysql_login.php';

  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");
	$query = "DELETE from client_relationships WHERE mid='" . $cMid . "' and rid='" . $rid_to_del ."'";
	mysql_query($query)  or die(mysql_error());

//send the user back to the page they were at
	include "../include/return.php";
} elseif($_GET['client'] == "new"){

include "../include/client/cnewrelat1.php";

} else {
echo "An error has occured.";
}
} elseif(isset($_GET['change'])){ 
$cMid = $_GET['mid'];
$mstatus = "A";
if($_GET['change'] == "status"){
	if (isset($_POST['newstatus'])) {
	if (strlen($_POST['newstatus']) == 1)
	$mstatus = $_POST['newstatus'];
	}
	  include '../include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");
$query = "UPDATE client SET mealstatus='" . $mstatus . "' WHERE mid='" . $cMid ."'";
mysql_query($query)  or die(mysql_error());
} elseif($_GET['change'] == "route"){
        if (isset($_POST['newroute'])) {
        if ($_POST['newroute'] != "NA")
        $newroute = $_POST['newroute'];
        }
          include '../include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");
$query = "UPDATE client SET dRoute='" . $newroute . "' WHERE mid='" . $cMid ."'";
mysql_query($query)  or die(mysql_error());
} elseif (isset($_POST['newdtype'])) {
//if (isset($_POST['newdtype'])) {
	$mstatus = "R";
	if (strlen($_POST['newdtype']) == 1)
	$mstatus = $_POST['newdtype'];
//	}
	  include '../include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");
$query = "UPDATE client SET dType='" . $mstatus . "' WHERE mid='" . $cMid ."'";
mysql_query($query)  or die(mysql_error());
} elseif (isset($_POST['newdirect'])) {
	if (strlen($_POST['newdirect']) > 1)
	$direct = $_POST['newdirect'];

	  include '../include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");
$query = "UPDATE client SET dDirections='" . mysql_real_escape_string($direct) . "' WHERE mid='" . $cMid ."'";
mysql_query($query)  or die(mysql_error());
}
	//send the user back to the page they were at
	include "../include/return.php";
} elseif (!(isset($_GET['spec']))) {
//error
die('error');
} else {
$cSpec = $_GET['spec'];

  include '../include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");
  if ($cSpec == "home") {
	if (isset($_POST['email']))
	$psemail = $_POST['email'];
	else
	$psemail = "";
	$cPhoneA = $_POST['phone1'] . str_replace("-","",$_POST['phone2']);
	$cPhoneB = $_POST['phoneb1'] . str_replace("-","",$_POST['phoneb2']);
	$query = "UPDATE member SET first_name='" . trim($_POST['f_name']) . "', m_name='" . $_POST['m_name'] . "', ";
	$query .= "last_name='" . trim($_POST['l_name']) . "', address1='" . mysql_real_escape_string(trim($_POST['add1'])) . "', address2='" . mysql_real_escape_string(trim($_POST['add2']));
	$query .= "', city='" . $_POST['city'] . "', prov='" . $_POST['prov'] . "', post='" . strtoupper($_POST['post']) . "', phone='";
	$query .= $cPhoneA . "', phoneb='" . $cPhoneB . "', email='" . $psemail . "' WHERE mid='" . $_POST['mid'] . "'";

	//update the client to member database
	mysql_query($query)  or die(mysql_error());
  
  } elseif ($cSpec == "meal") {

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
		$query .= "mDiet_msg='" . $_POST['dietr_i6'] . "', mDiet_glut='" . $_POST['dGluten'] . "', mDiet_div='" . $_POST['dDiv'] . "', mLabel='" . $_POST['dLabel'] . "'  WHERE mid='" . $_GET['mid'] . "'";
		//Add the info from the last page to the client database
		mysql_query($query)  or die(mysql_error());
  } elseif ($cSpec == "relate") {
	$cwID = 0;
	if(isset($_GET['cwid'])){
	if($_GET['cwid'] > 1)
	$cwID = $_GET['cwid'];
	}

	if($cwID > 1) {
		$query = "INSERT INTO client_relationships (mid, rid) Values ('";
		$query .= $_GET['mid'] . "','" . $cwID . "')";
    } else {
	$cwID = 0;
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
        $query = "INSERT INTO contacts (first_name, last_name,relate,  prof, organ, address1, address2, city, prov, ";
	$query .= "post, email, phone1, phone2, phone3, phone3ext, editor) Values ('";
	$query .= trim($_POST['relf_name'])  . "','" . trim($_POST['rell_name'])  . "','" . $_POST['slctRel'];
	$query .=  "','" .  $isProf . "','"  . $_POST['relorg'] . "','";
	$query .= $_POST['add1'] . "','" . $_POST['add2'] . "','" . $_POST['city'] . "','" . $_POST['prov'] . "','" . $_POST['post'];
	$query .= "','" . $psemail . "','" . $cPhoneA . "','" . $cPhoneB . "','" . $cPhoneC . "','" . $_POST['phonec3'] . "','" . $f_user . "')";
	
	//save and get the rid
	mysql_query($query)  or die(mysql_error());
	$query = "SELECT MAX(rid) AS rid FROM contacts";
	$result = mysql_query($query) or die(mysql_error());
	$rid ="";
	$row = mysql_fetch_array($result);
	$rid = $row['rid'] ;	

	//check if contact is the emergency contact/refering party
	$emrg = 0;
	if(isset($_POST["rel_emrg"]))
		$emrge = 1;
	$refr = 0;
	if(isset($_POST["rel_refr"]))
		$refr = 1;
	
	$query = "INSERT INTO client_relationships (mid,rid,emerge,refer,editor) Values (";
	$query .= $_GET['mid'] . "," . $rid . "," . $emrg . "," . $refr . ",'" . $f_user .  "')";
	
     }
	 //add the entry
       mysql_query($query)  or die(mysql_error());
    } elseif ($cSpec == "route") {
	//update stop number for each client
	for ($i = 1; $i <= $_POST['noStops']; $i++) {
	$query = "UPDATE client SET dStop='" . $_POST['or_stp' . $i] . "' WHERE mid='" . $_POST['or_mid' . $i] . "'";
	//line for debugging
	//echo $_POST['or_stp' . $i] . "-$i" . $_POST['or_mid' . $i] . "<br />";
	mysql_query($query)  or die(mysql_error());
	}
} elseif ($cSpec == "refer") {
	
	
	
	$bTo= $_POST['billTo'];
	$cMid = $_GET['mid'];
	
	//set all relationships billto to false
	$query = "UPDATE client_relationships SET billto='1' WHERE mid = '" . $cMid . "' and billto='1'";
	$result = mysql_query($query);

$sal = "";
$address1 = "";
$address2 = "";
$address3 = "";
$city = "";
$prov = "";
$post = "";
$phone = "";
$ext = "";
$output="";
$account =  "";




$authno = "";

if ($bTo == "cur") {
	$account =  $_POST['baccount'];
	$address1 = $_POST['betage'];
} elseif ($bTo == "blu") {
	$account =  $_POST['bacc'];
	$authno = $_POST['bauth'];
} elseif ($bTo == "oth") {
$sal = $_POST['salut'];
$address1 = $_POST['add1'];
$address2 = $_POST['add2'];
$address3 = $_POST['add3'];
$city = $_POST['city'];
$prov = $_POST['prov'];
$post = strtoupper($_POST['post']);
$phone = $_POST['phone1'] . $_POST['phone2'];
$ext = $_POST['ext'];
} elseif  ($bTo != "slf") {
	$relno = substr($bTo,1);
			$query = "UPDATE client_relationships SET billto='1' WHERE mid='" . $cMid . "' AND rid='" . $relno . "'";
        //add the entry 
	mysql_query($query)  or die(mysql_error());
	
}  
$query = "UPDATE client_billing SET billto='" .  $bTo. "',
accountno='". $account . "',
authno='". $authno . "',
address1='". $address1 . "',
address2='". $address2 . "',
address3='". $address3 . "',
salutation='". $sal . "',
city='". $city . "',
prov='". $prov . "',
post='". $post . "',
phone='". $phone . "',
ext='". $ext . "' WHERE mid='" . $cMid . "'";
mysql_query($query)  or die(mysql_error());

} elseif ($cSpec == "dlvr") {
$cMid = $_GET['mid'];
if ($_POST['changeType'] == "add"){
$thisTimeStamp = mktime(0, 0, 0, $_POST['mMonth'], $_POST['mDay'], $_POST['mYear']);
$thisMonth = $_POST['mMonth'];
$thisYear = $_POST['mYear'];
$thisDay = sprintf("%02d", $_POST['mDay']);
//Is there already a special entry for this day.
//If there is update it. If not insert a new entry.
$dayExist = 0;
$query = "SELECT * FROM meals_scheduled  WHERE mid = '" . $cMid . "'";
$result = mysql_query($query) or die(mysql_error());
$mSide = array();
$mSide['fs'] = 0;
$mSide['gs'] = 0;
$mSide['dd'] = 0;
$mSide['ds'] = 0;
$mSide['pd'] = 0;
$mSide['gz'] = 0;
$mSide['vz']  = 0;
$mSide['vb'] = 0;
$mSuspend = 0;
for ($i = 0; $i <= 9; $i++){
if ($_POST['skip' . $i] != "skip"){
	if ($_POST['slct' . $i] == "sd"){
	$mSide[$_POST['dsh' . $i]] = $_POST['nosd' . $i]; 
	} else {
	$mSide[$_POST['slct' . $i]] = $_POST['nosd' . $i]; 
	}
}
}

if ($_POST['ismeal'] == "meal") {
	$mPortion = $_POST['msize'];
	$mNumber = $_POST['mnumber'];
	} else {
	$mSide['vz'] = 1;
	$mPortion = "R";
	$mNumber = 0;
	}

	while($row = mysql_fetch_array( $result )) {
	 if ($row['mDate'] == $_POST['mDay']) 
	$dayExist = 1;
	 }

    if	($dayExist == 1){
    //update the entry
    $query = "UPDATE meals_scheduled SET mPortion='" . $mPortion . "', mNumber='";
	$query .= $mNumber . "', mSidefs='" . $mSide['fs'] . "', mSidegs='". $mSide['gs']. "', mSidedd='";
	$query .= $mSide['dd'] . "', mSideds='" . $mSide['ds'] . "', mSidepd='" . $mSide['pd'] . "', mSidegz='";
	$query .= $mSide['gz'] . "', mSidevz='" . $mSide['vz']. "', mSidevb='" . $mSide['vb'] . "', mSuspend='";
	$query .= $mSuspend . "', editor='" . $f_user_name . "' WHERE mid='" . $cMid . "' AND mDate='20" . $thisYear . "-" . $thisMonth . "-" . $thisDay . "'";
    } else {
	//create a new entry
	$query = "INSERT INTO meals_scheduled (mid, mDate, mPortion, mNumber, mSidefs, mSidegs, mSidedd, mSideds, mSidepd, mSidegz, mSidevz, mSidevb, mSuspend, editor) ";
	$query .= "VALUES ('" . $cMid .  "','20" . $thisYear . "-" . $thisMonth . "-" . $thisDay . "','" . $mPortion . "','" . $mNumber . "','";
	$query .= $mSide['fs'] . "','" . $mSide['gs']. "','" . $mSide['dd'] . "','" . $mSide['ds'] . "','" . $mSide['pd'] . "','" . $mSide['gz'] . "','" . $mSide['vz'] . "','" . $mSide['vb'] . "','" . $mSuspend . "','" . $f_user_name . "')";
    }
//for debugging
//echo "<br />" . $query . "<br />";
mysql_query($query)  or die(mysql_error());
} elseif ($_POST['changeType'] == "rem"){
$thisMonth = $_POST['mMonth'];
$thisYear = $_POST['mYear'];
$thisDay = sprintf("%02d", $_POST['mDay']);
$query = "DELETE FROM meals_scheduled WHERE mid='" . $cMid . "' AND mDate='20" . $thisYear . "-" . $thisMonth . "-" . $thisDay . "'";
mysql_query($query)  or die(mysql_error());
} elseif ($_POST['changeType'] == "susp"){
$thisMonth = $_POST['mMonth'];
$thisYear = $_POST['mYear'];
$thisDay = sprintf("%02d", $_POST['mDay']);
$query = "INSERT INTO meals_scheduled (mid, mDate, mSuspend, editor) ";
$query .= "VALUES ('" . $cMid .  "','20" . $thisYear . "-" . $thisMonth . "-" . $thisDay . "','1','" . $f_user_name . "')";
mysql_query($query)  or die(mysql_error());
}
//apply any changes to regular delivery days
$query = "UPDATE client SET dMon='" . $_POST['chkM'] . "', dTue='" . $_POST['chkT'] ;
$query .= "', dWed='" . $_POST['chkW'] . "', dFri='". $_POST['chkF'] . "', dSat='" .  $_POST['chkS'];
$query .= "' WHERE mid='" . $cMid . "'";
mysql_query($query)  or die(mysql_error());
$qDay=array();
$fi = 0;
if ($_POST['defM'] == 1) {
$qDay[$fi] = 'Mon';
$fi++;
}
if ($_POST['defT'] == 1) {
$qDay[$fi] = 'Tue';
$fi++;
}
if ($_POST['defW'] == 1) {
$qDay[$fi] = 'Wed';
$fi++;
}
if ($_POST['defF'] == 1) {
$qDay[$fi] = 'Fri';
$fi++;
}
if ($_POST['defS'] == 1) {
$qDay[$fi] = 'Sat';
$fi++;
}

if ($fi > 0) {
for ($f = 0; $f < $fi; $f++) {
$query = "UPDATE meals_default SET d" . $qDay[$f] . "Portion='" . $mPortion . "', d" . $qDay[$f] . "Number='";
$query .= $mNumber . "', d" . $qDay[$f] . "Sidefs='" . $mSide['fs'] . "', d" . $qDay[$f] . "Sidegs='". $mSide['gs']. "', d" . $qDay[$f] . "Sidedd='";
$query .= $mSide['dd'] . "', d" . $qDay[$f] . "Sideds='" . $mSide['ds'] . "', d" . $qDay[$f] . "Sidepd='" . $mSide['pd'] . "', d" . $qDay[$f] . "Sidegz='";
$query .= $mSide['gz'] . "', d" . $qDay[$f] . "Sidevz='" . $mSide['vz']. "', d" . $qDay[$f] . "Sidevb='" . $mSide['vb'] . "' WHERE mid='" . $cMid ."'";
mysql_query($query)  or die(mysql_error());
}
$query = "UPDATE client SET mPortion='" . $mPortion . "' WHERE mid='" . $cMid . "'";
mysql_query($query)  or die(mysql_error());
}
}
$cMid = $_GET['mid'];
$query = "SELECT * FROM member WHERE mid = '" . $cMid . "'";
$result = mysql_query($query);
// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );
//now send the user back to the page they were at.
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<?php echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"5; url=client.php?do=show&spec=" . $cSpec . "&mid=". $cMid . "\">"; ?>
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
<center><br /><div style="padding: 15px 5px 0 5px; color:#fff; font-size:12px;">changes to entry for client<b> <br /><?php echo $row['first_name'] . " " . $row['last_name']; ?> </b>were saved.</b></div><br /><input type="button" value="ok" onClick="window.open('client.php<?php echo "?do=show&spec=" . $cSpec . "&mid=" . $cMid; ?>', '_self', ''); return false; " /></center></td>
<td style="width:101px;background: url(theme/default/img/alertright.gif);">&nbsp;</td></tr>
</table></div></center>
</body></html>
<?php
}
?>
