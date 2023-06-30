<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}
if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "petugas")) { 
include "layout/header.php";


$data_siswa = select("SELECT * FROM t_siswa
                    INNER JOIN t_kelas ON t_siswa.id_kelas = t_kelas.id_kelas                   
                    INNER JOIN t_spp ON t_siswa.id_spp = t_spp.id_spp                   
                    ORDER BY nisn ASC");

$getlas = mysqli_query($koneksi, "SELECT * FROM t_kelas");
$getnom = mysqli_query($koneksi, "SELECT * FROM t_spp");


        if (isset($_POST['tambah'])){
        if (create_siswa($_POST) > 0){
            echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Siswa Berhasil Ditambahkan!',
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
                text: 'Data Siswa Gagal Ditambahkan!',
                }).then(function(){
                document.location.href = 'siswa.php';
                });
                </script>";
        }

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


<div class="content-wrapper container">
<div class="page-heading">
        <h3>Data Siswa</h3>
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
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Username</th>
                        <th>Nama Kelas</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Nominal SPP</th>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
                        <th>Aksi</th>
                        <?php  } ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $no = 1; ?>
                        <?php foreach ($data_siswa as $siswa):   ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $siswa['nisn']; ?></td>
                        <td><?= $siswa['nis']; ?></td>
                        <td><?= $siswa['nama']; ?></td>
                        <td><?= $siswa['nama_pengguna']; ?></td>
                        <td><?= $siswa['nama_kelas']; ?></td>
                        <td><?= $siswa['alamat']; ?></td>
                        <td><?= $siswa['telepon'];?></td>
                        <td><?= $siswa['nominal'];?>K</td>
                        <?php  if ($_SESSION['level'] == "admin") { ?>       
                        <td width="20%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?= $siswa['nisn']; ?>"><i class="fas fa-edit"></i> </button>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalHapus<?= $siswa['nisn']?>"><i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                        <?php } ?>
                        
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
                        <h4 class="modal-title" id="modalTambah">Tambah Siswa </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <label>NISN : </label>
                            <div class="form-group">
                                <input type="number" name="nisn" id="nisn" class="form-control" required>
                            </div>
                            <label>NIS : </label>
                            <div class="form-group">
                                <input type="number" name="nis" id="nis" class="form-control" required>
                            </div>

                            <label>Nama Siswa : </label>
                            <div class="form-group">
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <label>Username : </label>
                            <div class="form-group">
                                <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" required>
                            </div>
                            <label>Password : </label>
                            <div class="form-group">
                                <input type="password" name="sandi" id="sandi" class="form-control" required>
                            </div>
                            <label>Nama Kelas : </label>
                            <div class="form-group">
                                <select name="id_kelas" id="id_kelas" class="form-control">
                                    <option>--Nama Kelas --</option>
                                    <?php
                                while($kelas=mysqli_fetch_array($getlas)){?>
                                    <option name="id_kelas" value="<?=$kelas['id_kelas']?>">
                                        <?=$kelas['nama_kelas']?></option>
                                    <?php }?>

                                </select>
                            </div>
                            <label>Alamat : </label>
                            <div class="form-group">
                                <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <label>Telepon : </label>
                            <div class="form-group">
                                <input type="number" name="telepon" id="telepon" class="form-control" required>
                            </div>
                            <label>Nominal SPP : </label>
                            <div class="form-group">
                                <select name="id_spp" id="id_spp" class="form-control">
                                    <option>--Nominal SPP --</option>
                                    <?php
                                while($kelas=mysqli_fetch_array($getnom)){?>
                                    <option name="id_spp" value="<?=$kelas['id_spp']?>">
                                        <?=$kelas['nominal']?></option>
                                    <?php }?>

                                </select>
                            </div>
                            <input type="hidden" class="form-control" name="role" id="role" value="siswa">
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

        <?php foreach ($data_siswa as $siswa) : ?>
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
                            <label>NISN : </label>
                            <div class="form-group">
                                <input type="number" name="nisn" id="nisn" value="<?= $siswa['nisn'];?>"
                                    class="form-control" required>
                            </div>
                            <label>NIS : </label>
                            <div class="form-group">
                                <input type="number" name="nis" id="nis" value="<?= $siswa['nis'];?>"
                                    class="form-control" required>
                            </div>
                            <label>Nama Siswa : </label>
                            <div class="form-group">
                                <input type="text" name="nama" id="nama" value="<?= $siswa['nama'];?>"
                                    class="form-control" required>
                            </div>
                            <label>Username : </label>
                            <div class="form-group">
                                <input type="text" name="nama_pengguna" id="nama_pengguna" value="<?= $siswa['nama_pengguna'];?>" class="form-control" required>
                            </div>
                            <label>Password : </label>
                            <div class="form-group">
                                <input type="password" name="sandi" id="sandi" value="<?= $siswa['sandi'];?>" class="form-control" required>
                            </div>

                            
                            <label>Nama Kelas : </label>
                            <div class="form-group">
                                <select name="id_kelas" id="id_kelas" class="form-control">
                                    <?php
                                    $getlas = mysqli_query($koneksi, "SELECT * FROM t_kelas");
                                while($kelas=mysqli_fetch_array($getlas)){?>
                                    <option value="<?=$kelas['id_kelas']?>"
                                        <?=$siswa['id_kelas'] == $kelas['id_kelas'] ? 'selected' : null ?>>
                                        <?=$kelas['nama_kelas']?> </option>
                                    <?php }?>

                                </select>
                            </div>

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

                            <label>Nominal : </label>
                            <div class="form-group">
                                <select name="id_spp" id="id_spp" class="form-control">
                                    <?php
                                    $getnom = mysqli_query($koneksi, "SELECT * FROM t_spp");
                                while($kelas=mysqli_fetch_array($getnom)){?>
                                    <option value="<?=$kelas['id_spp']?>"
                                        <?=$siswa['id_spp'] == $kelas['id_spp'] ? 'selected' : null ?>>
                                        <?=$kelas['nominal']?> </option>
                                    <?php }?>

                                </select>
                            </div>
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

        <?php foreach ($data_siswa as $siswa) : ?>
        <div class="modal fade text-left" id="modalHapus<?= $siswa['nisn']?>" tabindex="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Hapus Siswa </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <p>Yakin Ingin Menghapus Data Siswa : <b><?= $siswa['nama']; ?></b> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <a href="hapus-siswa.php?nisn=<?= $siswa['nisn'];?>" class="btn btn-danger ml-1"><i
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