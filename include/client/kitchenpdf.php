<?php

include "/var/www/feastdb/include/showerror.php";
require_once('/var/www/feastdb/public/tcpdf/config/lang/eng.php');
require_once('/var/www/feastdb/public/tcpdf/tcpdf.php');
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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fireboy Technologies');
$pdf->SetTitle('Route Sheets');
$pdf->SetSubject('Santropol Roulant Route Sheets');
$pdf->SetKeywords('Santropol, Santropol Roulant, popote, route sheets, route');

// set default header data
$pdf->SetHeaderData('logo350_color.jpg', 20, 'Santropol Roulant', 'Phone: (514) 284-9335
' . date('F jS, Y') . '                                     Kitchen Count Report');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(9, 21, 9);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetHeaderMargin();
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 8);
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

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
$rTotals['side_ds'] = 0;
$rTotals['side_dd'] = 0;
$rTotals['side_fs'] = 0;
$rTotals['side_gs'] = 0;
$rTotals['side_pd'] = 0;
$rTotals['side_vz'] = 0;
$rTotals['side_vb'] = 0;
$rTotals['side_gz'] = 0;

$query = "SELECT * FROM client WHERE mealstatus='A'"; // ORDER BY Portion ASC";
$result = mysql_query($query);

//---START GET MEALS
while($row = mysql_fetch_array( $result )) {
$tMID = $row['mid'];
if ($row['dType']=="R") {
	//this client receives regular deliveries
	//does this person have a meal scheduled for this weekday?
	if ($row["d" . date('D')] == 1){ 
		if ($specials[$tMID]['is'] == 1){
			if ($specials[$tMID]['suspend'] != 1){
		//cancel if there is a suspension
		//add special meal if there is one
		
		$rTotals['no'] ++;
		$rTotals['meals'] += $specials[$tMID]['meals'];
		$rTotals['side_ds'] += $specials[$tMID]['side_ds'];
		$rTotals['side_dd'] += $specials[$tMID]['side_dd'];
		$rTotals['side_fs'] +=  $specials[$tMID]['side_fs'];
		$rTotals['side_gs'] += $specials[$tMID]['side_gs'];
		$rTotals['side_pd'] += $specials[$tMID]['side_pd']; 
		$rTotals['side_gz'] += $specials[$tMID]['side_gz']; 
		$rTotals['side_vb'] +=  $specials[$tMID]['side_vb']; 
		$rTotals['side_vz'] += $specials[$tMID]['side_vz'];
		$RouteOut[$j]  = $specials[$tMID];
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['directions']  = $row['dDirections'];
		//$RouteOut[$j]['portionsize'] = $row['mPortion'];
		$RouteOut[$j]['special'] = 0;
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
		} else {
		//output the individuals default delivery
		$rTotals['no'] ++;
		$queryb = "SELECT * FROM meals_default WHERE mid='" . $tMID . "'";
		$resultb = mysql_query($queryb);
		$rowb = mysql_fetch_array( $resultb );
		$rTotals['meals'] += $rowb['d' . $thisWDay . 'Number'];
		$rTotals['side_ds'] += $rowb['d' . $thisWDay . 'Sideds'];
		$rTotals['side_dd'] += $rowb['d' . $thisWDay . 'Sidedd'];
		$rTotals['side_fs'] += $rowb['d' . $thisWDay . 'Sidefs'];
		$rTotals['side_gs'] += $rowb['d' . $thisWDay . 'Sidegs'];
		$rTotals['side_pd'] +=  $rowb['d' . $thisWDay . 'Sidepd'];
		$rTotals['side_gz'] += $rowb['d' . $thisWDay . 'Sidegz'];
		$rTotals['side_vb'] += $rowb['d' . $thisWDay . 'Sidevb'];
		$rTotals['side_vz'] += $rowb['d' . $thisWDay . 'Sidevz'];
		$RouteOut[$j]['is'] = 1;
		$RouteOut[$j]['mid'] = $tMID;
		$RouteOut[$j]['meals'] = $rowb['d' . $thisWDay . 'Number'];
		$RouteOut[$j]['portionsize'] = $row['mPortion'];
/*	 if ($rowb['d' . $thisWDay . 'Portion'] != "")
	$RouteOut[$j]['portionsize'] = $rowb['d' . $thisWDay . 'Portion'];
*/		$RouteOut[$j]['side_ds'] = $rowb['d' . $thisWDay . 'Sideds'];
		$RouteOut[$j]['side_dd'] = $rowb['d' . $thisWDay . 'Sidedd'];
		$RouteOut[$j]['side_fs'] = $rowb['d' . $thisWDay . 'Sidefs'];
		$RouteOut[$j]['side_gs'] = $rowb['d' . $thisWDay . 'Sidegs'];
		$RouteOut[$j]['side_pd'] = $rowb['d' . $thisWDay . 'Sidepd'];
		$RouteOut[$j]['side_gz'] = $rowb['d' . $thisWDay . 'Sidegz'];
		$RouteOut[$j]['side_vb'] = $rowb['d' . $thisWDay . 'Sidevb'];
		$RouteOut[$j]['side_vz'] = $rowb['d' . $thisWDay . 'Sidevz'];
		$RouteOut[$j]['sp_words'] = "";
		$queryb = "SELECT * FROM client WHERE mid='" . $tMID . "'";
		$resultb = mysql_query($queryb);
		$rowb = mysql_fetch_array( $resultb );
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['special'] = 0;
		if ($row['mMealmod_cut']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "CutUp /";
			}
		if ($row['mMealmod_pur']) {
		$RouteOut[$j]['special'] = 1;
		$RouteOut[$j]['sp_words'] .= "puree /";
			}
		if ($row['mMealmod_dat']) {
		$RouteOut[$j]['date'] = 1;
		$RouteOut[$j]['sp_words'] .= "date /";
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
			
		$rTotals['no'] ++;
		$rTotals['meals'] += $specials[$tMID]['meals'];
		$rTotals['side_ds'] += $specials[$tMID]['side_ds'];
		$rTotals['side_dd'] += $specials[$tMID]['side_dd'];
		$rTotals['side_fs'] +=  $specials[$tMID]['side_fs'];
		$rTotals['side_gs'] += $specials[$tMID]['side_gs'];
		$rTotals['side_pd'] += $specials[$tMID]['side_pd']; 
		$rTotals['side_gz'] += $specials[$tMID]['side_gz']; 
		$rTotals['side_vb'] +=  $specials[$tMID]['side_vb']; 
		$rTotals['side_vz'] += $specials[$tMID]['side_vz'];
		$RouteOut[$j]  = $specials[$tMID];
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['directions']  = $row['dDirections'];
		$RouteOut[$j]['special'] = 0;
		$RouteOut[$j]['important'] = "";
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
		$rTotals['side_ds'] += $specials[$tMID]['side_ds'];
		$rTotals['side_dd'] += $specials[$tMID]['side_dd'];
		$rTotals['side_fs'] +=  $specials[$tMID]['side_fs'];
		$rTotals['side_gs'] += $specials[$tMID]['side_gs'];
		$rTotals['side_pd'] += $specials[$tMID]['side_pd']; 
		$rTotals['side_gz'] += $specials[$tMID]['side_gz']; 
		$rTotals['side_vb'] +=  $specials[$tMID]['side_vb']; 
		$rTotals['side_vz'] += $specials[$tMID]['side_vz'];
		$RouteOut[$j]  = $specials[$tMID];
		$RouteOut[$j]['label']  = $row['mLabel'];
		$RouteOut[$j]['directions']  = $row['dDirections'];
		$RouteOut[$j]['special'] = 0;
		$RouteOut[$j]['important'] = "";
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


if ($rTotals['side_ds'] > 0){
$strSide .= "Dessert" . $cReturn;
$strSideNo .= $rTotals['side_ds'] . $cReturn;
}
if ($rTotals['side_dd'] > 0){
$strSide .= "Diabetic Dessert" . $cReturn;
$strSideNo .= $rTotals['side_dd'] . $cReturn;
}
if ($rTotals['side_fs'] > 0){
$strSide .= "Fruit Salad" . $cReturn;
$strSideNo .= $rTotals['side_fs'] . $cReturn;
}
if ($rTotals['side_gs'] > 0){
$strSide .= "Green Salad" . $cReturn;
$strSideNo .= $rTotals['side_gs'] . $cReturn;
}
if ($rTotals['side_pd'] > 0){
$strSide .= "Pudding" . $cReturn;
$strSideNo .= $rTotals['side_pd'] . $cReturn;
}
if ($rTotals['side_vb'] > 0){
$strSide .= "Veggie Basket" . $cReturn;
$strSideNo .= $rTotals['side_vb'] . $cReturn;
}
$strSide .= "Repas / Meals" . $cReturn;
$strSideNo .= $rTotals['meals'];
// add a page
$pdf->startPageGroup(); 
$pdf->AddPage();


//$pdf->SetLineWidth(2);

// print some rows just as example
//for ($i = 0; $i < 5; $i++) {
//    $pdf->MultiRow('Row '.($i+1), $text."\n");
//}
$pdf->SetCellPadding(1);
//MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)
  
$pdf->SetFont('helvetica', 'I', 11);
$pdf->MultiCell(50, 2, 'Component Counts', 0, 'L', 0, 1);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetFont('helvetica', '', 10);
//$y_start = $pdf->GetY();
$pdf->MultiCell(36, 2, $strSide, 0, 'L', 0, 0);
//$y_end = $pdf->GetY();
//$pdf->MultiCell(14, 2, $strSideNo, 0, 'L', 0, 0, 36, $y_start);
$pdf->MultiCell(14, 2, $strSideNo, 0, 'L', 0, 1);


$pdf->SetFont('helvetica', 'I', 6);
$pdf->Cell(0, 0, '', '', 1, 'C');

$pdf->SetCellHeightRatio( 1.7 );
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 0, '- SPECIAL MEALS -', 'TB', 1, 'C');

$pdf->SetCellHeightRatio(1);
$pdf->SetFont('helvetica', 'I', 6);
$pdf->Cell(0, 0, '', '', 1, 'C');
$pdf->SetFont('helvetica', '', 9);

//-----START GET NAME
//$spTot = array();
$date_cntr = "0";
//$spTot[2] = "";
$cntr = 0;
for ($i = 0; $i <= $j; $i++) {
$query = "SELECT * FROM member WHERE mid='" . $RouteOut[$i]['mid'] . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
   if ($RouteOut[$i]['special'] == 1) {
	$name = $row['last_name'] . ", " . substr($row['first_name'],0,2) . ".";
	//$cntr += $RouteOut[$i]['meals'];
	$cntr ++;
	$pdf->MultiCell(30, 0, $name, 0, 'L',  0,  0);
	$m_spec=$RouteOut[$i]['meals'];
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
	$pdf->MultiCell(54, 0, 	$m_spec, 0, 'L',  0,  0);
	$pdf->MultiCell(0, 0, $RouteOut[$i]['label'], 0, 'L',  0,  1);
  } elseif ($RouteOut[$i]['date'] == 1) {
        $cntr ++;
        $date_cntr += $RouteOut[$i]['meals'];
	}
}

$pdf->SetFont('helvetica', 'I', 6);
$pdf->Cell(0, 0, '', '', 1, 'C');
$pdf->SetCellHeightRatio( 1.5 );

//-----END GET NAME
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 0,  '                                                   ' .  ($rTotals['special'] + $date_cntr) .' SPECIAL MEALS (' . $rTotals['special'] .  ' RESTRICTIONS + ' . $date_cntr  .  ' DATE ONLY)', 'T', 1, 'L');
$pdf->Cell(0, 0,  '                                                   ' .   $cntr . ' SPECIAL CLIENTS', 'B', 1, 'L');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('kitchcount.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
