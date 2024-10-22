<?php

if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';

        // Sanitize inputs
        $nama = mysqli_real_escape_string($db, $_POST['nama']);
        $nim = mysqli_real_escape_string($db, $_POST['nim']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $jenis_kelamin = mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
        $tanggal_lahir = mysqli_real_escape_string($db, $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']);
        $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
        $hobies = isset($_POST['hobi']) ? implode(",", $_POST['hobi']) : '';

        // Prepare and execute the query
        $sql = mysqli_query($db, "INSERT INTO mahasiswa (nim, nama, email, jenis_kelamin, tanggal_lahir, hobi, alamat) 
                VALUES ('$nim', '$nama', '$email', '$jenis_kelamin', '$tanggal_lahir', '$hobies', '$alamat')");
        
        if ($sql) {
            echo "<script>window.location='index.php?p=mhs'</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';

        // Sanitize inputs
        $nama = mysqli_real_escape_string($db, $_POST['nama']);
        $nim = mysqli_real_escape_string($db, $_POST['nim']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $jenis_kelamin = mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
        $tanggal_lahir = mysqli_real_escape_string($db, $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day']);
        $alamat = mysqli_real_escape_string($db, $_POST['alamat']);
        $hobies = isset($_POST['hobi']) ? implode(",", $_POST['hobi']) : '';

        // Prepare and execute the update query
        $sql = mysqli_query($db, "UPDATE mahasiswa SET nama='$nama', email='$email', jenis_kelamin='$jenis_kelamin', 
                                  tanggal_lahir='$tanggal_lahir', hobi='$hobies', alamat='$alamat' WHERE nim='$nim'");
        
        if ($sql) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='index.php?p=mhs'</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}

if (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    include 'koneksi.php';

    $nim = mysqli_real_escape_string($db, $_GET['id_hapus']);
    $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE nim = '$nim'");
    
    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=mhs'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
    }
}
?>
