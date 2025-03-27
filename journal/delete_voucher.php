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

// Mulai transaksi
$pdo->beginTransaction();
try {
    // Hapus detail voucher terlebih dahulu
    $stmtDetail = $pdo->prepare("DELETE FROM voucher_detail WHERE header_id = ?");
    $stmtDetail->execute([$voucher_id]);
    
    // Hapus header voucher
    $stmtHeader = $pdo->prepare("DELETE FROM voucher_header WHERE id = ?");
    $stmtHeader->execute([$voucher_id]);
    
    $pdo->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
