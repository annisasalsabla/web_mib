<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
        ?>
        <h2>Daftar Dosen</h2>
        <a href="index.php?p=dosen&aksi=tambah" class="btn btn-primary mb-3">Tambah Dosen</a>
        <table class="table table-bordered table-hover">
    <tr>
        <th>No</th>
        <th>NIP</th>
        <th>Nama Dosen</th>
        <th>Email</th>
        <th>Prodi</th> <!-- Ganti jadi Nama Prodi -->
        <th>No Telepon</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php
    include 'koneksi.php';
    // Query to get dosen and related prodi with nama_prodi instead of prodi_id
    $ambil = mysqli_query($db, "SELECT dosen.*, prodi.nama_prodi FROM dosen 
                                LEFT JOIN prodi ON dosen.prodi_id = prodi.id");
    $no = 1;
    while ($data = mysqli_fetch_array($ambil)) {
        ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $data['nip'] ?></td>
            <td><?= $data['nama_dosen'] ?></td>
            <td><?= $data['email'] ?></td>
            <td><?= $data['prodi_id'] ?></td> <!-- Tampilkan Nama Prodi -->
            <td><?= $data['no_telp'] ?></td>
            <td><?= $data['alamat'] ?></td>
            <td>
                <a href="index.php?p=dosen&aksi=edit&id_edit=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                <a href="proses_dosen.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Delete</a>
            </td>
        </tr>
        <?php
        $no++;
    }
    ?>
</table>

        <?php
        break;

    case 'tambah':
        ?>
        <h1 class="text-center mb-4">Tambah Dosen</h1>
        <form action="proses_dosen.php?proses=insert" method="POST" class="mb-5">
    <!-- Nama Dosen Field -->
    <div class="mb-3">
        <label for="nama_dosen" class="form-label">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
    </div>

    <!-- NIP Field -->
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="text" class="form-control" id="nip" name="nip" required>
    </div>

    <!-- Email Field -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <!-- Prodi Selection (Tampilkan Nama Prodi, Simpan ID Prodi) -->
    <div class="mb-3">
        <label for="prodi_id" class="form-label">Prodi</label>
        <select class="form-select" id="prodi_id" name="prodi_id" required>
            <option value="" disabled selected>Pilih Prodi</option>
            <?php
            include 'koneksi.php';
            $prodi_query = mysqli_query($db, "SELECT * FROM prodi");
            while ($prodi = mysqli_fetch_array($prodi_query)) {
                echo "<option value='" . $prodi['id'] . "'>" . $prodi['nama_prodi'] . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- No Telepon Field -->
    <div class="mb-3">
        <label for="no_telp" class="form-label">No Telepon</label>
        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
    </div>

    <!-- Alamat Field -->
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
</form>

        <?php
        break;

    case 'edit':
        include 'koneksi.php';
        $id_edit = $_GET['id_edit'];
        $ambil_dosen = mysqli_query($db, "SELECT * FROM dosen WHERE id='$id_edit'");
        $data_dosen = mysqli_fetch_array($ambil_dosen);

        if (!$data_dosen) {
            echo "<h2>Data tidak ditemukan!</h2>";
            exit;
        }
        ?>
        <h1 class="text-center mb-4">Edit Dosen</h1>
        <form action="proses_dosen.php?proses=update" method="POST" class="mb-5">
    <!-- Nama Dosen Field -->
    <div class="mb-3">
        <label for="nama_dosen" class="form-label">Nama Dosen</label>
        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= htmlspecialchars($data_dosen['nama_dosen']) ?>" required>
    </div>

    <!-- NIP Field (Readonly) -->
    <div class="mb-3">
        <label for="nip" class="form-label">NIP</label>
        <input type="hidden" name="id_edit" class="form-control" value="<?=$data_dosen['id']?>">
        <input type="text" class="form-control" id="nip" name="nip" value="<?= htmlspecialchars($data_dosen['nip']) ?>" required readonly>
    </div>

    <!-- Email Field -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($data_dosen['email']) ?>" required>
    </div>

    <!-- Prodi Selection (Tampilkan Nama Prodi, Simpan ID Prodi) -->
    <div class="mb-3">
        <label for="prodi_id" class="form-label">Prodi</label>
        <select class="form-select" id="prodi_id" name="prodi_id" required>
            <?php
            $prodi_query = mysqli_query($db, "SELECT * FROM prodi");
            while ($prodi = mysqli_fetch_array($prodi_query)) {
                $selected = ($data_dosen['prodi_id'] == $prodi_id['id']) ? 'selected' : '';
                echo "<option value='" . $prodi['id'] . "' ".$selected.">" . $prodi['nama_prodi'] . "</option>";
            }
            ?>
        </select>
    </div>

    <!-- No Telepon Field -->
    <div class="mb-3">
        <label for="no_telp" class="form-label">No Telepon</label>
        <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?= htmlspecialchars($data_dosen['no_telp']) ?>" required>
    </div>

    <!-- Alamat Field -->
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($data_dosen['alamat']) ?></textarea>
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>

        <?php
        break;
}
?>