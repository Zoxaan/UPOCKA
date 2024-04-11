<?php
include "../header/header.php";

// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "restoris";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка отправленной формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $message =  htmlspecialchars($_POST['message']);

    // SQL запрос для вставки отзыва в базу данных
    $sql = "INSERT INTO reviews (name, rating, message) VALUES ('$name', '$rating', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Отзыв успешно отправлен.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Ошибка: " . $conn->error . "</div>";
    }
}

// SQL запрос для выборки некоторых отзывов из базы данных
$sql_select_reviews = "SELECT * FROM reviews ORDER BY id DESC LIMIT 3";
$result_select_reviews = $conn->query($sql_select_reviews);

// Закрытие соединения с базой данных
$conn->close();
?>

<style>
    /* Стили для формы отзыва */
    .review-form {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .review-form label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .review-form input[type="text"],
    .review-form textarea,
    .review-form select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .review-form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .review-form input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Стили для сообщений об успехе и ошибке */
    .alert {
        margin-top: 20px;
    }

    /* Стили для отзывов */
    .review {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>

<body>

<div class="container">
    <h1 class="text-center mb-4">Оставить отзыв</h1>
    <div class="review-form-container">
        <form class="review-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="name">Ваше имя:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="rating">Оценка:</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Ваш отзыв:</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить отзыв</button>
        </form>
    </div>

    <!-- Показываем некоторые из уже существующих отзывов -->
    <div class="reviews-section">
        <h2 class="text-center mb-4">Отзывы клиентов</h2>
        <?php
        if ($result_select_reviews->num_rows > 0) {
            // Выводим данные каждого отзыва
            while ($row = $result_select_reviews->fetch_assoc()) {
                echo "<div class='review'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p><strong>Оценка:</strong> " . $row['rating'] . "</p>";
                echo "<p><strong>Отзыв:</strong> " . htmlspecialchars($row['message'])   . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-center'>Пока нет отзывов.</p>";
        }
        ?>
    </div>
</div>

<script>
    // Добавляем анимацию при наведении на форму отзыва
    $(".review-form").hover(
        function () {
            $(this).css("box-shadow", "0 0 30px rgba(0, 0, 0, 0.2)");
        },
        function () {
            $(this).css("box-shadow", "0 0 20px rgba(0, 0, 0, 0.1)");
        }
    );
</script>
</body>
