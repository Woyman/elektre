<?php 
include('../config/session.php');
include('../config/function.php');
include('../config/koneksi.php');

$qGetDataAlternatifLeptop = mysqli_query($konek, "SELECT * FROM alternatif 
                                            LEFT JOIN merk ON alternatif.id_merk = merk.id_merk
                                            WHERE jns_produk='laptop' ");

$qGetDataAlternatifSmartphone = mysqli_query($konek, "SELECT * FROM alternatif 
                                            LEFT JOIN merk ON alternatif.id_merk = merk.id_merk
                                            WHERE jns_produk='smartphone' ");

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

    <title><?php echo ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

   <?php include('navbar.php'); ?> 
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst(getURL($_SERVER['REQUEST_URI'])); ?></li>                
            </ol>            
        </nav>


        <div class="row">

      

        <?php  if( isset($_GET['success']) && $_GET['success'] == '1' )
            { ?>
                
                <div class="alert alert-success animated fadeOut delay-4s" role="alert">
                    Data berhasil ditambahkan.
                </div>

        <?php }elseif(isset($_GET['success']) && $_GET['success'] == '2'){ ?>

                <div class="alert alert-success animated fadeOut delay-4s" role="alert">
                    Data berhasil diupdate.
                </div>

            <?php }elseif(isset($_GET['success']) && $_GET['success'] == '3'){ ?>

                <div class="alert alert-info animated fadeOut delay-4s" role="alert">
                    Data berhasil dihapus.
                </div>

            <?php   }elseif(isset($_GET['error']) && $_GET['error'] == '1'){?>

                <div class="alert alert-danger animated fadeOut delay-4s" role="alert">
                    ID alternatif tidak ditemukan.
                </div>

        <?php }?>

        <ul class="nav nav-tabs nav-fill col-12" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#laptop" role="tab" aria-controls="home" aria-selected="true">Laptop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#smartphone" role="tab" aria-controls="profile" aria-selected="false">Smartphone</a>
            </li>           
        </ul>
        <div class="tab-content col-12" id="myTabContent">
            <div class="tab-pane fade show active" id="laptop" role="tabpanel" aria-labelledby="home-tab">
                
                <div class="col-12 ">
                    <div class="float-right">
                        <a href="tambahalternatif.php?alternatif=laptop" class="btn btn-primary btn-sm my-3"> Tambah Alternatif Baru </a>
                    </div>
                </div>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#  </th>
                            <th scope="col">Merk</th>  
                            <th scope="col">Jenis Produk</th>
                            <th scope="col">Seri Produk</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php $n = 1; while($alt = mysqli_fetch_assoc($qGetDataAlternatifLeptop)){ ?>
                        <tr>
                            <th scope="row"><?= $n ?></th>
                            <td> <?= $alt['nama_merk'] ?> </td>                            
                            <td> <?= $alt['jns_produk'] ?> </td>                            
                            <td> <?= $alt['seri_produk'] ?> </td>    
                            <td> 
                                <a href="#" class="btn btn-warning btn-sm delete"  data-id='<?= $alt['id_alternatif'] ?>'>Hapus</a>
                                <a href="edit/alternatif?id=<?= $alt['id_alternatif'] ?>" class="btn btn-info btn-sm" >Update</a>
                                <a href="detail/alternatif.php?id=<?= $alt['id_alternatif'] ?>" class="btn btn-primary btn-sm" >View</a>
                            </td>                                    
                        </tr>
                    <?php $n++;  } ?>

                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="smartphone" role="tabpanel" aria-labelledby="profile-tab">
                
                <div class="col-12 ">
                    <div class="float-right">
                        <a href="tambahalternatif.php?alternatif=smartphone" class="btn btn-primary btn-sm my-3"> Tambah Alternatif Baru </a>
                    </div>
                </div>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Merk</th>  
                            <th scope="col">Jenis Produk</th>
                            <th scope="col">Seri Produk</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php $n = 1; while($alt = mysqli_fetch_assoc($qGetDataAlternatifSmartphone)){ ?>
                        <tr>
                            <th scope="row"><?= $n ?></th>
                            <td> <?= $alt['nama_merk'] ?> </td>                            
                            <td> <?= $alt['jns_produk'] ?> </td>                            
                            <td> <?= $alt['seri_produk'] ?> </td>    
                            <td> 
                                <a href="#" class="btn btn-warning btn-sm delete" data-id='<?= $alt['id_alternatif'] ?>' >Hapus</a>
                                <a href="edit/alternatif?id=<?= $alt['id_alternatif'] ?>" class="btn btn-info btn-sm" >Update</a>
                                <a href="detail/alternatif.php?id=<?= $alt['id_alternatif'] ?>" class="btn btn-primary btn-sm" >View</a>
                            </td>                                    
                        </tr>
                    <?php $n++; } ?>

                    </tbody>
                </table>

              

            </div>            
        </div>
            
        </div>


    </div>


  
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>

$( document ).ready(function() {
    
    $('.delete').click(function(){

      if(confirm('Anda yakin ingin menghapus alternatif ini?'))
      {
          var id = $(this).attr('data-id');
          window.location = "proses/alternatif.php?action=delete&id="+id;
      }

    });

});

    </script>
  </body>
</html>