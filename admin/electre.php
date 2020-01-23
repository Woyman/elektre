<?php 
include('../config/koneksi.php');
include('../config/session.php');
include('../config/function.php');
include('proses/electre.php');
$electre = new electre;
$electre->setJenis('laptop');
$electre->setKonek($konek);
$qGetDataKriteria = mysqli_query($konek, "SELECT * FROM kriteria_smartphone");

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

    <title><?php echo 'Perhitungan '.ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

   <?php include('navbar.php'); ?> 
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item active" aria-current="page"><?php echo 'Perhitungan '.ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></li>
            </ol>
        </nav>        

        <?php                               
          $m_X = $electre->matrixX();      
        ?>

      <div class="col-6">
        <div class="card"> 
          <div class="card-header">
            Matrix Keputusan (X)
          </div>
          <div class="card-body">  
            <table class="table "> 
              <tr>
                <th>Alternatif</th>
                <?php foreach($m_X['kriteria'] as $kriteria ){ ?>
                  <th> <?= $kriteria['nama_kriteria']; ?> </th>
                <?php } ?>
              </tr>

              <tbody>
                <?php foreach($m_X['alternatif'] as $alt ){ ?>
                  <tr>
                    <td><?= $alt['nama'] ?></td>
                    <?php foreach($alt['nilai'] as $nilai ){ ?>
                      <td><?= $nilai ?></td>
                    <?php } ?>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          <div>
        </div>
      <div>


    </div>


  
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>