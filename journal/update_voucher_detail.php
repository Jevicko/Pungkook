<?php
// update_voucher_detail.php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
    exit;
}

$id = $data['id'];
// Ambil data lainnya
$department       = $data['department'] ?? '';
$account_no       = $data['account_no'] ?? '';
$account          = $data['account'] ?? '';
$description      = $data['description'] ?? '';
$po_no            = $data['po_no'] ?? '';
$cur              = $data['cur'] ?? '';
$amount_debit     = $data['amount_debit'] ?? 0;
$amount_credit    = $data['amount_credit'] ?? 0;
$idr_amount_debit = $data['idr_amount_debit'] ?? 0;
$idr_amount_credit= $data['idr_amount_credit'] ?? 0;

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
    echo json_encode(['success' => false, 'message' => "Koneksi DB gagal: " . $e->getMessage()]);
    exit;
}

$stmt = $pdo->prepare("UPDATE voucher_detail SET 
    department = ?,
    account_no = ?,
    account = ?,
    description = ?,
    po_no = ?,
    cur = ?,
    amount_debit = ?,
    amount_credit = ?,
    idr_amount_debit = ?,
    idr_amount_credit = ?
    WHERE id = ?");
try {
    $stmt->execute([
        $department, $account_no, $account, $description, $po_no, $cur,
        $amount_debit, $amount_credit, $idr_amount_debit, $idr_amount_credit,
        $id
    ]);
    echo json_encode(['success' => true]);
} catch (Exception $ex) {
    echo json_encode(['success' => false, 'message' => $ex->getMessage()]);
}
?>
