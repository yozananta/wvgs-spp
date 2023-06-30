<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}

if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "petugas")) { 
include "layout/header.php";


$data_pembayaran = select("SELECT * FROM t_pembayaran
                    INNER JOIN t_siswa ON t_pembayaran.nisn = t_siswa.nisn                       
                    INNER JOIN t_petugas ON t_pembayaran.id_petugas = t_petugas.id_petugas                       
                    ORDER BY id_pembayaran ASC");

$getsis = mysqli_query($koneksi, "SELECT * FROM t_siswa");


        if (isset($_POST['tambah'])){
        if (create_pembayaran($_POST) > 0){
            echo "<script>
            Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            color: 'white',
            background: '#1E1E2D',
            text: 'Data Pembayaran Berhasil Ditambahkan!',
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
                text: 'Data Pembayaran Gagal Ditambahkan!',
                }).then(function(){
                document.location.href = 'pembayaran.php';
                });
                </script>";
        }

        if (isset($_POST['edit'])) {
        if (update_pembayaran($_POST) > 0) {
                echo "<script>
                Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                color: 'white',
                background: '#1E1E2D',
                text: 'Data Pembayaran Berhasil Diedit!',
                }).then(function(){
                document.location.href = 'pembayaran.php';
                });
                </script>";
        } else
                echo "<script>
                Swal.fire({
                icon: 'error',
                title: 'Gagal',
                color: 'white',
                background: '#1E1E2D',
                text: 'Data Pembayaran Gagal Diedit!',
                }).then(function(){
                document.location.href = 'pembayaran.php';
                });
                </script>";
        }
?>


<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Data Pembayaran</h3>
    </div>
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                    class="fas fa-plus-circle"></i> Tambah Data</button>
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pembayaran</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan SPP</th>
                        <th>Tahun SPP</th>
                        <th>Harga SPP</th>
                        <th>Jumlah Bayar</th>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
                        <th>Kurang Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <?php  } ?>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $no = 1; ?>
                        <?php foreach ($data_pembayaran as $pembayaran):   ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>BYR00<?= $pembayaran['id_pembayaran']; ?></td>
                        <td><?= $pembayaran['nisn']; ?></td>
                        <td><?= $pembayaran['nama']; ?></td>
                        <td><?= $pembayaran['tgl_bayar']; ?></td>
                        <td><?= $pembayaran['bulan_spp']; ?></td>
                        <?php  $spp = $pembayaran['id_spp'];?>
                        <td><?=  $spp == '1' ?  '<p>2020</p>' :  ($spp == '2' ?  '<p>2021</p>' : ($spp == '3' ?  '<p>2022</p>' :'<p>2023</p>')) ?>
                        </td>
                        <td><?=  $spp == '1' ?  '<p>100K</p>' :  ($spp == '2' ?  '<p>120K</p>' : ($spp == '3' ?  '<p>150K</p>' : '<p>175K</p>')) ?>
                        </td>
                        <td><?= $pembayaran['jumlah_bayar'];?>K</td>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
                        <?php  $hargaspp = $spp == '1' ?  '100' :  ($spp == '2' ?  '120' : ($spp == '3' ?  '150' : '175'));
                            ?>
                        <td><?= $hargaspp - $pembayaran['jumlah_bayar'];?>K</td>
                        <?php  $status = $pembayaran['status'];?>
                        <td><?= $status == '1' ?  '<a class="text-warning">Lunas</a>' :  '<a class="text-danger">Belum Lunas</a>' ?>
                        </td>

                        <td width="20%" class="text-center">
                            <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalEdit<?= $pembayaran['id_pembayaran']; ?>"><i
                                    class="fas fa-edit"></i> </button>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#modalHapus<?= $pembayaran['id_pembayaran']?>"><i
                                    class="fas fa-trash-alt"></i>
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
                        <h4 class="modal-title" id="modalTambah">Tambah Pembayaran </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <label>Nama Siswa : </label>
                            <div class="form-group">
                                <select name="nisn" id="nisn" class="form-control">
                                    <option>--Nama Siswa --</option>
                                    <?php
                                while($pembayaran=mysqli_fetch_array($getsis)){?>
                                    <option name="nisn" value="<?=$pembayaran['nisn']?>">
                                        <?=$pembayaran['nama']?></option>
                                    <?php }?>

                                </select>
                            </div>

                            <label>Bulan SPP : </label>
                            <div class="form-group">
                                <select name="bulan_spp" id="bulan_spp" class="form-control" required>
                                    <option value="">--Pilih Bulan--</option>
                                    <option value="Januari">Januari</option>
                                    <option value="Februari">Februari</option>
                                    <option value="Maret">Maret</option>
                                    <option value="April">April</option>
                                    <option value="Mei">Mei</option>
                                    <option value="Juni">Juni</option>
                                    <option value="Juli">Juli</option>
                                    <option value="Agustus">Agustus</option>
                                    <option value="September">September</option>
                                    <option value="Oktober">Oktober</option>
                                    <option value="November">November</option>
                                    <option value="Desember">Desember</option>
                                </select>
                            </div>

                            <label>Jumlah Bayar : </label>
                            <div class="form-group">
                                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control"
                                    required>
                            </div>

                            <label>Status : </label>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">--Pilih Status--</option>
                                    <option value="1">Lunas</option>
                                    <option value="2">Belum Lunas</option>
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

        <?php foreach ($data_pembayaran as $pembayaran) : ?>
        <div class="modal fade text-left" id="modalEdit<?= $pembayaran['id_pembayaran']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Edit Pembayaran </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran']; ?>">

                            <label>Nama : </label>
                            <div class="form-group">
                                <select name="nisn" id="nisn" class="form-control">
                                    <?php
                                    $getsis = mysqli_query($koneksi, "SELECT * FROM t_siswa");
                                while($sis=mysqli_fetch_array($getsis)){?>
                                    <option value="<?=$sis['nisn']?>"
                                        <?=$pembayaran['nisn'] == $sis['nisn'] ? 'selected' : null ?>>
                                        <?=$sis['nama']?> </option>
                                    <?php }?>

                                </select>
                            </div>



                            <label>Bulan SPP : </label>
                            <div class="form-group">
                                <select name="bulan_spp" id="bulan_spp" class="form-control" required>
                                    <?php  $bulan = $pembayaran['bulan_spp'];?>
                                    <option value="Januari" <?= $bulan == 'Januari' ? 'selected' : null ?>>Januari
                                    </option>
                                    <option value="Februari" <?= $bulan == 'Februari' ? 'selected' : null ?>>Februari
                                    </option>
                                    <option value="Maret" <?= $bulan == 'Maret' ? 'selected' : null ?>>Maret</option>
                                    <option value="April" <?= $bulan == 'April' ? 'selected' : null ?>>April</option>
                                    <option value="Mei" <?= $bulan == 'Mei' ? 'selected' : null ?>>Mei</option>
                                    <option value="Juni" <?= $bulan == 'Juni' ? 'selected' : null ?>>Juni</option>
                                    <option value="Juli" <?= $bulan == 'Juli' ? 'selected' : null ?>>Juli</option>
                                    <option value="Agustus" <?= $bulan == 'Agustus' ? 'selected' : null ?>>Agustus
                                    </option>
                                    <option value="September" <?= $bulan == 'September' ? 'selected' : null ?>>September
                                    </option>
                                    <option value="Oktober" <?= $bulan == 'Oktober' ? 'selected' : null ?>>Oktober
                                    </option>
                                    <option value="November" <?= $bulan == 'November' ? 'selected' : null ?>>November
                                    </option>
                                    <option value="Desember" <?= $bulan == 'Desember' ? 'selected' : null ?>>Desember
                                    </option>
                                </select>
                            </div>

                            <label>Jumlah Bayar : </label>
                            <div class="form-group">
                                <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="form-control"
                                    value="<?= $pembayaran['jumlah_bayar']; ?>" required>
                            </div>
                            <label>Status : </label>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" required>
                                    <?php  $status = $pembayaran['status'];?>
                                    <option value="1" <?= $status == '1' ? 'selected' : null ?>>Lunas
                                    </option>
                                    <option value="2" <?= $status == '2' ? 'selected' : null ?>>Belum Lunas
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

        <?php foreach ($data_pembayaran as $pembayaran) : ?>
        <div class="modal fade text-left" id="modalHapus<?= $pembayaran['id_pembayaran']?>" tabindex="-1" role="dialog"
            aria-labelledby="modalEdit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalEdit">Hapus Pembayaran </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="" method="POST">
                        <div class="modal-body">
                            <p>Yakin Ingin Menghapus Data Pembayaran : <b><?= $pembayaran['nama']; ?></b> ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <a href="hapus-pembayaran.php?id_pembayaran=<?= $pembayaran['id_pembayaran'];?>"
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
    header("location:index.php");
} ?>