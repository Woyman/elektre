<?php 
ob_start();
include('../../config/koneksi.php');
include('../../config/function.php');

if(isset($_POST['action']) && $_POST['action'] == 'input' )
{
    $desc = $_POST['deskripsi'];
    $seri = $_POST['seri'];
    $jns_produk = $_POST['jns_produk'];
    $id_merk = $_POST['merk'];
    $id_kriteria = $_POST['id_kriteria'];
    $bobot = $_POST['bobot'];

    $foto = $_FILES['gambar']['name'];
    $file_tmp = $_FILES['gambar']['tmp_name'];
    
    if($jns_produk == 'laptop') { $table = "nilai_kriteria_laptop"; }
    else{ $table = "nilai_kriteria_smartphone"; }

    $query = "INSERT INTO alternatif(id_merk, jns_produk, seri_produk, foto, deskripsi)
                 VALUES('$id_merk', '$jns_produk', '$seri', '$foto', '$desc')";

    $insert = mysqli_query($konek, $query) or die(mysqli_error($konek));

    $alternatif = mysqli_query($konek, "SELECT id_alternatif FROM alternatif ORDER BY id_alternatif DESC limit 1");
    $alt = mysqli_fetch_assoc($alternatif); $lastIdAlternatif = $alt['id_alternatif'];    

    foreach($id_kriteria as $index=>$id )    
    {   $nilai = $bobot[$index];
        $qInsertNilai =  "INSERT INTO $table(id_kriteria, id_alternatif, nilai) VALUES('$id', '$lastIdAlternatif','$nilai')";
        mysqli_query($konek, $qInsertNilai);
    }

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
    $bobot = $_POST['bobot'];
    $id_nilai = $_POST['id_nilai'];

    if($jns_produk == 'laptop') { $table = "nilai_kriteria_laptop"; }
    else{ $table = "nilai_kriteria_smartphone"; }

    $qGetAlternatif = mysqli_query($konek,"SELECT * FROM alternatif WHERE id_alternatif='$idAlternatif' ");
    $alt = mysqli_fetch_assoc($qGetAlternatif);

    // echo "<pre>";
    // print_r($_FILES);


    if(!empty($_FILES['gambar']['name']))
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

    foreach($id_nilai as $index=>$id )    
    {   $nilai = $bobot[$index];
        $qInsertNilai =  "UPDATE $table SET nilai='$nilai' WHERE id_nilai = '$id' ";
        mysqli_query($konek, $qInsertNilai);
    }

    if($insert) 
    {

        if(!empty($_FILES['gambar']['name'])) move_uploaded_file($file_tmp, '../input/gambar/'.$foto);

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