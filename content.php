<?php
 
$pg=$_GET['content'];
if($pg=="home"){ include "content/home_administrator.php"; } 
// DATABASE
	//Tabel
		// elseif($pg=="tabel"){ include "content/database/tabel_vw.php"; }

//KONFIGURASI
		elseif($pg=="konfigurasiphoto"){ include "content/konfigurasi/photo/konfigurasiphoto_ubah.php"; }
		elseif($pg=="konfigurasipassword"){ include "content/konfigurasi/password/konfigurasipassword_ubah.php"; }
		elseif($pg=="konfigurasiprofil"){ include "content/konfigurasi/profil/konfigurasiprofil_ubah.php"; }



//iNCOMING GOODS
elseif($pg=="incoming_source"){ include "content/incoming_goods/incoming_source.php"; }
elseif($pg=="incoming_view"){ include "content/incoming_goods/incoming_view.php"; }

//general journal
elseif($pg=="journal_source"){ include "content/general_journal/journal_source.php"; }
elseif($pg=="journal_view"){ include "content/general_journal/journal_view.php"; }
elseif($pg=="general_journal"){ include "journal/General_Journal.php"; }