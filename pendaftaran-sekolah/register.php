<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Pendaftaran Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .register-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .register-body {
            padding: 40px 30px;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .loading {
            display: none;
        }
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        .password-strength {
            height: 5px;
            border-radius: 3px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }
        .strength-weak { background-color: #dc3545; }
        .strength-medium { background-color: #ffc107; }
        .strength-strong { background-color: #28a745; }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="register-header">
            <i class="fas fa-user-plus fa-3x mb-3"></i>
            <h3>Daftar Akun Baru</h3>
            <p class="mb-0">Buat akun untuk mengakses sistem</p>
        </div>
        <div class="register-body">
            <div id="alert-container"></div>
            
            <form id="registerForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-floating">
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                    <label for="nama_lengkap"><i class="fas fa-id-card me-2"></i>Nama Lengkap</label>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                    <div class="password-strength" id="passwordStrength"></div>
                </div>
                
                <div class="form-floating">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required>
                    <label for="confirm_password"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-register">
                    <span class="loading">
                        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                        Loading...
                    </span>
                    <span class="normal">
                        <i class="fas fa-user-plus me-2"></i>Daftar
                    </span>
                </button>
            </form>
            
            <div class="text-center mt-4">
                <p class="mb-0">Sudah punya akun? <a href="login.php" class="text-decoration-none">Login disini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Password strength checker
            $('#password').on('input', function() {
                const password = $(this).val();
                const strength = checkPasswordStrength(password);
                updatePasswordStrength(strength);
            });
            
            function checkPasswordStrength(password) {
                let score = 0;
                
                if (password.length >= 8) score++;
                if (/[a-z]/.test(password)) score++;
                if (/[A-Z]/.test(password)) score++;
                if (/[0-9]/.test(password)) score++;
                if (/[^A-Za-z0-9]/.test(password)) score++;
                
                if (score < 3) return 'weak';
                if (score < 5) return 'medium';
                return 'strong';
            }
            
            function updatePasswordStrength(strength) {
                const strengthBar = $('#passwordStrength');
                strengthBar.removeClass('strength-weak strength-medium strength-strong');
                
                if (strength === 'weak') {
                    strengthBar.addClass('strength-weak');
                } else if (strength === 'medium') {
                    strengthBar.addClass('strength-medium');
                } else {
                    strengthBar.addClass('strength-strong');
                }
            }
            
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                
                const username = $('#username').val().trim();
                const email = $('#email').val().trim();
                const nama_lengkap = $('#nama_lengkap').val().trim();
                const password = $('#password').val();
                const confirm_password = $('#confirm_password').val();
                
                // Validation
                if (!username || !email || !nama_lengkap || !password || !confirm_password) {
                    showAlert('Mohon isi semua field yang diperlukan', 'danger');
                    return;
                }
                
                if (password !== confirm_password) {
                    showAlert('Password dan konfirmasi password tidak cocok', 'danger');
                    return;
                }
                
                if (password.length < 6) {
                    showAlert('Password minimal 6 karakter', 'danger');
                    return;
                }
                
                if (!isValidEmail(email)) {
                    showAlert('Format email tidak valid', 'danger');
                    return;
                }
                
                // Show loading state
                $('.loading').show();
                $('.normal').hide();
                $('button[type="submit"]').prop('disabled', true);
                
                $.ajax({
                    url: 'auth_handler.php',
                    type: 'POST',
                    data: {
                        action: 'register',
                        username: username,
                        email: email,
                        nama_lengkap: nama_lengkap,
                        password: password
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            showAlert(response.message, 'success');
                            setTimeout(function() {
                                window.location.href = 'login.php';
                            }, 2000);
                        } else {
                            showAlert(response.message, 'danger');
                        }
                    },
                    error: function(xhr, status, error) {
                        showAlert('Terjadi kesalahan pada server. Silakan coba lagi.', 'danger');
                    },
                    complete: function() {
                        // Hide loading state
                        $('.loading').hide();
                        $('.normal').show();
                        $('button[type="submit"]').prop('disabled', false);
                    }
                });
            });
            
            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }
            
            function showAlert(message, type) {
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                $('#alert-container').html(alertHtml);
                
                // Auto dismiss after 5 seconds
                setTimeout(function() {
                    $('.alert').fadeOut();
                }, 5000);
            }
        });
    </script>
</body>
</html> 