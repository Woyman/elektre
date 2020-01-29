<?php 
include('config/koneksi.php');

include('config/function.php');
include('admin/proses/electre.php');

$electre = new electre;
$electre->setKonek($konek);
$electre->setJenis($_POST['jenis']);
$m_X = $electre->matrixX();
$m_R = $electre->matrixR();
$m_V = $electre->matrixV($_POST['nilaiKriteria']);
$CD_DD = $electre->hitungCDdanDD($m_V);
$dominan_CCnDD = $electre->dominan_CDDD($CD_DD, $electre->getAllAlternatif());
$aggregat_dominan = $electre->aggregateDominan($dominan_CCnDD);
$rank = $electre->ranking($aggregat_dominan);
$kriterias = $m_X['kriteria'];
$alternatifs = $electre->getAllNameAlternatif();
$bobots = $_POST['nilaiKriteria'];
    // echo "<pre>";
    // print_r($CD_DD);
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

    <style>
        
        .table thead th{
            text-align: center;
            vertical-align: middle;
        }

        .table thead{
            background-color: #209334 ;
            color: white;
        }

        .table thead .kriteria{
            background-color: #1aab18;
            color: white;
        }
        th{
            text-align: center;
            vertical-align: middle;
        }
        tr{
            vertical-align: middle;
        }

    </style>

    <title><?php echo 'Hasil Perhitungan Elektre'; ?></title>
  </head>
  <body>
    
    <!-- <div class="container"> -->

   <?php include('navbar.php'); ?> 
      
    <div class="container"> 
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb" style="background-color: unset;">
                <li class="breadcrumb-item active" aria-current="page"><?php echo 'Hasil Perhitungan Elektre ';  ?></li>
            </ol>
        </nav>        

             
         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Keputusan (X)</b></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3"> 
                            <thead>
                                <?php $jmlKriteria = count($m_X['kriteria']); ?>
                                <tr valign="middle">
                                    <th rowspan="2" >Alternatif</th>
                                    <th colspan="<?= $jmlKriteria ?>">Kriteria</th>
                                </tr>
                                <tr class='kriteria'>
                                    <?php foreach($m_X['kriteria'] as $kriteria ){
                                        $namaKriteria = $kriteria['nama_kriteria'];
                                        echo "<th> $namaKriteria </th>";
                                    } ?>                               
                                </tr>
                            </thead>
                        <?php 
                            foreach($m_X['alternatif'] as $alt )
                            {
                        ?>
                            <tr>
                                <th><?= $alt['nama'] ?></th>
                                
                                <?php foreach($alt['nilai'] as $nilai ){                                    
                                    echo "<td> $nilai </td>";
                                }?>

                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
             </div>
         </div>   

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Bobot Kriteria</b></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3"> 
                            <thead>
                                <tr>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot Kriteria</th>
                                </tr>
                            </thead>
                                
                                <?php foreach($kriterias as $index => &$kk){ ?>

                                    <tr>
                                    <td> <?= $kk['nama_kriteria'] ?> </td> 
                                    <td> <?= $bobots[$index]; ?> </td> 
                                    </tr>

                                <?php } ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>   

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Normalisasi (R)</b></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3"> 
                            <thead>
                                <?php $jmlKriteria = count($m_X['kriteria']); ?>
                                <tr valign="middle">
                                    <th rowspan="2" >Alternatif</th>
                                    <th colspan="<?= $jmlKriteria ?>">Kriteria</th>
                                </tr>
                                <tr class="kriteria">
                                    <?php foreach($m_R['kriteria'] as $kriteria ){
                                        $namaKriteria = $kriteria['nama_kriteria'];
                                        echo "<th> $namaKriteria </th>";
                                    } ?>                               
                                </tr>
                            </thead>
                        <?php 
                            foreach($m_R['alternatif'] as $alt )
                            {
                        ?>
                            <tr>
                                <th><?= $alt['nama'] ?></th>
                                
                                <?php foreach($alt['nilai'] as $nilai ){                                    
                                    echo "<td> $nilai </td>";
                                }?>

                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
             </div>
         </div>   

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Normalisasi Terbobot (V)</b></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3"> 
                            <thead>    
                                <?php $jmlKriteria = count($m_V['kriteria']); ?>
                                <tr valign="middle">
                                    <th rowspan="2" >Alternatif</th>
                                    <th colspan="<?= $jmlKriteria ?>">Kriteria</th>
                                </tr>
                                <tr class="kriteria" >
                                    <?php foreach($m_R['kriteria'] as $kriteria ){
                                        $namaKriteria = $kriteria['nama_kriteria'];
                                        echo "<th> $namaKriteria </th>";
                                    } ?>                               
                                </tr>
                            </thead>
                        <?php 
                            foreach($m_V['alternatif'] as $alt )
                            {
                        ?>
                            <tr>
                                <th><?= $alt['nama'] ?></th>
                                
                                <?php foreach($alt['nilai'] as $nilai ){                                    
                                    echo "<td> $nilai </td>";
                                }?>

                            </tr>
                            <?php }?>
                        </table>
                    </div>
                </div>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Concordance</b></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3"> 
                        
                            <?php 
                                foreach($CD_DD as $index => &$baris)
                                {
                                    echo "<tr>";
                                        foreach($baris as $indexKlm => $kolom )
                                        {
                                            echo "<td>";
                                            if(is_array($kolom))
                                            {
                                                echo $kolom['nilaiCD'];
                                            }else{
                                                echo "--";
                                            }
                                            echo "</td>";
                                        }
                                    echo "</tr>";
                                }
                            ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Discordance</b></div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped mt-3"> 
                        
                            <?php 
                                foreach($CD_DD as $index => &$baris)
                                {
                                    echo "<tr>";
                                        foreach($baris as $indexKlm => $kolom )
                                        {
                                            echo "<td>";
                                            if(is_array($kolom))
                                            {
                                                echo $kolom['nilaiDD'];
                                            }else{
                                                echo "--";
                                            }
                                            echo "</td>";
                                        }
                                    echo "</tr>";
                                }
                            ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Concordance Dominan</b></div>
                    <div class="card-body">
                        <h6>Threshold: <?= $dominan_CCnDD['thresholdCD'] ?>  </h6>
                        <table class="table table-bordered table-striped mt-3"> 
                        
                            <?php 
                                foreach($dominan_CCnDD['cd'] as $index => &$baris)
                                {
                                    echo "<tr>";
                                        foreach($baris as $indexKlm => $kolom )
                                        {
                                            echo "<td>";
                                            if($index != $indexKlm)
                                            {
                                                echo $kolom;
                                            }else{
                                                echo "--";
                                            }
                                            echo "</td>";
                                        }
                                    echo "</tr>";
                                }
                            ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Discordance Dominan</b></div>
                    <div class="card-body">
                        <h6>Threshold: <?= $dominan_CCnDD['thresholdDD'] ?>  </h6>
                        <table class="table table-bordered table-striped mt-3"> 
                        
                            <?php 
                                foreach($dominan_CCnDD['dd'] as $index => &$baris)
                                {
                                    echo "<tr>";
                                        foreach($baris as $indexKlm => $kolom )
                                        {
                                            echo "<td>";
                                            if($index != $indexKlm)
                                            {
                                                echo $kolom;
                                            }else{
                                                echo "--";
                                            }
                                            echo "</td>";
                                        }
                                    echo "</tr>";
                                }
                            ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>         

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Matriks Agregat Dominan</b></div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-striped mt-3">                                                 
                            <thead>    
                                <?php $jmlKriteria = count($m_V['alternatif']); ?>
                                <tr valign="middle">
                                    <th colspan="<?= $jmlKriteria ?>" >Matriks Dominan</th>
                                    <th >Jumlah</th>
                                </tr>                            
                            </thead>
                            <?php 
                                foreach($aggregat_dominan as $index => &$baris)
                                {                                       
                                    echo "<tr>";                                                                               
                                        foreach($baris as $indexKlm => $kolom )
                                        { ?>                                                                                                                                
                                            <td <?php echo ($indexKlm == 'jml')? "style='border-left: 2px solid;' ": '';  ?> >
                                                    <?php echo $kolom;  ?>                                                   
                                            </td>
                                    <?php }
                                    echo "</tr>";
                                }
                            ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>
                    <div class='card-header'><b>Ranking</b></div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-striped mt-3">                                                 
                            <thead>    
                                <tr valign="middle">
                                    <th>No.</th>
                                    <th>Alternatif</th>
                                    <th>Total Dominan</th>
                                </tr>                            
                            </thead>
                            <?php 
                                foreach($rank as $index => &$baris)
                                {             
                                    $no = $index+1;                          
                                    $altRanking= $baris['nama_alternatif'];
                                    $jmlDom= $baris['jml'];
                                    echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>$altRanking</td>";
                                    echo "<td>$jmlDom</td>";
                                    echo "</tr>";
                                }
                            ?>

                        </table>
                    </div>
                </div>
             </div>
         </div>

         <div class="row mt-3">
             <div class="col-12">
                <div class='card'>

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