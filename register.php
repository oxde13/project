<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=petshop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);

        echo "Регистрация прошла успешно. <a href='authorization.html'>Войти</a>";
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
