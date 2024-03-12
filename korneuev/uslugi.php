<?php include "header.php"; ?>
<link rel="stylesheet" href="style.scss">
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "textovarorg";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL запрос для получения информации о услугах
    $sql = "SELECT * FROM Services";
    $stmt = $db->query($sql);

    // Вывод данных о услугах
    echo '<div class="container mt-5 d-flex justify-content-center">';
    echo '<div class="row">';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col-md-12 mb-4">';
        echo '<div class="card mb-3">';
        echo '<div class="row no-gutters">';
        echo '<div class="col-md-8">';
        echo '<img src="' . $row['image'] . '" class="card-img" alt="Alt текст">';
        echo '</div>';
        echo '<div class="col-md-7">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
        echo '<p class="card-text">' . $row['description'] . '</p>';
        echo '<p class="card-text">Цена: ' . $row['price'] . '</p>';
        echo ' <a  href="full_service_info.php?id=' . $row['id'] . '" class="btn btn-bubble">Перейти</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';

} catch (PDOException $e) {
    echo '<p class="text-danger">Ошибка получения данных: ' . $e->getMessage() . '</p>';
}

?>
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-text {
        flex-grow: 1;
    }
    .row.no-gutters {
        display: flex;
        flex-direction: row;
    }
    .col-md-8 {
        flex: 1;
    }


</style>
