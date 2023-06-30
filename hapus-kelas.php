<?php 
session_start();
if ($_SESSION['level'] == "") {
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
    exit;
}

include "layout/header.php";

$id_kelas = (int)$_GET['id_kelas'];

if (delete_kelas($id_kelas) > 0) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Kelas Berhasil Dihapus!',
        }).then(function(){
            document.location.href = 'kelas.php';
        });
        </script>";
        }else
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Kelas Gagal Dihapus!',
        }).then(function(){
            document.location.href = 'kelas.php';
        });
        </script>";
?>

