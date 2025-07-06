<?php
session_start();
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran Sekolah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Daftar Siswa</h2>
            <small class="text-muted">Selamat datang, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></small>
        </div>
        <div>
            <a href="tambah.php" class="btn btn-primary me-2">
                <i class="fas fa-plus me-1"></i>Tambah Siswa
            </a>
            <button id="logoutBtn" class="btn btn-outline-danger">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </button>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>JK</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $result = mysqli_query($conn, "SELECT * FROM siswa");

            if (!$result) {
                echo "<tr><td colspan='6'>Gagal mengambil data: " . htmlspecialchars(mysqli_error($conn)) . "</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['alamat']) . "</td>
                        <td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>
                                <td>
            <a href='edit.php?id=" . urlencode($row['id']) . "' class='btn btn-warning btn-sm'>
                <i class='fas fa-edit me-1'></i>Edit
            </a>
            <a href='hapus.php?id=" . urlencode($row['id']) . "' onclick=\"return confirm('Yakin ingin menghapus?')\" class='btn btn-danger btn-sm'>
                <i class='fas fa-trash me-1'></i>Hapus
            </a>
        </td>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#logoutBtn').on('click', function() {
        if (confirm('Yakin ingin logout?')) {
            $.ajax({
                url: 'auth_handler.php',
                type: 'POST',
                data: {
                    action: 'logout'
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.href = 'login.php';
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat logout');
                }
            });
        }
    });
});
</script>
</body>
</html>
