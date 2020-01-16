   <nav class="navbar navbar-expand-lg navbar-dark" style="background: #1aab18" >
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="images/logo_wymn.png" width="33" height="33" class="d-inline-block align-top" alt="">
            Logo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'index' )? 'active': '';  ?> ">
                <a class="nav-link" href="#">Dashboard </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Kriteria
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Laptop</a>
                  <a class="dropdown-item" href="#">Smarthphone</a>                
                </div>
              </li>              
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'alternatif' )? 'active': '';  ?> ">
                <a class="nav-link" href="alternatif.php">Alternatif </a>
              </li>
              <li class="nav-item <?php echo (getURL($_SERVER['REQUEST_URI']) == 'merk' )? 'active': '';  ?> ">
                <a class="nav-link" href="merk.php">Merk </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>