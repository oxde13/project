<?php
session_start();
// Подключение к базе данных
try {
    $pdo = new PDO('mysql:host=localhost;dbname=petshop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Ошибка подключения к базе данных']));
}

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(['authRequired' => true, 'message' => 'Сначала войдите']);
    die();
}

if ($product_id) {
    // Вставляем товар в корзину
    $stmt = $pdo->prepare("INSERT INTO cart (product_id, user_id, quantity) VALUES (?, ?, 1)
                           ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    $stmt->execute([$product_id, $user_id]);

    // Возвращаем успешный ответ
    echo json_encode(['success' => true, 'message' => 'Товар добавлен в корзину']);
} else {
    // Если ID товара отсутствует, возвращаем ошибку
    echo json_encode(['success' => false, 'message' => 'Некорректный ID товара']);
}
?>
