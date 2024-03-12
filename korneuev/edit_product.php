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

// Проверка, была ли отправлена форма для обновления товара
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    try {
        // Подготовка и выполнение запроса на обновление информации о товаре
        $stmt = $db->prepare("UPDATE products SET name = :name, price = :price, description = :description WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->execute();

        // Перенаправление на страницу просмотра товаров после успешного обновления
        header("Location: view_products.php");
        exit;
    } catch(PDOException $e) {
        echo "Ошибка обновления товара: " . $e->getMessage();
        exit;
    }
}

// Получение идентификатора товара из запроса
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Запрос на получение информации о товаре по его идентификатору
        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Проверка, найден ли товар с указанным идентификатором
        if (!$product) {
            echo "Товар не найден.";
            exit;
        }
    } catch(PDOException $e) {
        echo "Ошибка запроса: " . $e->getMessage();
        exit;
    }
} else {
    // Если идентификатор товара не указан в запросе, выводим сообщение об ошибке
    echo "Ошибка: Идентификатор товара не указан.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать товар</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Редактировать товар</h2>
    <form method="post" action="edit_product.php?id=<?php echo $product['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>">
        </div>
        <div class="form-group">
            <label for="price">Цена:</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" id="description" name="description"><?php echo $product['description']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</div>
</body>
</html>
