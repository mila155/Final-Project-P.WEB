<?php
require_once('path/to/tcpdf.php'); // Adjust the path to your TCPDF library

// Create new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Laporan Stok Produk');
$pdf->SetSubject('Laporan Stok');
$pdf->SetKeywords('TCPDF, PDF, laporan, stok');

// Set default header data
$pdf->SetHeaderData('', 0, 'Laporan Stok Produk', 'Generated on: ' . date('Y-m-d'));

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Get the date range from POST
$tanggal_awal = $_POST['tanggal_awal'] ?? null;
$tanggal_akhir = $_POST['tanggal_akhir'] ?? null;

// Connect to the database
include 'service/koneksi.php';

// Prepare the query
$query = "
    SELECT 
        p.kode_produk,
        p.nama_produk,
        p.stok AS stok_awal_db,
        COALESCE(SUM(sm.jumlah_masuk), 0) AS total_masuk,
        COALESCE(SUM(sk.jumlah_keluar), 0) AS total_keluar,
        MAX(sm.tanggal_masuk) AS tanggal_terakhir_masuk
    FROM produk p
    LEFT JOIN stok_masuk sm ON p.kode_produk = sm.kode_produk AND sm.tanggal_masuk BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
    LEFT JOIN stok_keluar sk ON p.kode_produk = sk.kode_produk AND sk.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
    GROUP BY p.kode_produk
    HAVING total_masuk > 0 OR total_keluar > 0
";

$hasil = mysqli_query($conn, $query);
if (!$hasil) {
    die('Query Error: ' . mysqli_error($conn));
}

// Prepare HTML content for PDF
$html = '<h1>Laporan Stok Produk</h1>';
$html .= '<table border="1" cellpadding="5">';
$html .= '<tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Stok Awal</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Stok Akhir</th>
            <th>Tanggal Masuk</th>
          </tr>';

while ($data = mysqli_fetch_assoc($hasil)) {
    $stok_awal = $data['stok_awal_db'];
    $stok_akhir = $stok_awal + $data['total_masuk'] - $data['total_keluar'];
    $html .= '<tr>
                <td>' . htmlspecialchars($data['kode_produk']) . '</td>
                <td>' . htmlspecialchars($data['nama_produk']) . '</td>
                <td>' . $stok_awal . '</td>
                <td>' . $data['total_masuk'] . '</td>
                <td>' . $data['total_keluar'] . '</td>
                <td>' . $stok_akhir . '</td>
                <td>' . $data['tanggal_terakhir_masuk'] . '</td>
              </tr>';
}

$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('laporan_stok_produk.pdf', 'D'); // 'D' for download
?>