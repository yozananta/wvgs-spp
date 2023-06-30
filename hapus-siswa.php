<?php 
session_start();
if ($_SESSION['level'] == "") {
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
    exit;
}

include "layout/header.php";

$nisn = (int)$_GET['nisn'];

if (delete_siswa($nisn) > 0) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Siswa Berhasil Dihapus!',
        }).then(function(){
            document.location.href = 'siswa.php';
        });
        </script>";
        }else
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Siswa Gagal Dihapus!',
        }).then(function(){
            document.location.href = 'siswa.php';
        });
        </script>";
?>

