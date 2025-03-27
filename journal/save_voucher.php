<?php
// save_voucher.php

// Konfigurasi koneksi database (sesuaikan dengan lingkungan Anda)
$dbHost    = 'localhost';
$dbName    = 'jurnal_pemasukan'; // ganti sesuai nama database Anda
$dbUser    = 'root';
$dbPass    = '';
$dbCharset = 'utf8mb4';
$dsn = "mysql:host=$dbHost;dbname=" . urlencode($dbName) . ";charset=$dbCharset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Ambil data header dari form
$voucher_no   = $_POST['voucher_no'] ?? '';
$voucher_date = $_POST['voucher_date'] ?? '';
$ex_rate      = $_POST['ex_rate'] ?? 0;
$bc_doc_no    = $_POST['bc_doc_no'] ?? '';
$bc_date      = $_POST['bc_date'] ?? '';

// Ambil data detail (dari tabel) sebagai array
$departments      = $_POST['department'] ?? [];
$account_nos      = $_POST['account_no'] ?? [];
$accounts         = $_POST['account'] ?? [];
$descriptions     = $_POST['description'] ?? [];
$po_nos           = $_POST['po_no'] ?? [];
$curs             = $_POST['cur'] ?? [];
$amount_debits    = $_POST['amount_debit'] ?? [];
$amount_credits   = $_POST['amount_credit'] ?? [];
$idr_amount_debits   = $_POST['idr_amount_debit'] ?? [];
$idr_amount_credits  = $_POST['idr_amount_credit'] ?? [];

$rowCount = count($departments);

// Mulai transaksi
$pdo->beginTransaction();
try {
    // Simpan data header ke tabel voucher_header
    $stmtHeader = $pdo->prepare("INSERT INTO voucher_header 
      (voucher_no, voucher_date, ex_rate, bc_doc_no, bc_date) 
      VALUES (?, ?, ?, ?, ?)");
    $stmtHeader->execute([$voucher_no, $voucher_date, $ex_rate, $bc_doc_no, $bc_date]);
    $header_id = $pdo->lastInsertId();

    // Siapkan statement untuk simpan detail voucher
    $stmtDetail = $pdo->prepare("INSERT INTO voucher_detail 
      (header_id, row_no, department, account_no, account, description, po_no, cur, 
       amount_debit, amount_credit, idr_amount_debit, idr_amount_credit)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Simpan setiap baris detail
    for ($i = 0; $i < $rowCount; $i++) {
        $row_no = $i + 1;
        $stmtDetail->execute([
            $header_id,
            $row_no,
            $departments[$i],
            $account_nos[$i],
            $accounts[$i],
            $descriptions[$i],
            $po_nos[$i],
            $curs[$i],
            $amount_debits[$i] ?: 0,
            $amount_credits[$i] ?: 0,
            $idr_amount_debits[$i] ?: 0,
            $idr_amount_credits[$i] ?: 0
        ]);
    }
    
    $pdo->commit();
    echo "Data voucher berhasil disimpan!";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Gagal menyimpan data voucher: " . $e->getMessage();
}
?>
