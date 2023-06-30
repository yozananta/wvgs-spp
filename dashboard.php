<?php  
session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}
if ($_SESSION['level'] == "admin") {
include "layout/header.php";


?>
<div class="content-wrapper container">

    <div class="page-heading">
        <h3>Dashboard Admin</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Siswa</h6>
                                        <?php
                                            $data_siswa = mysqli_query($koneksi,"SELECT * FROM t_siswa");
                                            $tampil_siswa = mysqli_num_rows($data_siswa);
                                            ?>
                                        <h6 class="font-extrabold mb-0"><?= $tampil_siswa ?> <b>Data</b></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="fas fa-school"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Kelas</h6>
                                        <?php
                                            $data_kelas = mysqli_query($koneksi,"SELECT * FROM t_kelas");
                                            $tampil_kelas = mysqli_num_rows($data_kelas);
                                            ?>
                                        <h6 class="font-extrabold mb-0"><?= $tampil_kelas ?> <b>Data</b></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon green mb-2">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">SPP</h6>
                                        <?php
                                            $data_spp = mysqli_query($koneksi,"SELECT * FROM t_spp");
                                            $tampil_spp = mysqli_num_rows($data_spp);
                                            ?>
                                        <h6 class="font-extrabold mb-0"><?= $tampil_spp ?> <b>Data</b></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Akun</h6>
                                        <?php
                                            $data_petugas = mysqli_query($koneksi,"SELECT * FROM t_petugas");
                                            $tampil_petugas = mysqli_num_rows($data_petugas);
                                            ?>
                                        <h6 class="font-extrabold mb-0"><?= $tampil_petugas ?> <b>Data</b></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                    <i class="fas fa-money-check"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pembayaran</h6>
                                <?php
                                            $data_pembayaran = mysqli_query($koneksi,"SELECT * FROM t_pembayaran");
                                            $tampil_pembayaran = mysqli_num_rows($data_pembayaran);
                                            ?>
                                <h6 class="font-extrabold mb-0"><?= $tampil_pembayaran ?> <b>Data</b></h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section>


        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Siswa</h5>
                        </div>
                        <div class="card-content" style="margin-top: -40px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NISN</th>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Nama Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php $data_siswa = select("SELECT * FROM t_siswa
                                                    INNER JOIN t_kelas ON t_siswa.id_kelas = t_kelas.id_kelas                   
                                                    INNER JOIN t_spp ON t_siswa.id_spp = t_spp.id_spp                   
                                                    ORDER BY nisn ASC");  ?>

                                                <?php $no = 1; ?>
                                                <?php foreach ($data_siswa as $siswa):   ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $siswa['nisn']; ?></td>
                                                <td><?= $siswa['nis']; ?></td>
                                                <td><?= $siswa['nama']; ?></td>
                                                <td><?= $siswa['nama_kelas']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="siswa.php" type="button" class="btn btn-danger mt-4"><i
                                        class="fas fa-wrench"></i>
                                    Maintenance</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Kelas</h5>
                        </div>
                        <div class="card-content" style="margin-top: -40px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Kelas</th>
                                                <th>Jurusan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php  $data_kelas = select("SELECT * FROM t_kelas ORDER BY id_kelas ASC"); ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data_kelas as $kelas):   ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $kelas['nama_kelas']; ?></td>
                                                <td><?= $kelas['jurusan']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="kelas.php" type="button" class="btn btn-danger mt-4"><i
                                        class="fas fa-wrench"></i>
                                    Maintenance</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="basic-table">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data SPP</h5>
                        </div>
                        <div class="card-content" style="margin-top: -40px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID SPP</th>
                                                <th>Tahun</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php  $data_spp = select("SELECT * FROM t_spp ORDER BY id_spp ASC"); ?>

                                                <?php $no = 1; ?>
                                                <?php foreach ($data_spp as $spp):   ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>SP0<?= $spp['id_spp']; ?></td>
                                                <td><?= $spp['tahun']; ?></td>
                                                <td><?= $spp['nominal']; ?>K</td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="spp.php" type="button" class="btn btn-danger mt-4"><i
                                        class="fas fa-wrench"></i>
                                    Maintenance</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Akun</h5>
                        </div>
                        <div class="card-content" style="margin-top: -40px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Level</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php $data_akun = select("SELECT * FROM t_petugas ORDER BY id_petugas ASC"); ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data_akun as $akun):   ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $akun['username']; ?></td>
                                                <td><?= $akun['nama_petugas']; ?></td>
                                                <td><?= $akun['level']; ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="akun.php" type="button" class="btn btn-danger mt-4"><i
                                        class="fas fa-wrench"></i>
                                    Maintenance</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="basic-table">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Data Pembayaran</h5>
                        </div>
                        <div class="card-content" style="margin-top: -40px;">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-lg">
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
                                                <th>Kurang Bayar</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php $data_pembayaran = select("SELECT * FROM t_pembayaran
                                                INNER JOIN t_siswa ON t_pembayaran.nisn = t_siswa.nisn                       
                                                INNER JOIN t_petugas ON t_pembayaran.id_petugas = t_petugas.id_petugas                       
                                                ORDER BY id_pembayaran ASC") ; ?>

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
                                                <?=  $hargaspp = $spp == '1' ?  '100' :  ($spp == '2' ?  '120' : ($spp == '3' ?  '150' : '175'));
                                                     ?>
                                                <td><?= $hargaspp - $pembayaran['jumlah_bayar'];?>K</td>
                                                <?php  $status = $pembayaran['status'];?>
                                                <td><?= $status == '1' ?  '<a class="text-warning">Lunas</a>' :  '<a class="text-danger">Belum Lunas</a>' ?>
                                                </td>

                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="pembayaran.php" type="button" class="btn btn-danger mt-4"><i
                                        class="fas fa-wrench"></i>
                                    Maintenance</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

</div>


<?php 
   include "layout/footer.php";
?>

<?php  }
else {
    header("location:infoakun.php");
} ?>