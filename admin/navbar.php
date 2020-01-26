   <nav class="navbar navbar-expand-lg navbar-dark" style="background: #1aab18" >
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="images/logo_wymn.png" width="33" height="33" class="d-inline-block align-top" alt="">
            Logo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'index' )? 'active': '';  ?> ">
                <a class="nav-link" href="<?= base_url(); ?>index.php">Dashboard </a>
              </li>
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'merk' )? 'active': '';  ?> ">
                <a class="nav-link" href="<?= base_url(); ?>merk.php">Merk </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Kriteria
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?= base_url(); ?>laptop.php">Laptop</a>
                  <a class="dropdown-item" href="<?= base_url(); ?>smartphone.php">Smarthphone</a>                
                </div>
              </li>              
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'alternatif' )? 'active': '';  ?> ">
                <a class="nav-link" href="<?= base_url(true,'','', 'admin/'); ?>alternatif.php">Alternatif </a>
              </li>
              
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'electre' )? 'active': '';  ?> ">
                <a class="nav-link" href="<?= base_url(); ?>electre.php">Perhitungan </a>
              </li>
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'electre' )? 'active': '';  ?> ">
                <a class="nav-link" href="<?= base_url(); ?>logout.php">Logout </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>