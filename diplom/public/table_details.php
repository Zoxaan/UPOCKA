<?php include "../header/header.php"; ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('../uploads/1674905669_top-fon-com-p-skachat-temnii-fon-dlya-prezentatsii-179.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-color: rgba(255, 255, 255, 0.9);
        color: #c2c2c2;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }
    .table-info {
        border-radius: 10px;
        background-color: rgba(66, 66, 66, 0.8); /* Сочный темно-серый с прозрачностью */
        float: right;
        width: calc(50% - 10px); /* Вычисляем ширину с учетом отступов */
        padding-left: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Тень для элемента */
    }

    img {
        max-width: 50%;
        height: auto;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        float: left; /* Помещаем изображение слева */
        margin-right: 20px; /* Отступ справа для отделения от текста */
        margin-top: 20px;
    }
    p {
        font-size: 16px;
        margin-bottom: 10px;
    }
    .table-info p {
        margin: 5px 0; /* Уменьшаем внешние отступы */
        color: #ffffff; /* Изменили цвет текста на белый */
    }
    .table-info p strong {
        font-weight: bold; /* Устанавливаем жирный шрифт для названий характеристик */
        margin-right: 10px; /* Отступ справа между названием и значением */
    }

    .btn-book {
        background-color: #333; /* Цвет кнопки */
        color: #fff; /* Цвет текста на кнопке */
        border: none; /* Убираем границу */
        padding: 12px 24px; /* Внутренние отступы */
        border-radius: 5px; /* Закругленные углы */
        font-size: 16px; /* Размер текста */
        cursor: pointer; /* Изменяем курсор при наведении */
        transition: background-color 0.3s ease, box-shadow 0.3s ease; /* Плавное изменение цвета и тени при наведении */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Эффект тени */
        margin-bottom: 5px;
    }

    .btn-book:hover {
        background-color: #555; /* Цвет кнопки при наведении */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2); /* Увеличение тени при наведении */
    }

    .modal-content {
        background-color: #fefefe; /* Цвет фона модального окна */
        margin: 15% auto; /* Позиционируем модальное окно по центру */
        padding: 20px;
        border: 1px solid #888;
        width: auto; /* Автоматическая ширина */
        max-width: 30%; /* Максимальная ширина */
        height: 80%; /* Высота модального окна */
        overflow-y: auto; /* Включаем вертикальную прокрутку при необходимости */
        border-radius: 10px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Дополнительные стили для формы и элементов формы */
    #bookingForm {
        margin-top: 20px;
    }

    #bookingForm label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    #bookingForm input[type="text"],
    #bookingForm input[type="date"],
    #bookingForm input[type="time"] {
        width: calc(100% - 20px); /* Учитываем внутренние отступы */
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #bookingForm button[type="submit"] {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    #bookingForm button[type="submit"]:hover {
        background-color: #555;
    }
</style>
<div class="container">
    <?php
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

    // Обработка отправки формы бронирования
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $_POST['fullName'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $table_id = $_GET['id'];

        // Обновление статуса стола на "забронированный"
        $updateSql = "UPDATE tables SET status='забронированный' WHERE id=$table_id";
        if ($conn->query($updateSql) === TRUE) {
        } else {
            echo "Ошибка при обновлении статуса стола: " . $conn->error;
        }
    }

    // Получаем id стола из URL
    if (isset($_GET['id'])) {
        $table_id = $_GET['id'];

        // SQL запрос для выбора информации о столе по его id
        $sql = "SELECT * FROM tables WHERE id=$table_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Получаем данные о столе
            $row = $result->fetch_assoc();
            $name_table = $row["name_table"];
            $quantity = $row["quantity"];
            $status = $row["status"];
            $img = $row["img"];
            $description = $row["description"];

            // Отображаем подробную информацию о столе
            echo "<img src='../$img' alt='$name_table'>";
            echo "<div class='table-info'>";
            echo "<h1>$name_table</h1>";
            echo "<p><strong>Количество мест:</strong> $quantity</p>";
            echo "<p><strong>Статус:</strong> $status</p>";
            echo "<p><strong>Описание:</strong> $description</p>";
            echo "<button class='btn-book' onclick='openModal()'>Забронировать</button>"; // Добавляем кнопку "Забронировать" с вызовом функции открытия модального окна
            echo "<div id='successMessage' style='display: none;'>";
            echo "<p>Стол успешно забронирован!</p>";
            echo "<p>Ожидайте звонка от нас.</p>";
            echo "</div>";

        } else {
            echo "Стол с указанным ID не найден.";
        }
    } else {
        echo "ID стола не указан.";
    }

    // Закрытие соединения с базой данных
    $conn->close();
    ?>

</div>

<!-- Модальное окно -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Бронирование столика</h2>
        <form id="bookingForm" method="post" action="" onsubmit="submitForm(event)">
            <label for="fullName">ФИО:</label>
            <input type="text" id="fullName" name="fullName" placeholder="Введите ваше ФИО" required>
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" placeholder="Введите ваш номер телефона" required>
            <label for="date">Дата:</label>
            <input type="date" id="date" name="date" required>
            <label for="time">Время:</label>
            <input type="time" id="time" name="time" min="10:00" max="22:00" required>
            <button type="submit" class="btn-book">Забронировать</button>
        </form>
        <!-- Добавлен блок для отображения сообщения об успешном бронировании -->
        <div id="successMessage" style="display: none;">
            <p>Стол успешно забронирован!</p>
            <p>Ожидайте звонка от нас.</p>
        </div>
    </div>
</div>

<script>
    function submitForm(event) {
        event.preventDefault(); // Предотвращаем стандартное поведение формы

        // Получаем данные формы
        var formData = new FormData(document.getElementById("bookingForm"));

        // Отправляем данные на сервер через AJAX запрос
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true); // Пустая строка вместо URL, чтобы отправить на текущую страницу
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обработка успешного ответа
                document.getElementById("successMessage").style.display = "block";
                closeModal(); // Закрываем модальное окно
            }
        };
        xhr.send(formData); // Отправляем данные формы
    }
    // Функция открытия модального окна
    function openModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Функция закрытия модального окна
    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
</script>