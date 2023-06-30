<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}

if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "petugas")) {
include "layout/header.php";


$data_spp = select("SELECT * FROM t_spp ORDER BY id_spp ASC");



        if (isset($_POST['tambah'])){
        if (create_spp($_POST) > 0){
            echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data SPP Berhasil Ditambahkan!',
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
                text: 'Data SPP Gagal Ditambahkan!',
                }).then(function(){
                document.location.href = 'spp.php';
                });
                </script>";
        }

        if (isset($_POST['edit'])) {
        if (update_spp($_POST) > 0) {
                echo "<script>
                Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                color: 'white',
                background: '#1E1E2D',
                text: 'Data SPP Berhasil Diedit!',
                }).then(function(){
                document.location.href = 'spp.php';
                });
                </script>";
        } else
                echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Gagal',
                color: 'white',
                background: '#1E1E2D',
                text: 'Data SPP Gagal Diedit!',
                }).then(function(){
                document.location.href = 'spp.php';
                });
                </script>";
        }
?>


<div class="content-wrapper container">
<div class="page-heading">
        <h3>Data SPP</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <?php  if ($_SESSION['level'] == "admin") { ?>
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                    class="fas fa-plus-circle"></i> Tambah Data</button>
            <?php  } ?>

            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID SPP</th>
                        <th>Tahun</th>
                        <th>Nominal</th>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
                        <th>Aksi</th>
                        <?php  } ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $no = 1; ?>
                        <?php foreach ($data_spp as $spp):   ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>SP0<?= $spp['id_spp']; ?></td>
                        <td><?= $spp['tahun']; ?></td>
                        <td><?= $spp['nominal']; ?>K</td>
                        <?php  if ($_SESSION['level'] == "admin") { ?>        
                        <td width="20%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?= $spp['id_spp']; ?>"><i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalHapus<?= $spp['id_spp']?>"><i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                        <?php  } ?>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="modal fade text-left" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambah"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTambah">Tambah SPP </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <label>Tahun : </label>
                            <div class="form-group">
                                <input type="number" name="tahun" id="tahun" class="form-control" required>
                            </div>

                            <label>Nominal : </label>
                            <div class="form-group">
                                <input type="number" name="nominal" id="nominal" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" name="tambah" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Tambah</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php foreach ($data_spp as $spp) : ?>
        <div class="modal fade text-left" id="modalEdit<?= $spp['id_spp']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Edit SPP </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_spp" value="<?= $spp['id_spp']; ?>">

                            <label>Tahun : </label>
                            <div class="form-group">
                                <input type="number" name="tahun" id="tahun" value="<?= $spp['tahun'];?>"
                                    class="form-control" required>
                            </div>
                            <label>Nominal : </label>
                            <div class="form-group">
                                <input type="number" name="nominal" id="nominal" value="<?= $spp['nominal'];?>"
                                    class="form-control" required>
                            </div>

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

        <?php foreach ($data_spp as $spp) : ?>
        <div class="modal fade text-left" id="modalHapus<?= $spp['id_spp']?>" tabindex="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Hapus Akun </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <p>Yakin Ingin Menghapus Data SPP : <b><?= $spp['nominal']; ?></b> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <a href="hapus-spp.php?id_spp=<?= $spp['id_spp'];?>" class="btn btn-danger ml-1"><i
                                    class="bx bx-check d-block d-sm-none"></i><span
                                    class="d-none d-sm-block">Hapus</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<?php 
   include "layout/footer.php";
?>

<?php  }
else {
    header("location:infoakun.php");
} ?>