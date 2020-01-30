<?php 

include('config/koneksi.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Laptop</title>
  </head>
  <body>
    
    <!-- <div class="container"> -->
    <?php include('navbar.php'); ?>       
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item active" aria-current="page">Laptop</li>
            </ol>
        </nav>

        <div class="row"> 
            <div class="col-12">

                <div class="row">

                <?php 
                    $q = "SELECT * FROM alternatif LEFT JOIN merk ON alternatif.id_merk = merk.id_merk WHERE jns_produk='smartphone' ";
                    $getLaptop = mysqli_query($konek, $q);
                    while($laptop = mysqli_fetch_assoc($getLaptop) ){
                ?>
                    <div class="col-3 pb-4">
                        <div class="card">
                            <img class="card-img-top" src="admin/input/gambar/<?= $laptop['foto'] ?>" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title"><?= $laptop['nama_merk'].' '.$laptop['seri_produk'] ?></h5>                        
                            <a href="detail.php?j=smartphone&id=<?= $laptop['id_alternatif'] ?>" class="btn btn-primary">Lihat</a>
                            </div>
                        </div>
                    </div>

                <?php }  ?>

                </div>

            </div>
        </div>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>