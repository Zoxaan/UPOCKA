<?php
session_start();
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

$message = ""; // Переменная для хранения сообщения об успешной регистрации или об ошибках

// Проверка была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $telephone = $_POST['telephone']; // Получаем значение поля "телефон"

    // Проверка существования email
    $sql_check_email = "SELECT * FROM users WHERE mail='$mail'";
    $result_email = $conn->query($sql_check_email);
    if ($result_email->num_rows > 0) {
        $message = "Ошибка: Пользователь с таким email уже существует";
    } else {
        // Проверка существования телефона
        $sql_check_telephone = "SELECT * FROM users WHERE telephone='$telephone'";
        $result_telephone = $conn->query($sql_check_telephone);
        if ($result_telephone->num_rows > 0) {
            $message = "Ошибка: Пользователь с таким номером телефона уже существует";
        } else {
            // Хеширование пароля
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Создание запроса с добавлением поля "телефон"
            $sql = "INSERT INTO users (name, mail, password, telephone, role)
            VALUES ('$name', '$mail', '$hashed_password', '$telephone', 'user')";

            if ($conn->query($sql) === TRUE) {
                header("Location: login.php");
            } else {
                $message = "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

$conn->close();
?>
<body>
<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('uploads/martin-katler-l1lFK8dj6fA-unsplash.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #f8f9fa;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    .header {
        background-color: rgba(0, 0, 0, 0.8);
        padding: 10px 0;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }
    .header a {
        text-decoration: none;
        color: #f8f9fa;
        font-size: 24px;
        font-weight: bold;
        transition: color 0.3s ease;
    }
    .header a:hover {
        color: #007bff;
    }
    .container {
        margin-top: 150px;
        text-align: center;
    }
    form {
        display: inline-block;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #f8f9fa;
        background-color: rgba(255, 255, 255, 0.1);
        color: #f8f9fa;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        color: #f8f9fa;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: scale(1.05);
    }
</style>

<div class="header">
    <a href="index.php">Your Site</a>
</div>

<div class="container">
    <h2>Регистрация</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя" required>
        </div>
        <div class="form-group">
            <label for="mail">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" placeholder="Введите email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
        </div>
        <div class="form-group">
            <label for="telephone">Телефон</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Введите телефон" required>
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>

    <?php
    // Вывод сообщения об успешной регистрации или об ошибках
    if (!empty($message)) {
        echo '<div class="message">' . $message . '</div>';
    }
    ?>
</div>
</body>