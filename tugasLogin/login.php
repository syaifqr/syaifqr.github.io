<?php
session_start();
require 'koneksi.php';

//cek ada cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['aman'])){
  $id = $_COOKIE['id'];
  $aman = $_COOKIE['aman'];

  $hasil = mysqli_query($koneksi, "SELECT username FROM user_login WHERE id = $id");
  $row = mysqli_fetch_assoc($hasil);

  if($aman === hash('md5', $row['username'])){
    $_SESSION['login'] = true;
  }
}

if (isset($_SESSION["login"])){
  header("Location: index.php");
  exit;
}


if (isset($_POST["login"])) {
  $username = $_POST["exampleInputUsername1"];
  $password = $_POST["exampleInputPassword1"];

  $result = mysqli_query($koneksi, "SELECT * FROM user_login WHERE username ='$username'");

  if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      //SESSION
      $_SESSION["login"] = true;

      //CEK COOKIE
      if(isset($_POST['exampleCheck1'])) {
        setcookie('id', $row['id'], time()+120);
        setcookie('aman', hash('md5', $row['username']), time()+120);
      } 

      header("Location: index.php");
      exit;
    }
  }
  $error = true;

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4"></div>
        <div class="col-4">
          <h1 style="text-align: center;">Halaman Login</h1><br>
          <?php if (isset($error)) : ?>
            <p style="color: red; font-style: italic;">Username/Password salah</p>
          <?php endif; ?>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="exampleInputUsername1" class="form-label">Username</label>
              <input type="text" class="form-control" id="exampleInputUsername1" name="exampleInputUsername1">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1" name="exampleCheck1">Ingat Saya</label>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Submit</button>
            <button type="" class="btn btn-success" name="register"><a href="registrasi.php" style="text-decoration: none; color: white;">Registrasi</a></button>
          </form>
        </div>
        <div class="col-4"></div>
      </div>
      
    </div>
    


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>