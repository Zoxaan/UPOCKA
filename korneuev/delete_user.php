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

// Проверяем, был ли отправлен идентификатор пользователя для удаления
if(isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Подготовка и выполнение запроса на удаление пользователя
        $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("location:view_users.php");
    } catch(PDOException $e) {
        echo "Ошибка удаления пользователя: " . $e->getMessage();
    }
} else {
    echo "Идентификатор пользователя не указан.";
}
?>
