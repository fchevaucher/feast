<?php
//---variables for prices----
//
//replaced with price chart array in next version
//$price_meal = 3.50;
//$price_extra = 0.50;
//
//---------------------------

include './gsession.php';

$panel=array();
$panel['currentdb'] = "client";
$panel['showbranches'] = FALSE; 

  //function for sorting
	function cmp($a, $b){
		return strcmp($a["last_name"], $b["last_name"]);
	}

if(!isset($_GET['do']))
	include '../include/billing.php';
else {
	if($_GET['do']!="print") {
		include '../include/billing.php';
		exit;
	}

include '../include/config/mysql_login.php';
mysql_connect("localhost", $mysqluser, $mysqlpass);
require_once('../public/tcpdf/config/lang/eng.php');
require_once('../public/tcpdf/tcpdf.php');
$output = "";
$orders = array();
$mealprice = array();
$sideprice = array();

$query = "SELECT * FROM mowdata.db_settings WHERE type='CPPM' ORDER BY tindex ASC";
$result = mysql_query($query);
while($row = mysql_fetch_array( $result ))
	$mealprice[ intval($row['tindex']) ] = floatval($row['value']);

$query = "SELECT * FROM mowdata.db_settings WHERE type='CPPS' ORDER BY tindex ASC";
$result = mysql_query($query);
while($row = mysql_fetch_array( $result ))
	$sideprice[ intval($row['tindex']) ] = floatval($row['value']);

$query = "SELECT * FROM mowdata.meals_billed WHERE date LIKE '" . mysql_real_escape_string($_POST['month']) . "-%' ORDER BY date ASC LIMIT 1";
$result = mysql_query($query);
$first_day = mysql_fetch_array( $result );

$query = "SELECT * FROM mowdata.meals_billed WHERE date LIKE '" . mysql_real_escape_string($_POST['month']) . "-%' ORDER BY date DESC LIMIT 1";
$result = mysql_query($query);
$last_day = mysql_fetch_array( $result );
$total_meals = 0;

$query = "SELECT * FROM mowdata.meals_billed WHERE date LIKE '" . mysql_real_escape_string($_POST['month']) . "-%'";
$result = mysql_query($query);
while($row = mysql_fetch_array( $result )){
	$tMID = $row['mid'];
	if(!($orders[$tMID]['meals'] > 0)){
		$orders[$tMID]['meals'] = 0;
		$q2 = "SELECT * FROM mowdata.member where mid=" . $tMID;
		$r2 = mysql_query($q2);
		$person = mysql_fetch_array( $r2 );
		$orders[$tMID]['first_name'] = $person['first_name'];
		$orders[$tMID]['last_name'] = $person['last_name'];
	}
	$orders[$tMID]['meals'] += $row['mNumber'];
	$total_meals += $row['mNumber'];
	$orders[$tMID]['sides'] += $row['mSideds'];
	$orders[$tMID]['sides'] += $row['mSidedd'];
	$orders[$tMID]['sides'] += $row['mSidefs'];
	$orders[$tMID]['sides'] += $row['mSidegs'];
	$orders[$tMID]['sides'] += $row['mSidepd'];
	if($row['mSize'] == 'D')
		$orders[$tMID]['doubles'] += $row['mNumber'];
	$orders[$tMID]['newspapers'] += $row['mSidegz'];
	$orders[$tMID]['veggiebaskets'] += $row['mSidevb']; 
	$orders[$tMID]['payscale'] = $row['payscale'];
}

//now sort the entries
uasort($orders, 'cmp');

//use to create newline when generating pdfs
$cReturn = "\n";

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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fireboy Technologies');
$pdf->SetTitle('Billing Summary');
$pdf->SetSubject('Santropol Roulant Billing Summary');
$pdf->SetKeywords('Santropol, Santropol Roulant, popote, billing, summary');

// set default header data
$pdf->SetHeaderData('logo350_color.jpg', 20, 'Santropol Roulant', 'Phone: (514) 284-9335
                                       This page contains CONFIDENTIAL information.');

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
$pdf->SetAutoPageBreak(TRUE, 15);
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

$global_total = 0.0;
// ----END GET MEALS


//---------------------------------------------------------------------------
//
//              OUTPUT BILLING SUMMARY
//
//---------------------------------------------------------------------------

// ---------------------------------------------------------
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
  
$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 6, " ", 0, 1, 'C');     
$pdf->Cell(0, 12, "Billing Summary", 0, 1, 'C');     
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 7, 'Deliveries between ' . date('F jS',strtotime($first_day['date'])) . ' and ' . date('F jS, Y',strtotime($last_day['date'])), 0, 1, 'C');
$pdf->SetFont('helvetica', 'I', 11);
//$pdf->Cell(0, 7, '(' . $total_meals . ' meals total)', 0, 1, 'C');
$pdf->Cell(0, 8, " ", 0, 1, 'C');
$pdf->SetFont('helvetica', 'I', 9);
$pdf->Cell(0, 8, "Special Rate Client ***", 0, 1, 'L');
$pdf->SetFont('helvetica', 'I', 10);
$pdf->MultiCell(70, 2, "     CLIENT NAME", 'TB', 'L', 0, 0);
$pdf->MultiCell(40, 2, "MEALS      +  EXTRAS",'TB','R',0,0);
$pdf->MultiCell(0, 2, "TOTAL  ",'TB','R');
//$pdf->Cell(0, 1, ' ', 0, 1, 'C');
while (list($key, $value) = each($orders)) {
	$doubles= "";
	$xtrasides = "";
	$client_extra = ((($orders[$key]["sides"]- $orders[$key]["meals"]) + $orders[$key]["doubles"])*$sideprice[ $orders[$key]['payscale'] ]);
	if ($client_extra < 0)
		$client_extra = 0;
	$client_meals = ($orders[$key]["meals"]*$mealprice[ $orders[$key]['payscale'] ]);
	$client_total = $client_meals + $client_extra;
	if($client_extra <= 0)
		$client_extra = "";
	else
		$client_extra = "\$" . trim(sprintf("%5.2f",$client_meals)) . " + \$" . trim(sprintf("%5.2f",$client_extra)) . " =  ";
	if ($orders[$key]["doubles"] > 0)
		$doubles = " + " . $value["doubles"] . " double";
	if ($orders[$key]["sides"] > $orders[$key]["meals"])
		$xtrasides = " + ". ($orders[$key]["sides"]- $orders[$key]["meals"]) ." extras";

	//Add a star to their name if the payscale is not standard (not 1) -Charles
	if ($orders[$key]['payscale'] == 1)
		$pdf->MultiCell(75, 2, strtoupper($value["last_name"]) . ", " . $value["first_name"], 0, 'L', 0, 0);
	else
                $pdf->MultiCell(75, 2, strtoupper($value["last_name"]) . ", " . $value["first_name"] . '***', 0, 'L', 0, 0);




	$pdf->MultiCell(10, 2, $value["meals"],'C','L',0,0);
	$pdf->MultiCell(50, 2, $xtrasides . $doubles,'B','L',0,0);
	$pdf->MultiCell(45, 2, $client_extra ,'B','R',0,0);
	$pdf->MultiCell(0, 6, "\$" . trim(sprintf("%5.2f  ",$client_total)) . "  ",'B','R');

	// Add client_total to global_total
	$global_total += $client_total;
}
//*/
/* Print totals row after all clients  */
$pdf->SetFont('helvetica', 'B', 10);
$pdf->MultiCell(70, 2, "     TOTALS", 'T', 'L', 0, 0);
$pdf->MultiCell(40, 2, ' '.$total_meals.' ','T','L',0,0);
$pdf->MultiCell(0, 2, "\$" . trim(sprintf("%5.2f  ",$global_total)) . "  ",'T','R');


$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 0, ' ', 0, 1, 'R');
$pdf->Cell(0, 0, '- END OF SUMMARY -                  ', 0, 1, 'R');



// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$pdf->Output('billing' . $_POST['month'] . '.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+

}

?>
