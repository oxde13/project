<?php
// Подключение к базе данных
try {
    $pdo = new PDO('mysql:host=localhost;dbname=petshop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Получение всех товаров
$stmt = $pdo->query("SELECT * FROM products WHERE type = 'product'");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Возвращение данных о товарах в формате JSON
header('Content-Type: application/json');
echo json_encode($products);
?>
