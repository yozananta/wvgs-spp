<?php
include "config/app.php"; 
 
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=rekap-transaksi.doc");
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Kwitansi Pembayaran SPP SMK Negeri 1 Cerme</title>
</head>

<body>
    <?php
  if (isset($_POST['daritanggal'])) {
    $daritanggal = ($_POST['daritanggal']);
 $sampaitanggal = ($_POST['sampaitanggal']);
 
 ?>
    <p align="center">REKAP TRANSAKSI PEMBAYARAN SPP </p>
    <p align="center">SMK NEGERI 1 CERME</p>
    <p align="center">DARI TANGGAL <b><?php echo $daritanggal;?></b> SAMPAI TANGGAL <b><?php echo $sampaitanggal;?></b>
    </p>
    <p>&nbsp;</p>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Bayar</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Tanggal Bayar</th>
                <th>Bulan SPP</th>
                <th>Tahun SPP</th>
                <th>Harga SPP</th>
                <th>Jumlah Bayar</th>
                <th>Kurang Bayar</th>
                <th>Status</th>
                <th>Nama Petugas</th>

        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php  $query = "SELECT * FROM t_pembayaran,t_siswa,t_petugas WHERE t_pembayaran.nisn=t_siswa.nisn AND t_pembayaran.id_petugas=t_petugas.id_petugas AND (t_pembayaran.tgl_bayar between '$daritanggal' AND '$sampaitanggal')";
    $result = mysqli_query($koneksi, $query);
    if(!$result){
      die ("Query Error: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
    }
    while ($data = mysqli_fetch_assoc($result)){ ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td width="2%" >BYR00<?php echo $data['id_pembayaran']; ?></td>
                <td><?php echo $data['nisn']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['tgl_bayar']; ?></td>
                <td><?php if($data['bulan_spp']=='Januari'){ echo "Januari"; }else if($data['bulan_spp']=='Februari'){ echo "Februari"; }else if($data['bulan_spp']=='Maret'){ echo "Maret"; }else if($data['bulan_spp']=='April'){ echo "April"; }else if($data['bulan_spp']=='Mei'){ echo "Mei"; }else if($data['bulan_spp']=='Juni'){ echo "Juni"; }else if($data['bulan_spp']=='Juli'){ echo "Juli"; } else if($data['bulan_spp']=='Agustus'){ echo "Agustus"; }else if($data['bulan_spp']=='September'){ echo "September"; }else if($data['bulan_spp']=='Oktober'){ echo "Oktober"; }else if($data['bulan_spp']=='November'){ echo "November"; }else if($data['bulan_spp']=='Desember'){ echo "Desember"; }?>
                </td>
                <?php  $spp = $data['id_spp'];?>
                <td><?=  $spp == '1' ?  '<p>2020</p>' :  ($spp == '2' ?  '<p>2021</p>' : ($spp == '3' ?  '<p>2022</p>' :'<p>2023</p>')) ?>
                </td>
                <td><?=  $spp == '1' ?  '<p>100K</p>' :  ($spp == '2' ?  '<p>120K</p>' : ($spp == '3' ?  '<p>150K</p>' : '<p>175K</p>')) ?>
                </td>
                <td><?php echo $data['jumlah_bayar']; ?>K</td>
                <?php $hargaspp = $spp == '1' ?  '100' :  ($spp == '2' ?  '120' : ($spp == '3' ?  '150' : '175'));  ?>
                <td><?= $hargaspp - $data['jumlah_bayar'];?>K</td>
                <?php  $status = $data['status'];?>
                <td><?= $status == '1' ?  '<a class="text-warning">Lunas</a>' :  '<a class="text-danger">Belum Lunas</a>' ?>
                <td><?php echo $data['nama_petugas']; ?></td>
            </tr>

            <?php
         
      }}
	  
      ?>
        </tbody>
    </table>
</body>

</html>