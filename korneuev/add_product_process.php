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

// Обработка данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    // Обработка загруженного изображения
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Проверка, является ли файл изображением
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "Файл является изображением - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Файл не является изображением.";
            $uploadOk = 0;
        }
    }

    // Проверка наличия файла


    // Проверка размера файла (не более 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Извините, ваш файл слишком большой.";
        $uploadOk = 0;
    }

    // Разрешенные форматы файлов

    // Если все проверки пройдены, попытка загрузки файла
    if ($uploadOk == 0) {
        echo "Извините, ваш файл не был загружен.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Файл ". basename( $_FILES["image"]["name"]). " успешно загружен.";
            // Добавление данных в базу данных
            $image_path = $target_dir . basename($_FILES["image"]["name"]);
            $stmt = $db->prepare("INSERT INTO products (name, price, description, image) VALUES (:name, :price, :description, :image)");
            $stmt->execute(['name' => $name, 'price' => $price, 'description' => $description, 'image' => $image_path]);
        } else {
            echo "Извините, произошла ошибка при загрузке файла.";
        }
    }
}
?>
