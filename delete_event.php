<?php
session_start();
require "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? 0;

$stmt = $pdo->prepare("DELETE FROM etkinlikler WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION["user_id"]]);

header("Location: dashboard.php");
exit;
?>