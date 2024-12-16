<?php
require 'config.php';
require 'libs/fpdf.php';

// Query data siswa
$query = "SELECT siswa.*, pegawai.nama AS pegawai_pendaftar 
          FROM siswa
          LEFT JOIN pegawai ON siswa.pegawai_id = pegawai.id";
$result = $conn->query($query);

// Inisialisasi FPDF
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Header Laporan
$pdf->Cell(190, 10, 'Laporan Data Calon Siswa', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1, 'C');
$pdf->Ln(5);

// Header Tabel
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(10, 8, 'No', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Nama', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Email', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'Pegawai', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'Alamat', 1, 1, 'C', true);

// Isi Tabel
$pdf->SetFont('Arial', '', 10);
$no = 1;
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C');
    $pdf->Cell(50, 8, $row['nama'], 1, 0);
    $pdf->Cell(50, 8, $row['email'], 1, 0);
    $pdf->Cell(30, 8, $row['pegawai_pendaftar'] ?? '-', 1, 0);
    $pdf->Cell(50, 8, $row['alamat'], 1, 1);
}

// Output PDF
$pdf->Output('I', 'Laporan_Siswa.pdf');
?>