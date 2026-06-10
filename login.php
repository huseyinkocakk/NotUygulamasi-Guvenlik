<?php
session_start();
require "db.php";

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];

            header("Location: dashboard.php");
            exit;
        } else {
            $mesaj = "E-posta veya şifre hatalı.";
        }
    } else {
        $mesaj = "Lütfen tüm alanları doldurun.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            min-height: 100vh;
        }

        .login-card {
            border-radius: 25px;
        }

        .side-box {
            background-color: #f8f9fa;
            border-radius: 20px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand fw-bold fs-4 text-decoration-none">
            Hobi Kulübü
        </a>

        <a href="register.php" class="btn btn-warning">
            Üye Ol
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="card login-card shadow-lg border-0 p-4 p-md-5 mt-4">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h2 class="fw-bold mb-2">Giriş Yap</h2>
                <p class="text-muted mb-4">
                    Etkinlik panelinize erişmek için hesabınıza giriş yapın.
                </p>

                <?php if ($mesaj): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($mesaj) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">E-posta</label>
                        <input type="email" name="email" class="form-control" placeholder="E-posta adresinizi girin">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="password" class="form-control" placeholder="Şifrenizi girin">
                    </div>

                    <button class="btn btn-primary w-100">
                        Giriş Yap
                    </button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Hesabınız yok mu? <a href="register.php">Üye Ol</a>
                </p>
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
                <div class="side-box p-4">
                    <h4 class="fw-bold mb-3">Panelde Neler Var?</h4>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent">
                            Etkinliklerinizi görüntüleyebilirsiniz.
                        </li>
                        <li class="list-group-item bg-transparent">
                            Yeni etkinlik kayıtları oluşturabilirsiniz.
                        </li>
                        <li class="list-group-item bg-transparent">
                            Kayıtlı etkinliklerinizi güncelleyebilirsiniz.
                        </li>
                        <li class="list-group-item bg-transparent">
                            İstemediğiniz etkinlikleri silebilirsiniz.
                        </li>
                    </ul>

                    <div class="alert alert-success mt-4 mb-0">
                        Devam etmek için giriş bilgilerinizi kullanın.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>