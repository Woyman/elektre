<?php 
include('../config/session.php');
include('../config/function.php');
include('../config/koneksi.php');

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

    <title><?php echo 'Kriteria '.ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

   <?php include('navbar.php'); ?> 
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item active" aria-current="page"><?php echo 'Kriteria '.ucfirst(getURL($_SERVER['REQUEST_URI']))  ?></li>
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
                                <th scope="col">Nama Kriteria Smartphone</th>  
                                <th></th>                      
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no=1;
                        while($kriteria = mysqli_fetch_assoc($qGetDataKriteria)){ ?>

                            <tr>
                                <th scope="row"><?php echo $no; ?></th>
                                <td><?php echo $kriteria['nama_kriteria'] ?></td>                            
                                <td> 
                                    <a href="#" data-id="<?php echo $kriteria['id_k_smartphone'] ?>" class="btn btn-warning btn-sm delete "> Hapus </a>
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
                        Tambah Kriteria disini                        
                    </div>
                    <div class="card-body">
                        <form action="proses/kriteria.php" method="POST">
                            <input type="hidden" value="input" name="action">
                            <input type="hidden" value="smartphone" name="jenis">
                            <div class="form-group">
                                <label for="nama_kriteria">Nama Kriteria Smartphone</label>
                                <input type="text" name="nama_kriteria" class="form-control" id="nama_kriteria">                                
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
    <script>

$( document ).ready(function() {
    
    $('.delete').click(function(){

      if(confirm('Anda yakin ingin menghapus kriteria ini?'))
      {
          var id = $(this).attr('data-id');
        //   alert(id);
         window.location = "proses/kriteria.php?action=delete&jenis=smartphone&id="+id;
      }

    });

});

    </script>
  </body>
</html>