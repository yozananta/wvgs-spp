<?php 
session_start();
if ($_SESSION['level'] == "") {
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
    exit;
}

include "layout/header.php";

$id_pembayaran = (int)$_GET['id_pembayaran'];

if (delete_pembayaran($id_pembayaran) > 0) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Pembayaran Berhasil Dihapus!',
        }).then(function(){
            document.location.href = 'pembayaran.php';
        });
        </script>";
        }else
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Pembayaran Gagal Dihapus!',
        }).then(function(){
            document.location.href = 'pembayaran.php';
        });
        </script>";
?>

