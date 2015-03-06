<?php
		function cmp($a, $b){
			return strcmp($a["last_name"], $b["last_name"]);
		}
$newline = "
";

header("Content-type:application/csv");
header("Content-Disposition:inline;filename=touchbase.csv");

	//set some vars
	$yesimg = "Y";
	$people = array();
	$count = array();
	$count['CS'] = 0;
	$count['CDN'] = 0;
	$count['ME'] = 0;
	$count['MG'] = 0;
	$count['MGW'] = 0;
	$count['NDG'] = 0;
	$count['CV'] = 0;
	$count['WM'] = 0;

	$Mon = array();
	$Mon['CS'] = 0;
	$Mon['CDN'] = 0;
	$Mon['ME'] = 0;
	$Mon['MG'] = 0;
	$Mon['MGW'] = 0;
	$Mon['NDG'] = 0;
	$Mon['CV'] = 0;
	$Mon['WM'] = 0;

	$Tue = array();
	$Tue['CS'] = 0;
	$Tue['CDN'] = 0;
	$Tue['ME'] = 0;
	$Tue['MG'] = 0;
	$Tue['MGW'] = 0;
	$Tue['NDG'] = 0;
	$Tue['CV'] = 0;
	$Tue['WM'] = 0;
	
	$Wed = array();
	$Wed['CS'] = 0;
	$Wed['CDN'] = 0;
	$Wed['ME'] = 0;
	$Wed['MG'] = 0;
	$Wed['MGW'] = 0;
	$Wed['NDG'] = 0;
	$Wed['CV'] = 0;
	$Wed['WM'] = 0;
	
	$Thu = array();
	$Thu['CS'] = 0;
	$Thu['CDN'] = 0;
	$Thu['ME'] = 0;
	$Thu['MG'] = 0;
	$Thu['MGW'] = 0;
	$Thu['NDG'] = 0;
	$Thu['CV'] = 0;
	$Thu['WM'] = 0;
	
	$Fri = array();
	$Fri['CS'] = 0;
	$Fri['CDN'] = 0;
	$Fri['ME'] = 0;
	$Fri['MG'] = 0;
	$Fri['MGW'] = 0;
	$Fri['NDG'] = 0;
	$Fri['CV'] = 0;
	$Fri['WM'] = 0;
	
	$Sat = array();
	$Sat['CS'] = 0;
	$Sat['CDN'] = 0;
	$Sat['ME'] = 0;
	$Sat['MG'] = 0;
	$Sat['MGW'] = 0;
	$Sat['NDG'] = 0;
	$Sat['CV'] = 0;
	$Sat['WM'] = 0;
	

//setup mysql access
	include '../include/config/mysql_login.php';
	mysql_connect("localhost", $mysqluser, $mysqlpass);
	mysql_select_db("mowdata");
//find active clients on this route
	$query = "SELECT * FROM mowdata.client WHERE mealstatus= 'A'";
	$result = mysql_query($query);

	//add clients to an array and count them
	while($row = mysql_fetch_array( $result )){
		$q2 = "SELECT * FROM mowdata.member WHERE mid=" . $row['mid'] ;
		$r2 = mysql_query($q2);
		$person = mysql_fetch_array( $r2 );
		$tmid = $person['mid'];
		$people[$tmid]['first_name'] = $person['first_name'];
		$people[$tmid]['last_name'] = $person['last_name'];
		$people[$tmid]['phone'] = substr($person['phone'],0,3) . "-" . substr($person['phone'],3,3) . "-";
		$people[$tmid]['phone'] .= substr($person['phone'],6);
		$people[$tmid]['lang'] = $row['clang'];
		$count[$row['dRoute']]++;
		$people[$tmid]['droute'] = $row['dRoute'];
		$people[$tmid]['dtype'] = $row['dType'];
		$people[$tmid]['Mon'] = $row['dMon'];
		$people[$tmid]['Tue'] = $row['dTue'];
		$people[$tmid]['Wed'] = $row['dWed'];
		$people[$tmid]['Thu'] = $row['dThu'];
		$people[$tmid]['Fri'] = $row['dFri'];
		$people[$tmid]['Sat'] = $row['dSat'];

                $q2 = "SELECT * FROM mowdata.meals_default WHERE mid=" . $row['mid'] ;
                $r2 = mysql_query($q2);
                $person = mysql_fetch_array( $r2 );
                if ($row['dMon'])
                        $people[$tmid]['Mon']=$person['dMonNumber'];
                if ($row['dTue'])
                        $people[$tmid]['Tue']=$person['dTueNumber'];
                if ($row['dWed'])
                        $people[$tmid]['Wed']=$person['dWedNumber'];
                if ($row['dThu'])
                        $people[$tmid]['Thu']=$person['dThuNumber'];
                if ($row['dFri'])
                        $people[$tmid]['Fri']=$person['dFriNumber'];
                if ($row['dSat'])
                        $people[$tmid]['Sat']=$person['dSatNumber'];
	
	}
	//sort the array alphabetically by last name
	uasort($people, 'cmp');

	for ($j=0;$j<=7;$j++) {

	//name route

	switch ($j) {
		case 0:
		$dlet = "CS";
		$droutename = "Centre Sud";
		  break;
		case 1:
		$dlet = "CDN";
		$droutename = "Cote Des Neiges";
		  break;
		case 2:
		$dlet =  "ME";
		$droutename = "Mile End";
		  break;
		case 3:
		$dlet =  "MG";
		$droutename = "McGill";
		  break;
		case 4:
		$dlet =  "MGW";
		$droutename = "McGill West";
		  break;
		case 5:
		$dlet =  "NDG";
		$dRoute = "Notre Dame de Grace";
		  break;
		case 6:
		$dlet =  "CV";
		$droutename = "Downtown";
		  break;
		case 7:
		$dlet =  "WM";
		$droutename = "Westmount";
		break;
		default:
		$droutename = "";
	}

		$ptemp = $people;

		if ($j > 0)
			echo ",,,,,,,,," . $newline;
		echo "Route:," . $droutename . ",,,,,,,," . $newline;
		echo "Last Name,First Name,Phone,Lang,Mon,Tue,Wed,Thu,Fri,Sat" . $newline;
		while (list($key, $value) = each($ptemp)) {
   		   if($people[$key]['droute'] == $dlet){
			echo $people[$key]['last_name'] . "," . $people[$key]['first_name'] . ",";
			echo $people[$key]['phone'] . "," . $people[$key]['lang'] . ",";
			if($people[$key]['dtype'] != 'R')
				echo "episodic,,,,";
			else {
				if ($people[$key]['Mon'])
					echo $people[$key]['Mon'];
				echo ",";
				if($people[$key]['Tue'])
					echo $people[$key]['Tue'];
				echo ",";
				if($people[$key]['Wed'])
					echo $people[$key]['Wed'];
				echo ",";
				//if($people[$key]['Thu'])
				//	echo $people[$key]['Thu'];
				echo ",";
				if($people[$key]['Fri'])
					echo $people[$key]['Fri'];
				echo ",";
				if($people[$key]['Sat'])
					echo $people[$key]['Sat'];
				echo ",";
				$Mon[$dlet] += $people[$key]['Mon'];
				$Tue[$dlet] += $people[$key]['Tue'];
				$Wed[$dlet] += $people[$key]['Wed'];
				//$Thu[$dlet] += $people[$key]['Thu'];
				$Fri[$dlet] += $people[$key]['Fri'];
				$Sat[$dlet] += $people[$key]['Sat'];
			}
		 	echo $newline;
		    }
		}
		echo ",,,,,,,,," . $newline;
		echo "Total Clients," . $count[$dlet] . ",Ongoing Totals(by Day),," . $Mon[$dlet] . "," . $Tue[$dlet] . "," . $Wed[$dlet] . "," . $Thu[$dlet] . "," . $Fri[$dlet] . "," . $Sat[$dlet] . $newline;
		
}
?>
