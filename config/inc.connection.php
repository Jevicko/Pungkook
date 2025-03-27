<?php
$myHost	= "localhost";
$myUser	= "root";
$myPass	= "";
$myDbs	= "jurnal_pemasukan";

# Konek ke Web Server Lokal
$koneksidb	= mysqli_connect($myHost,  $myUser,  $myPass, $myDbs);
if (! $koneksidb) {
  echo "Failed Connection !";
}

# Memilih database pd mysql Server
mysqli_select_db( $koneksidb, $myDbs) or die ("Database not Found !");
?>