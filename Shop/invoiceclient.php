<?php

    function guidv4()
    {
        if (function_exists('com_create_guid') === true)
            return trim(com_create_guid(), '{}');

        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function Seite($pdf, $x, $y) {
        $pdf->SetY(5);
        //$pdf->Cell(0, 5, 'Strona ' . $pdf->PageNo() . '/' . $pdf->AliasNbPages='{nb}', 0, 0, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFillColor(128, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 5, 'Page ' . $pdf->PageNo() . '/' . $pdf->AliasNbPages='{nb}', 0, 0, 'C', true);
    }

    function Kopf($pdf, $x, $y) {
        $pdf->SetTextColor(0, 0, 0);    
        // header
        $pdf->Image('logo.png', 10, 11);
        $pdf->SetXY($x - $x, $y - 45);
        $pdf->SetFont('Arial', 'B', 20);
        $pdf->Cell(290, 14, utf8_decode('Invoice'), 0, 0, 'C');
        //$pdf->Ln();
        $pdf->SetXY($x - $x, $y - 40);
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(290, 14, 'ELECTROWORLD', 0, 0, 'C');
        $pdf->SetXY($x - $x, $y - 40);
        $pdf->Cell(280, 14, 'Your guid: '.$_SESSION['fullName'], 0, 0, 'R');
        //$pdf->Ln(20);
        
        // data
        $today = getdate();
        $dateGene = $today['year']."-".$today['mon']."-".$today['mday'];
        $timeGene = $today['hours'].":".$today['minutes'].":".$today['seconds'];
    
        $pdf->SetXY($x, $y - 20);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(276, 5, 'Company Name: -----', 0, 0, 'L');
        $pdf->SetXY($x, $y - 15);
        $pdf->Cell(276, 5, 'Address: -----', 0, 0, 'L');
        $pdf->SetXY($x, $y - 10);
        $pdf->Cell(276, 5, 'Phone: -----', 0, 0, 'L');

        $pdf->SetXY($x, $y - 20);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(270, 5, 'Date: '.$dateGene, 0, 0, 'R');
        $pdf->SetXY($x, $y - 15);
        $pdf->Cell(270, 5, 'Time: '.$timeGene, 0, 0, 'R');
        $pdf->SetXY($x, $y - 10);
        $pdf->Cell(270, 5, 'Invoice id: '.guidv4(), 0, 0, 'R');
        
    
        // separator
        $pdf->Line(20, 33, 280-10, 33); // 20mm from each edge       
        
        // tableheader
        $pdf->SetXY($x, $y);
        $pdf->SetFont('DejaVu', '', 11);
        $pdf->SetFillColor(128, 128, 128);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(20, 5, 'Product id', 1, 0, 'C', true);
        $pdf->Cell(80, 5, 'Your guid', 1, 0, 'C', true);
        $pdf->Cell(80, 5, 'Product name', 1, 0, 'C', true);
        $pdf->Cell(20, 5, 'Quantity', 1, 0, 'C', true);
        $pdf->Cell(30, 5, 'Price', 1, 0, 'C', true);
        $pdf->Cell(40, 5, 'Totalprice', 1, 0, 'C', true);
        $pdf->Ln();
    }

session_start();

require('tfpdf.php');

$db = new PDO('mysql:host=localhost;dbname=adminpanel', 'root', '');
$db->query("SET NAMES utf8 COLLATE utf8_polish_ci");

//if (isset($_POST['btngenerpdf'])){


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
    $name = $_SESSION['fullName'];
            $sel = "SELECT * from tbl_products where email='$name'";
            $stmt = $db->query($sel);
            while ($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $pdf->SetFont('DejaVu', '', 11);
                $pdf->SetTextColor(0, 0, 0);
                //$pdf->SetX(15);
                $pdf->SetXY($x, $y);
                //$pdf->Write(5, utf8_decode($data->id));
                //$pdf->Write(5, utf8_decode($data->name));
                //$pdf->Write(5, utf8_decode($data->file));
                $pdf->Cell(20, 5, $data->idproduct , 1, 0, 'L');
                $pdf->Cell(80, 5, $data->email , 1, 0, 'L');
                $pdf->Cell(80, 5, $data->name , 1, 0, 'L');
                $pdf->Cell(20, 5, $data->quantity , 1, 0, 'L');
                $pdf->Cell(30, 5, $data->price , 1, 0, 'L');
                $pdf->Cell(40, 5, $data->totalprice , 1, 0, 'L');
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

        $query = "SELECT SUM(totalprice) from tbl_products where email='$name'";
        $stmt1 = $db->query($query);
        $pdf->SetXY($x, $y + 10);
        $pdf->SetFont('Arial', '', 12);
        while ($data = $stmt1->fetch(PDO::FETCH_NUM)){
            $pdf->Cell(60, 5, 'Total: '.$data[0], 1, 0, 'L', true);
        }
        

    // footer
    Seite($pdf, $x, $y);

    $pdf->Output();
//}
?>