<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}

if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "petugas")) { 
include "layout/header.php";


?>

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Laporan Transaksi Pembayaran</h3>
    </div>
    <div class="card">
        <div class="card-header justify-content-center">
        </div>
        <div class="card-body">
            <form action="ekspor.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-lg-4">
                        <label>Tanggal Awal </label>
                        <input type="date" name="daritanggal" class="form-control">
                    </div>
                    <div class="col-lg-4">
                        <label>Tanggal Akhir </label>
                        <input type="date" name="sampaitanggal" class="form-control">
                    </div>
                    <div class="col-lg-4 mt-4">
                        <input type="submit" class="btn btn-success" value="Cetak">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php 
   include "layout/footer.php";
?>


<?php  }
else {
    header("location:index.php");
} ?>