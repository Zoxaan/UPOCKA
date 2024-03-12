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

// Получение списка товаров
$stmt = $db->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<h2>Просмотр товаров</h2>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    img {
        max-width: 100px;
        height: auto;
    }
    <style>
     table {
         width: 100%;
         border-collapse: collapse;
         margin-top: 20px;
     }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }

    .btn-primary:hover {
        animation: glow 1s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 10px #000000;
        }
        to {
            box-shadow: 0 0 20px #000000, 0 0 30px #000000, 0 0 40px #000000;
        }
    }


    .btn-danger:hover {
        animation: glow 1s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 10px #000000;
        }
        to {
            box-shadow: 0 0 20px #000000, 0 0 30px #000000, 0 0 40px #ffd000;
        }
    }
</style>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>Изображение</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>"></td>
            <td>
                <!-- Кнопка для удаления товара -->
                <form method="post" action="delete_product.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
                <!-- Кнопка для редактирования товара -->
                <form method="get" action="edit_product.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn btn-primary">Редактировать</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
