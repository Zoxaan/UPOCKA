<?php
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "textovarorg";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Получение данных из формы заказа
    $telephone = $_POST['telephone'];
    $product_id = $_POST['product_id'];

    // Проверка существования пользователя с указанным номером телефона
    $stmt = $db->prepare("SELECT * FROM users WHERE telephone = :telephone");
    $stmt->bindParam(':telephone', $telephone);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Пользователь с указанным номером телефона не найден. Выводим сообщение об ошибке.
        $_SESSION['error'] = "Пользователь с указанным номером телефона не найден. Заказ не может быть подтвержден.";
        header("Location: product_details.php?id=" . $product_id); // Перенаправляем обратно на страницу заказа
        exit();
    } else {
        // Получение цены товара
        $stmt = $db->prepare("SELECT price FROM products WHERE id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $product_price = $product['price'];

        // Получение текущей даты и времени
        $order_date = date("Y-m-d H:i:s");

        // SQL запрос для вставки данных заказа в таблицу orders
        $stmt = $db->prepare("INSERT INTO orders (telephone, product_id, order_date, product_price) VALUES (:telephone, :product_id, :order_date, :product_price)");
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':product_price', $product_price);
        $stmt->execute();

        // Вывод сообщения об успешном оформлении заказа
        $_SESSION['success'] = "Ваш заказ на услугу принят!";
        header("Location: product_details.php?id=" . $product_id); // Перенаправляем обратно на страницу заказа
        exit();
    }

} catch(PDOException $e) {
    echo "Ошибка при оформлении заказа: " . $e->getMessage();
}
?>
