<?php

// Insert Prodi
if (isset($_GET['proses']) && $_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';

        // Sanitize inputs
        $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);
        $jenjang_studi = mysqli_real_escape_string($db, $_POST['jenjang_studi']);

        // Prepare and execute the query
        $sql = mysqli_query($db, "INSERT INTO prodi (nama_prodi, jenjang_studi) 
                VALUES ('$nama_prodi', '$jenjang_studi')");
        
        if ($sql) {
            echo "<script>window.location='index.php?p=prodi'</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}

// Update Prodi
if (isset($_GET['proses']) && $_GET['proses'] == 'update') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';

        // Sanitize inputs
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);
        $jenjang_studi = mysqli_real_escape_string($db, $_POST['jenjang_studi']);

        // Prepare and execute the update query
        $sql = mysqli_query($db, "UPDATE prodi SET nama_prodi='$nama_prodi', jenjang_studi='$jenjang_studi' WHERE id='$id'");
        
        if ($sql) {
            echo "<script>alert('Data berhasil disimpan!'); window.location='index.php?p=prodi'</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data.');</script>";
        }
    }
}

// Delete Prodi
if (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    include 'koneksi.php';

    $id = mysqli_real_escape_string($db, $_GET['id_hapus']);
    $hapus = mysqli_query($db, "DELETE FROM prodi WHERE id = '$id'");
    
    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=prodi'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.');</script>";
    }
}
?>
