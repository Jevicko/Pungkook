<?php
// fetch_vouchers.php
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
$start = $_GET['start'] ?? '1900-01-01';
$end   = $_GET['end']   ?? '2100-12-31';

$stmt = $pdo->prepare("SELECT id, voucher_no, voucher_date 
                       FROM voucher_header
                       WHERE voucher_date BETWEEN ? AND ?
                       ORDER BY voucher_date, voucher_no");
$stmt->execute([$start, $end]);

$vouchers = $stmt->fetchAll(); // Contoh: [ ['id'=>1, 'voucher_no'=>'VCH-001', ...], ... ]

echo json_encode($vouchers);
