<?php
require_once("partials-front/menu.php");
require_once("partials-front/check-login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idmonan = $_POST['idmonan'] ?? null;
    $iduser = $_POST['iduser'] ?? null;
    $rating = $_POST['rating'] ?? null;

    // Kiểm tra dữ liệu
    if (!$idmonan || !$iduser || !$rating) {
        echo "error: Missing data";
        exit;
    }

    // Kết nối cơ sở dữ liệu
    if (!$conn) {
        echo "error: Database connection failed";
        exit;
    }

    $idmonan = (int)$idmonan;
    $iduser = (int)$iduser;
    $rating = (int)$rating;

    // Sử dụng prepared statement để tránh SQL Injection
    $stmt = $conn->prepare("INSERT INTO rating (id_monan, id_user, rating) VALUES (?, ?, ?)");
    if ($stmt === false) {
        echo "error: " . $conn->error;
        exit;
    }

    $stmt->bind_param("iii", $idmonan, $iduser, $rating);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }

    $stmt->close();
}
?>
