<?php
// fetch_voucher_detail.php
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
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    echo json_encode([]);
    exit;
}

// Ambil parameter
$header_id = $_GET['header_id'] ?? 0;
$header_id = (int)$header_id;

// Query detail (tambahkan kolom id)
$stmt = $pdo->prepare("SELECT id, row_no, department, account_no, account, description, po_no, cur, amount_debit, amount_credit, idr_amount_debit, idr_amount_credit
                       FROM voucher_detail
                       WHERE header_id = ?
                       ORDER BY row_no");
$stmt->execute([$header_id]);
$details = $stmt->fetchAll();

echo json_encode($details);
?>
