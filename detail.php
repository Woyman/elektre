<?php 
include('config/koneksi.php');
$id = $_GET['id'];
$jenis = $_GET['j'];
$q = "SELECT * FROM alternatif LEFT JOIN merk ON alternatif.id_merk = merk.id_merk WHERE id_alternatif = '$id' AND jns_produk ='$jenis'  ";
$getAlternatif = mysqli_query($konek, $q);
$alt = mysqli_fetch_assoc($getAlternatif);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Detail</title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

    <?php include('navbar.php'); ?>     
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item active" aria-current="page">Smartphone</li>
                <li class="breadcrumb-item active" aria-current="page">Samsung A50</li>
            </ol>
        </nav>

        <div class="row"> 
            <div class="col-12">
                    
                <div class="card">
                    <img class="rounded  mx-auto " src="admin/input/gambar/<?php echo $alt['foto'] ?>" style="max-width: 45%;" >
                    <div class="card-body">
                    <h5 class="card-title text-center"><?php echo $alt['nama_merk'].' '.$alt['seri_produk'] ?></h5>                                            
                    <table class="p-2 col-6 mx-auto">
                        <tr  style="border-bottom: 1px solid #ebebeb; vertical-align:top; ">
                            <td class="py-2" style="width: 120px;">Deskripsi :</td>                            
                        </tr>                       
                        <tr>
                            
                            <td><?php echo $alt['deskripsi'] ?></td>
                            
                        </tr>
                    </table>

                    </div>
                </div>                                
            </div>
        </div>

    </div>


  
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>