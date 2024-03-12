<?php include "header.php"; ?>
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "textovarorg";

// Запуск сессии

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Проверка наличия параметра id в URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // SQL запрос для получения информации о выбранной услуге
        $stmt = $db->prepare("SELECT * FROM Services WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        // Вывод полной информации о выбранной услуге
        echo '<div class="container mt-5">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<h2 class="service-title">' . $service['name'] . '</h2>';
        echo '<img src="' . $service['image'] . '" class="card-img" alt="Alt текст" style="max-width: 100%;">';
        echo '<p class="service-description">' . $service['description'] . '</p>';
        echo '<p class="service-bigdescription">' . $service['bigdescription'] . '</p>';
        echo '<p class="service-price">Цена: ' . $service['price'] . '</p>';
        // Дополнительные детали о выбранной услуге, если они есть
        echo '</div>';
        echo '<div class="col-md-6">';

        // Проверка авторизации пользователя
        if (isset($_SESSION['user'])) {
            echo '<h2>Оформление заказа</h2>';
            echo '<form action="makeservice_order.php" method="post">';
            echo '<input type="hidden" name="service_id" value="' . $service['id'] . '">';
            echo '<div class="form-group">';
            echo '<label for="telephone">Номер телефона:</label>';
            echo '<input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Введите номер телефона" required>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-success btn-lg mt-2">Отправить заказ</button>';
            echo '</form>';
        } else {
            // Сообщение о необходимости авторизации
            echo '<p class="text-danger">Чтобы заказать услугу, пожалуйста, авторизуйтесь.</p>';
        }

        // Проверка наличия сообщения об ошибке в сессии
        if (isset($_SESSION['error_message'])) {
            echo '<p class="text-danger">' . $_SESSION['error_message'] . '</p>';
            unset($_SESSION['error_message']); // Очищаем сообщение об ошибке из сессии
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
    } else {
        // Если параметр id отсутствует, выводим сообщение об ошибке
        echo '<p class="text-danger">Ошибка: Не передан ID услуги.</p>';
    }
} catch (PDOException $e) {
    echo '<p class="text-danger">Ошибка получения данных: ' . $e->getMessage() . '</p>';
}

?>
<style>
    .service-title {
        color: #3f3f3f; /* Темно-серый цвет для заголовка */
        font-size: 2em;
        font-weight: bold;
    }
    .service-description {
        color: #a9a9a9; /* Темно-серый цвет для описания */
        font-size: 1.2em;
        line-height: 1.5;
    }
    .service-bigdescription {
        color: #fcfcfc; /* Синий цвет для большого описания */
        font-size: 1.2em;
        line-height: 1.5;
    }
    .service-price {
        color: #FF4500; /* Оранжевый цвет для цены */
        font-size: 1.5em;
        font-weight: bold;
    }
</style>
