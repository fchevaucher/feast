<?php
if (isset($_POST['binderstartday'])&& (isset($_POST['binderendday']))) {
$buildday  = mktime(0, 0, 0, $_POST['binderstartmonth'] , $_POST['binderstartday'], $_POST['binderstartyear']);
$endday  = mktime(0, 0, 0, $_POST['binderendmonth'] , $_POST['binderendday'], $_POST['binderendyear']);
if ($builday < $endday) {
include "../include/showerror.php";
require_once('../public/tcpdf/config/lang/eng.php');
require_once('../public/tcpdf/tcpdf.php');

// extend TCPF with custom functions
class MYPDF extends TCPDF { 
    public function MultiRow($left, $right) {
        //MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0)
        
        $page_start = $this->getPage();
        $y_start = $this->GetY();
        
        // write the left cell
        $this->MultiCell(60, 0, $left, 1, 'R', 0, 2, '', '', true, 0);
        
        $page_end_1 = $this->getPage();
        $y_end_1 = $this->GetY();
        
        $this->setPage($page_start);
        
        // write the right cell
        $this->MultiCell(60, 0, $right, 1, 'J', 0, 1, $this->GetX() ,$y_start, true, 0);
        
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
        public function Header() {
                // Logo
                //$this->Image(K_PATH_IMAGES.'logo_example.jpg', 10, 8, 15);
                // Set font
                //$this->SetFont('helvetica', 'B', 20);
                // Move to the right
                //$this->Cell(80);
                // Title
               	//$this->Cell(30, 10, 'Title', 0, 0, 'C');
                // Line break
                //$this->Ln(20);
        return false;
        }


public function Footer() {
return false;
}

}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'Letter', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fireboy Technologies');
$pdf->SetTitle('Santropol Roulant Book Sheets');
$pdf->SetSubject('Daily Meal Sheets');
$pdf->SetKeywords('Santropol Roulant, santropol, meals on wheels, mow, meal sheets');

// set default header data
//$pdf->SetHeaderData('logo350_color.jpg', 20, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetMargins(14, 9, 14);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin(2);
$pdf->SetFooterMargin(2);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 9);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// START BUILDING PAGES FOR BINDER
//----------------------------------------------------------

//this variable will ensure pages only the second page
//of the first day, and the first page of the day following
//the last day are printed
$first_last = 0;

while ($buildday <= ($endday + 86400)) {
$bdate_en = date('l, F j, Y',$buildday);
setlocale(LC_TIME, "fr_FR");
switch (date('n',$buildday)) {
    case 1:
        $fr_month = "janvier";
        break;
    case 2:
        $fr_month = "février";
        break;
    case 3:
        $fr_month = "mars";
        break;
    case 4:
        $fr_month = "avril";
        break;
    case 5:
        $fr_month = "mai";
        break;
    case 6:
        $fr_month = "juin";
        break;
    case 7:
        $fr_month = "juillet";
        break;
    case 8:
        $fr_month = "août";
        break;
    case 9:
        $fr_month = "septembre";
        break;
    case 10:
        $fr_month = "octobre";
        break;
    case 11:
        $fr_month = "novembre";
        break;
    case 12:
        $fr_month = "décembre";
        break;
}
$bdate_fr = strftime("%A, le %e $fr_month ",$buildday);
$bdate_fr .= date('Y',$buildday);

if((date("N",$buildday) != "4") && (date("N",$buildday) != "7") ) {
	if($first_last > 0) {
		$pdf->AddPage();
		$pdf->SetFont('times', 'B', 11);
		$pdf->MultiCell(70,12, $bdate_en, 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 12, $bdate_fr, 0, 'R');
		$pdf->MultiCell(55, 6, 'STAY-LATE FROM 1H30 TO', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(25, 2, ' ', 'B', 'L', 0, 0);
		$pdf->MultiCell(27, 6, ' HRS - STAFF ', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 2, ' ', 'B', 'L');
		$pdf->SetFont('times', '', 11);
		$pdf->Cell(0, 7, 'McGILL :', 0, 1, 'L');
		$pdf->Cell(0, 13, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'McGILL WEST :', 0, 1, 'L');
		$pdf->Cell(0, 13, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'CENTRE-SUD :', 0, 1, 'L');
		$pdf->Cell(0, 13, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'MILE-END :', 0, 1, 'L');
		$pdf->Cell(0, 13, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'CENTRE-VILLE :', 0, 1, 'L');
		$pdf->Cell(0, 13, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'WESTMOUNT :', 0, 1, 'L');
		$pdf->Cell(0, 13, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'COTE-DES-NEIGES :', 0, 1, 'L');
		$pdf->Cell(0, 22, '', 0, 1, 'L');
		$pdf->Cell(0, 7, 'NOTRE-DAME-DE-GRACE :', 0, 1, 'L');
		$pdf->Cell(0, 22, '', 0, 1, 'L');
		$pdf->Cell(0, 9, 'SUIVI DE STAY-LATE / STAY-LATE FOLLOW-UP', 0, 1, 'L');
		$pdf->MultiCell(44,7, 'CLIENT', 1, 'L', 0, 0, '','');
		$pdf->MultiCell(118,7, 'SUIVIS / FOLLOW-UP', 1, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 7, 'STAFF', 1, 'L');
		for ($i = 0; $i < 4; $i++) {
			$pdf->MultiCell(44,11, '', 1, 'L', 0, 0, '','');
			$pdf->MultiCell(118,11, '', 1, 'L', 0, 0, '','');
			$pdf->MultiCell(0, 11, '', 1, 'L');
		}
	} else
		$first_last++;

	if($first_last < 2) {
		// add a page
		$pdf->AddPage();
		$pdf->SetFont('times', 'B', 11);
		//$pdf->SetCellPadding(0);
		//$pdf->SetLineWidth(2);
		$pdf->MultiCell(70,12, $bdate_en, 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 12, $bdate_fr, 0, 'R');
		$pdf->MultiCell(57, 7, 'Repas du jour / Meal of the day : ', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 2, ' ', 'B', 'L');
		$pdf->MultiCell(45, 7, 'À côtés / Side dishes :   1 -', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(65, 2, ' ', 'B', 'L', 0, 0);
		$pdf->MultiCell(8, 7, ' 2 -', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 2, ' ', 'B', 'L');
		$pdf->MultiCell(18, 7, 'Dessert : ', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 5, ' ', 'B', 'L');
		$pdf->MultiCell(65, 7, 'Repas Alternatif / Alternative meals:', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 2, ' ', 'B', 'L');
		$pdf->Cell(0, 4, ' ', 0, 1, 'L');
		$pdf->MultiCell(130, 8, 'Meal Orders / Commandes', 0, 'L', 0, 0);
		$pdf->MultiCell(0, 8, 'No Charge', 0, 1, 'L');
		// print some rows just as example
		$pdf->MultiCell(60, 7, ' ', 1, 'L', 0, 0, '','');
		$pdf->MultiCell(60, 2, ' ', 1, 'L', 0, 0, '','');
		$pdf->MultiCell(10, 2, ' ', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 2, ' ', 'LRT', 'L');
		for ($i = 0; $i < 8; $i++) {
			//    $pdf->MultiRow(' ', " ");
			$pdf->MultiCell(60, 7, ' ', 1, 'L', 0, 0, '','');
			$pdf->MultiCell(60, 2, ' ', 1, 'L', 0, 0, '','');
			$pdf->MultiCell(10, 2, ' ', 0, 'L', 0, 0, '','');
			$pdf->MultiCell(0, 2, ' ', 'LR', 'L');
		}
		$pdf->MultiCell(60, 7, ' ', 1, 'L', 0, 0, '','');
		$pdf->MultiCell(60, 2, ' ', 1, 'L', 0, 0, '','');
		$pdf->MultiCell(10, 2, ' ', 0, 'L', 0, 0, '','');
		$pdf->MultiCell(0, 2, ' ', 'BLR', 'L');
		$pdf->Cell(0, 12, 'Permanent Changes / Changements permanents', 0, 1, 'L');
		$pdf->Cell(0, 56, ' ', 1, 1, 'C');
		$pdf->Cell(0, 12, 'Client Comments / Commentaires des clients', 0, 1, 'L');
		$pdf->Cell(0, 56, ' ', 1, 1, 'C');

	}
// ---------------------------------------------------------
// end of two pages
// ---------------------------------------------------------

//end skipping of thursday and sunday
}

$buildday += (86400);
if ($buildday >= $endday)
	$first_last++;
}

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('binder.pdf', 'I');
} else {
?>Start date is after end date.<?php
}
} else {
?><form action="client.php?do=binder" method="post">
<center>start date:
<select style="width:41px;margin-right:2px" name="binderstartday">
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
<select style="width:55px;margin-right:2px" name="binderstartmonth">
<option value="01">Jan</option>
<option value="02" >Feb</option>
<option value="03" >Mar</option>
<option value="04" >Apr</option>
<option value="05" >May</option>
<option value="06" >Jun</option>
<option value="07" >Jul</option>
<option value="08" >Aug</option>
<option value="09" >Sep</option>
<option value="10" >Oct</option>
<option value="11" >Nov</option>
<option value="12" >Dec</option>
</select>
<input type="text" name="binderstartyear" style="width:40px;" value="<?php echo date('Y');?>"><br />
end date:
<select style="width:41px;margin-right:2px" name="binderendday">
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option>10</option>
<option>11</option>
<option>12</option>
<option>13</option>
<option>14</option>
<option>15</option>
<option>16</option>
<option>17</option>
<option>18</option>
<option>19</option>
<option>20</option>
<option>21</option>
<option>22</option>
<option>23</option>
<option>24</option>
<option>25</option>
<option>26</option>
<option>27</option>
<option>28</option>
<option>29</option>
<option>30</option>
<option>31</option>
<select style="width:55px;margin-right:2px" name="binderendmonth">
<option value="01">Jan</option>
<option value="02" >Feb</option>
<option value="03" >Mar</option>
<option value="04" >Apr</option>
<option value="05" >May</option>
<option value="06" >Jun</option>
<option value="07" >Jul</option>
<option value="08" >Aug</option>
<option value="09" >Sep</option>
<option value="10" >Oct</option>
<option value="11" >Nov</option>
<option value="12" >Dec</option>
</select>
<input type="text" name="binderendyear" style="width:40px;" value="<?php echo date('Y');?>"><br /><br /><br /><input type="submit" value="make pdf" /></center></form><?php
}
?>
