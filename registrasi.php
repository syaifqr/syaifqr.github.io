<?php
require 'koneksi.php';

function registrasi($data){
	global $koneksi;
	$username = strtolower($data["exampleInputUsername1"]);
	$password = mysqli_real_escape_string($koneksi, $data["exampleInputPassword1"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["exampleInputConfirmPassword1"]);

	$result = mysqli_query($koneksi, "SELECT username FROM user_login WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)){
		echo "<script>
			alert('Username sudah terdaftar');
		</script>";
		return false;
	}

	if ($password !== $password2){
		echo "<script>
			alert('Konfirmasi password tidak sesuai');
		</script>";
		return false;
	}
	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($koneksi, "INSERT INTO user_login VALUES('', '$username', '$password')");
	return mysqli_affected_rows($koneksi);

}

if(isset($_POST["register"])){
	if(registrasi($_POST) > 0){
		echo "<script>
			alert('User baru ditambahkan');
		</script>";
	}else {
		echo mysqli_error($koneksi);
	}
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

    <title>Registrasi</title>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4"></div>
        <div class="col-4">
          <h1 style="text-align: center;">Halaman Registrasi</h1><br>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="exampleInputUsername1" class="form-label">Username</label>
              <input type="text" class="form-control" id="exampleInputUsername1" name="exampleInputUsername1">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1">
            </div>
            <div class="mb-3">
              <label for="exampleInputConfirmPassword1" class="form-label">Konfirmasi Password</label>
              <input type="password" class="form-control" id="exampleInputConfirmPassword1" name="exampleInputConfirmPassword1">
            </div>
            <button type="submit" class="btn btn-primary" name="register">Submit</button>
            <button type="" class="btn btn-success" name="login"><a href="login.php" style="text-decoration: none; color: white;">Login</a></button>
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