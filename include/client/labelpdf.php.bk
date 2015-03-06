<?php

include "../include/showerror.php";
require_once('../public/tcpdf/config/lang/eng.php');
require_once('../public/tcpdf/tcpdf.php');
//use to create newline when generating pdfs
$cReturn = "\n";
$resIngNo = 0;
$resIng = array();
for ($i = 1; $i < 16; $i++) {
	if (strlen($_POST['dietr_i' . $i]) >1){
	$resIng[$resIngNo] = $_POST['dietr_i' . $i];
	$resIngNo++;
	}
}


// extend TCPF with custom functions
class MYPDF extends TCPDF { 
    public function MultiRow($left, $right) {
        //MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)
        
        $page_start = $this->getPage();
        $y_start = $this->GetY();
        
        // write the left cell
        $this->MultiCell(40, 0, $left, 0, 'R', 0, 2, '', '', true, 0);
        
        $page_end_1 = $this->getPage();
        $y_end_1 = $this->GetY();
        
        $this->setPage($page_start);
        
        // write the right cell
        $this->MultiCell(0, 0, $right, 0, 'J', 0, 1, $this->GetX() ,$y_start, true, 0);
        
        $page_end_2 = $this->getPage();
        $y_end_2 = $this->GetY();
        
        // set the new row position by case
        if (max($page_end_1,$page_end_2) == $page_start) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 == $page_end_2) {
            $ynew = max($y_end_1, $y_end_2);
        } elseif ($page_end_1 > $page_end_2) {
            $ynew = $y_end_1;
        } else {
            $ynew = $y_end_2;
        }
        
        $this->setPage(max($page_end_1,$page_end_2));
        $this->SetXY($this->GetX(),$ynew);
    }

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fireboy Technologies');
$pdf->SetTitle('Meal Labels');
$pdf->SetSubject('Santropol Roulant Meal Labels');
$pdf->SetKeywords('Santropol, Santropol Roulant, popote, label, labels');

// set default header data
//$pdf->SetHeaderData(0, 0, 0, 0);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(6, 7, 6);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 6);
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);
$pdf->SetFont('helvetica', '', 12);

  include '/var/www/feastdb/include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");


//set some variables
$thisDay = date('d');
$thisWDay = date('D');
$thisMonth = date('m');
$thisYear = date('y');
$thisTable = "meals" . $thisMonth . "_" . $thisYear;
$thisTimeStamp = mktime(0, 0, $thisDay, $thisMonth, 1, $thisYear);

$const=array();
$const[1]="salt";
$const[2]="spicy";
$const[3]="chocolate";
$const[4]="dairy";
$const[5]="dairy";
$const[6]="MSG";
$const[7]="rice";
$const[8]="potato";
$const[9]="nuts";
$const[10]="pasta";
$const[11]="poultry";
$const[12]="ham";
$const[13]="pork";
$const[14]="beef";
$const[15]="veal";
$const[16]="fish";


$RouteOut= array();
$rTotals = array();
$specials = array();
$i=0;
$j=0;

$query = "SELECT * FROM meals_scheduled  WHERE mDate='20" . $thisYear . "=" . $thisMonth . "-" . $thisDay . "'";
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
$i++;
}
$spTotal = $i;

$rTotals['no'] = 0;
$rTotals['meals'] = 0;
$rTotals['special'] = 0;
$rTotals['reg'] = 0;


$query = "SELECT * FROM client WHERE mealstatus='A'"; // ORDER BY Portion ASC";
$result = mysql_query($query);

//---START GET MEALS
while($row = mysql_fetch_array( $result )) {
$tMID = $row['mid'];
if ($row['dType']=="R") {
	//this client receives regular deliveries
	//does this person have a meal scheduled for this weekday?
	if ($row["d" . $thisWDay] == 1){ 
		if ($specials[$tMID]['is'] == 1){
			if ($specials[$tMID]['suspend'] != 1){
		//cancel if there is a suspension
		//add special meal if there is one
		
		$rTotals['no'] ++;
		$rTotals['meals'] += $specials[$tMID]['meals'];
		$RouteOut[$j]  = $specials[$tMID];
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['route']  = $row['dRoute'];
		$RouteOut[$j]['special'] = 0;
		if ($row['mMealmod_cut'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_pur'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_dat'])
		$RouteOut[$j]['date'] = 1;
		if ($RouteOut[$j]['portionsize'] != "R")
			$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_dat'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealdiabete'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealallergy'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mDiet_glut'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mDiet_div'])
		$RouteOut[$j]['special'] = 1;
		if ($RouteOut[$j]['special'] == 0) {
			for ($d = 0; $d < $resIngNo; $d++) {
				if ($row['mDiet_' . $resIng[$d]])
				$RouteOut[$j]['special'] = 1;
			}
		}
		if ($RouteOut[$j]['special']  == 1) 
		$rTotals['special'] += $RouteOut[$j]['meals'];
		$j++;
		 }
		} else {
		//output the individuals default delivery
		$rTotals['no'] ++;
		$queryb = "SELECT * FROM meals_default WHERE mid='" . $tMID . "'";
		$resultb = mysql_query($queryb);
		$rowb = mysql_fetch_array( $resultb );
		$rTotals['meals'] += $rowb['d' . $thisWDay . 'Number'];
		$RouteOut[$j]['is'] = 1;
		$RouteOut[$j]['mid'] = $tMID;
		$RouteOut[$j]['meals'] = $rowb['d' . $thisWDay . 'Number'];
		$RouteOut[$j]['portionsize'] = $row['mPortion'];
		$RouteOut[$j]['sp_words'] = "";
		$queryb = "SELECT * FROM client WHERE mid='" . $tMID . "'";
		$resultb = mysql_query($queryb);
		$rowb = mysql_fetch_array( $resultb );
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['route']  = $row['dRoute'];
		$RouteOut[$j]['special'] = 0;
		if ($RouteOut[$j]['portionsize'] != "R")
			$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_cut']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "CutUp /";
			}
		if ($row['mMealmod_pur']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "puree /";
			}
		if ($row['mPortion'] != "R")
			$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_dat']) {
		$RouteOut[$j]['date'] = 1;
		$RouteOut[$j]['special'] = 1;
			}
		if ($row['mMealdiabete']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "diab /";
			}
		if ($row['mMealallergy']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "allerg /";
			}
		if ($row['mDiet_glut']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "glut /";
			}
		if ($row['mDiet_div']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "DIV /";
			}
		if ($RouteOut[$j]['special'] == 0) {
			for ($d = 0; $d < $resIngNo; $d++) {
				if ($row['mDiet_' . $resIng[$d]]){
				$RouteOut[$j]['special'] = 1;
// 				$RouteOut[$j]['sp_words'] .= " " . $const[$d+1];
	                       }
			}
		}
		if ($RouteOut[$j]['special']  == 1) 
		$rTotals['special'] += $RouteOut[$j]['meals'];
		$j++;	
		}
	} else {
		//  client does not normally receive meals on this day
		if ($specials[$tMID]['is'] == 1){
			if ($specials[$tMID]['suspend'] != 1){
                $RouteOut[$j]['label']  = $row['mLabel'];
                $RouteOut[$j]['route']  = $row['dRoute'];
	
		$rTotals['no'] ++;
		$rTotals['meals'] += $specials[$tMID]['meals'];
		$RouteOut[$j]  = $specials[$tMID];
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['route']  = $row['dRoute'];
		$RouteOut[$j]['special'] = 0;
		$RouteOut[$j]['important'] = "";
		if ($RouteOut[$j]['portionsize'] != "R")
			$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_cut'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_pur'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_dat'])
		$RouteOut[$j]['date'] = 1;
		if ($row['mMealmod_dat'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealdiabete'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealallergy'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mDiet_glut'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mDiet_div'])
		$RouteOut[$j]['special'] = 1;
		if ($RouteOut[$j]['special'] == 0) {
			for ($d = 0; $d < $resIngNo; $d++) {
				if ($row['mDiet_' . $resIng[$d]])
				$RouteOut[$j]['special'] = 1;
			}
		}
		if ($RouteOut[$j]['special']  == 1) 
		$rTotals['special'] += $RouteOut[$j]['meals'];
		$j++;
		}
	}
 }
} elseif ($specials[$tMID]['is'] == 1){
//this client receives episodic deliveries

//$rTotals['special'] += 0;
//$rTotals['reg'] += 0;

		$rTotals['no'] ++;
		$rTotals['meals'] += $specials[$tMID]['meals'];
		$RouteOut[$j]  = $specials[$tMID];
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['route']  = $row['dRoute'];
		$RouteOut[$j]['special'] = 0;
		$RouteOut[$j]['important'] = "";
		if ($RouteOut[$j]['portionsize'] != "R")
			$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_cut'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_pur'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealmod_dat']){
			$RouteOut[$j]['date'] = 1;
			$RouteOut[$j]['special'] = 1;
		}
		if ($row['mMealmod_dat'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealdiabete'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mMealallergy'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mDiet_glut'])
		$RouteOut[$j]['special'] = 1;
		if ($row['mDiet_div'])
		$RouteOut[$j]['special'] = 1;
		if ($RouteOut[$j]['special'] == 0) {
			for ($d = 0; $d < $resIngNo; $d++) {
				if ($row['mDiet_' . $resIng[$d]])
				$RouteOut[$j]['special'] = 1;
			}
		}
		if ($RouteOut[$j]['special']  == 1) 
		$rTotals['special'] += $RouteOut[$j]['meals'];
		$j++;
		

 }
}
// ----END GET MEALS


//---------------------------------------------------------------------------
//
//              OUTPUT PDF ROUTE SHEETS
//					(one route at a time)
//---------------------------------------------------------------------------

// ---------------------------------------------------------
//for ($i = 1; $i <= 10; $i++)
$strSide="";
$strSideNo ="";
$portionNo ="";

/*
if ($rTotals['side_fs'] > 0){
$strSide .= "Fruit Salad" . $cReturn;
$strSideNo .= $rTotals['side_fs'] . $cReturn;
}
if ($rTotals['side_fs'] > 0){
$strSide .= "Fruit Salad" . $cReturn;
$strSideNo .= $rTotals['side_fs'] . $cReturn;
}
if ($rTotals['side_fs'] > 0){
$strSide .= "Fruit Salad" . $cReturn;
$strSideNo .= $rTotals['side_fs'] . $cReturn;
}
*/


// add a page
//$pdf->startPageGroup(); 
$pdf->AddPage();


//$pdf->SetLineWidth(2);

// print some rows just as example
//for ($i = 0; $i < 5; $i++) {
//    $pdf->MultiRow('Row '.($i+1), $text."\n");
//}
$pdf->SetCellPadding(1);
$pdf->SetCellHeightRatio( 1.7 );
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 0, '- SPECIAL MEAL LABELS -', 'B', 1, 'C');

$pdf->SetCellHeightRatio(1);
$pdf->SetFont('helvetica', 'I', 6);
$pdf->Cell(0, 0, '', '', 1, 'C');
$pdf->SetFont('helvetica', '', 9);

//-----START GET NAME
//$spTot = array();
$date_cntr = "0";
//$spTot[2] = "";
$cntr = 0;
$offset = 0;
for ($i = 0; $i <= $j; $i++) {
$query = "SELECT * FROM member WHERE mid='" . $RouteOut[$i]['mid'] . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
   if ($RouteOut[$i]['special'] == 1) {
     for($k = 1; $k <= $RouteOut[$i]['meals']; $k++){
	//if ($RouteOut[$i]['route'] == "NDG")
	//   continue;
	$name = $row['last_name'] . ", " . substr($row['first_name'],0,2) . ".";
	$m_spec = "";
	switch($RouteOut[$i]['portionsize']) {
	case "D":
		$m_spec .= " double"; 
		break;
	case "L":
		$m_spec .= " large";
		break;
	case "H":
		$m_spec .= " half";
		break;
	}
	if ($RouteOut[$i]['date'] == 1)
		$m_spec .= " - date";
	$routeW = "";
	switch($RouteOut[$i]['route']){
         case "CV":
		$routeW = "Downtown";
		break;
	case "CDN":
		$routeW = "Cote-Des-Neiges";
		break;
	case "CS":
		$routeW = "Centre Sud";
		break;
	case "ME":
		$routeW = "Mile End";
		break;
	case "MG":
		$routeW = "McGill";
		break;
	case "MGW":
		$routeW = "McGill West";
		break;
	case "NDG":
		$routeW = "Notre-Dame-de-Grace";
		break;
	case "WM":
		$routeW = "Westmount";
		break;
	}
	if($cntr < 7) {
	if($offset == 0) {
		$offset = 1;
		$pdf->SetY(19);
	}

	//$cntr += $RouteOut[$i]['meals'];
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(73, 0, $name, 0, 'L',  0,  0);
	$pdf->SetFont('helvetica', 'R', 10);
	$pdf->MultiCell(24, 0, 	date("D, M-d"), 0, 'R',  0,  1);
	$pdf->MultiCell(65, 0, $m_spec, 0, 'L',  0,  0);
	$pdf->SetFont('helvetica', 'I', 8);
	$pdf->MultiCell(32, 6, 	$routeW, 0, 'R',  0,  1);
	$pdf->SetFont('helvetica', 'R', 9);
	$pdf->MultiCell(97, 24, $RouteOut[$i]['label'], 0, 'L',  0,  1);

	} else {
	if($offset == 1) {
		$offset = 0;
		$pdf->SetY(19);
	}

	//$cntr += $RouteOut[$i]['meals'];
	$pdf->SetFont('helvetica', 'B', 12);
	$pdf->MultiCell(73, 0, $name, 0, 'L',  0,  0,112.5);
	$pdf->SetFont('helvetica', 'R', 10);
	$pdf->MultiCell(24, 0, 	date("D, M-d"), 0, 'R',  0,  1);
	$pdf->MultiCell(65, 0, $m_spec, 0, 'L',  0,  0,112.5);
	$pdf->SetFont('helvetica', 'I', 8);
	$pdf->MultiCell(32, 6, 	$routeW, 0, 'R',  0,  1);
	$pdf->SetFont('helvetica', 'R', 9);
	$pdf->MultiCell(97, 24, $RouteOut[$i]['label'], 0, 'L',  0,  1, 112.5);
	}
        $cntr ++;
		if($cntr >= 14) {
			$cntr = 0;
			$pdf->AddPage();

			$pdf->SetCellPadding(1);
			$pdf->SetCellHeightRatio( 1.7 );
			$pdf->SetFont('helvetica', 'I', 10);
			$pdf->Cell(0, 0, '- SPECIAL MEAL LABELS -', 'B', 1, 'C');

			$pdf->SetCellHeightRatio(1);
			$pdf->SetFont('helvetica', 'I', 6);
			$pdf->Cell(0, 0, '', '', 1, 'C');
			$pdf->SetFont('helvetica', '', 9);
		}
 	}
    }
}


$pdf->SetFont('helvetica', 'I', 6);
$pdf->Cell(0, 0, '', '', 1, 'C');
$pdf->SetCellHeightRatio( 1.5 );

//-----END GET NAME

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('labels.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
