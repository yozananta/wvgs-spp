<?php 
session_start();
if ($_SESSION['level'] == "") {
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
    exit;
}

include "layout/header.php";

$id_spp = (int)$_GET['id_spp'];

if (delete_spp($id_spp) > 0) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data SPP Berhasil Dihapus!',
        }).then(function(){
            document.location.href = 'spp.php';
        });
        </script>";
        }else
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data SPP Gagal Dihapus!',
        }).then(function(){
            document.location.href = 'spp.php';
        });
        </script>";
?>

