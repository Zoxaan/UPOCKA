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

// Проверка, была ли отправлена форма для добавления услуги
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $bigdescription = $_POST['bigdescription'];

    // Обработка отправленного изображения
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDirectory = "uploads/"; // Папка для сохранения загруженных изображений
        $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Проверка типа файла (может быть расширен)
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Извините, только JPG, JPEG, PNG & GIF файлы разрешены.";
            exit;
        }

        // Перемещение файла в нужную директорию
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Файл был успешно загружен
            // Теперь сохраняем путь к изображению в переменную для добавления в базу данных
            $imagePath = $targetFile;
        } else {
            echo "Ошибка загрузки файла.";
            exit;
        }
    } else {
        echo "Файл изображения не был отправлен.";
        exit;
    }

    try {
        // Подготовка и выполнение запроса на добавление новой услуги
        $stmt = $db->prepare("INSERT INTO services (name, price, description, bigdescription, image) VALUES (:name, :price, :description, :bigdescription, :image)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':bigdescription', $bigdescription);
        $stmt->bindParam(':image', $imagePath); // Путь к изображению
        $stmt->execute();

        // Перенаправление на страницу просмотра услуг после успешного добавления
        header("Location: view_services.php");
        exit;
    } catch(PDOException $e) {
        echo "Ошибка добавления услуги: " . $e->getMessage();
        exit;
    }
}
?>
