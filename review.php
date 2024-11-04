<?php
// Подключение к базе данных
try {
    $pdo = new PDO('mysql:host=localhost;dbname=new_reviews', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}



$sql = "SELECT * FROM reviews";
$stmt = $pdo->query($sql);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($reviews as $review) {
    echo "<p><strong>{$review['name']}</strong>: {$review['review']} (товар:
    {$review['product']})</p>";
  
    }
    echo "<a href='home.html'>Вернуться на главную страницу</a>";