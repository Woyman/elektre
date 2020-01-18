<?php 

include('../../config/koneksi.php');
include('../../config/function.php');

if(isset($_POST['action']) && $_POST['action'] == 'input' )
{
    $desc = $_POST['deskripsi'];
    $seri = $_POST['seri'];
    $jns_produk = $_POST['jns_produk'];
    $id_merk = $_POST['merk'];

    $foto = $_FILES['gambar']['name'];
    $file_tmp = $_FILES['gambar']['tmp_name'];

    $query = "INSERT INTO alternatif(id_merk, jns_produk, seri_produk, foto, deskripsi)
                VALUES('$id_merk', '$jns_produk', '$seri', '$foto', '$desc')";

    $insert = mysqli_query($konek, $query) or die(mysqli_error($konek));

    if($insert) 
    {
        move_uploaded_file($file_tmp, '../input/gambar/'.$foto);
    }else{
        mysqli_error($konek);
    }    
    header("Location: ../alternatif.php?success=1");  
}
elseif(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $id_merk = $_GET['id'];
    $deleteMerk = mysqli_query($konek, "DELETE FROM merk WHERE id_merk='$id_merk' ");

    header("Location: ../merk.php?success=2");  
}

?>