<?php
$printNow = 0;
if (isset($_GET['print']))
  $printNow = 1;

if ($printNow == 1) {
  include '../include/client/routepdf.php';
} else {
		//All deliveries for today will be processed once now.
		//This will reduce the amount of work needed to be done for creation
		//of route sheets and will simplify billing output.
	
	
		$thsyear = date('y');
		$thsmonth = date('m');
		$thsday = date('d');
		$thisWDay = date('D');

		//we should expel past billed meals for today.
		$query = "DELETE FROM mowdata.meals_billed WHERE date ='20" . $thsyear . "-" . $thsmonth . "-" . $thsday . "'";
		$result = mysql_query($query); 
		
	
	//create an array and store all special meals
	mysql_select_db("mowdata");
		
	$specials = array();
	$query = "SELECT * FROM meals_scheduled  WHERE mDate='20" . $thsyear . "-" . $thsmonth . "-" . $thsday . "'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array( $result )) {
		$tMID = $row['mid'];
		$specials[$tMID]['is'] = 1;
		$specials[$tMID]['mid'] = $row['mid'];
		$specials[$tMID]['meals'] = $row['mNumber'];
		$specials[$tMID]['portionsize'] = $row['mPortion'];
		$specials[$tMID]['side_ds'] = $row['mSideds'];
		$specials[$tMID]['side_dd'] = $row['mSidedd'];
		$specials[$tMID]['side_fs'] = $row['mSidefs'];
		$specials[$tMID]['side_gs'] = $row['mSidegs'];
		$specials[$tMID]['side_pd'] = $row['mSidepd'];
		$specials[$tMID]['side_gz'] = $row['mSidegz'];
		$specials[$tMID]['side_vb'] = $row['mSidevb'];
		$specials[$tMID]['side_vz'] = $row['mSidevz'];
		$specials[$tMID]['suspend'] = $row['mSuspend'];
	}
//select count(agent_id) as cnt from survey_table; 
				
		$query = "SELECT * FROM mowdata.client WHERE mealstatus='A'";
		$result = mysql_query($query);
		while($row=mysql_fetch_array($result)) {
			//reset to ensure the last meals aren't assigned to this user
			$meals   = 0; 
			$side_vz = 0;
			$payscale = 0;

			if($row['payscale'])
				$payscale = $row['payscale'];
			
			$tMID = $row['mid'];
			if ($row['dType']=="R") {
				//this client receives regular deliveries
				//does this person have a meal scheduled for this weekday?
				if ($row["d" . date('D')] == 1){ 
					if ($specials[$tMID]['is'] == 1){
						if ($specials[$tMID]['suspend'] != 1){
							//cancel if there is a suspension
							//add special meal if there is one
							$meals   = $specials[$tMID]['meals'];
							$side_ds = $specials[$tMID]['side_ds'];
							$side_dd = $specials[$tMID]['side_dd'];
							$side_fs =  $specials[$tMID]['side_fs'];
							$side_gs = $specials[$tMID]['side_gs'];
							$side_pd = $specials[$tMID]['side_pd']; 
							$side_gz = $specials[$tMID]['side_gz']; 
							$side_vb =  $specials[$tMID]['side_vb']; 
							$side_vz = $specials[$tMID]['side_vz'];
							$portion = $specials[$tMID]['portionsize'];
						}
					} else {
							//output the individuals default delivery
						$queryb = "SELECT * FROM mowdata.meals_default WHERE mid='" . $tMID . "'";
						$resultb = mysql_query($queryb);
						$rowb = mysql_fetch_array( $resultb );
						$meals   = $rowb['d' . $thisWDay . 'Number'];
						$side_ds =$rowb['d' . $thisWDay . 'Sideds'];
						$side_dd =$rowb['d' . $thisWDay . 'Sidedd'];
						$side_fs = $rowb['d' . $thisWDay . 'Sidefs'];
						$side_gs =$rowb['d' . $thisWDay . 'Sidegs'];
						$side_pd = $rowb['d' . $thisWDay . 'Sidepd'];
						$side_gz =$rowb['d' . $thisWDay . 'Sidegz'];
						$side_vb =$rowb['d' . $thisWDay . 'Sidevb'];
						$side_vz =$rowb['d' . $thisWDay . 'Sidevz'];
						$portion = $rowb['d' . $thisWDay . 'Portion'];
					}
				} else {
					if (($specials[$tMID]['is'] == 1)&&($specials[$tMID]['suspend'] != 1)){
						//output a special delivery
						$meals   = $specials[$tMID]['meals'];
						$side_ds = $specials[$tMID]['side_ds'];
						$side_dd = $specials[$tMID]['side_dd'];
						$side_fs =  $specials[$tMID]['side_fs'];
						$side_gs = $specials[$tMID]['side_gs'];
						$side_pd = $specials[$tMID]['side_pd']; 
						$side_gz = $specials[$tMID]['side_gz']; 
						$side_vb =  $specials[$tMID]['side_vb']; 
						$side_vz = $specials[$tMID]['side_vz'];
						$portion = $specials[$tMID]['portionsize'];
				}
			}
		} elseif ($specials[$tMID]['is'] == 1){
			//this client receives episodic deliveries
			//output the individuals default delivery
						$meals   = $specials[$tMID]['meals'];
						$side_ds = $specials[$tMID]['side_ds'];
						$side_dd = $specials[$tMID]['side_dd'];
						$side_fs =  $specials[$tMID]['side_fs'];
						$side_gs = $specials[$tMID]['side_gs'];
						$side_pd = $specials[$tMID]['side_pd']; 
						$side_gz = $specials[$tMID]['side_gz']; 
						$side_vb =  $specials[$tMID]['side_vb']; 
						$side_vz = $specials[$tMID]['side_vz'];
						$portion = $specials[$tMID]['portionsize'];
		}
		if (($meals > 0)||($side_vz > 0)){
		$addbill = "INSERT INTO mowdata.meals_billed (";
		$addbill .= "mid,mNumber,mSize,mSidedd,mSideds,mSidefs,mSidegs,mSidepd,mSidegz,mSidevb,mSidevz,payscale,";
		$addbill .= "date,editor) VALUES ('" . $tMID . "','" . $meals . "','" . $portion . "','" . $side_dd . "','" . $side_ds;
		$addbill .= "','" . $side_fs . "','" . $side_gs . "','" . $side_pd . "','" . $side_gz . "','" . $side_vb;
		$addbill .= "','" . $side_vz . "','" . $payscale . "','20" . $thsyear . "-" . $thsmonth . "-" . $thsday . "','" .  $f_user ."')";
		$addbillresult = mysql_query($addbill) or die(mysql_error());
		}		
	}
	unset($specials);
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><title>FeastDB - Fireboy Technologies</title><meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="clib/ncwid.js"></script>
<link type="text/css" rel="stylesheet" href="theme/default/c1.css" /></head>
<body bgcolor="#FFFFFF">
<?php include "../include/general/gtop.php";?>
<div id="ut"><div id="us"><ul><li class="sp"><b><span> <br></span> </b></li><li class="dv"><a
class="pg"><span class="h6"> <br></span>clients</a></li><li 
class="sp"><b><span> <br></span> </b></li><li class="dv"><a
href="?do=new"><span class="h6"> <br></span>create new</a></li><li class="sp"><b><span> <br></span> </b></li><li class="df"><a
href="?go=search"><span class="h6"> <br></span>search</a></li></ul></div></div></div><div id="fn" class="w8"><form name="mowcreate" action="?do=routesheet&print=now" method="post"><table width="100%" border="0" cellpadding="0"
cellspacing="0">

<tr id="ft">
<td class="ll"> </td>
<td class="ml"> </td>
<td class="mc"> </td>
<td class="rr"> </td>
</tr><tr id="sr">
<td class="ll"><div style="font-size:13px;padding:0 25px; float:right; width:200px;color:#BBBBBB;">Let's print off the route sheets.<br />&nbsp;</div></td>
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
</div></div><div class="snd"><input type="submit" value="Make Route Sheets &raquo;" /></div>
</th></tr><tr>
<td rowspan="2"><img src="theme/default/p1/apl.gif" width="138"height="150" border="0"alt="FeastDB" /></td>
<td class="gr"> </td></tr></table></form></div><div class="fbt"><a 
href="http://www.fireboytech.com">2008 © fireboy technologies</a></div>
</div></div></div></center></body></html><?php } ?>
