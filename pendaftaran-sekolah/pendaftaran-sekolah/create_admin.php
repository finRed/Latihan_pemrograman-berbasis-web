<?php
include 'config.php';

// Check if admin user already exists
$check_admin = mysqli_query($conn, "SELECT id FROM users WHERE role = 'admin' LIMIT 1");

if (mysqli_num_rows($check_admin) > 0) {
    echo "Admin user already exists!";
    exit();
}

// Create admin user
$admin_username = "admin";
$admin_email = "admin@sekolah.com";
$admin_password = "admin123"; // Change this password!
$admin_nama = "Administrator";
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password, nama_lengkap, role) VALUES (?, ?, ?, ?, 'admin')");
mysqli_stmt_bind_param($stmt, "ssss", $admin_username, $admin_email, $hashed_password, $admin_nama);

if (mysqli_stmt_execute($stmt)) {
    echo "Admin user created successfully!<br>";
    echo "Username: " . $admin_username . "<br>";
    echo "Password: " . $admin_password . "<br>";
    echo "<br><strong>IMPORTANT:</strong> Please change the admin password after first login and delete this file for security!";
} else {
    echo "Failed to create admin user: " . mysqli_error($conn);
}
?> 