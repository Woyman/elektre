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
elseif(isset($_POST['action']) && $_POST['action'] == 'update')
{
    $idAlternatif = $_POST['id_alternatif'];
    $desc = $_POST['deskripsi'];
    $seri = $_POST['seri'];
    $jns_produk = $_POST['jns_produk'];
    $id_merk = $_POST['merk'];

    $qGetAlternatif = mysqli_query($konek,"SELECT * FROM alternatif WHERE id_alternatif='$idAlternatif' ");
    $alt = mysqli_fetch_assoc($qGetAlternatif);

    if(isset($_FILES['gambar']))
    {
        $foto = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        unlink('../input/gambar/'.$alt['foto']);
    }else{
        $foto = $alt['foto'];
    }
        

    $query = "UPDATE alternatif SET id_merk='$id_merk',
                                    seri_produk='$seri',
                                    jns_produk='$jns_produk',
                                    deskripsi='$desc', 
                                    foto='$foto' WHERE id_alternatif='$idAlternatif' ";

    $insert = mysqli_query($konek, $query) or die(mysqli_error($konek));

    if($insert) 
    {

        if(isset($_FILES['gambar'])) move_uploaded_file($file_tmp, '../input/gambar/'.$foto);

    }else{
        mysqli_error($konek);
    }    
    header("Location: ../alternatif.php?success=2");  

}
elseif(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    $idAlternatif = $_GET['id'];
    $deleteAlternatif = mysqli_query($konek, "DELETE FROM alternatif WHERE id_alternatif='$idAlternatif' ");

    header("Location: ../alternatif.php?success=3");  
}


?>