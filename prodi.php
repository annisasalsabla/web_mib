<?php

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
        ?>
        <h2>Daftar Program Studi</h2>
        <a href="index.php?p=prodi&aksi=tambah" class="btn btn-primary mb-3">Tambah Prodi</a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Prodi</th>
                <th>Jenjang Studi</th>
                <th>Aksi</th>
            </tr>
            <?php
            include 'koneksi.php';
            $ambil = mysqli_query($db, "SELECT * FROM prodi");
            $no = 1;
            while ($data = mysqli_fetch_array($ambil)) {
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['nama_prodi'] ?></td>
                    <td><?= $data['jenjang_studi'] ?></td>
                    <td>
                        <a href="index.php?p=prodi&aksi=edit&id_edit=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                        <a href="proses_prodi.php?proses=delete&id_hapus=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Delete</a>
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
        <h1 class="text-center mb-4">Tambah Program Studi</h1>
        <form action="proses_prodi.php?proses=insert" method="POST" class="mb-5">
            <!-- Nama Prodi Field -->
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
            </div>

            <!-- Jenjang Studi Field with Select Option -->
            <div class="mb-3">
                <label for="jenjang_studi" class="form-label">Jenjang Studi</label>
                <select class="form-select" id="jenjang_studi" name="jenjang_studi" required>
                    <option value="" disabled selected>Pilih Jenjang Studi</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="D3">D3</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
        <?php
        break;

    case 'edit':
        include 'koneksi.php';
        $id_edit = $_GET['id_edit'];
        $ambil_prodi = mysqli_query($db, "SELECT * FROM prodi WHERE id='$id_edit'");
        $data_prodi = mysqli_fetch_array($ambil_prodi);

        if (!$data_prodi) {
            echo "<h2>Data tidak ditemukan!</h2>";
            exit;
        }
        ?>
        <h1 class="text-center mb-4">Edit Program Studi</h1>
        <form action="proses_prodi.php?proses=update" method="POST" class="mb-5">
            <!-- Nama Prodi Field -->
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Program Studi</label>
                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= htmlspecialchars($data_prodi['nama_prodi']) ?>" required>
            </div>

            <!-- Jenjang Studi Field with Select Option -->
            <div class="mb-3">
                <label for="jenjang_studi" class="form-label">Jenjang Studi</label>
                <select class="form-select" id="jenjang_studi" name="jenjang_studi" required>
                    <option value="S1" <?= ($data_prodi['jenjang_studi'] == 'S1') ? 'selected' : ''; ?>>S1</option>
                    <option value="S2" <?= ($data_prodi['jenjang_studi'] == 'S2') ? 'selected' : ''; ?>>S2</option>
                    <option value="D3" <?= ($data_prodi['jenjang_studi'] == 'D3') ? 'selected' : ''; ?>>D3</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
        <?php
        break;
}
?>
