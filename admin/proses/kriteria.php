<?php 

include('../../config/koneksi.php');

if(isset($_POST['action']) && $_POST['action'] == 'input' )
{
    $nama_kriteria = $_POST['nama_kriteria'];

    if($_POST['jenis'] == 'laptop' )
    {
        $table = 'kriteria_laptop';
        $header = 'Location: ../laptop.php?success=1';

    }else{
        $table = 'kriteria_smartphone';
        $header = 'Location: ../smartphone.php?success=1';
    }

    $q = "INSERT INTO $table (nama_kriteria) VALUES ('$nama_kriteria') ";

    $insertKriteria = mysqli_query($konek, $q);

    // mysqli_error($konek);    
    header($header);  
}
elseif(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $kriteria = $_GET['id'];

    if($_GET['jenis'] == 'laptop' )
    {
        $table = 'kriteria_laptop';
        $header = 'Location: ../laptop.php?success=2';
        $id_table = "id_k_laptop";
    }else{
        $table = 'kriteria_smartphone';
        $header = 'Location: ../smartphone.php?success=2';
        $id_table = "id_k_smartphone";
    }
    $q = "DELETE FROM $table WHERE $id_table='$kriteria' ";
    $deleteMerk = mysqli_query($konek, $q);

    header($header);  
}

?>