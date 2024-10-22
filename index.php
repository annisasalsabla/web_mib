<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>APP MI-Department</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">APP TI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= isset($_GET['p']) && $_GET['p'] == 'home' ? 'active' : '' ?>" aria-current="page" href="index.php?p=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isset($_GET['p']) && $_GET['p'] == 'mhs' ? 'active' : '' ?>" href="index.php?p=mhs">Mahasiswa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isset($_GET['p']) && $_GET['p'] == 'prodi' ? 'active' : '' ?>" href="index.php?p=prodi">Prodi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isset($_GET['p']) && $_GET['p'] == 'dosen' ? 'active' : '' ?>" href="index.php?p=dosen">Dosen</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <?php
        // Modifikasi dengan hanya menggunakan else untuk include file
        $page = isset($_GET['p']) ? $_GET['p'] : 'home';

        if ($page == 'mhs') {
            include 'mahasiswa.php';
        } elseif ($page == 'edit_mhs') {
            include 'edit_mahasiswa.php';
        } elseif ($page == 'create_mhs') {
            include 'mahasiswa.php';
        } elseif ($page == 'prodi') {
            include 'prodi.php';
        } elseif ($page == 'edit_prodi') {
            include 'edit_prodi.php';
        } elseif ($page == 'create_prodi') {
            include 'prodi.php';
        } elseif ($page == 'dosen') {
            include 'dosen.php';
        } elseif ($page == 'edit_dosen') {
            include 'edit_dosen.php';
        } elseif ($page == 'create_dosen') {
            include 'dosen.php';
        } else {
            include 'home.php';  
        }
    ?>
</div>

</body>
</html>
