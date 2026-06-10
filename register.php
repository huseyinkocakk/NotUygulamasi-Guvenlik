<?php
require "db.php";

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($username && $email && $password) {
        $hashli_sifre = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashli_sifre]);
            header("Location: login.php");
            exit;
        } catch (PDOException $e) {
            $mesaj = "Bu kullanıcı adı veya e-posta zaten kayıtlı.";
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
    <title>Üye Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            min-height: 100vh;
        }

        .register-card {
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

        <a href="login.php" class="btn btn-outline-light">
            Giriş Yap
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="card register-card shadow-lg border-0 p-4 p-md-5 mt-4">
        <div class="row align-items-center">

            <div class="col-md-6">
                <h2 class="fw-bold mb-2">Üye Ol</h2>
                <p class="text-muted mb-4">
                    Etkinliklerinizi yönetmek için hesabınızı oluşturun.
                </p>

                <?php if ($mesaj): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($mesaj) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Kullanıcı Adı</label>
                        <input type="text" name="username" class="form-control" placeholder="Kullanıcı adınızı girin">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-posta</label>
                        <input type="email" name="email" class="form-control" placeholder="E-posta adresinizi girin">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="password" class="form-control" placeholder="Şifrenizi girin">
                    </div>

                    <button class="btn btn-primary w-100">
                        Üye Ol
                    </button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Zaten hesabınız var mı? <a href="login.php">Giriş Yap</a>
                </p>
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
                <div class="side-box p-4">
                    <h4 class="fw-bold mb-3">Üyelik Avantajları</h4>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent">
                            Kendi etkinliklerinizi oluşturabilirsiniz.
                        </li>
                        <li class="list-group-item bg-transparent">
                            Etkinliklerinizi panelden takip edebilirsiniz.
                        </li>
                        <li class="list-group-item bg-transparent">
                            Kayıtlarınızı istediğiniz zaman güncelleyebilirsiniz.
                        </li>
                        <li class="list-group-item bg-transparent">
                            Gereksiz etkinlikleri kolayca silebilirsiniz.
                        </li>
                    </ul>

                    
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>