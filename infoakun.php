<?php  
session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}
if ($_SESSION['level'] == "siswa") {
include "layout/header.php";

$tampil = $_SESSION['nomorinduk'];
$loginsiswa= select("SELECT * FROM t_siswa WHERE nisn = $tampil
 ORDER BY nisn ASC");

if (isset($_POST['edit'])) {
    if (update_siswa($_POST) > 0) {
            echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Siswa Berhasil Diedit!',
            }).then(function(){
            document.location.href = 'siswa.php';
            });
            </script>";
    } else
            echo "<script>
            Swal.fire({
            icon: 'error',
            title: 'Gagal',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Siswa Gagal Diedit!',
            }).then(function(){
            document.location.href = 'siswa.php';
            });
            </script>";
    }
?>


<?php foreach ($loginsiswa as $siswa):   ?>
<div class="content-wrapper container">
    <div class="container">
    <h3 class="mb-3">Informasi Pribadi</h3>
        <div class="main-body">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body" style="height: 445px;">
                            <div class="d-flex flex-column align-items-center text-center">
                                <br>
                                <img src="assets/images/faces/profil.png" alt="Admin" class="rounded-circle"
                                    width="150">
                                <div class="mt-3">
                                    <h4><?=  $siswa['nama']; ?></h4>
                                    <p class="text-secondary mb-1"><?=  $_SESSION['level']; ?></p>
                                    <p class="text-muted font-size-sm">SMK Negeri 1 Cerme</p>
                                    <br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body mt-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NISN</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?= $siswa['nisn'];?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">NIS</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=  $siswa['nis']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=  $siswa['nama']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Alamat</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=  $siswa['alamat']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Telepon</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=  $siswa['telepon']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?=  $siswa['nama_pengguna']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <buttontype="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?= $siswa['nisn']; ?>"><i class="fas fa-edit"></i> Edit Akun</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ;   ?>

                    <?php foreach ($loginsiswa as $siswa) : ?>
        <div class="modal fade text-left" id="modalEdit<?= $siswa['nisn']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Edit Siswa </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="nisn" value="<?= $siswa['nisn']; ?>">
                            <input type="hidden" class="form-control" name="nis" id="nis" value="<?= $siswa['nis'];?>">
                            <input type="hidden" class="form-control" name="nama" id="nama" value="<?= $siswa['nama'];?>">
                            <label>Username : </label>
                            <div class="form-group">
                                <input type="text" name="nama_pengguna" id="nama_pengguna" value="<?= $siswa['nama_pengguna'];?>" class="form-control" required>
                            </div>
                            <label>Password : </label>
                            <div class="form-group">
                                <input type="password" name="sandi" id="sandi" value="<?= $siswa['sandi'];?>" class="form-control" required>
                            </div>

                            <input type="hidden" class="form-control" name="id_kelas" id="id_kelas" value="<?= $siswa['id_kelas'];?>">

                            <label>Alamat : </label>
                            <div class="form-group">
                                <input type="text" name="alamat" id="alamat" value="<?= $siswa['alamat'];?>"
                                    class="form-control" required>
                            </div>
                            <label>Telepon : </label>
                            <div class="form-group">
                                <input type="number" name="telepon" id="telepon" value="<?= $siswa['telepon'];?>"
                                    class="form-control" required>
                            </div>
                            <input type="hidden" class="form-control" name="id_spp" id="id_spp" value="<?= $siswa['id_spp'];?>">

                            <input type="hidden" class="form-control" name="role" id="role" value="<?= $siswa['role'];?>">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" name="edit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Edit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php 
   include "layout/footer.php";
?>

        <?php  }
else {
    header("location:dashboard.php");
} ?>