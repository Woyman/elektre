<?php 
include('../../config/session.php');
include('../../config/function.php');
include('../../config/koneksi.php');

if(!isset($_GET['id'])) header('Location: ../alternatif.php?error=1');

$idAlternatif = $_GET['id'];
$q = "SELECT * FROM alternatif WHERE id_alternatif = '$idAlternatif' ";


$qGetDataMerk = mysqli_query($konek, "SELECT * FROM merk");

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

    <title><?php echo ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

   <?php include('../navbar.php'); ?> 
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item" aria-current="page">Alternatif</li>                
                <li class="breadcrumb-item active" aria-current="page">Update Alternatif</li>                
            </ol>            
        </nav>

    <form action="../proses/alternatif.php" method="post" enctype="multipart/form-data"> 
        <div class="row">
            <div class="col-6">
            <h4 class="pb-3">Update Alternatif  </h4>
                
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id_alternatif" value="<?= $alt['id_alternatif'] ?>">
                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <select class="form-control" name="merk" Required> 
                            <option value=""> --merk </option>
                            <?php while($merk = mysqli_fetch_assoc($qGetDataMerk) ){ ?>
                                <option value="<?php echo $merk['id_merk'] ?>" <?php echo ($merk['id_merk'] == $alt['id_merk'])? 'selected': ''; ?> > <?php echo $merk['nama_merk'] ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jns_produk">Jenis Produk</label>
                        <select class="form-control" name="jns_produk" id="jns_produk" Required> 
                            <option value=""> --jenis produk </option>
                            <option value="laptop" <?php echo ($alt['jns_produk'] == 'laptop')? 'selected': ''; ?>> Laptop</option>
                            <option value="smartphone" <?php echo ($alt['jns_produk'] == 'smartphone')? 'selected': ''; ?> > Smartphone</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="seri">Seri Produk</label>
                        <input type="text" name="seri" class="form-control" id="seri" value="<?= $alt['seri_produk'] ?>" Required>                                
                    </div>

                    <div class="form-group row">
                        <div class="col-6">
                            <label for="gambar">Ganti Foto/Gambar</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" >                                
                        </div>
                        <div class="col-6">
                            <label for="gambar">Foto/Gambar yang dipakai</label>
                            <img class="img-fluid" src="../input/gambar/<?= $alt['foto'] ?>" style="max-width: 75%;" >
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="merk">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="desc" rows="5" Required> <?= $alt['deskripsi'] ?> </textarea>
                    </div>

                    <div class="form-group">
                       <button class="btn btn-primary col-3">Input</button>
                    </div>
                
            </div>                

            <div class="col-6">
            <h4 class="pb-3">Nilai Kriteria.</h4>                                                         
                
                <?php 
                    if($alt['jns_produk'] == 'laptop')
                    {
                        $table = 'kriteria_laptop';
                        $tableNilai = 'nilai_kriteria_laptop';
                    }else{
                        $table = 'kriteria_smartphone';
                        $tableNilai = 'nilai_kriteria_smartphone';
                    }
                    
                    $getKriteria = mysqli_query($konek, "SELECT * FROM $table");
                                                                           
                while($k = mysqli_fetch_row($getKriteria)){
                    $id_kriteria = $k[0];
                    $qGetNilai = mysqli_query($konek,"SELECT * FROM $tableNilai WHERE id_alternatif='$idAlternatif' AND id_kriteria = '$id_kriteria' ");
                    $nilai = mysqli_fetch_assoc($qGetNilai);
                ?>
                    <div class="form-group">
                    <input type="hidden" name="id_kriteria[]" value="<?= $k[0] ?>">
                    <input type="hidden" name="id_nilai[]" value="<?= $nilai['id_nilai'] ?>">
                        <label for="k_<?= $k[0] ?>"><?= $k[1] ?></label>
                        <input type="number" max='5' min='1' name="bobot[]" class="form-control" value="<?= $nilai['nilai'] ?>" id="k_<?= $k[0] ?>" Required >                                
                    </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    </form>

    </div>


  
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../../plugin/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('desc');
    </Script>

  </body>
</html>