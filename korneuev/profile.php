<?php include "header.php"; ?>
<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера базы данных
$username = "zoxan"; // Имя пользователя базы данных
$password = "123"; // Пароль пользователя базы данных
$dbname = "textovarorg"; // Имя базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных о пользователе
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        echo "Пользователь не найден.";
    }
} else {
    echo "Пользователь не авторизован.";
}

// Обработка изменения пароля
$success_message = ""; // Сообщение о успешном изменении пароля
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['new_password'])) {
        $new_password = $_POST['new_password'];
        // Здесь должна быть логика для обновления пароля в базе данных
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = $user_id";
        if ($conn->query($update_sql) === TRUE) {
            $success_message = "Пароль успешно изменен.";
            // Очищаем сессию после отображения сообщения
            unset($_SESSION['success_message']);
        } else {
            echo "Ошибка при изменении пароля: " . $conn->error;
        }
    }
}

// Сохраняем сообщение в сессии, если оно есть
if (!empty($success_message)) {
    $_SESSION['success_message'] = $success_message;
}
?>
<style>

</style>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-header">
            <h5 class="card-title text-center">Профиль пользователя</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Имя:</strong> <?php echo $user_data['name']; ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo $user_data['mail']; ?></li>
                <li class="list-group-item"><strong>Телефон:</strong> <?php echo $user_data['telephone']; ?></li>
            </ul>
            <!-- Форма для изменения пароля -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="new_password" class="form-label">Новый пароль:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="show_password">
                    <label class="form-check-label" for="show_password">Показать пароль</label>
                </div>
                <button type="submit" class="btn btn-primary">Изменить пароль</button>
            </form>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById("show_password").addEventListener("change", function() {
        var passwordInput = document.getElementById("new_password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
</script>

<?php
// Закрытие подключения к базе данных
$conn->close();
?>
