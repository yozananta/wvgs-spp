<?php 
include "config/app.php";

$data_petugas = select("SELECT * FROM t_petugas");




if (isset($_POST['tambah'])) {
  if (create_akun($_POST) > 0) {
    echo "<script>
        alert('Akun Berhasil Dibuat')
        document.location.href = 'login.php';
    </script>";
} else
    echo "<script>
    alert('Akun Gagal Dibuat')
        document.location.href = 'register.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo"  style="margin-bottom: 40px;">
                <a href="index.html"><img src="assets/images/logo/logosmknew.png" alt="Logo"></a>
            </div>
            <h1 class="auth-title" style="color: white; font-size: 50px;">Sign Up</h1>
            <p class="auth-subtitle mb-5" style="font-size: 18px;">Buat Username dan Password Anda!</p>

            <form action="" method="post">
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="username" class="form-control form-control-xl" placeholder="Username">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" class="form-control form-control-xl" placeholder="Password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="nama_petugas" class="form-control form-control-xl" placeholder="Nama">
                    <div class="form-control-icon">
                    <i class="far fa-address-card"></i>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="level" id="level" value="siswa">
              
                <button type="submit" name="tambah" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" >Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? <a href="login.php" class="font-bold">Log
                        in</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

    </div>
</body>

</html>
