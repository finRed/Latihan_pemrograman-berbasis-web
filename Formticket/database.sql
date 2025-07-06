CREATE DATABASE IF NOT EXISTS ticket_db;
USE ticket_db;

CREATE TABLE IF NOT EXISTS pemesanan_tiket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    jenis_tiket VARCHAR(50) NOT NULL,
    jumlah INT NOT NULL,
    tanggal_pesen TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tanggal_pengambilan DATE NOT NULL,
    status ENUM('pending', 'completed') DEFAULT 'pending'
);
