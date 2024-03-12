<?php
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "textovarorg";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$name = $_POST['name'];
$mail = $_POST['mail'];
$password = $_POST['password'];
$telephone = $_POST['telephone']; // Получаем значение поля "телефон"

// Проверка существования email
$sql_check_email = "SELECT * FROM users WHERE mail='$mail'";
$result_email = $conn->query($sql_check_email);
if ($result_email->num_rows > 0) {
    $registration_message = "Ошибка: Пользователь с таким email уже существует";
    // Выводим сообщение об ошибке
    echo $registration_message;
    exit; // Прерываем выполнение скрипта, если пользователь с таким email уже существует
}

// Проверка существования телефона
$sql_check_telephone = "SELECT * FROM users WHERE telephone='$telephone'";
$result_telephone = $conn->query($sql_check_telephone);
if ($result_telephone->num_rows > 0) {
    $registration_message = "Ошибка: Пользователь с таким номером телефона уже существует";
    // Выводим сообщение об ошибке
    echo $registration_message;
    exit; // Прерываем выполнение скрипта, если пользователь с таким телефоном уже существует
}

// Хеширование пароля
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Создание запроса с добавлением поля "телефон"
$sql = "INSERT INTO users (name, mail, password, telephone, role)
VALUES ('$name', '$mail', '$hashed_password', '$telephone', 'user')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
    // Выводим сообщение об успешной регистрации

} else {
    $registration_message = "Ошибка: " . $sql . "<br>" . $conn->error;
    // Выводим сообщение об ошибке
    echo $registration_message;
}

$conn->close();
?>
