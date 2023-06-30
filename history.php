<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}

include "layout/header.php";


?>

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Histori Pembayaran</h3>
    </div>
    <div class="card">
        <div class="card-header justify-content-center">
        </div>
        <div class="card-body">
            <form action="" method="get">
                <h4>Cari Histori Pembayaran</h4>
                <br>
                <table class="table">
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td>
                            <input class="form-control" type="text" name="nisn"
                                placeholder="-- Masukkan NISN Siswa --">
                        </td>
                        <td>
                            <button class="btn btn-success" type="submit" name="cari">Cari</button>
                        </td>
                    </tr>

                </table>
            </form>
            <?php 
                if (isset($_GET['nisn']) && $_GET['nisn']!='') {
                  $query = mysqli_query($koneksi, "SELECT * FROM t_siswa INNER JOIN t_kelas ON t_siswa.id_kelas = t_kelas.id_kelas WHERE nisn='$_GET[nisn]'");
                  $data = mysqli_fetch_array($query);
                  $nisn = $data['nisn'];
                
                ?>
            <br>
            <h4>Detail Siswa</h4>
            <br>
            <table class="table">

                <tr>
                    <td width="14%" scope="col-3">NISN</td>
                    <td width="5%">:</td>
                    <td><?= $data['nisn']; ?></td>


                </tr>
                <tr>
                    <td scope="col">NIS</td>
                    <td>:</td>
                    <td><?= $data['nis']; ?></td>
                </tr>
                <tr>
                    <td scope="col">Nama Siswa</td>
                    <td>:</td>
                    <td><?= $data['nama']; ?></td>
                </tr>
                <tr>
                    <td scope="col">Kelas</td>
                    <td>:</td>
                    <td><?= $data['nama_kelas']; ?></td>
                </tr>




            </table>

            <br>
            <h4>Histori Pembayaran Siswa</h4>
            <br>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>ID Pembayaran</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tanggal Bayar</th>
                        <th>Bulan SPP</th>
                        <th>Tahun SPP</th>
                        <th>Harus Dibayar</th>
                        <th>Jumlah Bayar</th>
                        <th>Status</th>

                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1; ?>

                    <?php 
                         $tampil = $data['nisn'];
                            $query = mysqli_query($koneksi,"SELECT * FROM t_pembayaran 
                            JOIN t_siswa ON t_pembayaran.nisn = t_siswa.nisn                       
                            JOIN t_petugas ON t_pembayaran.id_petugas = t_petugas.id_petugas 
                            WHERE t_siswa.nisn = $tampil ORDER BY id_pembayaran ASC");
                

                                while ($data=mysqli_fetch_array($query)) { ?>
                    <tr>
                        <td>BYR00<?= $data['id_pembayaran']; ?></td>
                        <td><?= $data['nisn']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td><?= $data['tgl_bayar']; ?></td>
                        <td><?= $data['bulan_spp']; ?></td>
                        <?php  $spp = $data['id_spp'];?>
                        <td><?=  $spp == '1' ?  '<p>2020</p>' :  ($spp == '2' ?  '<p>2021</p>' : ($spp == '3' ?  '<p>2022</p>' :'<p>2023</p>')) ?>
                        </td>
                        <td><?=  $spp == '1' ?  '<p>100K</p>' :  ($spp == '2' ?  '<p>120K</p>' : ($spp == '3' ?  '<p>150K</p>' : '<p>175K</p>')) ?>
                        </td>
                        <td><?= $data['jumlah_bayar'];?>K</td>
                        <?php  $status = $data['status'];?>
                        <td><?= $status == '1' ?  '<a class="text-warning">Lunas</a>' :  '<a class="text-danger">Belum Lunas</a>' ?>
                        </td>

                    </tr>
                    <?php }

                    ?>

                </tbody>

            </table>

            <?php 
    }
    ?>
        </div>
    </div>

</div>


<?php 
   include "layout/footer.php";
?>