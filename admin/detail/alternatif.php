<?php 
include('../../config/session.php');
include('../../config/function.php');
include('../../config/koneksi.php');

if(!isset($_GET['id'])) header('Location: ../alternatif.php?error=1');


$idAlternatif = $_GET['id'];
$q = "SELECT * FROM alternatif JOIN merk ON alternatif.id_merk = merk.id_merk WHERE id_alternatif = '$idAlternatif' ";
$qGetDataAlt = mysqli_query($konek, $q);
$alt = mysqli_fetch_assoc($qGetDataAlt);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"> 

    <title>Detail <?php echo ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

   <?php include('../navbar.php'); ?> 
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item" aria-current="page">Alternatif</li>                
                <li class="breadcrumb-item active" aria-current="page">Detail Alternatif </li>                
            </ol>            
        </nav>


        <div class="row">
            <div class="col-8 offset-2">
                
                <img class="card-img-top" src="../input/gambar/<?= $alt['foto'] ?>" style="max-width: 30%;" >
                    <table class="p-2">
                        <tr  style="border-bottom: 1px solid #ebebeb; ">
                            <td class="py-2" style="width: 150px;">Merk</td>
                            <td><?= $alt['nama_merk'] ?></td>
                        </tr>
                        <tr  style="border-bottom: 1px solid #ebebeb; ">
                            <td class="py-2" style="width: 150px;">Jenis Produk</td>
                            <td><?= ucfirst($alt['jns_produk']) ?></td>
                        </tr>
                        <tr  style="border-bottom: 1px solid #ebebeb; ">
                            <td class="py-2" style="width: 150px;">Seri Produk</td>
                            <td><?= ucfirst($alt['seri_produk']) ?></td>
                        </tr>
                        <tr  style="border-bottom: 1px solid #ebebeb; ">
                            <td class="py-2" style="width: 150px; " valign="top">Detail</td>
                            <td><?= $alt['deskripsi'] ?></td>
                        </tr>
                        
                    </table>

            </div>                
        </div>


    </div>


  
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>