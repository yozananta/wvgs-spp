<?php 

session_start();
if($_SESSION['level']==""){
    $_SESSION['gagal-login'] = "Gagal Masuk Page !";
    header("location:login.php");
exit;
}

include "layout/header.php";
$tampil = $_SESSION['nomorinduk'];
$data_pembayaran = select("SELECT * FROM t_pembayaran
                    INNER JOIN t_siswa ON t_pembayaran.nisn = t_siswa.nisn                       
                    INNER JOIN t_petugas ON t_pembayaran.id_petugas = t_petugas.id_petugas                       
                    WHERE t_pembayaran.nisn = $tampil ORDER BY id_pembayaran ASC");
    
?>

<div class="content-wrapper container">
    <div class="page-heading">
        <h3>Histori Pembayaran</h3>
    </div>
    <div class="card">
        <div class="card-header justify-content-center">
        </div>
        <div class="card-body">
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
                        <th>Harus Dibayar</th>
                        <th>Jumlah Bayar</th>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
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
                        <td><?=  $spp == '1' ?  '<p>2020</p>' :  ($spp == '2' ?  '<p>2021</p>' : ($spp == '3' ?  '<p>2022</p>' :'<p>2023</p>')) ?></td>
                        <td><?=  $spp == '1' ?  '<p>100K</p>' :  ($spp == '2' ?  '<p>120K</p>' : ($spp == '3' ?  '<p>150K</p>' : '<p>175K</p>')) ?></td>
                        <td><?= $pembayaran['jumlah_bayar'];?>K</td>
                        <?php  if ($_SESSION['level'] == "admin") { ?>
                        <?php  $status = $pembayaran['status'];?>
                        <td><?= $status == '1' ?  '<a class="text-warning">Lunas</a>' :  '<a class="text-danger">Belum Lunas</a>' ?></td>

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
    </div>

</div>


<?php 
   include "layout/footer.php";
?>