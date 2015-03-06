<?php
include "../include/showerror.php";
require_once('./tcpdf/config/lang/eng.php');
require_once('./tcpdf/tcpdf.php');

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

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetHeaderMargin(14);
$pdf->SetFooterMargin(14);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// build 2 pages one day at a time...
$pdfstartmonth = "7";
$pdfstartday = "6";
$pdfstartyear = "2009";
$buildday  = mktime(0, 0, 0, $pdfstartmonth  , $pdfstartday, $pdfstartyear);

for ($j = 0; $j < 10; $j++) {
$buildday += (24 * 60 * 60);
$bdate_en = date('l, F j, Y',$buildday);
setlocale(LC_TIME, "fr_FR");
$bdate_fr = strftime("%A, le %e %B %G",$buildday);

// add a page
$pdf->AddPage();
$pdf->SetFont('times', 'B', 10);
//$pdf->SetCellPadding(0);
//$pdf->SetLineWidth(2);
$pdf->MultiCell(70,12, $bdate_en, 0, 'L', 0, 0, '','');
$pdf->MultiCell(0, 12, $bdate_fr, 0, 'R');
$pdf->MultiCell(54, 7, 'Repas du jour / Meal of the day : ', 0, 'L', 0, 0, '','');
$pdf->MultiCell(0, 2, ' ', 'B', 'L');
$pdf->MultiCell(42, 7, 'À côtés / Side dishes :   1 -', 0, 'L', 0, 0, '','');
$pdf->MultiCell(65, 2, ' ', 'B', 'L', 0, 0);
$pdf->MultiCell(7, 7, ' 2 -', 0, 'L', 0, 0, '','');
$pdf->MultiCell(0, 2, ' ', 'B', 'L');
$pdf->MultiCell(17, 7, 'Dessert : ', 0, 'L', 0, 0, '','');
$pdf->MultiCell(0, 2, ' ', 'B', 'L');
$pdf->Cell(0, 2, ' ', 0, 1, 'L');
$pdf->Cell(0, 12, 'Meal Orders / Commandes', 0, 1, 'L');

// print some rows just as example
for ($i = 0; $i < 10; $i++) {
    $pdf->MultiRow(' ', " ");
}
$pdf->Cell(0, 12, 'Permanent Changes / Changements permanents', 0, 1, 'L');
$pdf->Cell(0, 50, ' ', 1, 1, 'C');
$pdf->Cell(0, 12, 'Client Comments / Commentairs des clients', 0, 1, 'L');
$pdf->Cell(0, 50, ' ', 1, 1, 'C');

$pdf->AddPage();
$pdf->MultiCell(70,12, $bdate_en, 0, 'L', 0, 0, '','');
$pdf->MultiCell(0, 12, $bdate_fr, 0, 'R');
$pdf->MultiCell(50, 7, 'STAY-LATE FROM 1H30 TO', 0, 'L', 0, 0, '','');
$pdf->MultiCell(25, 2, ' ', 'B', 'L', 0, 0);
$pdf->MultiCell(26, 7, ' HRS - STAFF ', 0, 'L', 0, 0, '','');
$pdf->MultiCell(0, 2, ' ', 'B', 'L');
$pdf->SetFont('times', '', 10);
$pdf->Cell(0, 18, 'McGILL :', 0, 1, 'L');
$pdf->Cell(0, 18, 'McGILL WEST :', 0, 1, 'L');
$pdf->Cell(0, 18, 'CENTRE-SUD :', 0, 1, 'L');
$pdf->Cell(0, 18, 'MILE-END :', 0, 1, 'L');
$pdf->Cell(0, 18, 'CENTRE-VILLE :', 0, 1, 'L');
$pdf->Cell(0, 18, 'WESTMOUNT :', 0, 1, 'L');
$pdf->Cell(0, 18, 'COTE-DES-NEIGES :', 0, 1, 'L');
$pdf->Cell(0, 15, '', 0, 1, 'L');
$pdf->Cell(0, 18, 'NOTRE-DAME-DE-GRACE :', 0, 1, 'L');
$pdf->Cell(0, 15, '', 0, 1, 'L');
$pdf->Cell(0, 9, 'SUIVI DE STAY-LATE / STAY-LATE FOLLOW-UP', 0, 1, 'L');
$pdf->MultiCell(44,7, 'CLIENT', 1, 'L', 0, 0, '','');
$pdf->MultiCell(118,7, 'SUIVIS / FOLLOW-UP', 1, 'L', 0, 0, '','');
$pdf->MultiCell(0, 7, 'STAFF', 1, 'L');
for ($i = 0; $i < 4; $i++) {
$pdf->MultiCell(44,12, '', 1, 'L', 0, 0, '','');
$pdf->MultiCell(118,12, '', 1, 'L', 0, 0, '','');
$pdf->MultiCell(0, 12, '', 1, 'L');
}
// ---------------------------------------------------------
// end of two pages
}
// ---------------------------------------------------------


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_020.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+
?>
