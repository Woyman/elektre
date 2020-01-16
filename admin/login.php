<?php 

include('../config/koneksi.php');


ob_start();
session_start();

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $q = mysqli_query($konek, "SELECT  * FROM admin WHERE username='$username' AND password='$password' ");

    $cek = mysqli_num_rows($q);

    if($cek > 0)
    {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        header("location:index.php");
    }else{
        header("location:../login.php?error=1");
    }
    
}else{
    header("location:../login.php?error=0");
}


// print_r($_POST);



?>