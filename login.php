<?php
// ============================================
// login.php — Form Login & Autentikasi
// Pertemuan 14: Login & Session PHP
// ============================================
session_start();

// Jika sudah login, langsung ke index
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

include 'config.php';

$error = '';

// ==========================================
// PROSES LOGIN (POST)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Username dan password wajib diisi.";
    } else {
        try {
            $pdo = new PDO($dsn, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Ambil data user berdasarkan username
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
            $stmt->execute([':username' => $username]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifikasi password dengan password_verify() (aman, tidak plain text)
            if ($userData && password_verify($password, $userData['password'])) {
                // Simpan data sesi
                $_SESSION['user'] = [
                    'id'       => $userData['id'],
                    'username' => $userData['username'],
                    'level'    => $userData['level'],
                ];
                header("Location: index.php");
                exit;
            } else {
                $error = "Username atau password salah. Silakan coba lagi.";
            }
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Simple ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
        }
        .login-header {
            background-color: #343a40;
            color: #fff;
            border-radius: .375rem .375rem 0 0;
            padding: 2rem;
            text-align: center;
        }
        .login-header h2 {
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: .25rem;
        }
        .login-header p {
            color: #adb5bd;
            font-size: .9rem;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <div style="font-size:2.5rem;">🏭</div>
            <h2>ERP Kampus</h2>
            <p>Sistem Manajemen Produk & Stok</p>
        </div>
        <div class="card shadow border-0" style="border-radius: 0 0 .375rem .375rem;">
            <div class="card-body p-4">

                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($error); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                            required
                            autofocus
                        >
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">
                        🔐 LOGIN
                    </button>
                </form>

                <p class="text-center text-muted small mt-3 mb-0">
                    &copy; <?php echo date('Y'); ?> Simple ERP &mdash; Fullstack Class
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
