<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incoming Goods</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-custom-green { background-color: #28a745; }
        .bg-custom-yellow { background-color: #ffff99; }
        .bg-custom-light-green { background-color: #d4edda; }
        
        body {
            font-family: Arial, sans-serif;
        }
        .header-journal {
            background-color: #004d00;
            color: yellow;
            text-align: center;
            padding: 4px;
        }
        .table-header {
            background-color: #f0f0f0;
        }
        .table-cell {
            border: 1px solid #ccc;
            padding: 5px;
        }
        .highlight {
            background-color: #00cccc;
        }
        .idr-amount {
            background-color: #00cccc;
        }
        .input-small {
            width: 60px;
        }
        .input-medium {
            width: 100px;
        }
        .divider {
            border-left: 1px solid #ccc;
            height: 100%;
            margin-left: 1rem;
            margin-right: 1rem;
        }
        .input-field {
            width: 100%;
            border: none;
            padding: 5px;
            box-sizing: border-box;
        }
        .button-container-journal {
            background-color: #ffff99;
            padding: 10px;
            border-radius: 5px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-primary p-4">
    <div class="bg-white p-4 rounded-lg shadow-lg">
        <div class="bg-custom-green text-white p-2 rounded-top">
            <h1 class="h5">Incoming Goods</h1>
        </div>
        <div class="p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <label for="date-from" class="fw-bold me-2">Date</label>
                        <input type="number" id="date-from-day" class="form-control me-1" value="1" style="width: 60px;">
                        <input type="number" id="date-from-month" class="form-control me-1" value="3" style="width: 60px;">
                        <input type="number" id="date-from-year" class="form-control me-1" value="2025" style="width: 80px;">
                        <span class="me-2">To</span>
                        <input type="number" id="date-to-day" class="form-control me-1" value="31" style="width: 60px;">
                        <input type="number" id="date-to-month" class="form-control me-1" value="3" style="width: 60px;">
                        <input type="number" id="date-to-year" class="form-control me-1" value="2025" style="width: 80px;">
                        <button class="btn btn-secondary">VIEW</button>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <label for="find" class="fw-bold me-2">Find (Incoming No | Invoice | BC Number | BC Type):</label>
                    <input type="text" id="find" class="form-control me-2">
                    <button class="btn btn-danger">ENTER</button>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="table-responsive mb-3">
                        <table id="supplierTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Supplier</th>
                                    <th>Incoming Docs | Date</th>
                                    <th>Incoming Docs | Number</th>
                                    <th>Customs Docs | Number</th>
                                    <th>Customs Docs | Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <label for="description-usage" class="fw-bold">Description of Usage:</label>
                        <input type="text" id="description-usage" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="description-ppn" class="fw-bold">Description of PPN:</label>
                        <input type="text" id="description-ppn" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="description-pph" class="fw-bold">Description of PPH:</label>
                        <input type="text" id="description-pph" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="description-payment" class="fw-bold">Description of Payment:</label>
                        <input type="text" id="description-payment" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive mb-3">
                        <table id="itemTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Item Number</th>
                                    <th>Items</th>
                                    <th>Unit</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                    <td><input type="text" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table id="journalTable" class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Journal</th>
                                            <th>No</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="total-amount" class="fw-bold">Total Amount</label>
                                        <input type="text" id="total-amount" class="form-control bg-custom-yellow" value="0,00">
                                    </div>
                                    <div class="mb-2">
                                        <label for="dp" class="fw-bold">DP</label>
                                        <input type="text" id="dp" class="form-control bg-custom-yellow" value="0,00">
                                    </div>
                                    <div class="mb-2">
                                        <label for="receivable" class="fw-bold">Receivable</label>
                                        <input type="text" id="receivable" class="form-control bg-custom-yellow" value="0,00">
                                    </div>
                                    <div class="mb-2">
                                        <label for="payable" class="fw-bold">Payable</label>
                                        <input type="text" id="payable" class="form-control bg-custom-yellow" value="0,00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="early-exrate" class="fw-bold">Early ExRate</label>
                                        <input type="text" id="early-exrate" class="form-control" value="0">
                                    </div>
                                    <div class="mb-2">
                                        <label for="other-cost" class="fw-bold">Other Cost</label>
                                        <input type="text" id="other-cost" class="form-control" value="0">
                                    </div>
                                    <div class="mb-2">
                                        <label for="discount" class="fw-bold">Discount</label>
                                        <input type="text" id="discount" class="form-control" value="0">
                                    </div>
                                    <div class="mb-2">
                                        <label for="tanggal-input" class="fw-bold">Tanggal Input</label>
                                        <div class="d-flex">
                                            <input type="number" id="tanggal-input-day" class="form-control me-1" value="1" style="width: 60px;">
                                            <input type="number" id="tanggal-input-month" class="form-control me-1" value="1" style="width: 60px;">
                                            <input type="number" id="tanggal-input-year" class="form-control me-1" value="2000" style="width: 80px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <button class="btn btn-secondary me-2">SET ACCOUNT</button>
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" id="ppn-tax">
                            <label class="form-check-label fw-bold" for="ppn-tax">PPN Tax</label>
                        </div>
                        <div class="form-check me-2">
                            <input class="form-check-input" type="checkbox" id="pph-tax">
                            <label class="form-check-label fw-bold" for="pph-tax">PPh Tax</label>
                        </div>
                        <div class="d-flex align-items-center me-2">
                            <label for="date-of-payment" class="fw-bold me-2">Date of Payment:</label>
                            <input type="number" id="date-of-payment-day" class="form-control me-1" value="1" style="width: 60px;">
                            <input type="number" id="date-of-payment-month" class="form-control me-1" value="3" style="width: 60px;">
                            <input type="number" id="date-of-payment-year" class="form-control me-1" value="2025" style="width: 80px;">
                        </div>
                        <div class="d-flex align-items-center me-2">
                            <label for="ex-rate" class="fw-bold me-2">Ex Rate:</label>
                            <input type="text" id="ex-rate" class="form-control" value="1,00" style="width: 80px;">
                        </div>
                        <button class="btn btn-success">JOURNAL</button>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="table-responsive mb-3">
                        <table id="incomingTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Number</th>
                                    <th>Incoming Docs</th>
                                    <th>Customs Docs</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>31-01-2025</td>
                                    <td>000040-315178-20250117-000040-31517</td>
                                    <td>17/01/2025</td>
                                    <td>A0224/SGKDS/20</td>
                                    <td>5505-0002</td>
                                </tr>
                                <tr>
                                    <td>31-01-2025</td>
                                    <td>000040-315178-20250117-000040-31517</td>
                                    <td>17/01/2025</td>
                                    <td>A0223/SKGDS/20</td>
                                    <td>1103-0003-0003</td>
                                </tr>
                                <tr>
                                    <td>28-01-2025</td>
                                    <td>000040-315178-20250108-000040-31517</td>
                                    <td>08/01/2025</td>
                                    <td>SP2501-0058</td>
                                    <td>2101-0001-0002</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive mb-3">
                        <table id="accountTable" class="table table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Account Number</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Total Harga (-)</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Ex Rate</th>
                                    <th>Total Harga (+)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>5505-0002</td>
                                    <td>Payment for CV Surya Gas Industri - Payment for Helium Re</td>
                                    <td>1</td>
                                    <td>9.150.000,00</td>
                                    <td>0,00</td>
                                    <td>9.150.000,00</td>
                                    <td>1</td>
                                    <td>9.150.000,00</td>
                                </tr>
                                <tr>
                                    <td>1103-0003-0003</td>
                                    <td>Payment for CV Surya Gas Industri - 070.025-00.03059192</td>
                                    <td>1</td>
                                    <td>0,00</td>
                                    <td>9.150.000,00</td>
                                    <td>0,00</td>
                                    <td>1</td>
                                    <td>9.150.000,00</td>
                                </tr>
                                <tr>
                                <td>2101-0001-0002</td>
                                    <td>Payment for CV Surya Gas Industri</td>
                                    <td>1</td>
                                    <td>9.150.000,00</td>
                                    <td>0,00</td>
                                    <td>9.150.000,00</td>
                                    <td>1</td>
                                    <td>9.150.000,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center mb-3">
                        <label for="find-bottom" class="fw-bold me-2">Find (Incoming Number | Invoice | Customs Docs):</label>
                        <input type="text" id="find-bottom" class="form-control me-2">
                        <button class="btn btn-danger">ENTER</button>
                    </div>
                    <div class="d-flex align-items-center">
                        <label for="date-bottom-from" class="fw-bold me-2">Date</label>
                        <input type="number" id="date-bottom-from-day" class="form-control me-1" value="1" style="width: 60px;">
                        <input type="number" id="date-bottom-from-month" class="form-control me-1" value="3" style="width: 60px;">
                        <input type="number" id="date-bottom-from-year" class="form-control me-1" value="2025" style="width: 80px;">
                        <span class="me-2">To</span>
                        <input type="number" id="date-bottom-to-day" class="form-control me-1" value="31" style="width: 60px;">
                        <input type="number" id="date-bottom-to-month" class="form-control me-1" value="3" style="width: 60px;">
                        <input type="number" id="date-bottom-to-year" class="form-control me-1" value="2025" style="width: 80px;">
                        <button class="btn btn-secondary">VIEW</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary me-2">PRINT VOUCHER</button>
                <button class="btn btn-warning me-2">EDIT</button>
                <button class="btn btn-danger">CANCEL</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
                            