

<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
        ?>
        <h2>Daftar Mahasiswa</h2>
        <a href="index.php?p=mhs&aksi=tambah" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
        <table class="table table-bordered table-hover">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Hobi</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php
            include 'koneksi.php';
            $ambil = mysqli_query($db, "SELECT * FROM mahasiswa");
            $no = 1;
            while ($data = mysqli_fetch_array($ambil)) {
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['nim'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['tanggal_lahir'] ?></td>
                    <td><?= $data['jenis_kelamin'] ?></td>
                    <td><?= $data['hobi'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td>
                        <a href="index.php?p=mhs&aksi=edit&id_edit=<?= $data['nim'] ?>" class="btn btn-warning">Edit</a>
                        <a href="proses_mahasiswa.php?proses=delete&id_hapus=<?= $data['nim'] ?>" class="btn btn-danger" onclick="return confirm('Yakin akan menghapus data?')">Delete</a>
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
        <h1 class="text-center mb-4">Registrasi Mahasiswa</h1>
        <form action="proses_mahasiswa.php?proses=insert" method="POST" class="mb-5">
            <!-- Nama Field -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <!-- NIM Field -->
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>

            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Tanggal Lahir Fields -->
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <div class="row">
                    <div class="col">
                        <select class="form-select" name="day" required>
                            <option value="" disabled selected>Hari</option>
                            <?php for ($i = 1; $i <= 31; $i++) : ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" name="month" required>
                            <option value="" disabled selected>Bulan</option>
                            <?php for ($i = 1; $i <= 12; $i++) : ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" name="year" required>
                            <option value="" disabled selected>Tahun</option>
                            <?php for ($i = 1980; $i <= 2024; $i++) : ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Jenis Kelamin Field -->
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" required>
                    <label class="form-check-label" for="laki_laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>

            <!-- Hobi Field -->
            <div class="mb-3">
                <label class="form-label">Hobi</label>
                <div class="d-flex flex-wrap">
                    <?php
                    $hobi_options = ['Memasak', 'Membaca Buku', 'Olahraga', 'Mendengarkan Musik'];
                    foreach ($hobi_options as $hobi) {
                        echo "
                        <div class='form-check form-check-inline'>
                            <input class='form-check-input' type='checkbox' name='hobi[]' id='$hobi' value='$hobi'>
                            <label class='form-check-label' for='$hobi'>$hobi</label>
                        </div>";
                    }
                    ?>
                </div>
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
        $nim_edit = $_GET['id_edit'];
        $ambil_mhs = mysqli_query($db, "SELECT * FROM mahasiswa WHERE nim='$nim_edit'");
        $data_mhs = mysqli_fetch_array($ambil_mhs);

        if (!$data_mhs) {
            echo "<h2>Data tidak ditemukan!</h2>";
            exit;
        }

        $tgl = explode("-", $data_mhs['tanggal_lahir']);
        ?>
        <h1 class="text-center mb-4">Edit Mahasiswa</h1>
        <form action="proses_mahasiswa.php?proses=update" method="POST" class="mb-5">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($data_mhs['nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= htmlspecialchars($data_mhs['nim']) ?>" required readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($data_mhs['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <div class="row">
                    <div class="col">
                        <select class="form-select" name="day" required>
                            <option value="" disabled>Hari</option>
                            <?php for ($i = 1; $i <= 31; $i++): ?>
                                <option value="<?= $i ?>" <?= ($tgl[2] == $i) ? 'selected' : ''; ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" name="month" required>
                            <option value="" disabled>Bulan</option>
                            <?php for ($i = 1; $i <= 12; $i++): ?>
                                <option value="<?= $i ?>" <?= ($tgl[1] == $i) ? 'selected' : ''; ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" name="year" required>
                            <option value="" disabled>Tahun</option>
                            <?php for ($i = 1980; $i <= 2024; $i++): ?>
                                <option value="<?= $i ?>" <?= ($tgl[0] == $i) ? 'selected' : ''; ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki" value="Laki-laki" <?= ($data_mhs['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="laki_laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" <?= ($data_mhs['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>

            <div class="mb-3">
            <label class="form-label">Hobi</label>
            <div class="d-flex flex-wrap">
                <?php
                $hobi_arr = explode(",", $data_mhs['hobi']);
                $hobi_options = ['Memasak', 'Membaca Buku', 'Olahraga', 'Mendengarkan Musik'];

                foreach ($hobi_options as $hobi) {
                    $checked = in_array($hobi, $hobi_arr) ? 'checked' : '';
                    echo "<div class='form-check form-check-inline'>
                            <input class='form-check-input' type='checkbox' name='hobi[]' id='$hobi' value='$hobi' $checked>
                            <label class='form-check-label' for='$hobi'>$hobi</label>
                          </div>";
                }
                ?>
            </div>
        </div>




            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= htmlspecialchars($data_mhs['alamat']) ?></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
        <?php
        break;

   
}
?>


