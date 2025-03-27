<?php
// delete_voucher_detail.php
header('Content-Type: application/json');

// Pastikan request method adalah DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(['success' => false, 'message' => 'Metode request harus DELETE.']);
    exit;
}

// Konfigurasi koneksi database
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
    error_log("Koneksi gagal: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Koneksi gagal: ' . $e->getMessage()]);
    exit;
}

// Ambil parameter detail_id
$detail_id = isset($_GET['detail_id']) ? (int)$_GET['detail_id'] : 0;
if ($detail_id <= 0) {
    error_log("Detail ID tidak valid: " . $detail_id);
    echo json_encode(['success' => false, 'message' => 'Detail ID tidak valid.']);
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM voucher_detail WHERE id = ?");
    $stmt->execute([$detail_id]);
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true]);
    } else {
        error_log("Detail tidak ditemukan atau sudah dihapus: ID " . $detail_id);
        echo json_encode(['success' => false, 'message' => 'Detail tidak ditemukan atau sudah dihapus.']);
    }
} catch (Exception $e) {
    error_log("Error saat menghapus detail: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
