<?php
session_start();

// Подключение к базе данных
try {
    $pdo = new PDO('mysql:host=localhost;dbname=petshop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

$user_id = $_SESSION['user_id'] ?? null;

// Получаем товары в корзине
$stmt = $pdo->query("SELECT p.name, p.price, c.quantity
                     FROM cart c
                     JOIN products p ON c.product_id = p.id
                     WHERE user_id = $user_id");
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Возвращаем данные корзины в формате JSON
header('Content-Type: application/json');
echo json_encode($cartItems);
?>
