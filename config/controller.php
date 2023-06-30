<?php

function select($query){
    global $koneksi;

    $result = mysqli_query($koneksi, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}


//..............................................PUNYA PEMBAYARAN...................................................//


function create_pembayaran($post)
{
    global $koneksi;

    $id_petugas = $_SESSION['petugas_id'];
    $nisn = $post['nisn'];
    $bulan_spp = $post['bulan_spp'];
    $jumlah_bayar = $post['jumlah_bayar'];
    $status = $post['status'];

    $query = "INSERT INTO t_pembayaran VALUES (null, '$id_petugas', '$nisn',null, '$bulan_spp', '$jumlah_bayar', '$status')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function update_pembayaran($post)
{
    global $koneksi;

    $id_pembayaran = $post['id_pembayaran'];
    $nisn = $post['nisn'];
    $bulan_spp = $post['bulan_spp'];
    $jumlah_bayar = $post['jumlah_bayar'];
    $status = $post['status'];

    $query = "UPDATE t_pembayaran SET nisn = '$nisn' , bulan_spp = '$bulan_spp' , jumlah_bayar = '$jumlah_bayar', status = '$status' WHERE id_pembayaran = $id_pembayaran";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function delete_pembayaran($id_pembayaran)
{
    global $koneksi;

    $query = "DELETE FROM t_pembayaran WHERE id_pembayaran = $id_pembayaran";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


//..............................................PUNYA SISWA...................................................//


function create_siswa($post)
{
    global $koneksi;

    $nisn = $post['nisn'];
    $nis = $post['nis'];
    $nama = $post['nama'];
    $nama_pengguna = $post['nama_pengguna'];
    $sandi = md5($post['sandi']);
    $id_kelas = $post['id_kelas'];
    $alamat = $post['alamat'];
    $telepon = $post['telepon'];
    $id_spp = $post['id_spp'];
    $role = $post['role'];

    $query = "INSERT INTO t_siswa VALUES ('$nisn' , '$nis', '$nama', '$nama_pengguna' , '$sandi', '$id_kelas', '$alamat', '$telepon', '$id_spp', '$role')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function update_siswa($post)
{
    global $koneksi;

    $nisn = $post['nisn'];
    $nis = $post['nis'];
    $nama = $post['nama'];
    $nama_pengguna = $post['nama_pengguna'];
    $sandi = md5($post['sandi']);
    $id_kelas = $post['id_kelas'];
    $alamat = $post['alamat'];
    $telepon = $post['telepon'];
    $id_spp = $post['id_spp'];
    $role = $post['role'];

    $query = "UPDATE t_siswa SET nisn = '$nisn', nis = '$nis' , nama = '$nama', nama_pengguna = '$nama_pengguna', sandi = '$sandi', id_kelas = '$id_kelas' , alamat = '$alamat' , telepon = '$telepon', id_spp = '$id_spp', role = '$role' WHERE nisn = $nisn";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function delete_siswa($nisn)
{
    global $koneksi;

    $query = "DELETE FROM t_siswa WHERE nisn = $nisn";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}



//..............................................PUNYA KELAS...................................................//


function create_kelas($post)
{
    global $koneksi;

    $nama_kelas = $post['nama_kelas'];
    $jurusan = $post['jurusan'];

    $query = "INSERT INTO t_kelas VALUES (null, '$nama_kelas', '$jurusan')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function update_kelas($post)
{
    global $koneksi;

    $id_kelas = $post['id_kelas'];
    $nama_kelas = $post['nama_kelas'];
    $jurusan = $post['jurusan'];

    $query = "UPDATE t_kelas SET nama_kelas = '$nama_kelas', jurusan = '$jurusan' WHERE id_kelas = $id_kelas";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function delete_kelas($id_kelas)
{
    global $koneksi;

    $query = "DELETE FROM t_kelas WHERE id_kelas = $id_kelas";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


// // //..............................................PUNYA AKUN...................................................//



function create_akun($post)
{
    global $koneksi;

    $username = $post['username'];
    $password = md5($post['password']);
    $nama_petugas = $post['nama_petugas'];
    $level = $post['level'];

    $query = "INSERT INTO t_petugas VALUES (null,'$username','$password', '$nama_petugas','$level')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
    

}


function update_akun($post)
{
    global $koneksi;

    $id_petugas = $post ['id_petugas'];
    $username = $post['username'];
    $password = md5($post['password']);
    $nama_petugas = $post['nama_petugas'];
    $level = $post['level'];

    $query = "UPDATE t_petugas SET  username = '$username' , password = '$password' , nama_petugas = '$nama_petugas', level = '$level' WHERE id_petugas = $id_petugas";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function delete_akun($id_petugas)
{
    global $koneksi;

    $query = "DELETE FROM t_petugas WHERE id_petugas = $id_petugas";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// // //..............................................PUNYA SPP...................................................//



function create_spp($post)
{
    global $koneksi;

    $tahun = $post['tahun'];
    $nominal = $post['nominal'];

    $query = "INSERT INTO t_spp VALUES (null,'$tahun','$nominal')";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
    

}


function update_spp($post)
{
    global $koneksi;

    $id_spp = $post ['id_spp'];
    $tahun = $post['tahun'];
    $nominal = $post['nominal'];

    $query = "UPDATE t_spp SET  tahun = '$tahun' , nominal = '$nominal'  WHERE id_spp = $id_spp";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function delete_spp($id_spp)
{
    global $koneksi;

    $query = "DELETE FROM t_spp WHERE id_spp = $id_spp";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}