<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incoming Goods</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
    .table-cell {
            border: 1px solid #ccc;
            padding: 5px;
            padding: 5px;
        }
</style>
<body class="bg-gray-100 p-4">
    <div class="bg-green-900 text-yellow-200 p-2 flex justify-center items-center h-12   ">
        <h1 class="text-lg font-bold">Incoming Goods</h1>
    </div>
    <div class="border border-gray-300 p-2">
        <div class="flex space-x-2">
            <div class="flex flex-col space-y-1">
                <div class="flex items-center space-x-1">
                    <label for="date-from" class="text-sm">Date</label>
                    <input type="number" id="date-from-day" class="border border-gray-300 p-1 w-12" value="1">
                    <input type="number" id="date-from-month" class="border border-gray-300 p-1 w-12" value="3">
                    <input type="number" id="date-from-year" class="border border-gray-300 p-1 w-16" value="2025">
                </div>
                <div class="flex items-center space-x-2">
    <div class="flex items-center space-x-1">
        <span class="text-sm">To</span>
        <input type="number" id="date-to-day" class="border border-gray-300 p-1 w-12 h-8" value="31">
        <input type="number" id="date-to-month" class="border border-gray-300 p-1 w-12 h-8" value="3">
        <input type="number" id="date-to-year" class="border border-gray-300 p-1 w-16 h-8" value="2025">
        </div>
        <button class="bg-gray-200 border border-gray-300 p-1 h-8 w-16 flex items-center justify-center">VIEW</button>
    </div>
            </div>
            <div class="flex flex-col space-y-1 ml-6">
    <label for="find" class="text-sm">Find (Incoming No | Invoice | BC Number | BC Type):</label>
        <div class="flex space-x-2">
        <input type="text" id="find" class="border border-gray-300 p-1 w-64">
        <button class="bg-red-500 text-white p-1">ENTER</button>
        </div>
        </div>
        
         </div>
            <div class="mt-2 flex">
            <div class="w-2/4">
                <table class="w-full border border-gray-300 text-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2">Supplier</th>
                            <th class="border border-gray-300 p-2">Incoming Docs | Date</th>
                            <th class="border border-gray-300 p-2">Incoming Docs | Number</th>
                            <th class="border border-gray-300 p-2">Customs</th>
                            <th class="border border-gray-300 p-2">Customs Docs</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
        </tr>
                        <tr>
                        <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                        <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                        <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                        <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-5">
                    <label for="description-usage" class="text-sm">Description of Usage:</label>
                    <input type="text" id="description-usage" class="border border-gray-300 p-1 w-full">
                </div>
                <div class="mt-2">
                    <label for="description-ppn" class="text-sm">Description of PPN:</label>
                    <input type="text" id="description-ppn" class="border border-gray-300 p-1 w-full">
                </div>
                <div class="mt-2">
                    <label for="description-pph" class="text-sm">Description of PPH:</label>
                    <input type="text" id="description-pph" class="border border-gray-300 p-1 w-full">
                </div>
                <div class="mt-2">
                    <label for="description-payment" class="text-sm">Description of Payment:</label>
                    <input type="text" id="description-payment" class="border border-gray-300 p-1 w-full">
                </div>
            </div>
            <div class="w-3/5">
                <div class="flex justify-between items-center bg-blue-200 p-2">
                    <h2 class="text-xl font-extrabold flex-1 text-center">List of Items</h2>
                    <button class="bg-gray-200 border border-gray-300 p-1">Button1</button>
                </div>
                <table class="w-full border border-gray-300 text-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 p-2">Item Number</th>
                            <th class="border border-gray-300 p-2">Items</th>
                            <th class="border border-gray-300 p-2">Unit</th>
                            <th class="border border-gray-300 p-2">Qty</th>
                            <th class="border border-gray-300 p-2">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                            <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                            <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                            <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                        <tr>
                            <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex mt-2">
                    <div class="w-1/2">
                        <table class="w-full border border-gray-300 text-lg">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="border border-gray-300 p-2">Journal</th>
                                    <th class="border border-gray-300 p-2">No</th>
                                    <th class="border border-gray-300 p-2">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                                </tr>
                                <tr>
                                <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                                </tr>
                                <tr>
                                <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                                </tr>
                                <tr>
                                <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                                </tr>
                                <tr>
                                <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                    <td class="table-cell"><input type="text" class="input-field"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-1/2 flex flex-col space-y-1">
                        <div class="flex justify-between items-center">
                            <label for="total-amount" class="text-sm">Total Amount:</label>
                            <input type="text" id="total-amount" class="border border-gray-300 p-1 w-24 text-right" value="0,00">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="dp" class="text-sm">DP:</label>
                            <input type="text" id="dp" class="border border-gray-300 p-1 w-24 text-right" value="0,00">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="receivable" class="text-sm">Receivable:</label>
                            <input type="text" id="receivable" class="border border-gray-300 p-1 w-24 text-right" value="0,00">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="payable" class="text-sm">Payable:</label>
                            <input type="text" id="payable" class="border border-gray-300 p-1 w-24 text-right" value="0,00">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="tanggal-input" class="text-sm">Tanggal Input:</label>
                            <input type="number" id="tanggal-input-day" class="border border-gray-300 p-1 w-12" value="1">
                            <input type="number" id="tanggal-input-month" class="border border-gray-300 p-1 w-12" value="3">
                            <input type="number" id="tanggal-input-year" class="border border-gray-300 p-1 w-16" value="2000">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="early-exrate" class="text-sm">Early ExRate:</label>
                            <input type="text" id="early-exrate" class="border border-gray-300 p-1 w-16 text-right" value="0">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="other-cost" class="text-sm">Other Cost:</label>
                            <input type="text" id="other-cost" class="border border-gray-300 p-1 w-16 text-right" value="0">
                        </div>
                        <div class="flex justify-between items-center">
                            <label for="discount" class="text-sm">Discount:</label>
                            <input type="text" id="discount" class="border border-gray-300 p-1 w-16 text-right" value="0">
                        </div>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <button class="bg-gray-200 border border-gray-300 p-8 w-52 transform translate-x-4">SET ACCOUNT</button>
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center space-x-1">
                            <input type="checkbox" id="ppn-tax" class="border border-gray-300">
                            <label for="ppn-tax" class="text-sm">PPN Tax</label>
                        </div>
                        <div class="flex items-center space-x-1">
                            <input type="checkbox" id="pph-tax" class="border border-gray-300">
                            <label for="pph-tax" class="text-sm">PPh Tax</label>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <div class="flex items-center space-x-1">
                            <label for="date-of-payment" class="text-sm">Date of Payment:</label>
                            <input type="number" id="date-of-payment-day" class="border border-gray-300 p-1 w-12" value="1">
                            <input type="number" id="date-of-payment-month" class="border border-gray-300 p-1 w-12" value="3">
                            <input type="number" id="date-of-payment-year" class="border border-gray-300 p-1 w-16" value="2025">
                        </div>
                        <div class="flex items-center space-x-1">
                            <label for="ex-rate" class="text-sm">Ex Rate:</label>
                            <input type="text" id="ex-rate" class="border border-gray-300 p-1 w-16 text-right" value="1,00">
                        </div>
                    </div>
                    <button class="bg-gray-200 border border-gray-300 p-2">JOURNAL</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>