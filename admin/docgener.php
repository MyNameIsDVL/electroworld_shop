<?php

    function Seite($pdf, $x, $y) {
        $pdf->SetY(5);
        //$pdf->Cell(0, 5, 'Strona ' . $pdf->PageNo() . '/' . $pdf->AliasNbPages='{nb}', 0, 0, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFillColor(128, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'Strona ' . $pdf->PageNo() . '/' . $pdf->AliasNbPages='{nb}', 0, 0, 'C', true);
    }

    function Kopf($pdf, $x, $y) {
        $pdf->SetTextColor(0, 0, 0);    
        // header
        $pdf->Image('logo.png', 10, 11);
        $pdf->SetXY($x - $x, $y - 45);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(276, 14, utf8_decode('Lista produktów'), 0, 0, 'C');
        //$pdf->Ln();
        $pdf->SetXY($x - $x, $y - 40);
        $pdf->SetFont('Arial', '', 14);
        $pdf->Cell(276, 14, 'ELECTROWORLD', 0, 0, 'C');
        //$pdf->Ln(20);
        
        // data
        $today = getdate();
        $dateGene = $today['year']."-".$today['mon']."-".$today['mday'];
        $timeGene = $today['hours'].":".$today['minutes'].":".$today['seconds'];
    
        $pdf->SetXY($x, $y - 20);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(276, 5, 'Data wygenerowania: '.$dateGene, 0, 0, 'L');
        $pdf->SetXY($x, $y - 15);
        $pdf->Cell(276, 5, 'Godzina wygenerowania: '.$timeGene, 0, 0, 'L');
        $pdf->SetXY($x, $y - 10);
        $pdf->Cell(276, 5, 'Autor: '.$_SESSION['username'], 0, 0, 'L');
        //$pdf->Ln(15);
    
        // separator
        $pdf->Line(40, 33, 280-10, 33); // 20mm from each edge       
        
        // tableheader
        $pdf->SetXY($x, $y);
        $pdf->SetFont('DejaVu', '', 11);
        $pdf->SetFillColor(128, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'Id', 1, 0, 'C', true);
        $pdf->Cell(80, 5, 'Nazwa', 1, 0, 'C', true);
        $pdf->Cell(60, 5, 'Obrazek', 1, 0, 'C', true);
        $pdf->Cell(40, 5, 'Cena', 1, 0, 'C', true);
        $pdf->Cell(35, 5, 'Marka', 1, 0, 'C', true);
        $pdf->Cell(35, 5, 'Typ', 1, 0, 'C', true);
        $pdf->Ln();
    }

session_start();

require('tfpdf.php');

$db = new PDO('mysql:host=localhost;dbname=adminpanel', 'root', '');
$db->query("SET NAMES utf8 COLLATE utf8_polish_ci");

if (isset($_POST['btngenerpdf'])){

    $generpdf = $_POST['gener'];

    $pdf = new tFPDF();
    $pdf->AddPage('L', 'A4', 0);
    // Add a Unicode font (uses UTF-8)
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 10);
    
    // Position auf der X- und Y-Achse
    $x = 15;
    $y = 60; 
    
    Seite($pdf, $x, $y);
    
    Kopf($pdf, $x, $y);
    $y += 5;

    $cur_page = 0;
    // tablerows
            $sel = "SELECT * from tbl_shop_product where name like '%$generpdf%' OR image like '%$generpdf%'";
            $stmt = $db->query($sel);
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $pdf->SetFont('DejaVu', '', 11);
                $pdf->SetTextColor(0, 0, 0);
                //$pdf->SetX(15);
                $pdf->SetXY($x, $y);
                //$pdf->Write(5, utf8_decode($data->id));
                //$pdf->Write(5, utf8_decode($data->name));
                //$pdf->Write(5, utf8_decode($data->file));
                $pdf->Cell(10, 5, $data->id , 1, 0, 'L');
                $pdf->Cell(80, 5, $data->name , 1, 0, 'L');
                $pdf->Cell(60, 5, $data->image , 1, 0, 'L');
                $pdf->Cell(40, 5, $data->price , 1, 0, 'L');
                $pdf->Cell(35, 5, $data->brands , 1, 0, 'L');
                $pdf->Cell(35, 5, $data->type , 1, 0, 'L');
                $pdf->Ln();
                $y += 5;      
                if ($y > 170) {
                    // eine neue Seite einfügen
                    $pdf->AddPage('L', 'A4', 0);
                    // Ausgabe des Fusszeilentext
                    Seite($pdf, $x, $y);
                    $y = 60;
                    
                    Kopf($pdf, $x, $y);                    
                    $y += 5;
                }
            }

    // footer
    Seite($pdf, $x, $y);

    $pdf->Output();
}
?>