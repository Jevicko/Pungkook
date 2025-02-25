<?php
$dataHarian = isset($_SESSION['dataHarian']) ? $_SESSION['dataHarian'] : "";
$dataBulan = isset($_SESSION['dataBulan']) ? $_SESSION['dataBulan'] : "";
$dataTahun = isset($_SESSION['dataTahun']) ? $_SESSION['dataTahun'] : "";
$dataDariTanggal = isset($_SESSION['dataDariTanggal']) ? $_SESSION['dataDariTanggal'] : "";
$dataSampaiTanggal = isset($_SESSION['dataSampaiTanggal']) ? $_SESSION['dataSampaiTanggal'] : "";
$tampil = isset($_SESSION['tampil']) ? $_SESSION['tampil'] : "";
$dataAnggota            = (isset($_SESSION['dataAnggota'])) ? $_SESSION['dataAnggota'] : "";
$dataBuku               = (isset($_SESSION['dataBuku'])) ? $_SESSION['dataBuku'] : "";
$dataJnskelamin         = (isset($_SESSION['dataJnskelamin'])) ? $_SESSION['dataJnskelamin'] : "";
$dataCakupan               = (isset($_SESSION['dataCakupan'])) ? $_SESSION['dataCakupan'] : "";
$dataKelas               = (isset($_SESSION['dataKelas'])) ? $_SESSION['dataKelas'] : "";
$dataPilihan               = (isset($_SESSION['dataPilihan'])) ? $_SESSION['dataPilihan'] : "";


$aColumns = array('idbuku', 'judul', 'tglpinjam', 'tglhrskembali');
$sTable = "(SELECT a.noapk, a.idjnsbuku AS idjnsbuku, a.idbuku AS idbuku, a.judul AS judul, b.tglpinjam AS tglpinjam, b.tglhrskembali AS tglhrskembali, c.idjnsang AS idjnsang, c.jnskel AS jnskel, c.idkelas AS idkelas
FROM tbuku a JOIN tpinbuku b ON a.idbuku = b.idbuku JOIN ranggota c ON b.nipnis = c.nipnis) AS tpinbuku";
$sIndexColumn = "idbuku";

if ($dataHarian != "" && $dataPilihan == "harian") {
    $sWhereDefault = " WHERE tglpinjam = '" . $dataHarian . "' ";

} elseif ($dataBulan != "" && $dataTahun != "" && $dataPilihan == "bulanan") {
    $sWhereDefault = " WHERE MONTH(tglpinjam) = '" . $dataBulan . "' AND YEAR(tglpinjam) = '" . $dataTahun . "' ";

} elseif ($dataDariTanggal != "" && $dataSampaiTanggal != "" && $dataPilihan == "custom") {
    $sWhereDefault = " WHERE tglpinjam >= '" . $dataDariTanggal . "' AND tglpinjam <= '" . $dataSampaiTanggal . "' ";

}

if($dataAnggota=="Siswa"){
    $sWhereDefault .= " AND idjnsang = 1 ";

}else if($dataAnggota=="Guru/Karyawan"){
    $sWhereDefault .= " AND idjnsang = 2 ";

}

if ($dataJnskelamin=="Laki-laki") {
    $sWhereDefault .= " AND jnskel = 'L' ";

}else if ($dataJnskelamin=="Perempuan") {
    $sWhereDefault .= " AND jnskel = 'P' ";
    
}

if ($dataCakupan == "Per Kelas") {
    $sWhereDefault .= " AND idkelas = '$dataKelas' ";

}

$sWhereDefault .= "AND idjnsbuku = 4";
$sWhereDefault .= " AND noapk = $_SESSION[noapk] ";

$gaSql['link'] = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password']) or die('Could not open connection to server');
mysqli_select_db($gaSql['link'], $gaSql['db']) or die('Could not select database ' . $gaSql['db']);

$sLimit = "";
if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
    $sLimit = "LIMIT " . mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayStart']) . ", " .
        mysqli_real_escape_string($gaSql['link'], $_GET['iDisplayLength']);
}

if (isset($_GET['iSortCol_0'])) {
    $sOrder = "ORDER BY ";
    $sortingCols = intval($_GET['iSortingCols']); 
    for ($i = 0; $i < $sortingCols; $i++) {
        $sortableColumnIndex = intval($_GET['iSortCol_' . $i]);
        
        $actualColumnIndex = $sortableColumnIndex - 1;

        if ($actualColumnIndex>=0) {
            $sOrder .= $aColumns[$actualColumnIndex] . " " . mysqli_real_escape_string($gaSql['link'], $_GET['sSortDir_' . $i]) . ", ";
        }else{
            $sOrder = "";
        }
    }

    $sOrder = rtrim($sOrder, ", ");
}

$sWhere = $sWhereDefault;
if ($_GET['sSearch'] != "") {
    $sWhere .= " and (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch']) . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
}

for ($i = 0; $i < count($aColumns); $i++) {
    if ($_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
        if ($sWhere == "") {
            $sWhere .= " and ";
        } else {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
    }
}

$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " FROM   
    $sTable
    $sWhere 
    $sOrder
    $sLimit
    ";

$rResult = mysqli_query($gaSql['link'], $sQuery) or die(mysqli_error($gaSql['link']));

$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($gaSql['link'], $sQuery) or die(mysqli_error($gaSql['link']));
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

$sQuery = "SELECT COUNT($sIndexColumn) FROM  $sTable $sWhereDefault";
$rResultTotal = mysqli_query($gaSql['link'], $sQuery) or die(mysqli_error($gaSql['link']));
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];

$output = array(
    "sEcho" => intval($_GET['sEcho']),
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

$no = $_GET['iDisplayStart'] + 1;
while ($dataRow = mysqli_fetch_array($rResult)) {

        $idbuku = $dataRow['idbuku'];
        $judul = $dataRow['judul'];
        $tglpinjam = $dataRow['tglpinjam'];
        $tglhrskembali = $dataRow['tglhrskembali'];

            $row = array($no, $idbuku, $judul ,$tglpinjam, $tglhrskembali);
        
        $no++;
        $output['aaData'][] = $row;
    
}

echo json_encode($output);
?>
