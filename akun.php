<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}

if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "petugas")) {
include "layout/header.php";


$data_akun = select("SELECT * FROM t_petugas ORDER BY id_petugas ASC");



        if (isset($_POST['tambah'])){
        if (create_akun($_POST) > 0){
            echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Akun Berhasil Ditambahkan!',
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
                text: 'Data Akun Gagal Ditambahkan!',
                }).then(function(){
                document.location.href = 'akun.php';
                });
                </script>";
        }

        if (isset($_POST['edit'])) {
        if (update_akun($_POST) > 0) {
                echo "<script>
                Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                color: 'white',
                background: '#1E1E2D',
                text: 'Data Akun Berhasil Diedit!',
                }).then(function(){
                document.location.href = 'akun.php';
                });
                </script>";
        } else
                echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Gagal',
                color: 'white',
                background: '#1E1E2D',
                text: 'Data Akun Gagal Diedit!',
                }).then(function(){
                document.location.href = 'akun.php';
                });
                </script>";
        }
?>


<div class="content-wrapper container">
<div class="page-heading">
        <h3>Data Akun</h3>
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
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
                        <th>Aksi</th>
                        <?php  } ?>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $no = 1; ?>
                        <?php foreach ($data_akun as $akun):   ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td><?= $akun['password']; ?></td>
                        <td><?= $akun['nama_petugas']; ?></td>
                        <td><?= $akun['level']; ?></td>
                        <?php  if ($_SESSION['level'] == "admin") { ?>    
                        <td width="20%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?= $akun['id_petugas']; ?>"><i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalHapus<?= $akun['id_petugas']?>"><i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                        <?php  } ?>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="modal fade text-left" id="modalTambah" tabinfologin="-1" role="dialog" aria-labelledby="modalTambah"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalTambah">Tambah Akun </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <label>Username : </label>
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>

                            <label>Password : </label>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <label>Nama : </label>
                            <div class="form-group">
                                <input type="nama_petugas" name="nama_petugas" id="nama_petugas" class="form-control"
                                    required>
                            </div>

                            <label>Level : </label>
                            <div class="form-group">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="">--Pilih Level--</option>
                                    <option value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>

                                </select>
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

        <?php foreach ($data_akun as $akun) : ?>
        <div class="modal fade text-left" id="modalEdit<?= $akun['id_petugas']; ?>" tabinfologin="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Edit Akun </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_petugas" value="<?= $akun['id_petugas']; ?>">

                            <label>Username : </label>
                            <div class="form-group">
                                <input type="text" name="username" id="username" value="<?= $akun['username'];?>"
                                    class="form-control" required>
                            </div>
                            <label>Password : </label>
                            <div class="form-group">
                                <input type="password" name="password" id="password" value="<?= $akun['password'];?>"
                                    class="form-control" required>
                            </div>
                            <label>Nama : </label>
                            <div class="form-group">
                                <input type="text" name="nama_petugas" id="nama_petugas"
                                    value="<?= $akun['nama_petugas'];?>" class="form-control" required>
                            </div>
                            <label>Level : </label>
                            <div class="form-group">
                                <select name="level" id="level" class="form-control" required>
                                    <?php  $level = $akun['level'];?>
                                    <option value="admin" <?= $level == 'admin' ? 'selected' : null ?>>Admin
                                    </option>
                                    <option value="petugas" <?= $level == 'petugas' ? 'selected' : null ?>>Petugas
                                    </option>
                                </select>
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

        <?php foreach ($data_akun as $akun) : ?>
        <div class="modal fade text-left" id="modalHapus<?= $akun['id_petugas']?>" tabinfologin="-1" role="dialog"
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
                            <p>Yakin Ingin Menghapus Data Akun : <b><?= $akun['nama_petugas']; ?></b> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <a href="hapus-Akun.php?id_petugas=<?= $akun['id_petugas'];?>"
                                class="btn btn-danger ml-1"><i class="bx bx-check d-block d-sm-none"></i><span
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
    header("location:infologin.php");
} ?>