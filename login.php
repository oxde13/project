<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=petshop', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: /project/home.html');
        } else {
            echo "Неверное имя пользователя или пароль.";
        }
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
s