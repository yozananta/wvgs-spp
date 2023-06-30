<?php
session_start();

include "config/app.php";

$username = $_POST['username'];
$password = md5($_POST['password']);



	$q = mysqli_query($koneksi, "SELECT * from t_siswa where nama_pengguna='$username' and sandi='$password'");
	$r = mysqli_fetch_array($q);

	$q2 = mysqli_query($koneksi, "SELECT * from t_petugas where username='$username' and password='$password'");
	$row = mysqli_fetch_array($q2);

	if (mysqli_num_rows($q) == 1) {
		$_SESSION['nomorinduk'] = $r['nisn'];
		$_SESSION['nomorsiswa'] = $r['nis'];
		$_SESSION['namanya'] = $r['nama'];
		$_SESSION['username'] = $r['nama_pengguna'];
		$_SESSION['alamat'] = $r['alamat'];
		$_SESSION['telepon'] = $r['telepon'];
		$_SESSION['level'] = 'siswa';
		header('location:infoakun.php');
	} elseif (mysqli_num_rows($q2) == 1) {
		if ($row['level'] == "admin") {
			$_SESSION['petugas_id'] = $row['id_petugas'];
			$_SESSION['namanya'] = $row['nama_petugas'];
			$_SESSION['username'] = $username;
			$_SESSION['level'] = "admin";
			header("location:dashboard.php");
		} elseif ($row['level'] == "petugas") {
			$_SESSION['petugas_id'] = $row['id_petugas'];
			$_SESSION['namanya'] = $row['nama_petugas'];
			$_SESSION['username'] = $username;
			$_SESSION['level'] = "petugas";
			header("location:pembayaran.php");
		}
	} else {
		$_SESSION['gagal'] = "";
		header("location:index.php");
	}

?>