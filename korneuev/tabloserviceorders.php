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

// Получение списка заказов услуг
$stmt = $db->query("SELECT * FROM serviceorders");
$service_orders = $stmt->fetchAll();
?>

<div class="container">
    <h2>Просмотр заказов услуг</h2>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Услуга</th>
            <th>Общая цена</th>
            <th>Дата заказа</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($service_orders as $order): ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['telephone']; ?></td>
                <td><?php echo $order['service_id']; ?></td>
                <td><?php echo $order['total_price']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

