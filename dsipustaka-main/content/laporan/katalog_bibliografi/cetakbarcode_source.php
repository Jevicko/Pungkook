<?php 
$dataCetakBerdasar = $_POST['txtCetakBerdasar'];
$dataIdBukuDari = $_POST['txtIdBukuDari'];
$dataIdBukuSampai = $_POST['txtIdBukuSampai'];

if (empty($dataCetakBerdasar) || empty($dataIdBukuDari) || empty($dataIdBukuSampai)) {
    echo "<div class='alert alert-danger alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
            <strong><i class='fa fa-times'></i>&nbsp; Data Tidak Boleh Kosong </strong>
            </div>";
}else{

    $qry   = "SELECT isbn,idbuku FROM vw_tbuku WHERE idbuku >= ? AND idbuku <= ? AND noapk = $_SESSION[noapk] ORDER BY idbuku";
	$stmt  = mysqli_prepare($koneksidb,$qry) or die ("Gagal menyiapkan statement: " . mysqli_error($koneksidb));
	mysqli_stmt_bind_param($stmt,"ii",$dataIdBukuDari,$dataIdBukuSampai);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$dataIsbn,$dataIdbuku);

}
?>
<style>

.container {
    width: 30%;
    page-break-inside: avoid;
}

.cnt {
    display: flex;
    flex-wrap: wrap;
    max-width: 100%;
    }
</style>

<div class="cnt">

<?php
$i=1;
while (mysqli_stmt_fetch($stmt)) {
?>

<div class="container" style="margin-bottom: 20px;">
<p>ISBN : <?=$dataIsbn?></p>
<p class="nomor"><?=$dataIdbuku?></p>
</div>

<?php }
mysqli_stmt_close($stmt);
?>
</div>

<script src="https://unpkg.com/jsbarcode@latest/dist/JsBarcode.all.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

let nomor = document.querySelectorAll(".nomor");
let no = 1;

let id;
nomor.forEach(e => {
  id = "#barcode-" + no.toString();
  let no_nomor = e.textContent;
  no++;
  JsBarcode(id, no_nomor, {
    width: 1,
    height: 30,
    displayValue: true,
    fontSize: 12
  });

});

});
</script>