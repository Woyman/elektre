<?php 
include('../config/koneksi.php');
include('proses/electre.php');

$electre = new electre;
$electre->setKonek($konek);
$electre->setJenis($_POST['jenis']);
$m_X = $electre->matrixX();
$m_R = $electre->matrixR();
$m_V = $electre->matrixV($_POST['nilaiKriteria']);
$CD_DD = $electre->hitungCDdanDD($m_V);

echo "<pre>";
// print_r($_POST);

// echo "Matriks X";
// print_r($m_X);
// echo "Matriks R";
print_r($m_V);
// echo "Matriks V";
// print_r($CD_DD);



?>