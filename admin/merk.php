<?php 
include('../config/session.php');
include('../config/function.php');
include('../config/koneksi.php');

$qGetDataMerk = mysqli_query($konek, "SELECT * FROM merk");

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
                <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></li>
            </ol>
        </nav>

        <?php 
            if( isset($_GET['success']) && $_GET['success'] == '1' )
            { ?>
                
                <div class="alert alert-success animated fadeOut delay-4s" role="alert">
                    Data berhasil ditambahkan.
                </div>

        <?php }elseif(isset($_GET['success']) && $_GET['success'] == '2'){ ?>

                <div class="alert alert-info animated fadeOut delay-4s" role="alert">
                    Data berhasil dihapus.
                </div>
        <?php } ?>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Merk</th>  
                                <th></th>                      
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no=1;
                        while($merk = mysqli_fetch_assoc($qGetDataMerk)){ ?>

                            <tr>
                                <th scope="row"><?php echo $no; ?></th>
                                <td><?php echo $merk['nama_merk'] ?></td>                            
                                <td> 
                                    <a href="proses/merk.php?action=delete&id=<?php echo $merk['id_merk'] ?>" class="btn btn-warning btn-sm"> Hapus </a>
                                </td>
                            </tr>

                        <?php $no++;  } ?>
                        </tbody>
                    </table>
                </div>
            </div> 

            <div class="col-6">
                <div class="card">
                    <div class="card-header text-white" style="background: #1aab18">
                        Tambah Merk disini                        
                    </div>
                    <div class="card-body">
                        <form action="proses/merk.php" method="POST">
                            <input type="hidden" value="input" name="action">
                            <div class="form-group">
                                <label for="merk">Nama Merk</label>
                                <input type="text" name="merk" class="form-control" id="merk">                                
                            </div>
                            
                            <div class="form-group">                                
                                    <button type="submit" class="btn btn-primary col-12">Input</button>                                
                            </div>
                        </form>
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