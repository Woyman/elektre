<?php 

include('../../config/koneksi.php');

if(isset($_POST['action']) && $_POST['action'] == 'input' )
{
    $nama_merk = $_POST['merk'];
    $insertMerk = mysqli_query($konek, "INSERT INTO merk (nama_merk) VALUES ('$nama_merk') ");


    // mysqli_error($konek);
    header("Location: ../merk.php?success=1");  
}
elseif(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $id_merk = $_GET['id'];
    $deleteMerk = mysqli_query($konek, "DELETE FROM merk WHERE id_merk='$id_merk' ");

    header("Location: ../merk.php?success=2");  
}

?>