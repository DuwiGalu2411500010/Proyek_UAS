<?php
require('../fpdf/fpdf.php');
include('../includes/config.php');

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(190,10,'LAPORAN TRANSAKSI',0,1,'C');

$pdf->Ln(5);
$pdf->SetFont('Arial','',10);

if ($tanggal != '') {
    $pdf->Cell(190,8,'Tanggal: '.$tanggal,0,1);
}

$pdf->Ln(3);

/* HEADER TABEL */
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,8,'ID',1);
$pdf->Cell(50,8,'Tanggal',1);
$pdf->Cell(60,8,'Kasir',1);
$pdf->Cell(40,8,'Total',1);
$pdf->Ln();

/* DATA */
$pdf->SetFont('Arial','',10);

$query = "
    SELECT 
        t.id_transaksi,
        t.tanggal,
        t.kasir,
        SUM(d.subtotal) AS total
    FROM transaksi t
    JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
";

if ($tanggal != '') {
    $query .= " WHERE DATE(t.tanggal) = '$tanggal'";
}

$query .= " GROUP BY t.id_transaksi ORDER BY t.tanggal DESC";

$result = mysqli_query($conn, $query);
$grandTotal = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(20,8,$row['id_transaksi'],1);
    $pdf->Cell(50,8,$row['tanggal'],1);
    $pdf->Cell(60,8,$row['kasir'],1);
    $pdf->Cell(40,8,'Rp '.number_format($row['total'],0,',','.'),1,0,'R');
    $pdf->Ln();
    $grandTotal += $row['total'];
}

/* GRAND TOTAL */
$pdf->SetFont('Arial','B',10);
$pdf->Cell(130,8,'TOTAL KESELURUHAN',1);
$pdf->Cell(40,8,'Rp '.number_format($grandTotal,0,',','.'),1,0,'R');

$pdf->Output();
