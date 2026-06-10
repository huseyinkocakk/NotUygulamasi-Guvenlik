<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM etkinlikler WHERE user_id = ? ORDER BY etkinlik_tarihi DESC");
$stmt->execute([$_SESSION["user_id"]]);
$etkinlikler = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Hobi Kulübü Paneli</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #0d6efd, #6610f2);
    }

    .navbar-box {
        background: rgba(255,255,255,0.12);
        backdrop-filter: blur(10px);
        border-radius: 18px;
    }

    .welcome-card {
        background: white;
        border-radius: 28px;
    }

    .event-card {
        border: 0;
        border-radius: 22px;
        transition: 0.25s;
    }

    .event-card:hover {
        transform: translateY(-4px);
    }

    .date-badge {
        background: #eef4ff;
        color: #0d6efd;
        border-radius: 14px;
        padding: 8px 12px;
        display: inline-block;
        font-weight: 600;
    }

    .empty-box {
        background: white;
        border-radius: 22px;
    }
</style>
</head>

<body>

<div class="container py-4">

    <div class="navbar-box px-4 py-3 d-flex justify-content-between align-items-center mb-4">
        <div class="text-white">
            <h4 class="fw-bold mb-0">Hobi Kulübü</h4>
            <small>Etkinlik Yönetim Paneli</small>
        </div>

        <div>
            <a href="add_event.php" class="btn btn-warning me-2">
                + Etkinlik Ekle
            </a>
            <a href="logout.php" class="btn btn-light">
                Çıkış Yap
            </a>
        </div>
    </div>

    <div class="welcome-card shadow-lg p-4 p-md-5 mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge bg-primary mb-3">Hoş geldiniz</span>
                <h1 class="fw-bold mb-2">
                    Merhaba, <?= htmlspecialchars($_SESSION["username"]) ?>
                </h1>
                <p class="text-muted mb-0">
                    Etkinliklerinizi buradan ekleyebilir, düzenleyebilir ve silebilirsiniz.
                </p>
            </div>

            <div class="col-md-4 mt-4 mt-md-0">
                <div class="bg-light rounded-4 p-4 text-center">
                    <p class="text-muted mb-1">Toplam Etkinlik</p>
                    <h1 class="fw-bold text-primary mb-0">
                        <?= count($etkinlikler) ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <?php if (count($etkinlikler) > 0): ?>

        <div class="row g-4">
            <?php foreach ($etkinlikler as $etkinlik): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card shadow-lg h-100">
                        <div class="card-body p-4">

                            <div class="date-badge mb-3">
                                <?= htmlspecialchars($etkinlik["etkinlik_tarihi"]) ?>
                            </div>

                            <h4 class="fw-bold">
                                <?= htmlspecialchars($etkinlik["etkinlik_adi"]) ?>
                            </h4>

                            <p class="text-muted mb-2">
                                <strong>Yer:</strong>
                                <?= htmlspecialchars($etkinlik["yer"]) ?>
                            </p>

                            <p class="text-muted">
                                <?= htmlspecialchars($etkinlik["aciklama"]) ?>
                            </p>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="edit_event.php?id=<?= $etkinlik["id"] ?>" class="btn btn-outline-primary">
                                    Düzenle
                                </a>

                                <a href="delete_event.php?id=<?= $etkinlik["id"] ?>"
                                   class="btn btn-outline-danger"
                                   onclick="return confirm('Bu etkinliği silmek istediğinizden emin misiniz?')">
                                    Sil
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>

        <div class="empty-box shadow-lg p-5 text-center">
            <h3 class="fw-bold">Henüz etkinlik eklenmedi</h3>
            <p class="text-muted">
                İlk etkinliğinizi ekleyerek panelinizi kullanmaya başlayabilirsiniz.
            </p>
            <a href="add_event.php" class="btn btn-primary btn-lg">
                İlk Etkinliği Ekle
            </a>
        </div>

    <?php endif; ?>

</div>

</body>
</html>