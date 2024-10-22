<?php

// Periksa jika proses insert, update, atau delete dilakukan

    // Proses Insert Data
    
   
    // Proses Update Data 
   
    if ($_GET['proses'] == 'insert')
    {
        if (isset($_POST['submit'])) {
            include 'koneksi.php';
          
            $sql = "INSERT INTO dosen (nip, nama_dosen, email, prodi_id,no_telp, alamat) 
                    VALUES ('$_POST[nip]', '$_POST[nama_dosen]', '$_POST[email]', '$_POST[prodi_id]', '$_POST[no_telp]', '$_POST[alamat]')";
      
            if (mysqli_query($db, $sql)) {
      
              //kalau tidak berhasil redirect pakai java script
      
              echo "<script> window.location='index.php?p=dosen'
              </script>";
             // header('location:index.php?p=mhs'); //redirect
              //echo "<script>alert('Data berhasil disimpan')</script>";
            } else {
              echo "Error: " . mysqli_error($db);
            }
          }
    }

    if ($_GET['proses'] == 'update')
    {
        if (isset($_POST['submit'])) {
            include 'koneksi.php';
            
            $simpan =mysqli_query($db, "Update  dosen 
                    set  nip='$_POST[nip]', 
                    nama_dosen ='$_POST[nama_dosen]',
                    email ='$_POST[email]',
                    prodi_id = '$_POST[prodi_id]',
                    no_telp ='$_POST[no_telp]',
                    alamat = '$_POST[alamat]'


                     WHERE id='$_POST[id_edit]'
                    "    
                  );
          
            if ($simpan) {
          
              //kalau tidak berhasil redirect pakai java script
          
              echo "<script> window.location='index.php?p=dosen'
              </script>";
             // header('location:index.php?p=mhs'); //redirect
              //echo "<script>alert('Data berhasil disimpan')</script>";
            } else {
              echo "Error: " . mysqli_error($db);
            }
          }
    }

   if (isset($_GET['proses']) && $_GET['proses'] == 'delete') {
    include 'koneksi.php';

    // Sanitasi input id untuk menghindari SQL Injection
    $id = mysqli_real_escape_string($db, $_GET['id']);

    // Query untuk menghapus data dosen berdasarkan id
    $hapus = mysqli_query($db, "DELETE FROM dosen WHERE id = '$id'");
    
    // Cek apakah penghapusan berhasil
    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php?p=dosen'</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.'); window.history.back();</script>";
    }
}


?>