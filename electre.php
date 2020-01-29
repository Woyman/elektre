<?php 
include('config/koneksi.php');

include('config/function.php');
include('admin/proses/electre.php');

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

        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Laptop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Smartphone</a>
          </li>        
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php 
              $electre = new electre;
              $electre->setKonek($konek);
              $electre->setJenis('laptop');
              $m_X = $electre->matrixX();      
              $Allkriteria = $electre->getAllNameKriteria();
            ?>
            <div class="row">
              
              <div class="col-6 mt-3">
                  <h4>Nilai Bobot</h4>     
                  <p>Masukkan nilai bobot tiap kriteria untuk perhitungan electre</p>
                  <form action="hitung_electre.php" method="post">
                    <input type="hidden" value="laptop" name="jenis" >
                    <?php  
                      foreach($Allkriteria as $kri )
                      {
                    ?>
                      <div class="form-group">
                        <label for="idK<?= $kri['id_k_laptop'] ?>"><?= $kri['nama_kriteria'] ?></label>
                          <input type="hidden" name="id_kriteria[]" value="<?= $kri['id_k_laptop'] ?>" required>                          
                          <input type="number" min='1' max='5' name="nilaiKriteria[]" id="idK<?= $kri['id_k_laptop'] ?>" class="form-control">  
                      </div>
                    <?php 
                      }
                    ?>

                      <div class="form-group">
                        <button class="btn btn-primary">Hitung</button>
                      </div>
                  </form>
                  <pre>
                  
              </div>
            </div>
                                  
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <?php 
              $smartphone = new electre;
              $smartphone->setKonek($konek);
              $smartphone->setJenis('smartphone');
              $m_XSmarphone = $smartphone->matrixX();      
              $Allkriteria = $smartphone->getAllNameKriteria();
            ?>
            <div class="row">
              
              <div class="col-6 mt-3">
                  <h4>Nilai Bobot</h4>     
                  <p>Masukkan nilai bobot tiap kriteria untuk perhitungan electre</p>
                  <form action="hitung_electre.php" method="post">
                    <input type="hidden" value="smartphone" name="jenis" >
                    <?php  
                      foreach($Allkriteria as $kri )
                      {
                    ?>
                      <div class="form-group">
                        <label for="idK<?= $kri['id_k_smartphone'] ?>"><?= $kri['nama_kriteria'] ?></label>
                          <input type="hidden" name="id_kriteria[]" value="<?= $kri['id_k_smartphone'] ?>" required>                          
                          <input type="number" min='1' max='5' name="nilaiKriteria[]" id="idK<?= $kri['id_k_smartphone'] ?>" class="form-control">  
                      </div>
                    <?php 
                      }
                    ?>

                      <div class="form-group">
                        <button class="btn btn-primary">Hitung</button>
                      </div>
                  </form>
                  <pre>
                  
              </div>
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