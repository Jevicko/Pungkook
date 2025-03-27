<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Journal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        
    </style>
</head>
<body class="p-4">
    <div class="header-journal">
        <h3>GENERAL JOURNAL [PAGE #1]</h3>
    </div>
    <div class="border border-gray-300 p-2">
        <div class="flex justify-between mb-2">
            <div class="flex items-center">
                <label for="voucherNo" class="mr-2">Voucher No. :</label>
                <input type="text" id="voucherNo" class="border border-gray-300 p-1 input-medium" value="GJ/01050/III/25">
            </div>
            <div class="flex items-center">
                <label for="exRate" class="mr-2">Ex Rate :</label>
                <input type="text" id="exRate" class="border border-gray-300 p-1 input-small" value="1,00">
            </div>
            <div class="divider"></div>
            <div class="flex items-center">
                <label for="bcDocsNo" class="mr-2">BC Docs No :</label>
                <input type="text" id="bcDocsNo" class="border border-gray-300 p-1 input-medium" value="-">
            </div>
        </div>
        <div class="flex justify-between mb-2">
            <div class="flex items-center">
                <label for="date" class="mr-2">Date :</label>
                <input type="number" id="date" class="border border-gray-300 p-1 input-small" value="">
                <input type="number" id="month" class="border border-gray-300 p-1 mx-1 input-small" value="">
                <input type="number" id="year" class="border border-gray-300 p-1 input-small" value="" style="width: 80px;">
            </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
            let today = new Date();
            document.getElementById("date").value = today.getDate();
            document.getElementById("month").value = today.getMonth() + 1; // Bulan dimulai dari 0, jadi perlu +1
            document.getElementById("year").value = today.getFullYear();});
        </script>


            <div class="flex items-center">
                <label for="bcDate" class="mr-2">Date :</label>
                <input type="number" id="bcDate" class="border border-gray-300 p-1 input-small" value="24">
                <input type="number" id="bcMonth" class="border border-gray-300 p-1 mx-1 input-small" value="3">
                <input type="number" id="bcYear" class="border border-gray-300 p-1 input-small" value="2025" style="width: 80px;">
            </div>

            <script>
            document.addEventListener("DOMContentLoaded", function () {
            let today = new Date();
            document.getElementById("bcDate").value = today.getDate();
            document.getElementById("bcMonth").value = today.getMonth() + 1; // Bulan dimulai dari 0, jadi perlu +1
            document.getElementById("bcYear").value = today.getFullYear();});
        </script>

        </div>
        <table class="w-full border-collapse">
            <thead class="table-header">
                <tr>
                <th class="table-cell" rowspan="2">No</th>
                    <th class="table-cell" rowspan="2">Departement</th>
                    <th class="table-cell" rowspan="2">Account No. [F12]</th>
                    <th class="table-cell" rowspan="2">Account</th>
                    <th class="table-cell" rowspan="2">Description</th>
                    <th class="table-cell" rowspan="2">PO No.</th>
                    <th class="table-cell" rowspan="2">Curr</th>
                    <th class="table-cell" colspan="2">Amount</th>
                    <th class="table-cell" colspan="2">IDR Amount</th>
                </tr>
                <tr class="table-header">
                    <th class="table-cell">Debit</th>
                    <th class="table-cell">Credit</th>
                    <th class="table-cell">Debit</th>
                    <th class="table-cell">Credit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="table-cell highlight">1</td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field" value="-"></td>
                    <td class="table-cell highlight"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell idr-amount"></td>
                    <td class="table-cell idr-amount"></td>
                </tr>
                <tr>
                    <td class="table-cell highlight">2</td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field" value="-"></td>
                    <td class="table-cell highlight"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell idr-amount"></td>
                    <td class="table-cell idr-amount"></td>
                </tr>
                <tr>
                    <td class="table-cell highlight">3</td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field" value="-"></td>
                    <td class="table-cell highlight"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell idr-amount"></td>
                    <td class="table-cell idr-amount"></td>
                </tr>
                <tr>
                    <td class="table-cell highlight">4</td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field" value="-"></td>
                    <td class="table-cell highlight"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell idr-amount"></td>
                    <td class="table-cell idr-amount"></td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end mt-2">
            <div class="flex items-center">
                <label for="total" class="mr-2">0,00</label>
            </div>
        </div>
        <div class="button-container-journal flex justify-between mt-4">
            <div class="space-x-2">
                <button class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">Insert on Rec</button>
                <button class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">Delete on Rec</button>
            </div>
            <div class="space-x-2">
                <button class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">Save</button>
                <button class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">Clear</button>
            </div>
            <div class="space-x-2">
                <button class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">Import Excel</button>
            </div>
        </div>
    </div>
</body>


<!-- table view  -->

<head>
    <style>
    .table-container {
    transform: scale(1.5); /* Memperbesar 20% */
    transform-origin: top left; /* Agar skala tetap dari kiri atas */}
    </style>

</head>
<body-view class="bg-gray-100 p-4">
    <div class="bg-white border border-gray-300 p-2">
        <div class="flex justify-center items-center space-x-2 mb-2">
        <label for="date-from" class="text-base">Date :</label>
            <div class="relative">
            <input id="date-from" type="number" value="24" class="border border-gray-300 p-2 text-lg w-16 appearance-none">
                <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center">
                    <button type="button" onclick="incrementValue('date-from', 1)" class="text-xs px-1"></button>
                    <button type="button" onclick="incrementValue('date-from', -1)" class="text-xs px-1"></button>
                </div>
            </div>
            <div class="relative">
                <input type="number" value="3" class="border border-gray-300 p-1 text-sm w-12 appearance-none">
                <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center">
                    <button type="button" onclick="incrementValue(this.previousElementSibling, 1)" class="text-xs px-1"></button>
                    <button type="button" onclick="incrementValue(this.previousElementSibling, -1)" class="text-xs px-1"></button>
                </div>
            </div>
            <div class="relative">
                <input type="number" value="2025" class="border border-gray-300 p-1 text-sm w-16 appearance-none">
                <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center">
                    <button type="button" onclick="incrementValue(this.previousElementSibling, 1)" class="text-xs px-1"></button>
                    <button type="button" onclick="incrementValue(this.previousElementSibling, -1)" class="text-xs px-1"></button>
                </div>
            </div>
            <span class="text-sm">To</span>
            <div class="relative">
                <input type="number" value="24" class="border border-gray-300 p-1 text-sm w-12 appearance-none">
                <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center">
                    <button type="button" onclick="incrementValue(this.previousElementSibling, 1)" class="text-xs px-1"></button>
                    <button type="button" onclick="incrementValue(this.previousElementSibling, -1)" class="text-xs px-1"></button>
                </div>
            </div>
            <div class="relative">
                <input type="number" value="3" class="border border-gray-300 p-1 text-sm w-12 appearance-none">
                <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center">
                    <button type="button" onclick="incrementValue(this.previousElementSibling, 1)" class="text-xs px-1"></button>
                    <button type="button" onclick="incrementValue(this.previousElementSibling, -1)" class="text-xs px-1"></button>
                </div>
            </div>
            <div class="relative">
                <input type="number" value="2025" class="border border-gray-300 p-1 text-sm w-16 appearance-none">
                <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center">
                    <button type="button" onclick="incrementValue(this.previousElementSibling, 1)" class="text-xs px-1"></button>
                    <button type="button" onclick="incrementValue(this.previousElementSibling, -1)" class="text-xs px-1"></button>
                </div>
            </div>
            <button class="bg-gray-200 border border-gray-300 px-2 py-1 text-sm">VIEW</button>
        </div>
        <div class="flex">
            <div class="w-1/4 border border-gray-300">
            <table class="w-full text-lg">

                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-3">Date</th>
                            <th class="border border-gray-300 p-3">Voucher Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-3">24/03/2025</td>
                            <td class="border border-gray-300 p-3">GJ/01049/III/25</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="w-3/4 border border-gray-300 ml-2">
            <table class="w-full text-lg">


                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-3">No</th>
                            <th class="border border-gray-300 p-3">Dept.</th>
                            <th class="border border-gray-300 p-3">Account No.</th>
                            <th class="border border-gray-300 p-3">Account</th>
                            <th class="border border-gray-300 p-3">Description</th>
                            <th class="border border-gray-300 p-3">Curr</th>
                            <th class="border border-gray-300 p-3" colspan="2">Amount</th>
                            <th class="border border-gray-300 p-3" colspan="2">IDR Amount</th>
                        </tr>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-3"></th>
                            <th class="border border-gray-300 p-3"></th>
                            <th class="border border-gray-300 p-3"></th>
                            <th class="border border-gray-300 p-3"></th>
                            <th class="border border-gray-300 p-3"></th>
                            <th class="border border-gray-300 p-3"></th>
                            <th class="border border-gray-300 p-3">Debit</th>
                            <th class="border border-gray-300 p-3">Credit</th>
                            <th class="border border-gray-300 p-3">Debit</th>
                            <th class="border border-gray-300 p-3">Credit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 p-3">1</td>
                            <td class="border border-gray-300 p-3">03</td>
                            <td class="border border-gray-300 p-3">1101-0001-0001-0001</td>
                            <td class="border border-gray-300 p-3">Cash (IDR) - Subang</td>
                            <td class="border border-gray-300 p-3">Pembelian Material</td>
                            <td class="border border-gray-300 p-3">IDR</td>
                            <td class="border border-gray-300 p-3">100,00</td>
                            <td class="border border-gray-300 p-3"></td>
                            <td class="border border-gray-300 p-3">100,</td>
                            <td class="border border-gray-300 p-3"></td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 p-3">2</td>
                            <td class="border border-gray-300 p-3">01</td>
                            <td class="border border-gray-300 p-3">1101-0001-0004-0001</td>
                            <td class="border border-gray-300 p-3">Cash (USD) - G</td>
                            <td class="border border-gray-300 p-3">Pembelian Material</td>
                            <td class="border border-gray-300 p-3">IDR</td>
                            <td class="border border-gray-300 p-3"></td>
                            <td class="border border-gray-300 p-3">100,00</td>
                            <td class="border border-gray-300 p-3"></td>
                            <td class="border border-gray-300 p-3">100,00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        
        <div class="mt-4 bg-yellow-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center bg-white p-2">
                    <label for="find-voucher" class="text-sm">Find Voucher :</label>
                    <input id="find-voucher" type="text" class="border border-gray-300 p-2 text-sm ml-12">
                    <button type="button" class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">ENTER</button>
                </div>
                <div class="flex space-x-2">
                    <button type="button" class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">PRINT VOUCHER</button>
                    <button type="button" class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">EDIT</button>
                    <button type="button" class="bg-gray-100 border border-gray-300 text-black px-4 py-2 rounded hover:bg-gray-300 hover:border-gray-400 active:bg-gray-400 active:border-gray-500">DELETE</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function incrementValue(element, increment) {
            if (typeof element === 'string') {
                element = document.getElementById(element);
            }
            let value = parseInt(element.value, 10);
            value = isNaN(value) ? 0 : value;
            value += increment;
            element.value = value;
        }
    </script>
</body-view>
</html>