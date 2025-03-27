<?php
// General_Journal.php

// Koneksi database untuk pop-up Department dan Account
$dbHost    = 'localhost';
$dbName    = 'jurnal_pemasukan'; // Nama database
$dbUser    = 'root';         // Ganti dengan username Anda
$dbPass    = '';     // Ganti dengan password Anda
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

// Ambil data untuk pop-up Department
$stmtDept = $pdo->query("SELECT code, name FROM departments ORDER BY code");
$departments = $stmtDept->fetchAll();

// Ambil data untuk pop-up Account
$stmtAcc = $pdo->query("SELECT code, name FROM accounts ORDER BY code");
$accounts = $stmtAcc->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>General Journal with Two Pop Ups & Excel Import</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      font-size: 16px;
    }
    h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    .header-inputs {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    .header-inputs .left, .header-inputs .right {
      width: 48%;
    }
    .form-row {
      margin-bottom: 10px;
    }
    .form-row label {
      display: inline-block;
      width: 120px;
      font-weight: bold;
    }
    .form-row input[type="text"],
    .form-row input[type="date"],
    .form-row input[type="number"] {
      padding: 5px;
      width: 250px;
      font-size: 16px;
    }
    .table-wrapper {
      width: 100%;
      margin: 0 auto;
      overflow-x: auto;  /* Jika lebar tabel melebihi layar */
    }
    .scrollable-table-container {
      max-height: 400px;
      overflow-y: auto;
      border: 1px solid #ccc;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
      vertical-align: middle;
      word-wrap: break-word;
    }
    th {
      background-color: #f0f0f0;
    }
    .readonly-col {
      background-color: #d6f0ff;
    }
    .indicator {
      width: 3%;
    }
    .col-no   { width: 3%; }
    .col-dept { width: 10%; }
    .col-acc-no { width: 12%; }
    .col-acc  { width: 12%; }
    .col-desc { width: 20%; }
    .col-po   { width: 8%; }
    .col-cur  { width: 4%; }
    .col-amt  { width: 24%; }
    .totals-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 5px;
    }
    .totals-table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
      vertical-align: middle;
    }
    .totals-table .readonly-col {
      background-color: #d6f0ff;
    }
    .button-container {
      margin-top: 20px;
      text-align: center;
    }
    .button-container button {
      padding: 10px 15px;
      margin: 0 5px;
      font-size: 16px;
      cursor: pointer;
    }
    tr.selected {
      background-color: #e0f7fa;
    }
    /* Modal Popup Department */
    #deptModal {
      display: none; 
      position: fixed; 
      z-index: 999; 
      left: 0; top: 0; 
      width: 100%; height: 100%; 
      overflow: auto; 
      background-color: rgba(0,0,0,0.4);
    }
    #deptModalContent {
      background-color: #fff;
      margin: 5% auto;
      padding: 20px;
      width: 500px;
      border: 1px solid #ccc;
      position: relative;
    }
    #deptTable {
      width: 100%;
      border-collapse: collapse;
    }
    #deptTable th, #deptTable td {
      border: 1px solid #ccc;
      padding: 5px;
      text-align: left;
    }
    #closeDeptModal {
      position: absolute;
      right: 10px;
      top: 5px;
      cursor: pointer;
      font-weight: bold;
    }
    /* Modal Popup Account */
    #accModal {
      display: none; 
      position: fixed; 
      z-index: 999; 
      left: 0; top: 0; 
      width: 100%; height: 100%; 
      overflow: auto; 
      background-color: rgba(0,0,0,0.4);
    }
    #accModalContent {
      background-color: #fff;
      margin: 5% auto;
      padding: 20px;
      width: 600px;
      border: 1px solid #ccc;
      position: relative;
    }
    #accTable {
      width: 100%;
      border-collapse: collapse;
    }
    #accTable th, #accTable td {
      border: 1px solid #ccc;
      padding: 5px;
      text-align: left;
    }
    #closeAccModal {
      position: absolute;
      right: 10px;
      top: 5px;
      cursor: pointer;
      font-weight: bold;
    }
    /* Modal Import Excel */
    #excelModal {
      display: none;
      padding: 20px;
      border: 1px solid #ccc;
      position: fixed; 
      z-index: 1000; 
      left: 0; top: 0; 
      width: 100%; height: 100%; 
      overflow: auto; 
      background-color: rgba(0,0,0,0.4);
    }
    #excelModalContent {
      background-color: #fff;
      margin: 5% auto;
      padding: 20px;
      width: 400px;
      border: 1px solid #ccc;
      position: relative;
    }
    #closeExcelModal {
      position: absolute;
      right: 10px;
      top: 5px;
      cursor: pointer;
      font-weight: bold;
    }
  </style>
  <!-- SheetJS library (untuk client-side parse Excel) -->
  <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
</head>
<body>

<h1>General Journal</h1>

<!-- Form Utama -->
<form method="post" action="save_voucher.php" id="journalForm">
  <!-- Input Header -->
  <div class="header-inputs">
    <div class="left">
      <div class="form-row">
        <label for="voucher_no">Voucher No.:</label>
        <input type="text" id="voucher_no" name="voucher_no" placeholder="123/2023" />
      </div>
      <div class="form-row">
        <label for="voucher_date">Date:</label>
        <input type="date" id="voucher_date" name="voucher_date" />
      </div>
      <div class="form-row">
        <label for="ex_rate">Ex Rate:</label>
        <input type="number" step="0.0001" id="ex_rate" name="ex_rate" placeholder="1.00" />
      </div>
    </div>
    <div class="right">
      <div class="form-row">
        <label for="bc_doc_no">BC Docs No.:</label>
        <input type="text" id="bc_doc_no" name="bc_doc_no" placeholder="BC/001" />
      </div>
      <div class="form-row">
        <label for="bc_date">Date:</label>
        <input type="date" id="bc_date" name="bc_date" />
      </div>
    </div>
  </div>

  <!-- Tabel Detail -->
  <div class="table-wrapper">
    <div class="scrollable-table-container">
      <table id="voucherTable">
        <thead>
          <tr>
            <th class="indicator" rowspan="2"></th>
            <th rowspan="2" class="col-no">No</th>
            <th rowspan="2" class="col-dept">Department</th>
            <th rowspan="2" class="col-acc-no">Account No.<br>[F12]</th>
            <th rowspan="2" class="col-acc">Account</th>
            <th rowspan="2" class="col-desc">Description</th>
            <th rowspan="2" class="col-po">PO No.</th>
            <th rowspan="2" class="col-cur">Cur</th>
            <th colspan="2" class="col-amt">Amount</th>
            <th colspan="2" class="col-amt">IDR Amount</th>
          </tr>
          <tr>
            <th class="col-amt">Debit</th>
            <th class="col-amt">Credit</th>
            <th class="col-amt">Debit</th>
            <th class="col-amt">Credit</th>
          </tr>
        </thead>
        <tbody>
          <tr onclick="selectRow(this)">
            <td class="indicator"></td>
            <td class="readonly-col">1</td>
            <!-- Department -->
            <td>
              <div style="display:flex; align-items:center; justify-content:center;">
                <input type="text" name="department[]" style="width: 80%;" readonly />
                <button type="button" style="width:20%;" onclick="openDeptModal(this)">...</button>
              </div>
            </td>
            <!-- Account No. -->
            <td>
              <div style="display:flex; align-items:center; justify-content:center;">
                <input type="text" name="account_no[]" style="width:80%;" readonly />
                <button type="button" style="width:20%;" onclick="openAccModal(this)">...</button>
              </div>
            </td>
            <!-- Account -->
            <td><input type="text" name="account[]" style="width: 95%;" readonly /></td>
            <td><input type="text" name="description[]" style="width: 95%;" /></td>
            <td><input type="text" name="po_no[]" style="width: 95%;" /></td>
            <td><input type="text" name="cur[]" readonly class="readonly-col" style="width: 95%;" /></td>
<!-- Amount Debit dengan oninput -->
<td>
  <input type="number" step="0.01" name="amount_debit[]" style="width: 95%;" oninput="copyToIDR(this, 'debit')" />
</td>
<!-- Amount Credit dengan oninput -->
<td>
  <input type="number" step="0.01" name="amount_credit[]" style="width: 95%;" oninput="copyToIDR(this, 'credit')" />
</td>

            <td><input type="number" step="0.01" name="idr_amount_debit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" /></td>
            <td><input type="number" step="0.01" name="idr_amount_credit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" /></td>
          </tr>
        </tbody>
      </table>
    </div>
    <table class="totals-table">
      <tr>
        <td colspan="10" style="text-align: right;"><strong>Total:</strong></td>
        <td class="readonly-col"><strong>0,00</strong></td>
        <td class="readonly-col"><strong>0,00</strong></td>
      </tr>
    </table>
  </div>

  <!-- Tombol Aksi -->
  <div class="button-container">
    <button type="button" onclick="addRow()">Insert Detail Line</button>
    <button type="button" onclick="deleteRow()">Delete Detail Line</button>
    <button type="submit">Save</button>
    <button type="button" onclick="clearSelectedRow()">Clear</button>
    <button type="button" onclick="document.getElementById('excelModal').style.display='block'">Import from Excel</button>
  </div>
</form>

<!-- MODAL POPUP DEPARTMENT -->
<div id="deptModal">
  <div id="deptModalContent">
    <span id="closeDeptModal" onclick="closeDeptModal()">X</span>
    <h3>Pilih Department</h3>
    <div style="max-height:300px; overflow-y:auto;">
      <table id="deptTable">
        <thead>
          <tr>
            <th>Department Code</th>
            <th>Department Name</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($departments as $dept): ?>
          <tr onclick="selectDepartment('<?php echo $dept['code']; ?>','<?php echo $dept['name']; ?>')">
            <td><?php echo $dept['code']; ?></td>
            <td><?php echo $dept['name']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- MODAL POPUP ACCOUNT -->
<div id="accModal">
  <div id="accModalContent">
    <span id="closeAccModal" onclick="closeAccModal()">X</span>
    <h3>Pilih Account</h3>
    <div style="max-height:300px; overflow-y:auto;">
      <table id="accTable">
        <thead>
          <tr>
            <th>Kode Akun</th>
            <th>Nama Akun</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($accounts as $acc): ?>
          <tr onclick="selectAccount('<?php echo $acc['code']; ?>','<?php echo $acc['name']; ?>')">
            <td><?php echo $acc['code']; ?></td>
            <td><?php echo $acc['name']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- MODAL IMPORT EXCEL -->
<div id="excelModal">
  <div id="excelModalContent">
    <span id="closeExcelModal" onclick="document.getElementById('excelModal').style.display='none'">X</span>
    <h3>Import from Excel</h3>
    <input type="file" id="excelFile" accept=".xls,.xlsx" />
    <br><br>
    <button type="button" onclick="handleExcelImport()">Import Excel</button>
  </div>
</div>

<script>
function copyToIDR(element, type) {
  const row = element.closest('tr');
  if (type === 'debit') {
    const idrDebit = row.querySelector('input[name="idr_amount_debit[]"]');
    if (idrDebit) {
      idrDebit.value = element.value;
    }
  } else if (type === 'credit') {
    const idrCredit = row.querySelector('input[name="idr_amount_credit[]"]');
    if (idrCredit) {
      idrCredit.value = element.value;
    }
  }
  updateTotals();
}

function updateTotals() {
  let totalDebit = 0;
  let totalCredit = 0;
  document.querySelectorAll('input[name="idr_amount_debit[]"]').forEach(function(el) {
    totalDebit += parseFloat(el.value) || 0;
  });
  document.querySelectorAll('input[name="idr_amount_credit[]"]').forEach(function(el) {
    totalCredit += parseFloat(el.value) || 0;
  });
  const totalsCells = document.querySelectorAll('.totals-table td.readonly-col');
  if (totalsCells.length >= 2) {
    totalsCells[0].innerHTML = '<strong>' + totalDebit.toFixed(2) + '</strong>';
    totalsCells[1].innerHTML = '<strong>' + totalCredit.toFixed(2) + '</strong>';
  }
}



  //======================================================
  // POPUP DEPARTMENT
  //======================================================
  let deptTargetInput = null;
  function openDeptModal(button) {
    const tdParent = button.parentElement; 
    deptTargetInput = tdParent.querySelector('input[name="department[]"]');
    document.getElementById('deptModal').style.display = 'block';
  }
  function closeDeptModal() {
    document.getElementById('deptModal').style.display = 'none';
  }
  function selectDepartment(code, name) {
    if (deptTargetInput) {
      deptTargetInput.value = code;
    }
    closeDeptModal();
  }

  //======================================================
  // POPUP ACCOUNT
  //======================================================
  let accNoTargetInput = null;
  let accNameTargetInput = null;
  function openAccModal(button) {
    const row = button.closest('tr');
    accNoTargetInput = row.querySelector('input[name="account_no[]"]');
    accNameTargetInput = row.querySelector('input[name="account[]"]');
    document.getElementById('accModal').style.display = 'block';
  }
  function closeAccModal() {
    document.getElementById('accModal').style.display = 'none';
  }
  function selectAccount(kode, nama) {
    if (accNoTargetInput && accNameTargetInput) {
      accNoTargetInput.value = kode;
      accNameTargetInput.value = nama;
    }
    closeAccModal();
  }

  //======================================================
  // PILIH BARIS
  //======================================================
  function selectRow(row) {
    const rows = document.querySelectorAll("#voucherTable tbody tr");
    rows.forEach(r => {
      r.classList.remove("selected");
      r.cells[0].innerHTML = "";
    });
    row.classList.add("selected");
    row.cells[0].innerHTML = "➤";
  }

  //======================================================
  // INSERT & DELETE ROW
  //======================================================
  function addRow() {
  const tableBody = document.getElementById("voucherTable").querySelector("tbody");
  const rowCount = tableBody.rows.length;
  const newRow = tableBody.insertRow();
  newRow.setAttribute("onclick", "selectRow(this)");

  let cellIndicator = newRow.insertCell(0);
  cellIndicator.className = "indicator";
  cellIndicator.innerHTML = "";

  let cellNo = newRow.insertCell(1);
  cellNo.classList.add("readonly-col");
  cellNo.textContent = rowCount + 1;

  // Department
  let cellDept = newRow.insertCell(2);
  cellDept.innerHTML = `
    <div style="display:flex; align-items:center; justify-content:center;">
      <input type="text" name="department[]" style="width: 80%;" readonly />
      <button type="button" style="width:20%;" onclick="openDeptModal(this)">...</button>
    </div>
  `;

  // Account No.
  let cellAccNo = newRow.insertCell(3);
  cellAccNo.innerHTML = `
    <div style="display:flex; align-items:center; justify-content:center;">
      <input type="text" name="account_no[]" style="width:80%;" readonly />
      <button type="button" style="width:20%;" onclick="openAccModal(this)">...</button>
    </div>
  `;

  // Account
  let cellAcc = newRow.insertCell(4);
  cellAcc.innerHTML = '<input type="text" name="account[]" style="width: 95%;" readonly />';

  // Description
  let cellDesc = newRow.insertCell(5);
  cellDesc.innerHTML = '<input type="text" name="description[]" style="width: 95%;" />';

  // PO No.
  let cellPO = newRow.insertCell(6);
  cellPO.innerHTML = '<input type="text" name="po_no[]" style="width: 95%;" />';

  // Cur
  let cellCur = newRow.insertCell(7);
  cellCur.innerHTML = '<input type="text" name="cur[]" readonly class="readonly-col" style="width: 95%;" />';

  // Amount Debit dengan onchange
  let cellAmtDebit = newRow.insertCell(8);
  cellAmtDebit.innerHTML = '<input type="number" step="0.01" name="amount_debit[]" style="width: 95%;" oninput="copyToIDR(this, \'debit\')" />';

  // Amount Credit dengan onchange
  let cellAmtCredit = newRow.insertCell(9);
  cellAmtCredit.innerHTML = '<input type="number" step="0.01" name="amount_credit[]" style="width: 95%;" oninput="copyToIDR(this, \'credit\')" />';

  // IDR Amount Debit (read-only)
  let cellIDRDebit = newRow.insertCell(10);
  cellIDRDebit.innerHTML = '<input type="number" step="0.01" name="idr_amount_debit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" />';

  // IDR Amount Credit (read-only)
  let cellIDRCredit = newRow.insertCell(11);
  cellIDRCredit.innerHTML = '<input type="number" step="0.01" name="idr_amount_credit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" />';
}


function deleteRow() {
  // Cari baris yang memiliki kelas "selected"
  const selectedRow = document.querySelector("#voucherTable tbody tr.selected");
  if (selectedRow) {
    // Hapus baris yang dipilih
    selectedRow.remove();
    // Optional: Perbarui nomor urut (kolom No) setelah penghapusan
    const rows = document.querySelectorAll("#voucherTable tbody tr");
    rows.forEach((row, index) => {
      row.cells[1].textContent = index + 1;
    });
    updateTotals(); // Jika total perlu diperbarui
  } else {
    alert("Silakan pilih baris yang akan dihapus.");
  }
}


  //======================================================
  // CLEAR SELECTED ROW
  //======================================================
  function clearSelectedRow() {
    const selectedRow = document.querySelector("#voucherTable tbody tr.selected");
    if (selectedRow) {
      selectedRow.querySelectorAll("input").forEach(input => input.value = "");
    } else {
      alert("Silakan pilih baris yang akan dikosongkan.");
    }
  }

  //======================================================
  // IMPORT EXCEL (SheetJS / xlsx)
  //======================================================
  function updateTotals() {
  let totalDebit = 0;
  let totalCredit = 0;
  // Ambil semua nilai dari kolom IDR Amount Debit
  document.querySelectorAll('input[name="idr_amount_debit[]"]').forEach(function(el) {
    totalDebit += parseFloat(el.value) || 0;
  });
  // Ambil semua nilai dari kolom IDR Amount Credit
  document.querySelectorAll('input[name="idr_amount_credit[]"]').forEach(function(el) {
    totalCredit += parseFloat(el.value) || 0;
  });
  // Update tampilan total; misalnya, kita update dua cell pada totals-table
  const totalsCells = document.querySelectorAll('.totals-table td.readonly-col');
  if (totalsCells.length >= 2) {
    totalsCells[0].innerHTML = '<strong>' + totalDebit.toFixed(2) + '</strong>';
    totalsCells[1].innerHTML = '<strong>' + totalCredit.toFixed(2) + '</strong>';
  }
}

function handleExcelImport() {
  const fileInput = document.getElementById('excelFile');
  if (!fileInput.files || fileInput.files.length === 0) {
    alert("Silakan pilih file Excel terlebih dahulu.");
    return;
  }
  const file = fileInput.files[0];
  const reader = new FileReader();
  reader.onload = function(e) {
    const data = new Uint8Array(e.target.result);
    const workbook = XLSX.read(data, { type: 'array' });
    const sheetName = workbook.SheetNames[0];
    const sheet = workbook.Sheets[sheetName];
    // rows adalah array 2D dari Excel
    const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });
    
    // Hapus seluruh isi tabel (tbody)
    const tableBody = document.getElementById("voucherTable").querySelector("tbody");
    tableBody.innerHTML = "";
    
    // Mulai dari baris ke-3 (indeks 2), karena baris 1 dan 2 adalah header
    for (let i = 2; i < rows.length; i++) {
      const rowData = rows[i];
      if (rowData.every(cell => cell === "" || cell === null || typeof cell === 'undefined')) continue;
      const newRow = tableBody.insertRow();
      newRow.setAttribute("onclick", "selectRow(this)");
      
      // Kolom indikator
      let cellIndicator = newRow.insertCell(0);
      cellIndicator.className = "indicator";
      cellIndicator.innerHTML = "";
      
      // Kolom No (nomor urut)
      let cellNo = newRow.insertCell(1);
      cellNo.classList.add("readonly-col");
      cellNo.textContent = tableBody.rows.length; // nomor urut baru
      
      // Department
      let cellDept = newRow.insertCell(2);
      let valDept = rowData[0] || "";
      cellDept.innerHTML = `
        <div style="display:flex; align-items:center; justify-content:center;">
          <input type="text" name="department[]" style="width: 80%;" readonly value="${valDept}" />
          <button type="button" style="width:20%;" onclick="openDeptModal(this)">...</button>
        </div>
      `;
      
      // Account No.
      let cellAccNo = newRow.insertCell(3);
      let valAccNo = rowData[1] || "";
      cellAccNo.innerHTML = `
        <div style="display:flex; align-items:center; justify-content:center;">
          <input type="text" name="account_no[]" style="width:80%;" readonly value="${valAccNo}" />
          <button type="button" style="width:20%;" onclick="openAccModal(this)">...</button>
        </div>
      `;
      
      // Account
      let cellAcc = newRow.insertCell(4);
      let valAcc = rowData[2] || "";
      cellAcc.innerHTML = `<input type="text" name="account[]" style="width:95%;" readonly value="${valAcc}" />`;
      
      // Description
      let cellDesc = newRow.insertCell(5);
      let valDesc = rowData[3] || "";
      cellDesc.innerHTML = `<input type="text" name="description[]" style="width:95%;" value="${valDesc}" />`;
      
      // PO No.
      let cellPO = newRow.insertCell(6);
      let valPO = rowData[4] || "";
      cellPO.innerHTML = `<input type="text" name="po_no[]" style="width:95%;" value="${valPO}" />`;
      
      // Cur
      let cellCur = newRow.insertCell(7);
      let valCur = rowData[5] || "";
      cellCur.innerHTML = `<input type="text" name="cur[]" readonly class="readonly-col" style="width:95%;" value="${valCur}" />`;
      
      // Amount Debit
      let cellAmtDebit = newRow.insertCell(8);
      let valDebit = rowData[6] || 0;
      cellAmtDebit.innerHTML = `<input type="number" step="0.01" name="amount_debit[]" style="width:95%;" value="${valDebit}" oninput="copyToIDR(this, 'debit')" />`;
      
      // Amount Credit
      let cellAmtCredit = newRow.insertCell(9);
      let valCredit = rowData[7] || 0;
      cellAmtCredit.innerHTML = `<input type="number" step="0.01" name="amount_credit[]" style="width:95%;" value="${valCredit}" oninput="copyToIDR(this, 'credit')" />`;
      
      // IDR Amount Debit (langsung salin dari Amount Debit)
      let cellIDRDebit = newRow.insertCell(10);
      let valIDRDebit = valDebit; // langsung disalin
      cellIDRDebit.innerHTML = `<input type="number" step="0.01" name="idr_amount_debit[]" readonly class="readonly-col" style="width:95%;" value="${valIDRDebit}" />`;
      
      // IDR Amount Credit (langsung salin dari Amount Credit)
      let cellIDRCredit = newRow.insertCell(11);
      let valIDRCredit = valCredit;
      cellIDRCredit.innerHTML = `<input type="number" step="0.01" name="idr_amount_credit[]" readonly class="readonly-col" style="width:95%;" value="${valIDRCredit}" />`;
    }
    
    // Setelah import, panggil updateTotals untuk menghitung total
    updateTotals();
    document.getElementById('excelModal').style.display = 'none';
  };
  reader.readAsArrayBuffer(file);
}


</script>

<!-- SECTION: Voucher Search & Detail -->
<div id="voucherSearchSection" style="border:1px solid #ccc; margin:20px; padding:10px;">
  <h2>Search Voucher</h2>

  <!-- Filter Date -->
  <div style="margin-bottom:10px;">
    <label>Date: </label>
    <input type="date" id="startDate" />
    to
    <input type="date" id="endDate" />
    <button type="button" onclick="viewVouchers()">VIEW</button>
  </div>

  <!-- Tabel Header Voucher -->
  <div style="overflow-x:auto; margin-bottom:10px;">
    <table id="voucherHeaderTable" style="width:100%; border-collapse:collapse;">
      <thead>
        <tr>
          <!-- Kolom untuk menampilkan anak panah (Select) -->
          <th style="border:1px solid #ccc; padding:8px; width:3%;">Select</th>
          <th style="border:1px solid #ccc; padding:8px;">Date</th>
          <th style="border:1px solid #ccc; padding:8px;">Voucher Number</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data voucher header akan diisi secara dinamis via AJAX -->
      </tbody>
    </table>
  </div>

  <!-- Search Find Voucher -->
  <div style="margin-bottom:10px;">
    <label>Find Voucher:</label>
    <input type="text" id="searchVoucher" placeholder="Enter" onkeyup="searchVoucherHeader()" />
  </div>

  <!-- Tabel Detail (Read-only) -->
  <div style="overflow-x:auto;">
    <table id="voucherDetailTable" style="width:100%; border-collapse:collapse;">
      <thead>
        <!-- Baris pertama: header multi-row -->
        <tr>
          <th style="border:1px solid #ccc; padding:8px; width:3%;" rowspan="2">Select</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">No</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">Department</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">Account No<br>[F12]</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">Account</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">Description</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">PO No.</th>
          <th style="border:1px solid #ccc; padding:8px;" rowspan="2">Cur</th>
          <th style="border:1px solid #ccc; padding:8px;" colspan="2">Amount</th>
          <th style="border:1px solid #ccc; padding:8px;" colspan="2">IDR Amount</th>
        </tr>
        <!-- Baris kedua: sub kolom Debit & Credit -->
        <tr>
          <th style="border:1px solid #ccc; padding:8px;">Debit</th>
          <th style="border:1px solid #ccc; padding:8px;">Credit</th>
          <th style="border:1px solid #ccc; padding:8px;">Debit</th>
          <th style="border:1px solid #ccc; padding:8px;">Credit</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data detail voucher akan diisi secara dinamis via AJAX.
             Pastikan setiap <tr> yang berasal dari database menyertakan atribut:
             data-detail-id="ID_RECORD"
        -->
      </tbody>
    </table>
  </div>

  <!-- Tombol Aksi -->
  <div style="margin-top:10px; text-align:center;">
    <button type="button" onclick="printVoucher()">PRINT VOUCHER</button>
    <button type="button" onclick="editVoucher()">EDIT</button>
    <button type="button" onclick="deleteDetailRow()">DELETE</button>
  </div>
</div>

<script>
// Fungsi untuk memuat voucher header berdasarkan range tanggal
function viewVouchers() {
  const start = document.getElementById('startDate').value;
  const end   = document.getElementById('endDate').value;

  fetch(`fetch_vouchers.php?start=${start}&end=${end}`)
    .then(response => response.json())
    .then(data => {
      const tbody = document.querySelector('#voucherHeaderTable tbody');
      tbody.innerHTML = '';
      data.forEach(voucher => {
        const row = document.createElement('tr');
        row.onclick = () => selectVoucherHeader(row, voucher.id);
        row.setAttribute("data-voucher-id", voucher.id);

        // Kolom Select
        const cellSelect = document.createElement('td');
        cellSelect.style.border = '1px solid #ccc';
        cellSelect.style.padding = '8px';

        const cellDate = document.createElement('td');
        cellDate.style.border = '1px solid #ccc';
        cellDate.style.padding = '8px';
        cellDate.textContent = voucher.voucher_date;

        const cellNo = document.createElement('td');
        cellNo.style.border = '1px solid #ccc';
        cellNo.style.padding = '8px';
        cellNo.textContent = voucher.voucher_no;

        row.appendChild(cellSelect);
        row.appendChild(cellDate);
        row.appendChild(cellNo);
        tbody.appendChild(row);
      });
    })
    .catch(err => {
      console.error(err);
      alert('Terjadi kesalahan saat memuat data voucher.');
    });
}

// Fungsi pencarian voucher header (client-side filter)
function searchVoucherHeader() {
  const query = document.getElementById('searchVoucher').value.toLowerCase();
  const rows = document.querySelectorAll('#voucherHeaderTable tbody tr');
  rows.forEach(row => {
    const voucherNo = row.cells[2].textContent.toLowerCase();
    row.style.display = (voucherNo.indexOf(query) > -1) ? '' : 'none';
  });
}

// Fungsi ketika voucher header dipilih
function selectVoucherHeader(row, headerId) {
  const allRows = document.querySelectorAll('#voucherHeaderTable tbody tr');
  allRows.forEach(r => {
    r.classList.remove('selected');
    r.cells[0].textContent = '';
  });
  row.classList.add('selected');
  row.cells[0].textContent = '➤';

  loadVoucherDetails(headerId);
}

// Fungsi untuk memuat detail voucher dari server
function loadVoucherDetails(headerId) {
  fetch(`fetch_voucher_detail.php?header_id=${headerId}`)
    .then(response => response.json())
    .then(data => {
      const tbody = document.querySelector('#voucherDetailTable tbody');
      tbody.innerHTML = '';
      data.forEach(detail => {
        const row = document.createElement('tr');
        // Jika detail sudah tersimpan di database, set atribut data-detail-id
        if (detail.id) {
          row.setAttribute("data-detail-id", detail.id);
        }
        row.onclick = () => selectVoucherDetail(row);

        // Kolom Select
        const cellSelect = document.createElement('td');
        cellSelect.style.border = '1px solid #ccc';
        cellSelect.style.padding = '8px';

        const cellNo = document.createElement('td');
        cellNo.style.border = '1px solid #ccc';
        cellNo.style.padding = '8px';
        cellNo.textContent = detail.row_no;

        const cellDept = document.createElement('td');
        cellDept.style.border = '1px solid #ccc';
        cellDept.style.padding = '8px';
        cellDept.textContent = detail.department;

        const cellAccNo = document.createElement('td');
        cellAccNo.style.border = '1px solid #ccc';
        cellAccNo.style.padding = '8px';
        cellAccNo.textContent = detail.account_no;

        const cellAcc = document.createElement('td');
        cellAcc.style.border = '1px solid #ccc';
        cellAcc.style.padding = '8px';
        cellAcc.textContent = detail.account;

        const cellDesc = document.createElement('td');
        cellDesc.style.border = '1px solid #ccc';
        cellDesc.style.padding = '8px';
        cellDesc.textContent = detail.description;

        const cellPO = document.createElement('td');
        cellPO.style.border = '1px solid #ccc';
        cellPO.style.padding = '8px';
        cellPO.textContent = detail.po_no;

        const cellCur = document.createElement('td');
        cellCur.style.border = '1px solid #ccc';
        cellCur.style.padding = '8px';
        cellCur.textContent = detail.cur;

        const cellDebit = document.createElement('td');
        cellDebit.style.border = '1px solid #ccc';
        cellDebit.style.padding = '8px';
        cellDebit.textContent = detail.amount_debit;

        const cellCredit = document.createElement('td');
        cellCredit.style.border = '1px solid #ccc';
        cellCredit.style.padding = '8px';
        cellCredit.textContent = detail.amount_credit;

        const cellIDRDebit = document.createElement('td');
        cellIDRDebit.style.border = '1px solid #ccc';
        cellIDRDebit.style.padding = '8px';
        cellIDRDebit.textContent = detail.idr_amount_debit;

        const cellIDRCredit = document.createElement('td');
        cellIDRCredit.style.border = '1px solid #ccc';
        cellIDRCredit.style.padding = '8px';
        cellIDRCredit.textContent = detail.idr_amount_credit;

        row.appendChild(cellSelect);
        row.appendChild(cellNo);
        row.appendChild(cellDept);
        row.appendChild(cellAccNo);
        row.appendChild(cellAcc);
        row.appendChild(cellDesc);
        row.appendChild(cellPO);
        row.appendChild(cellCur);
        row.appendChild(cellDebit);
        row.appendChild(cellCredit);
        row.appendChild(cellIDRDebit);
        row.appendChild(cellIDRCredit);

        tbody.appendChild(row);
      });
    })
    .catch(err => {
      console.error(err);
      alert('Terjadi kesalahan saat memuat detail voucher.');
    });
}

// Fungsi untuk memilih baris detail voucher
function selectVoucherDetail(row) {
  const allRows = document.querySelectorAll('#voucherDetailTable tbody tr');
  allRows.forEach(r => {
    r.classList.remove('selected');
    r.cells[0].textContent = '';
  });
  row.classList.add('selected');
  row.cells[0].textContent = '➤';
}

// Fungsi untuk menghapus baris detail voucher yang dipilih (database + tampilan)
function deleteDetailRow() {
  console.log("deleteDetailRow() dipanggil");
  const selectedRow = document.querySelector("#voucherDetailTable tbody tr.selected");
  if (!selectedRow) {
    alert("Silakan pilih baris detail yang akan dihapus.");
    return;
  }
  
  const detailId = selectedRow.getAttribute("data-detail-id");
  
  if (detailId) {
    if (confirm("Anda yakin ingin menghapus baris detail ini dari database?")) {
      fetch(`delete_voucher_detail.php?detail_id=${detailId}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(result => {
          console.log("Response dari delete_voucher_detail.php:", result);
          if (result.success) {
            selectedRow.remove();
            updateDetailRowNumbers();
          } else {
            alert("Gagal menghapus detail: " + result.message);
          }
        })
        .catch(error => {
          console.error("Error saat deleteDetailRow():", error);
          alert("Terjadi kesalahan saat menghapus detail.");
        });
    }
  } else {
    selectedRow.remove();
    updateDetailRowNumbers();
  }
}

// Fungsi untuk memperbarui nomor urut pada tabel detail
function updateDetailRowNumbers() {
  const rows = document.querySelectorAll("#voucherDetailTable tbody tr");
  rows.forEach((row, index) => {
    // Kolom No berada di index 1 (index 0 adalah kolom Select)
    row.cells[1].textContent = index + 1;
  });
}

function printVoucher() {
  // Cari baris voucher header yang dipilih
  const selectedRow = document.querySelector("#voucherHeaderTable tbody tr.selected");
  if (!selectedRow) {
    alert("Silakan pilih voucher yang akan dicetak.");
    return;
  }
  const voucherId = selectedRow.getAttribute("data-voucher-id");
  if (!voucherId) {
    alert("Voucher ID tidak ditemukan.");
    return;
  }

  // Buka halaman print_voucher.php dengan voucher_id
  // Menggunakan window.open agar tampil di tab baru (opsional)
  window.open(`print_voucher.php?voucher_id=${voucherId}`, "_blank");
}

function editVoucher() {
  const selectedRow = document.querySelector("#voucherHeaderTable tbody tr.selected");
  if (!selectedRow) {
    alert("Silakan pilih voucher untuk diedit.");
    return;
  }
  const voucherId = selectedRow.getAttribute("data-voucher-id");
  if (!voucherId) {
    alert("Voucher ID tidak ditemukan.");
    return;
  }
  fetch(`fetch_voucher_by_id.php?voucher_id=${voucherId}`)
    .then(response => response.json())
    .then(data => {
      // Populasi form header
      document.getElementById('voucher_no').value = data.header.voucher_no;
      document.getElementById('voucher_date').value = data.header.voucher_date;
      document.getElementById('ex_rate').value = data.header.ex_rate;
      document.getElementById('bc_doc_no').value = data.header.bc_doc_no;
      document.getElementById('bc_date').value = data.header.bc_date;
      
      // Isi tabel detail form utama (tabel dengan ID "voucherTable")
      const detailTbody = document.querySelector("#voucherTable tbody");
      detailTbody.innerHTML = "";
      data.details.forEach((detail, index) => {
        const newRow = detailTbody.insertRow();
        newRow.setAttribute("onclick", "selectRow(this)");
        if (detail.id) {
          newRow.setAttribute("data-detail-id", detail.id);
        }
        const cellSelect = newRow.insertCell(0);
        cellSelect.className = "indicator";
        cellSelect.innerHTML = "";
        const cellNo = newRow.insertCell(1);
        cellNo.classList.add("readonly-col");
        cellNo.textContent = index + 1;
        const cellDept = newRow.insertCell(2);
        cellDept.innerHTML = `
          <div style="display:flex; align-items:center; justify-content:center;">
            <input type="text" name="department[]" style="width:80%;" readonly value="${detail.department}" />
            <button type="button" style="width:20%;" onclick="openDeptModal(this)">...</button>
          </div>
        `;
        const cellAccNo = newRow.insertCell(3);
        cellAccNo.innerHTML = `
          <div style="display:flex; align-items:center; justify-content:center;">
            <input type="text" name="account_no[]" style="width:80%;" readonly value="${detail.account_no}" />
            <button type="button" style="width:20%;" onclick="openAccModal(this)">...</button>
          </div>
        `;
        const cellAcc = newRow.insertCell(4);
        cellAcc.innerHTML = `<input type="text" name="account[]" style="width:95%;" readonly value="${detail.account}" />`;
        const cellDesc = newRow.insertCell(5);
        cellDesc.innerHTML = `<input type="text" name="description[]" style="width:95%;" value="${detail.description}" />`;
        const cellPO = newRow.insertCell(6);
        cellPO.innerHTML = `<input type="text" name="po_no[]" style="width:95%;" value="${detail.po_no}" />`;
        const cellCur = newRow.insertCell(7);
        cellCur.innerHTML = `<input type="text" name="cur[]" readonly class="readonly-col" style="width:95%;" value="${detail.cur}" />`;
        const cellAmtDebit = newRow.insertCell(8);
        cellAmtDebit.innerHTML = `<input type="number" step="0.01" name="amount_debit[]" style="width:95%;" value="${detail.amount_debit}" oninput="copyToIDR(this, 'debit')" />`;
        const cellAmtCredit = newRow.insertCell(9);
        cellAmtCredit.innerHTML = `<input type="number" step="0.01" name="amount_credit[]" style="width:95%;" value="${detail.amount_credit}" oninput="copyToIDR(this, 'credit')" />`;
        const cellIDRDebit = newRow.insertCell(10);
        cellIDRDebit.innerHTML = `<input type="number" step="0.01" name="idr_amount_debit[]" readonly class="readonly-col" style="width:95%;" value="${detail.idr_amount_debit}" />`;
        const cellIDRCredit = newRow.insertCell(11);
        cellIDRCredit.innerHTML = `<input type="number" step="0.01" name="idr_amount_credit[]" readonly class="readonly-col" style="width:95%;" value="${detail.idr_amount_credit}" />`;
      });
      window.scrollTo(0,0);
    })
    .catch(err => {
      console.error(err);
      alert("Gagal memuat data voucher untuk edit.");
    });
}
function deleteVoucher() {
  const selectedRow = document.querySelector("#voucherHeaderTable tbody tr.selected");
  if (!selectedRow) {
    alert("Silakan pilih voucher untuk dihapus.");
    return;
  }
  const voucherId = selectedRow.getAttribute("data-voucher-id");
  if (!voucherId) {
    alert("Voucher ID tidak ditemukan.");
    return;
  }
  
  if (confirm("Anda yakin ingin menghapus voucher ini?")) {
    fetch(`delete_voucher.php?voucher_id=${voucherId}`, { method: 'DELETE' })
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          alert("Voucher berhasil dihapus.");
          viewVouchers();
          document.querySelector("#voucherDetailTable tbody").innerHTML = "";
        } else {
          alert("Gagal menghapus voucher: " + result.message);
        }
      })
      .catch(err => {
        console.error(err);
        alert("Terjadi kesalahan saat menghapus voucher.");
      });
  }
}
</script>




</body>
</html>
