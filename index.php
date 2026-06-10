<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hobi Kulübü</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            min-height: 100vh;
        }

        .hero-card {
            border-radius: 28px;
        }

        .info-panel {
            background-color: #f8f9fa;
            border-radius: 22px;
        }

        .info-item {
            background: white;
            border-radius: 14px;
            padding: 14px 16px;
            margin-bottom: 12px;
            border: 1px solid #e9ecef;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand fw-bold fs-4">Hobi Kulübü</span>

        <div>
            <a href="login.php" class="btn btn-outline-light me-2">
                Giriş Yap
            </a>

            <a href="register.php" class="btn btn-warning">
                Üye Ol
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">

    <div class="card hero-card shadow-lg border-0 p-4 p-md-5 mt-4">
        <div class="row align-items-center">

            <div class="col-md-6">
                <span class="badge bg-primary mb-3">Hobi Kulübü</span>

                <h1 class="display-5 fw-bold mb-3">
                    Etkinliklerinizi Tek Bir Yerden Yönetin
                </h1>

                <p class="lead text-muted">
                    Kulüp etkinliklerinizi düzenli şekilde oluşturun, takip edin,
                    güncelleyin ve ihtiyaç duyduğunuzda kolayca yönetin.
                </p>

                
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
                <div class="info-panel p-4 shadow-sm">
                    <h4 class="fw-bold mb-3">Neler Yapabilirsiniz?</h4>

                    <div class="info-item">
                        <strong>Etkinlik oluşturun</strong>
                        <p class="text-muted mb-0">
                            Etkinlik adı, tarih, yer ve açıklama bilgisi ekleyebilirsiniz.
                        </p>
                    </div>

                    <div class="info-item">
                        <strong>Etkinliklerinizi listeleyin</strong>
                        <p class="text-muted mb-0">
                            Oluşturduğunuz tüm etkinlikleri panel üzerinden görüntüleyebilirsiniz.
                        </p>
                    </div>

                    <div class="info-item">
                        <strong>Bilgileri güncelleyin</strong>
                        <p class="text-muted mb-0">
                            Yanlış veya eksik girilen etkinlik bilgilerini kolayca düzenleyebilirsiniz.
                        </p>
                    </div>

                    <div class="info-item mb-0">
                        <strong>Etkinlikleri silin</strong>
                        <p class="text-muted mb-0">
                            Artık gerekli olmayan kayıtları sistemden kaldırabilirsiniz.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <p class="text-center text-white mt-4 mb-0">
        © 2026 Hobi Kulübü
    </p>

</div>

</body>
</html>