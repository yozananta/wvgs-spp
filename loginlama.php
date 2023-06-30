<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo" style="margin-bottom: 40px;">
                        <a href="index.html"><img src="assets/images/logo/logosmknew.png" alt="Logo"></a>
                    </div>
                    <h2 class="auth-title" style="color: white; font-size: 50px;">Log in.</h2>
                    <p class="auth-subtitle mb-5" style="font-size: 18px;">Masukkan Username dan Password Anda!</p>

                    <form action="ingfologin.php" method="post">
                        <?php
                                    session_start();
                                    if(isset($_SESSION['gagal'])){
                                    ?>
                        <div class="alert bg-warning text-center" style="color: black;">
                            <p><b> Username/Password Salah!</b></p>
                        </div>
                        <?php
                                        session_destroy();
                                      }
                                    
                                    if(isset($_SESSION['gagal-login'])){?>
                        <script>
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= $_SESSION['gagal-login']?>',
                            text: 'Login Dulu Yaa..!',
                            color: 'white',
                            background: '#1E1E2D',
                        }).then(function() {
                            document.location.href = 'login.php';
                        });
                        </script>
                        <?php  session_destroy();
                                    }
                            ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="username" id="username"
                                placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password" id="password"
                                placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <!-- <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="register.php"
                                class="font-bold">Sign
                                up</a>.</p>
                    </div> -->
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