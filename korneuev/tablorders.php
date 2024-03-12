<?php include "header.php"; ?>
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "textovarorg";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}

// Получение списка заказов с дополнительными данными о товарах
$stmt = $db->query("SELECT * FROM orders");
$orders = $stmt->fetchAll();
?>

<div class="container">
    <h2>Просмотр заказов</h2>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Товар</th>
            <th>Дата заказа</th>
            <th>Цена товара</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['telephone']; ?></td>
                <td><?php echo $order['product_id']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['product_price']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

