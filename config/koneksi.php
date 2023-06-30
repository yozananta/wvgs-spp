<?php
$koneksi=mysqli_connect('localhost','root','','db_spp');

	if(mysqli_connect_error()){
		printf("Connect Failed:", mysqli_connect_error());
		exit();
	}

?>



