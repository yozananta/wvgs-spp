<?php 
session_start();
if ($_SESSION['level'] == "") {
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
    exit;
}

include "layout/header.php";

$id_petugas = (int)$_GET['id_petugas'];

if (delete_akun($id_petugas) > 0) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Akun Berhasil Dihapus!',
        }).then(function(){
            document.location.href = 'akun.php';
        });
        </script>";
        }else
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Akun Gagal Dihapus!',
        }).then(function(){
            document.location.href = 'akun.php';
        });
        </script>";
?>

