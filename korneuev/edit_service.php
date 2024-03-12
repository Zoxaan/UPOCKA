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

// Проверяем, был ли отправлен запрос на редактирование
if(isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $bigdescription = $_POST['bigdescription'];

    // Проверяем, был ли загружен новый файл изображения
    if(isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['new_image']['name'];
        $file_tmp = $_FILES['new_image']['tmp_name'];
        $file_type = $_FILES['new_image']['type'];

        // Куда сохранять файл и его типы
        $allowed_extensions = array("image/jpeg", "image/png", "image/gif");
        $upload_path = "uploads/";

        // Проверка расширения файла
        if(in_array($file_type, $allowed_extensions)) {
            // Сохранение файла
            move_uploaded_file($file_tmp, $upload_path . $file_name);

            // Установка нового пути к изображению
            $image = $upload_path . $file_name;
        } else {
            echo "Неподдерживаемый формат файла. Пожалуйста, загрузите файл в формате JPG, PNG или GIF.";
            exit;
        }
    }

    try {
        // Подготовка и выполнение запроса на обновление услуги
        $stmt = $db->prepare("UPDATE services SET name = :name, price = :price, description = :description, image = :image, bigdescription = :bigdescription WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':bigdescription', $bigdescription);
        $stmt->bindParam(':id', $edit_id);
        $stmt->execute();

        // Отображение сообщения об успешном обновлении
        echo "<script>alert('Услуга успешно обновлена');</script>";
        echo "<script>window.location = 'view_services.php';</script>";
        exit;
    } catch(PDOException $e) {
        echo "Ошибка редактирования услуги: " . $e->getMessage();
    }
}

// Получаем данные о редактируемой услуге
if(isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    try {
        // Подготовка и выполнение запроса на получение данных о редактируемой услуге
        $stmt = $db->prepare("SELECT * FROM services WHERE id = :id");
        $stmt->bindParam(':id', $edit_id);
        $stmt->execute();
        $service = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Ошибка получения данных о редактируемой услуге: " . $e->getMessage();
    }
}
?>

<h2>Редактирование услуги</h2>

<form method="post" action="" enctype="multipart/form-data">
    <?php if(isset($service)): ?>
        <input type="hidden" name="edit_id" value="<?php echo $service['id']; ?>">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $service['name']; ?>">
        </div>
        <div class="form-group">
            <label for="price">Цена:</label>
            <input type="text" class="form-control" id="price" name="price" value="<?php echo $service['price']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" id="description" name="description"><?php echo $service['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="new_image">Новое изображение:</label>
            <input type="file" class="form-control" id="new_image" name="new_image">
        </div>
        <div class="form-group">
            <label for="bigdescription">Большое описание:</label>
            <textarea class="form-control" id="bigdescription" name="bigdescription"><?php echo $service['bigdescription']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    <?php else: ?>
        <p>Нет данных для редактирования.</p>
    <?php endif; ?>
</form>

