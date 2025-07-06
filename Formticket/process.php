<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "ticket_db";

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die(json_encode([
        'success' => false,
        'message' => "Koneksi gagal: " . $conn->connect_error
    ]));
}

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$jenis_tiket = $_POST['jenis_tiket'];
$jumlah = $_POST['jumlah'];
$tanggal_pengambilan = $_POST['tanggal_pengambilan'];

// Query untuk menyimpan ke tabel pemesanan_tiket
$sql = "INSERT INTO pemesanan_tiket (nama, email, jenis_tiket, jumlah, tanggal_pengambilan)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssis", $nama, $email, $jenis_tiket, $jumlah, $tanggal_pengambilan);

// Eksekusi query
if ($stmt->execute()) {
    $ticket_id = $conn->insert_id;
    
    // Ambil data tiket yang baru dibuat
    $sql = "SELECT *, DATE_FORMAT(tanggal_pesen, '%d-%m-%Y %H:%i') as formatted_tanggal_pesen 
            FROM pemesanan_tiket WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();
    
    echo json_encode([
        'success' => true,
        'id' => $ticket['id'],
        'nama' => $ticket['nama'],
        'email' => $ticket['email'],
        'jenis_tiket' => $ticket['jenis_tiket'],
        'jumlah' => $ticket['jumlah'],
        'tanggal_pesen' => $ticket['formatted_tanggal_pesen'],
        'tanggal_pengambilan' => $ticket['tanggal_pengambilan']
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => "Error: " . $stmt->error
    ]);
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
