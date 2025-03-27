<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>General Journal</title>
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
    /* Container input atas dengan dua kolom */
    .header-inputs {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    .header-inputs .left,
    .header-inputs .right {
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
    /* Container Tabel Full Width */
    .table-wrapper {
      width: 100%;
      margin: 0 auto;
    }
    /* Container scrollable untuk isi tabel */
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
    /* Kolom read-only (tidak bisa diedit) dengan background biru muda */
    .readonly-col {
      background-color: #d6f0ff;
    }
    /* Kolom indikator (panah) */
    .indicator {
      width: 3%;
    }
    /* Pengaturan lebar kolom dalam persentase (sesuai kolom lain) */
    .col-no   { width: 3%; }
    .col-dept { width: 10%; }
    .col-acc-no { width: 12%; }
    .col-acc  { width: 12%; }
    .col-desc { width: 20%; }
    .col-po   { width: 8%; }
    .col-cur  { width: 4%; }
    .col-amt  { width: 24%; } /* Masing-masing subkolom Amount & IDR Amount */
    /* Tabel Total */
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
    /* Tombol */
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
    /* Baris terpilih */
    tr.selected {
      background-color: #e0f7fa;
    }
  </style>
</head>
<body>

<h1>General Journal</h1>

<!-- Input Header (dua kolom) -->
<div class="header-inputs">
  <!-- Kolom Kiri: Voucher No, Date, Ex Rate -->
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
  <!-- Kolom Kanan: BC Docs No, Date -->
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

<!-- Tabel Voucher -->
<div class="table-wrapper">
  <!-- Tabel Scrollable -->
  <div class="scrollable-table-container">
    <table id="voucherTable">
      <thead>
        <tr>
          <!-- Kolom indikator, diberi rowspan agar tetap tampil di kedua baris header -->
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
          <!-- Kolom indikator (kosong jika tidak terpilih) -->
          <td class="indicator"></td>
          <!-- No (read-only) -->
          <td class="readonly-col">1</td>
          <!-- Department -->
          <td><input type="text" name="department[]" style="width: 95%;" /></td>
          <!-- Account No. -->
          <td><input type="text" name="account_no[]" style="width: 95%;" /></td>
          <!-- Account -->
          <td><input type="text" name="account[]" style="width: 95%;" /></td>
          <!-- Description -->
          <td><input type="text" name="description[]" style="width: 95%;" /></td>
          <!-- PO No. -->
          <td><input type="text" name="po_no[]" style="width: 95%;" /></td>
          <!-- Cur (read-only) -->
          <td><input type="text" name="cur[]" readonly class="readonly-col" style="width: 95%;" /></td>
          <!-- Amount Debit -->
          <td><input type="number" step="0.01" name="amount_debit[]" style="width: 95%;" /></td>
          <!-- Amount Credit -->
          <td><input type="number" step="0.01" name="amount_credit[]" style="width: 95%;" /></td>
          <!-- IDR Amount Debit (read-only) -->
          <td><input type="number" step="0.01" name="idr_amount_debit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" /></td>
          <!-- IDR Amount Credit (read-only) -->
          <td><input type="number" step="0.01" name="idr_amount_credit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" /></td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- Baris Total yang selalu ditampilkan di bawah tabel -->
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
  <button type="submit" onclick="alert('Data disimpan (simulasi)!')">Save</button>
  <button type="button" onclick="clearForm()">Clear</button>
  <button type="button" onclick="alert('Import dari Excel (simulasi)!')">Import from Excel</button>
</div>

<script>
  // Fungsi untuk menandai baris yang diklik
  function selectRow(row) {
    // Hapus kelas 'selected' dari semua baris
    const rows = document.querySelectorAll("#voucherTable tbody tr");
    rows.forEach(r => {
      r.classList.remove("selected");
      // Kosongkan kolom indikator
      r.cells[0].innerHTML = "";
    });
    // Tambahkan kelas 'selected' ke baris yang diklik
    row.classList.add("selected");
    // Tampilkan panah di kolom indikator (gunakan simbol panah misalnya "➤")
    row.cells[0].innerHTML = "➤";
  }

  // Fungsi untuk menambahkan baris baru pada tabel
  function addRow() {
    const tableBody = document.getElementById("voucherTable").querySelector("tbody");
    const rowCount = tableBody.rows.length;
    const newRow = tableBody.insertRow();
    newRow.setAttribute("onclick", "selectRow(this)");

    // Kolom indikator (kosongkan)
    let cellIndicator = newRow.insertCell(0);
    cellIndicator.className = "indicator";
    cellIndicator.innerHTML = "";

    // Kolom No (read-only)
    let cellNo = newRow.insertCell(1);
    cellNo.classList.add("readonly-col");
    cellNo.textContent = rowCount + 1;
    
    // Department
    let cellDept = newRow.insertCell(2);
    cellDept.innerHTML = '<input type="text" name="department[]" style="width: 95%;" />';
    
    // Account No.
    let cellAccNo = newRow.insertCell(3);
    cellAccNo.innerHTML = '<input type="text" name="account_no[]" style="width: 95%;" />';
    
    // Account
    let cellAcc = newRow.insertCell(4);
    cellAcc.innerHTML = '<input type="text" name="account[]" style="width: 95%;" />';
    
    // Description
    let cellDesc = newRow.insertCell(5);
    cellDesc.innerHTML = '<input type="text" name="description[]" style="width: 95%;" />';
    
    // PO No.
    let cellPO = newRow.insertCell(6);
    cellPO.innerHTML = '<input type="text" name="po_no[]" style="width: 95%;" />';
    
    // Cur (read-only)
    let cellCur = newRow.insertCell(7);
    cellCur.innerHTML = '<input type="text" name="cur[]" readonly class="readonly-col" style="width: 95%;" />';
    
    // Amount Debit
    let cellAmtDebit = newRow.insertCell(8);
    cellAmtDebit.innerHTML = '<input type="number" step="0.01" name="amount_debit[]" style="width: 95%;" />';
    
    // Amount Credit
    let cellAmtCredit = newRow.insertCell(9);
    cellAmtCredit.innerHTML = '<input type="number" step="0.01" name="amount_credit[]" style="width: 95%;" />';
    
    // IDR Amount Debit (read-only)
    let cellIDRDebit = newRow.insertCell(10);
    cellIDRDebit.innerHTML = '<input type="number" step="0.01" name="idr_amount_debit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" />';
    
    // IDR Amount Credit (read-only)
    let cellIDRCredit = newRow.insertCell(11);
    cellIDRCredit.innerHTML = '<input type="number" step="0.01" name="idr_amount_credit[]" readonly class="readonly-col" style="width: 95%;" value="0.00" />';
  }

  // Fungsi untuk menghapus baris terakhir (minimal 1 baris)
  function deleteRow() {
    const tableBody = document.getElementById("voucherTable").querySelector("tbody");
    if (tableBody.rows.length > 1) {
      tableBody.deleteRow(tableBody.rows.length - 1);
    } else {
      alert("Tidak bisa menghapus semua baris.");
    }
  }

  // Fungsi untuk mengosongkan form dan mengembalikan tabel ke satu baris default
  function clearForm() {
    document.getElementById("voucher_no").value = "";
    document.getElementById("voucher_date").value = "";
    document.getElementById("ex_rate").value = "";
    document.getElementById("bc_doc_no").value = "";
    document.getElementById("bc_date").value = "";
    const tableBody = document.getElementById("voucherTable").querySelector("tbody");
    while (tableBody.rows.length > 1) {
      tableBody.deleteRow(tableBody.rows.length - 1);
    }
    tableBody.rows[0].querySelectorAll("input").forEach(input => input.value = "");
    // Kosongkan juga indikator dan hilangkan kelas selected pada baris default
    tableBody.rows[0].cells[0].innerHTML = "";
    tableBody.rows[0].classList.remove("selected");
  }
</script>

</body>
</html>
