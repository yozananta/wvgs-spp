<!doctype html>
<html lang="en" prefix="og: https://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
    <title>Login | SPP</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="//ogp.me" rel="dns-prefetch">
    <link href="//unpkg.com" rel="dns-prefetch">
    <link href="//cdn.jsdelivr.net" rel="dns-prefetch">
    <link href="//fonts.gstatic.com" rel="dns-prefetch">
    <link href="//www.w3.org" rel="dns-prefetch">
    <link rel="stylesheet" href="assets/css/loginstyle.css">
    <style>
    @media (max-height: 534px) {
        .vh {
            height: unset;
        }

        .tengah {
            transform: translate(-50%, 0);
        }

    }

    
    footer {
            background-color: #151521;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="vh">
        <div class="bg-utama"></div>
        <div class="tengah">
            <div class="card pt-3 pb-3">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="assets/images/logo/smk144.png" alt="SMK Negeri 1 Cerme">
                        <h5 class="card-title">Login</h5>
                    </div>
                    <form action="ingfologin.php" method="post">
					<?php
                                    session_start();
                                    if(isset($_SESSION['gagal'])){
                                    ?>
                        <div class="alert text-center" style="color: white;">
                            <span class="border bg-danger"> Username/Password Salah!</span>
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
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form_login input"
                            placeholder="Masukkan Username" required
                            oninvalid="this.setCustomValidity('Masukkan NIM/NIK/NIP')"
                            oninput="setCustomValidity('')" />
                        <div class="inisatu">
                            <label for="password">Password</label>
                            <div id="show_hide_password">
                                <input type="password" name="password" id="password" class="form_login input"
                                    placeholder="Masukkan Password" required
                                    oninvalid="this.setCustomValidity('Masukkan Password')"
                                    oninput="setCustomValidity('')" />
                                <div class="input-addon">
                                    <a href="" role="button" title="Lihat Password"><i class="bx bx-hide"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mb-2 mr-sm-2" style="margin-left:-10px;">
                            <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                        </div>
                        <button type="submit" class="tombol_login elcreative-ripple-effect"><i
                                class="bx bx-log-in"></i>&nbsp;Login</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
    //<[CDATA[
    ! function(e) {
        e(".elcreative-ripple-effect").click(function(c) {
            var a = e(this);
            0 === a.find(".elc-ripple-effect").length && a.append("<span class='elc-ripple-effect'></span>");
            var b = a.find(".elc-ripple-effect");
            if (b.removeClass("animate"), !b.height() && !b.width()) {
                var d = Math.max(a.outerWidth(), a.outerHeight());
                b.css({
                    height: d,
                    width: d
                })
            }
            d = c.pageX - a.offset().left - b.width() / 2;
            c = c.pageY - a.offset().top - b.height() / 2;
            b.css({
                top: c + "px",
                left: d + "px"
            }).addClass("animate")
        })
    }(jQuery);
    //]]>
    </script>
    <script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
    </script>
</body>
<footer>
        <div class="container">
            <p>&copy; 2023 Yozakha Kirnanta. All Rights Reserved.</p>
        </div>
    </footer>





</html>