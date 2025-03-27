<?php
// print_voucher.php
require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Ambil parameter voucher_id
$voucherId = isset($_GET['voucher_id']) ? (int)$_GET['voucher_id'] : 0;
if ($voucherId <= 0) {
    echo "Voucher ID tidak valid.";
    exit;
}

// Koneksi database
$dbHost    = 'localhost';
$dbName    = 'jurnal_pemasukan';
$dbUser    = 'root';
$dbPass    = '';
$dbCharset = 'utf8mb4';

$dsn = "mysql:host=$dbHost;dbname=" . urlencode($dbName) . ";charset=$dbCharset";
$optionsDb = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $optionsDb);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit;
}

// Query header
$stmtH = $pdo->prepare("SELECT voucher_no, voucher_date, ex_rate, bc_doc_no, bc_date 
                        FROM voucher_header 
                        WHERE id = ?");
$stmtH->execute([$voucherId]);
$header = $stmtH->fetch();
if (!$header) {
    echo "Voucher tidak ditemukan.";
    exit;
}

// Query detail
$stmtD = $pdo->prepare("SELECT account_no, account, amount_debit, amount_credit, description
                        FROM voucher_detail
                        WHERE header_id = ?
                        ORDER BY row_no");
$stmtD->execute([$voucherId]);
$details = $stmtD->fetchAll();

// Hitung total
$totalDebit = 0;
$totalCredit = 0;
foreach ($details as $d) {
    $totalDebit  += floatval($d['amount_debit']);
    $totalCredit += floatval($d['amount_credit']);
}

// Fungsi terbilang sederhana (opsional)
function terbilang($angka) {
    $angka = (int)$angka;
    if ($angka == 0) return "Nol";
    $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", 
              "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
    if ($angka < 12)
        return $huruf[$angka];
    elseif ($angka < 20)
        return terbilang($angka - 10) . " Belas";
    elseif ($angka < 100)
        return terbilang($angka / 10) . " Puluh " . terbilang($angka % 10);
    elseif ($angka < 200)
        return "Seratus " . terbilang($angka - 100);
    elseif ($angka < 1000)
        return terbilang($angka / 100) . " Ratus " . terbilang($angka % 100);
    elseif ($angka < 2000)
        return "Seribu " . terbilang($angka - 1000);
    elseif ($angka < 1000000)
        return terbilang($angka / 1000) . " Ribu " . terbilang($angka % 1000);
    return $angka;
}
$sayTotal = terbilang($totalDebit);

// Siapkan logo
$logoPath = __DIR__ . "/assets/images/logo.jpeg"; 
$logoData = "";
if (file_exists($logoPath)) {
    $logoData = base64_encode(file_get_contents($logoPath));
}

// Susun HTML
$html = '
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 14px; 
      margin: 0; 
      padding: 0;
    }
    .container {
      padding: 20px;
    }
    /* Header Layout */
    .header {
      width: 100%;
      margin-bottom: 20px;
      overflow: auto;
    }
    .header-left {
      float: left;
      width: 60%;
    }
    .logo-wrapper {
      display: inline-block;
      vertical-align: middle;
    }
    .logo-wrapper img {
      max-height: 60px;
      vertical-align: middle;
    }
    .company-info {
      display: inline-block;
      vertical-align: middle;
      margin-left: 10px;
      line-height: 1.2;
    }
    .voucher-info-rounded {
      float: right;
      border: 1px solid #000;
      border-radius: 8px;
      padding: 10px;
      width: 180px;
      text-align: left;
    }
    .voucher-info-rounded h2 {
      margin: 0;
      font-size: 16px;
      text-align: center;
    }
    .voucher-info-rounded p {
      margin: 4px 0;
      font-size: 13px;
    }
    /* Tabel Data */
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      vertical-align: middle;
    }
    th {
      background-color: #f2f2f2; 
    }
    .right-align {
      text-align: right;
    }
    /* Footer Layout */
    .footer-section {
      margin-top: 100px;
      width: 100%;
      /* Kita gunakan float kiri untuk say + desc,
         float kanan untuk deb-credit. */
      overflow: auto; 
    }
    /* Bagian kiri menampung say-box dan desc-box secara vertikal */
    .footer-left {
      float: left;
      width: 60%; /* Sesuaikan jika ingin lebih kecil/besar */
    }
    .say-box {
      width: 100%;
      height: 50px;
      border: 1px solid #000;
      border-radius: 8px;
      padding: 5px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }
    .desc-box {
      width: 100%;
      height: 70px;
      border: 1px solid #000;
      border-radius: 8px;
      padding: 5px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }
    /* Bagian kanan menampung deb-credit-box */
    .footer-right {
      float: right;
      width: 28%; /* Atur lebar sisanya */
    }
    .deb-credit-box {
      border: 1px solid #000;
      border-radius: 8px;
      padding: 10px;
      text-align: left;
    }
    .deb-credit-box label {
      font-weight: bold;
    }
    .deb-credit-box .amount {
      float: right;
      font-weight: normal;
    }
  </style>
</head>
<body>

<div class="container">

  <!-- Header -->
  <div class="header">
    <div class="header-left">
      <div class="logo-wrapper">
        <img src="data:image/png;base64,' . $logoData . '" alt="Logo" />
      </div>
      <div class="company-info">
        <strong>PT. PUNGKOOK INDONESIA ONE</strong><br />
        SUBANG
      </div>
    </div>
    <div class="voucher-info-rounded">
      <h2>JURNAL VOUCHER</h2>
      <p>Voucher No : ' . htmlspecialchars($header['voucher_no']) . '</p>
      <p>Date : ' . htmlspecialchars($header['voucher_date']) . '</p>
    </div>
    <div style="clear:both;"></div>
  </div>

  <!-- Tabel Data -->
  <table>
    <thead>
      <tr>
        <th style="width:20%;">Account No.</th>
        <th style="width:20%;">Account Name</th>
        <th style="width:10%;">Debit</th>
        <th style="width:10%;">Credit</th>
        <th style="width:40%;">Memo</th>
      </tr>
    </thead>
    <tbody>';

foreach ($details as $d) {
  $html .= '
      <tr>
        <td>' . htmlspecialchars($d['account_no']) . '</td>
        <td>' . htmlspecialchars($d['account']) . '</td>
        <td class="right-align">' . number_format($d['amount_debit'], 2) . '</td>
        <td class="right-align">' . number_format($d['amount_credit'], 2) . '</td>
        <td>' . htmlspecialchars($d['description']) . '</td>
      </tr>';
}

$html .= '
    </tbody>
  </table>

  <!-- Footer Section -->
  <div class="footer-section">
    <div class="footer-left">
      <div class="say-box">
        <strong>Say :</strong> ' . htmlspecialchars($sayTotal) . '
      </div>
      <div class="desc-box">
        <strong>Description :</strong><br />
        (Masukkan deskripsi global di sini)
      </div>
    </div>

    <div class="footer-right">
      <div class="deb-credit-box">
        <label>Debits</label>
        <span class="amount">' . number_format($totalDebit, 2) . '</span><br />
        <label>Credits</label>
        <span class="amount">' . number_format($totalCredit, 2) . '</span>
      </div>
    </div>
    <div style="clear:both;"></div>
  </div>

</div>
</body>
</html>
';

// Buat objek Dompdf
$optionsPdf = new Options();
$optionsPdf->set('isRemoteEnabled', true);
$dompdf = new Dompdf($optionsPdf);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF ke browser
$dompdf->stream("voucher_" . $header['voucher_no'] . ".pdf", ["Attachment" => false]);
exit;
