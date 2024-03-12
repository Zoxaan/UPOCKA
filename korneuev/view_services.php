<?php
include "header.php";
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

// Проверка, был ли отправлен запрос на удаление
if(isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    try {
        // Подготовка и выполнение запроса на удаление услуги
        $stmt = $db->prepare("DELETE FROM services WHERE id = :id");
        $stmt->bindParam(':id', $delete_id);
        $stmt->execute();

        // Перенаправление на эту же страницу после удаления
        header("Location: view_services.php");
        exit;
    } catch(PDOException $e) {
        echo "Ошибка удаления услуги: " . $e->getMessage();
    }
}

// Получение списка услуг
$stmt = $db->query("SELECT * FROM services");
$services = $stmt->fetchAll();
?>

<h2>Просмотр услуг</h2>

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

    .btn-primary:hover {
        animation: glow 1s ease-in-out infinite alternate;
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

<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Описание</th>
        <th>Изображение</th>
        <th>Большое описание</th>
        <th>Редактировать</th>
        <th>Удалить</th>
    </tr>
    <?php foreach ($services as $service): ?>
        <tr>
            <td><?php echo $service['id']; ?></td>
            <td><?php echo $service['name']; ?></td>
            <td><?php echo $service['price']; ?></td>
            <td><?php echo $service['description']; ?></td>
            <td><img src="<?php echo $service['image']; ?>" width="100" height="100"></td>
            <td><?php echo $service['bigdescription']; ?></td>
            <td>
                <a href="edit_service.php?edit_id=<?php echo $service['id']; ?>" class="btn btn-primary">Редактировать</a>
            </td>
            <td>
                <form method="post" onsubmit="return confirm('Вы уверены, что хотите удалить эту услугу?');">
                    <input type="hidden" name="delete_id" value="<?php echo $service['id']; ?>">
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
