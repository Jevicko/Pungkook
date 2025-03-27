<?php
header('Content-Type: application/json');

// Koneksi database
$dbHost    = 'localhost';
$dbName    = 'jurnal_pemasukan';
$dbUser    = 'root';
$dbPass    = '';
$dbCharset = 'utf8mb4';
$dsn = "mysql:host=$dbHost;dbname=" . urlencode($dbName) . ";charset=$dbCharset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "Koneksi gagal: " . $e->getMessage()]);
    exit;
}

// Ambil voucher_id dari GET
$voucher_id = $_GET['voucher_id'] ?? 0;
$voucher_id = (int)$voucher_id;

if (!$voucher_id) {
    echo json_encode(['success' => false, 'message' => "Voucher ID tidak valid"]);
    exit;
}

// Ambil data header voucher
$stmtHeader = $pdo->prepare("SELECT id, voucher_no, voucher_date, ex_rate, bc_doc_no, bc_date FROM voucher_header WHERE id = ?");
$stmtHeader->execute([$voucher_id]);
$header = $stmtHeader->fetch();

if (!$header) {
    echo json_encode(['success' => false, 'message' => "Voucher tidak ditemukan"]);
    exit;
}

// Ambil data detail voucher
$stmtDetail = $pdo->prepare("SELECT row_no, department, account_no, account, description, po_no, cur, amount_debit, amount_credit, idr_amount_debit, idr_amount_credit FROM voucher_detail WHERE header_id = ? ORDER BY row_no");
$stmtDetail->execute([$voucher_id]);
$details = $stmtDetail->fetchAll();

// Kembalikan data sebagai JSON
echo json_encode([
    'success' => true,
    'header'  => $header,
    'details' => $details
]);
?>
