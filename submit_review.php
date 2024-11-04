<?php
// Настройка подключения к базе данных с использованием PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=new_reviews', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

// Проверка, что данные были отправлены методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы и очистка от вредоносного кода
    $name = htmlspecialchars(trim($_POST['name']));
    $product = htmlspecialchars(trim($_POST['product']));
    $review = htmlspecialchars(trim($_POST['review']));

    // Проверка, что все поля формы заполнены
    if (!empty($name) && !empty($product) && !empty($review)) {
        try {
            // Вставка данных в таблицу reviews
            $stmt = $pdo->prepare("INSERT INTO reviews (name, product, review) VALUES (:name, :product, :review)");
            $stmt->execute(['name' => $name, 'product' => $product, 'review' => $review]);

            echo "Спасибо за ваш отзыв!";
            echo "<a href='home.html'>Вернуться на главную страницу</a>";
        } catch (PDOException $e) {
            echo "Ошибка при добавлении отзыва: " . $e->getMessage();
        }
    } else {
        echo "Пожалуйста, заполните все поля формы.";
    }
} else {
    echo "Неверный метод отправки.";
}
?>

