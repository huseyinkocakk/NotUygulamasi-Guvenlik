<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM etkinlikler WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION["user_id"]]);
$etkinlik = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etkinlik) {
    die("Etkinlik bulunamadı.");
}

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $etkinlik_adi = trim($_POST["etkinlik_adi"]);
    $etkinlik_tarihi = $_POST["etkinlik_tarihi"];
    $yer = trim($_POST["yer"]);
    $aciklama = trim($_POST["aciklama"]);

    if ($etkinlik_adi && $etkinlik_tarihi && $yer) {

        $stmt = $pdo->prepare("
            UPDATE etkinlikler
            SET etkinlik_adi = ?, etkinlik_tarihi = ?, yer = ?, aciklama = ?
            WHERE id = ? AND user_id = ?
        ");

        $stmt->execute([
            $etkinlik_adi,
            $etkinlik_tarihi,
            $yer,
            $aciklama,
            $id,
            $_SESSION["user_id"]
        ]);

        header("Location: dashboard.php");
        exit;

    } else {
        $mesaj = "Lütfen gerekli alanları doldurun.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<title>Etkinlik Düzenle</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #0d6efd, #6610f2);
    }

    .page-card {
        border-radius: 28px;
        border: 0;
    }

    .info-box {
        background-color: #f8f9fa;
        border-radius: 22px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px;
    }

    textarea {
        resize: none;
    }
</style>
</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="text-white">
            <h3 class="fw-bold mb-0">Hobi Kulübü</h3>
            <small>Etkinlik düzenleme sayfası</small>
        </div>

        <a href="dashboard.php" class="btn btn-light">
            Panele Dön
        </a>
    </div>

    <div class="card page-card shadow-lg p-4 p-md-5">
        <div class="row align-items-center">

            <div class="col-md-6">

                <span class="badge bg-warning text-dark mb-3">
                    Etkinlik Düzenle
                </span>

                <h2 class="fw-bold mb-2">
                    Etkinlik Bilgilerini Güncelle
                </h2>

                <p class="text-muted mb-4">
                    Seçili etkinliğin bilgilerini düzenleyebilir ve güncelleyebilirsiniz.
                </p>

                <?php if ($mesaj): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($mesaj) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Etkinlik Adı</label>
                        <input type="text"
                               name="etkinlik_adi"
                               value="<?= htmlspecialchars($etkinlik['etkinlik_adi']) ?>"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Etkinlik Tarihi</label>
                        <input type="date"
                               name="etkinlik_tarihi"
                               value="<?= htmlspecialchars($etkinlik['etkinlik_tarihi']) ?>"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Yer</label>
                        <input type="text"
                               name="yer"
                               value="<?= htmlspecialchars($etkinlik['yer']) ?>"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Açıklama</label>
                        <textarea name="aciklama"
                                  rows="4"
                                  class="form-control"><?= htmlspecialchars($etkinlik['aciklama']) ?></textarea>
                    </div>

                    <button class="btn btn-warning btn-lg">
                        Güncelle
                    </button>

                    <a href="dashboard.php" class="btn btn-outline-secondary btn-lg">
                        İptal
                    </a>

                </form>

            </div>

            <div class="col-md-6 mt-4 mt-md-0">
                <div class="info-box p-4 shadow-sm">

                    <h4 class="fw-bold mb-3">
                        Düzenleme Bilgileri
                    </h4>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent">
                            Etkinlik adını değiştirebilirsiniz.
                        </li>

                        <li class="list-group-item bg-transparent">
                            Tarih bilgisini güncelleyebilirsiniz.
                        </li>

                        <li class="list-group-item bg-transparent">
                            Yer bilgisini düzeltebilirsiniz.
                        </li>

                        <li class="list-group-item bg-transparent">
                            Açıklama alanını yeniden düzenleyebilirsiniz.
                        </li>
                    </ul>

                    <div class="alert alert-warning mt-4 mb-0">
                        Kaydettiğiniz değişiklikler anında etkinlik kartlarına yansır.
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>