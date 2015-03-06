<?php

//function for sorting
function cmp($a, $b){
	return strcmp($a, $b);
}
//end sorting functions

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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fireboy Technologies');
$pdf->SetTitle('Route Sheets');
$pdf->SetSubject('Santropol Roulant Route Sheets');
$pdf->SetKeywords('Santropol, Santropol Roulant, popote, route sheets, route');

// set default header data
$pdf->SetHeaderData('logo350_color.jpg', 20, 'Santropol Roulant', 'Phone: (514) 284-9335                         Ce document contient des informations confidentielles.
' . date('F jS, Y') . '                                     This page contains CONFIDENTIAL information.');

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

  include '../include/config/mysql_login.php';
  mysql_connect("localhost", $mysqluser, $mysqlpass);
  mysql_select_db("mowdata");


//set some variables
$thisDay = date('d');
$thisWDay = date('D');
$thisMonth = date('m');
$thisYear = date('y');
$thisTable = "meals" . $thisMonth . "_" . $thisYear;
$thisTimeStamp = mktime(0, 0, $thisDay, $thisMonth, 1, $thisYear);

$Route= array();
$rTotals = array();
$meals = array();
$i=0;
$j=array();

$rTotals['CS']['no'] = 0;
$rTotals['CS']['meals'] = 0;
$rTotals['CS']['special'] = 0;
$rTotals['CS']['reg'] = 0;
$rTotals['CS']['side_ds'] = 0;
$rTotals['CS']['side_dd'] = 0;
$rTotals['CS']['side_fs'] = 0;
$rTotals['CS']['side_gs'] = 0;
$rTotals['CS']['side_pd'] = 0;
$rTotals['CS']['side_vz'] = 0;
$rTotals['CS']['side_vb'] = 0;
$rTotals['CS']['side_gz'] = 0;
$j['CS']=0;

$rTotals['CDN']['no'] = 0;
$rTotals['CDN']['meals'] = 0;
$rTotals['CDN']['special'] = 0;
$rTotals['CDN']['reg'] = 0;
$rTotals['CDN']['side_ds'] = 0;
$rTotals['CDN']['side_dd'] = 0;
$rTotals['CDN']['side_fs'] = 0;
$rTotals['CDN']['side_gs'] = 0;
$rTotals['CDN']['side_pd'] = 0;
$rTotals['CDN']['side_vz'] = 0;
$rTotals['CDN']['side_vb'] = 0;
$rTotals['CDN']['side_gz'] = 0;
$j['CDN']=0;

$rTotals['ME']['no'] = 0;
$rTotals['ME']['meals'] = 0;
$rTotals['ME']['special'] = 0;
$rTotals['ME']['reg'] = 0;
$rTotals['ME']['side_ds'] = 0;
$rTotals['ME']['side_dd'] = 0;
$rTotals['ME']['side_fs'] = 0;
$rTotals['ME']['side_gs'] = 0;
$rTotals['ME']['side_pd'] = 0;
$rTotals['ME']['side_vz'] = 0;
$rTotals['ME']['side_vb'] = 0;
$rTotals['ME']['side_gz'] = 0;
$j['ME']=0;

$rTotals['MG']['no'] = 0;
$rTotals['MG']['meals'] = 0;
$rTotals['MG']['special'] = 0;
$rTotals['MG']['reg'] = 0;
$rTotals['MG']['side_ds'] = 0;
$rTotals['MG']['side_dd'] = 0;
$rTotals['MG']['side_fs'] = 0;
$rTotals['MG']['side_gs'] = 0;
$rTotals['MG']['side_pd'] = 0;
$rTotals['MG']['side_vz'] = 0;
$rTotals['MG']['side_vb'] = 0;
$rTotals['MG']['side_gz'] = 0;
$j['MG']=0;

$rTotals['MGW']['no'] = 0;
$rTotals['MGW']['meals'] = 0;
$rTotals['MGW']['special'] = 0;
$rTotals['MGW']['reg'] = 0;
$rTotals['MGW']['side_ds'] = 0;
$rTotals['MGW']['side_dd'] = 0;
$rTotals['MGW']['side_fs'] = 0;
$rTotals['MGW']['side_gs'] = 0;
$rTotals['MGW']['side_pd'] = 0;
$rTotals['MGW']['side_vz'] = 0;
$rTotals['MGW']['side_vb'] = 0;
$rTotals['MGW']['side_gz'] = 0;
$j['MGW']=0;

$rTotals['NDG']['no'] = 0;
$rTotals['NDG']['meals'] = 0;
$rTotals['NDG']['special'] = 0;
$rTotals['NDG']['reg'] = 0;
$rTotals['NDG']['side_ds'] = 0;
$rTotals['NDG']['side_dd'] = 0;
$rTotals['NDG']['side_fs'] = 0;
$rTotals['NDG']['side_gs'] = 0;
$rTotals['NDG']['side_pd'] = 0;
$rTotals['NDG']['side_vz'] = 0;
$rTotals['NDG']['side_vb'] = 0;
$rTotals['NDG']['side_gz'] = 0;
$j['NDG']=0;

$rTotals['CV']['no'] = 0;
$rTotals['CV']['meals'] = 0;
$rTotals['CV']['special'] = 0;
$rTotals['CV']['reg'] = 0;
$rTotals['CV']['side_ds'] = 0;
$rTotals['CV']['side_dd'] = 0;
$rTotals['CV']['side_fs'] = 0;
$rTotals['CV']['side_gs'] = 0;
$rTotals['CV']['side_pd'] = 0;
$rTotals['CV']['side_vz'] = 0;
$rTotals['CV']['side_vb'] = 0;
$rTotals['CV']['side_gz'] = 0;
$j['CV']=0;

$rTotals['WM']['no'] = 0;
$rTotals['WM']['meals'] = 0;
$rTotals['WM']['special'] = 0;
$rTotals['WM']['reg'] = 0;
$rTotals['WM']['side_ds'] = 0;
$rTotals['WM']['side_dd'] = 0;
$rTotals['WM']['side_fs'] = 0;
$rTotals['WM']['side_gs'] = 0;
$rTotals['WM']['side_pd'] = 0;
$rTotals['WM']['side_vz'] = 0;
$rTotals['WM']['side_vb'] = 0;
$rTotals['WM']['side_gz'] = 0;
$j['WM']=0;

//---START GET MEALS
$query = "SELECT * FROM meals_billed WHERE date='20" . $thisYear . "-" . $thisMonth . "-" . $thisDay . "'";
$result = mysql_query($query);

	if(!($result))
		die("There are no meals scheduled for delivery today.");
		
while($delivery = mysql_fetch_array( $result )) {
	$tMID = $delivery['mid'];
	$meals[$tMID]['is'] = 1;
	$meals[$tMID]['mid'] = $delivery['mid'];
	$meals[$tMID]['meals'] = $delivery['mNumber'];
	$meals[$tMID]['portionsize'] = $delivery['mSize'];
	$meals[$tMID]['side_ds'] = $delivery['mSideds'];
	$meals[$tMID]['side_dd'] = $delivery['mSidedd'];
	$meals[$tMID]['side_fs'] = $delivery['mSidefs'];
	$meals[$tMID]['side_gs'] = $delivery['mSidegs'];
	$meals[$tMID]['side_pd'] = $delivery['mSidepd'];
	$meals[$tMID]['side_gz'] = $delivery['mSidegz'];
	$meals[$tMID]['side_vb'] = $delivery['mSidevb'];
	$meals[$tMID]['side_vz'] = $delivery['mSidevz'];

	//is this a special meal?
	$query = "SELECT * FROM mowdata.client WHERE mid='" . $tMID . "'";
	$r2 = mysql_query($query);
	$row=mysql_fetch_array($r2);
	$rTmp = $row['dRoute'];

	//update route totals
	$rTotals[$rTmp]['meals'] += $delivery['mNumber'];
	$rTotals[$rTmp]['side_ds'] += $delivery['mSideds'];
	$rTotals[$rTmp]['side_dd'] += $delivery['mSidedd'];
	$rTotals[$rTmp]['side_fs'] += $delivery['mSidefs'];
	$rTotals[$rTmp]['side_gs'] += $delivery['mSidegs'];
	$rTotals[$rTmp]['side_pd'] += $delivery['mSidepd'];
	$rTotals[$rTmp]['side_gz'] += $delivery['mSidegz'];
	$rTotals[$rTmp]['side_vb'] += $delivery['mSidevb'];
	$rTotals[$rTmp]['side_vz'] += $delivery['mSidevz'];

	//add this entry into the appropriate route sheet.
	//convert stop no. to three digit (add leading zeroes).
	//this ensures proper route order.
	$Route[$row['dRoute']][$tMID] = sprintf("%03d",$row['dStop']);
	$rTotals[$rTmp]['no']++;

	$meals[$tMID]['route'] = $row['dRoute'];
	$meals[$tMID]['directions']  = $row['dDirections'];
	$meals[$tMID]['special'] = 0;
	if ($row['mMealmod_cut'])
		$meals[$tMID]['special'] = 1;
	if ($row['mMealmod_pur'])
		$meals[$tMID]['special'] = 1;
	if ($row['mMealmod_dat'])
		$meals[$tMID]['special'] = 1;
	if ($row['mMealmod_dat'])
		$meals[$tMID]['special'] = 1;
	if ($row['mMealdiabete'])
		$meals[$tMID]['special'] = 1;
	if ($row['mMealallergy'])
		$meals[$tMID]['special'] = 1;
	if ($row['mDiet_glut'])
		$meals[$tMID]['special'] = 1;
	if ($row['mPortion'] != "R")
		$meals[$tMID]['special'] = 1;
	if ($row['mDiet_div'])
		$meals[$tMID]['special'] = 1;
	if ($meals[$tMID]['special'] == 0) {
		for ($d = 0; $d < $resIngNo; $d++) {
			if ($row['mDiet_' . $resIng[$d]])
			$meals[$tMID]['special'] = 1;
		}
	}
	if ($meals[$tMID]['special']  == 1) 
		$rTotals[$rTmp]['special'] += $meals[$tMID]['meals'];
	$j[$rTmp]++;
	$i++;
}
$spTotal = $i;

if($i < 1)
		die("There are no meals scheduled for delivery today.");

// ----END GET MEALS


//---------------------------------------------------------------------------
//
//              OUTPUT PDF ROUTE SHEETS
//					(one route at a time)
//---------------------------------------------------------------------------
for ($q = 1; $q <= 8; $q++) {
switch ($q) {
	case 1:
	$thsRoute = "CS";
	$hdRoute = "Centre Sud";
	break;
	case 2:
	$thsRoute = "CV";
	$hdRoute = "Centre-Ville / Downtown";
	break;
	case 3:
	$thsRoute = "CDN";
	$hdRoute = "Cote Des Neiges";
	break;
	case 4:
	$thsRoute = "ME";
	$hdRoute = "Mile-End";
	break;
	case 5:
	$thsRoute = "MG";
	$hdRoute = "McGill";
	break;
	case 6:
	$thsRoute = "MGW";
	$hdRoute = "McGill West";
	break;
	case 7:
	$thsRoute = "NDG";
	$hdRoute = "Notre Dame de Grace";
	break;
	case 8:
	$thsRoute = "WM";
	$hdRoute = "Westmount";
	break;
}

//-----START GET NAME
$spTot = array();
$spTot[1] = "";
$spTot[2] = "";
$cntr = 0;

if (!(count($Route[$thsRoute]) >= 1))
 continue;


//for ($i = 0; $i <= $j[$thsRoute]; $i++) {
foreach($Route[$thsRoute] as $key => $value){
$query = "SELECT * FROM member WHERE mid='" . $key . "'";
$result = mysql_query($query);
$row = mysql_fetch_array( $result );
$tMID=$key;
$meals[$tMID]['name'] = $row['first_name'] . " " . $row['last_name'];
if (strlen($meals[$tMID]['name']) > 23)
	$meals[$tMID]['name'] = substr(html_entity_decode($row['first_name']),0,2) . ". " . $row['last_name'];

$meals[$tMID]['address'] = $row['address1'] . $cReturn;
if ($row['address2'] != "")
$meals[$tMID]['address'] .= $row['address2'] . $cReturn;
$meals[$tMID]['address'] .= substr($row['phone'],0,3) . "-" . substr($row['phone'],3,3) . "-" . substr($row['phone'],6);
   if ($meals[$tMID]['special'] == 1) {
	if ($rTotals[$thsRoute]['special'] > 4) {
	if ($cntr <= ($rTotals[$thsRoute]['special']/2))
	$w = 1;
	else
	$w = 2;
	} else 
	$w = 1;
	$spTot[$w] .= $row['last_name'];
	$cntr += $meals[$tMID]['meals'];
	if ($meals[$tMID]['meals'] > 1)
    $spTot[$w] .= " x" . $meals[$tMID]['meals'];
    $spTot[$w] .= "\n";
	}
}
//-----END GET NAME

// ---------------------------------------------------------
//for ($i = 1; $i <= 10; $i++)
$strSide="";
$strSideNo ="";

if ($rTotals[$thsRoute]['side_ds'] > 0){
$strSide .= "Dessert" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_ds'] . $cReturn;
}
if ($rTotals[$thsRoute]['side_dd'] > 0){
$strSide .= "Diabetic Dessert" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_dd'] . $cReturn;
}
if ($rTotals[$thsRoute]['side_fs'] > 0){
$strSide .= "Fruit Salad" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_fs'] . $cReturn;
}
if ($rTotals[$thsRoute]['side_gs'] > 0){
$strSide .= "Green Salad" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_gs'] . $cReturn;
}
if ($rTotals[$thsRoute]['side_pd'] > 0){
$strSide .= "Pudding" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_pd'] . $cReturn;
}
if ($rTotals[$thsRoute]['side_gz'] > 0){
$strSide .= "Gazette" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_gz'] . $cReturn;
}
if ($rTotals[$thsRoute]['side_vb'] > 0){
$strSide .= "Veggie Basket" . $cReturn;
$strSideNo .= $rTotals[$thsRoute]['side_vb'] . $cReturn;
}
$strMealNo = $rTotals[$thsRoute]['meals'];
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
$pdf->MultiCell(50, 2, 'Side Dishes', 0, 'L', 0, 0);
$pdf->MultiCell(38, 2, 'Meals / Repas:' , 'B', 'L',0,0);
$pdf->MultiCell(23, 2, "Total: " . $strMealNo , 'B', 'R');
$pdf->SetFont('helvetica', '', 10);
$y_start = $pdf->GetY();
$pdf->MultiCell(36, 2, $strSide, 0, 'L', 0, 1);
$y_end = $pdf->GetY();
$pdf->MultiCell(14, 2, $strSideNo, 0, 'L', 0, 0, 36, $y_start);
$pdf->MultiCell(36, 0, '', 0, 'L', 0, 0);
$pdf->MultiCell(5, 0, '', 'T', 'L', 0, 0);
$pdf->MultiCell(5, 0, '=', 0, 'R', 0, 0);
$pdf->MultiCell(14, 0, ($strMealNo - $rTotals[$thsRoute]['special']) . ' reg', 0, 'L', 0, 0);
$pdf->MultiCell(8, 0, '+', 0, 'L', 0, 0);
$pdf->MultiCell(25, 0, $spTot[1] , 0, 'L',  0,  1);
$y_end2 = $pdf->GetY();
$pdf->MultiCell(0, 0, $spTot[2] , 0, 'L',  0,  1, 150, $y_start);
$y_start = $pdf->GetY();
if ($y_start < max($y_end,$y_end2))
$pdf->SetXY($pdf->GetX(),max($y_end,$y_end2)); 
$pdf->SetFont('helvetica', '', 30);
$pdf->Cell(0, 20, $hdRoute, 'T', 1, 'C');     
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 0, ' - DEBUT DE LA ROUTE / START ROUTE -', 'T', 1, 'C');
//sort the entries by stop
uasort($Route[$thsRoute], 'cmp');

//echo $meals[$key]['meals'];
//-----START GET NAME


while (list($key, $value) = each($Route[$thsRoute])) {


$strM="";
$strNo ="";
$header_size = 1;
if ($meals[$key]['meals'] > 0){
$strM .= "Meal/Repas" . $cReturn;
$strNo .= $meals[$key]['meals'] . $cReturn;
}
if ($meals[$key]['side_ds'] > 0){
$strM .= "Dessert" . $cReturn;
$strNo .= $meals[$key]['side_ds'] . $cReturn;
}
if ($meals[$key]['side_dd'] > 0){
$strM .= "Diabetic Dessert" . $cReturn;
$strNo .= $meals[$key]['side_dd'] . $cReturn;
}
if ($meals[$key]['side_fs'] > 0){
$strM .= "Salade de fruits" . $cReturn;
$strNo .= $meals[$key]['side_fs'] . $cReturn;
}
if ($meals[$key]['side_gs'] > 0){
$strM .= "Salade Verte" . $cReturn;
$strNo .= $meals[$key]['side_gs'] . $cReturn;
}
if ($meals[$key]['side_pd'] > 0){
$strM .= "Pudding" . $cReturn;
$strNo .= $meals[$key]['side_pd'] . $cReturn;
}
if ($meals[$key]['side_gz'] > 0){
$strM .= "Gazette" . $cReturn;
$strNo .= $meals[$key]['side_gz'] . $cReturn;
}
if ($meals[$key]['side_vb'] > 0){
$strM .= "Veggie Basket" . $cReturn;
$strNo .= $meals[$key]['side_vb'] . $cReturn;
}

if ($thsRoute == "NDG"){
$strM .= "No. Containers  [" . $cReturn;
$strNo .= " ]" . $cReturn;
}
$page_start = $pdf->getPage();
$y_start = $pdf->GetY();
$T="T";
if ($y_start > 252) {
	if ($y_start < 280) {
	$pdf->Cell(0, 0, '     ', 'T', 1, 'C');
	$pdf->SetFont('helvetica', 'I', 9);
	$pdf->Cell(0, 0, '** suite au verso / continue on next page **', 0, 1, 'C');
	$pdf->addPage();
	$T = 0;
	} elseif ($y_start < 270) {
	$pdf->SetFont('helvetica', 'I', 9);
	$pdf->Cell(0, 0, '** suite au verso / continue on next page **', 0, 1, 'C');
	$pdf->addPage();
	$T = 0;
	} else {
	$pdf->addPage();
	$T = 0;
	}
}
$pdf->SetFont('helvetica', 'B', 12);
$pdf->MultiCell(55, 1, $meals[$key]['name'], $T, 'L', 0, 0);

$pdf->MultiCell(97, 1, ' ', $T, 'L', 0, 0);
$pdf->SetFont('helvetica', 'B', 10);
if 	($meals[$key]['special'] == 1) {
$pdf->MultiCell(0, 1, "* SPECIAL *", $T, 'C');
$spOffset = 0;
} else {
$pdf->SetFont('helvetica', '', 9);
$spOffset = 5;
//$pdf->MultiCell(0, 1, "--items--", $T, 'C');

$pdf->MultiCell(0, 1, " ", $T, 'C');
}
$pdf->SetFont('helvetica', '', 11);
$page_start = $pdf->getPage();
	$y_start = $pdf->GetY();
	$pdf->setPage($page_start);
$pdf->MultiCell(51, 0, $meals[$key]['address'] , 0, 'L',  0, 2, 9, $y_start, true, 0);
	$page_end_1 = $pdf->getPage();
	$y_end_1 = $pdf->GetY();
	$pdf->setPage($page_start);
$pdf->MultiCell(100, 0, $meals[$key]['directions'], 0, 'L',  0,  2, $pdf->GetX() ,($y_start - 5), true, 0);
	$page_end_2 = $pdf->getPage();
	$y_end_2 = $pdf->GetY();
	$pdf->setPage($page_start);
$pdf->MultiCell(34, 0, $strM , 0, 'L',  0,  2, $pdf->GetX() ,($y_start - $spOffset), true, 0); 
$pdf->MultiCell(0, 0, $strNo , 0, 'L', 0 , 1, $pdf->GetX() ,($y_start - $spOffset), true, 0); 
$page_end_3 = $pdf->getPage();
$y_end_3 = $pdf->GetY();
$pdf->SetXY($pdf->GetX(),max($y_end_1,$y_end_2,$y_end_3)); 
}
//-----END GET NAME
$pdf->Cell(0, 0, '-END OF ROUTE / FIN DE ROUTE-             Nombre d\'arrets / Number of Stops: '. $rTotals[$thsRoute]['no'] . '       ', 'T', 1, 'R');
$thispageno = $pdf->getPage();
if ($thispageno&1)
  $pdf->AddPage();
  
}

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('routesheets.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
