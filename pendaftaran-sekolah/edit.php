<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? 0;
$data = mysqli_query($conn, "SELECT * FROM siswa WHERE id=$id");
$row = mysqli_fetch_assoc($data);

if (!$row) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - Sistem Pendaftaran Sekolah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Siswa</h2>
        <a href="index.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Kembali
        </a>
    </div>
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $row['alamat']; ?></textarea>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label><br>
            <input type="radio" name="jk" value="Laki-laki" <?= ($row['jenis_kelamin'] == 'Laki-laki') ? 'checked' : '' ?>> Laki-laki
            <input type="radio" name="jk" value="Perempuan" <?= ($row['jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?>> Perempuan
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $row['tanggal_lahir']; ?>" required>
        </div>
        <button name="update" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>Update
        </button>
    </form>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $tgl = $_POST['tanggal_lahir'];

    mysqli_query($conn, "UPDATE siswa SET nama='$nama', alamat='$alamat', jenis_kelamin='$jk', tanggal_lahir='$tgl' WHERE id=$id");
    echo "<script>window.location='index.php';</script>";
}
?>
</body>
</html>
