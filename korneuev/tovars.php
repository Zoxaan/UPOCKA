<?php include "header.php"; ?>

<body>
<div class="container">
    <h1>Оргтехника</h1>
    <p>Добро пожаловать на наш сайт товаров</p>
    <hr>

    <!-- Карусель -->
    <style>
        .carousel-item img {
            max-height: 300px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .carousel-control-prev,
        .carousel-control-next {
            filter: drop-shadow(0 0 10px rgba(0, 0, 0, 0.3));
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            height: 30px;
            background-color: #333;
            border-radius: 50%;
            color: #fff;
        }
         h2, h3, h1 {
            color: #ffd000; /* Цвет заголовка */
        }

        p {

            padding-top: 3%;
            font-size: 16px;
        }

        .company-info img {
            display: block;
            margin: 0 auto; /* Располагаем изображение по центру */
            width: 25%; /* Увеличиваем ширину изображения */
            max-width: 100%;
            height: auto;
            border-radius: 10px; /* Добавляем скругление углов */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Добавляем тень */
        }
        .company-info img + p::after {
            content: "";
            display: block;
            width: 100%;
            margin-top: 10px;
            border-top: 3px solid #ffd000; /* Зеленый цвет линии */
        }
    </style>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 60%; margin: 0 auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://3dnews.ru/assets/external/illustrations/2023/09/11/1092862/printer-pixabay.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://lekom.ru/lekom_main_page_middle/images/complex_it_solutions.webp" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h2>Товары</h2>
    <div class="row">
        <?php
        // Подключение к базе данных
        $servername = "localhost";
        $username = "zoxan";
        $password = "123";
        $dbname = "textovarorg";

        try {
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Получение списка товаров из базы данных
            $stmt = $db->query("SELECT * FROM products");
            $products = $stmt->fetchAll();

            // Вывод карточек товаров
            foreach ($products as $product) {
                echo '<div class="col-md-3 col-sm-5">'; // Установка ширины карточки на устройствах среднего размера и больше
                echo '<div class="card" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">';
                echo '<img src="' . $product['image'] . '" class="card-img-top" style="width: 100%; height: auto;" alt="...">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $product['name'] . '</h5>';
                echo '<p class="card-text">' . $product['description'] . '</p>';
                echo '<p class="card-text">Цена: ' . $product['price'] . '</p>';
                // Добавление ссылки с передачей ID товара
                echo '<a href="product_details.php?id=' . $product['id'] . '" class="btn btn-primary">Подробнее</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo "Ошибка получения данных: " . $e->getMessage();
        }
        ?>
    </div>
<?php include "foter.php"; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
