<?php include "header.php"; ?>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    // Подключение к базе данных
                    $servername = "localhost";
                    $username = "zoxan";
                    $password = "123";
                    $dbname = "textovarorg";

                    try {
                        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Проверка наличия переданного ID товара
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];

                            // Получение информации о товаре из базы данных
                            $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
                            $stmt->bindParam(':id', $id);
                            $stmt->execute();
                            $product = $stmt->fetch(PDO::FETCH_ASSOC);

                            // Проверка, найден ли товар с указанным ID
                            if($product) {
                                // Вывод информации о товаре
                                echo '<h2 class="card-title">' . $product['name'] . '</h2>';
                                echo '<div class="text-center mb-4">';
                                echo '<img src="' . $product['image'] . '" class="img-fluid product-img" alt="Изображение товара">';
                                echo '</div>';
                                echo '<p class="card-text">' . $product['description'] . '</p>';
                                echo '<p class="card-text">Цена: ' . $product['price'] . '</p>';

                                // Проверка авторизации пользователя
                                if(isset($_SESSION['user'])) {
                                    // Вывод формы "Заказать"
                                    echo '<form action="make_order.php" method="post">';
                                    echo '<div class="form-group">';
                                    echo ' <label for="telephone">Введите ваш номер телефона:</label>';
                                    echo '<input type="tel" class="form-control" id="telephone" name="telephone" required>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="product_id" id="product_id" value="' . $product['id'] . '">';
                                    echo '<input type="hidden" name="order_date" value="' . date("Y-m-d H:i:s") . '">';

                                    // Проверка наличия ошибок и вывод их под инпутом
                                    if(isset($_SESSION['error'])) {
                                        echo '<div class="alert alert-danger mt-3" role="alert">';
                                        echo $_SESSION['error'];
                                        echo '</div>';
                                        unset($_SESSION['error']); // Очищаем ошибку после вывода
                                    }

                                    echo '<button type="submit" class="btn btn-primary mt-2">Подтвердить заказ</button>';
                                    echo '</form>';
                                } else {
                                    // Сообщение о необходимости авторизации
                                    echo '<p class="text-danger">Чтобы заказать товар, пожалуйста, авторизуйтесь.</p>';
                                }

                                // Здесь можно добавить любую другую информацию о товаре
                            } else {
                                echo '<p class="text-danger">Товар не найден.</p>';
                            }
                        } else {
                            echo '<p class="text-danger">ID товара не указан.</p>';
                        }
                    } catch (PDOException $e) {
                        echo '<p class="text-danger">Ошибка получения данных: ' . $e->getMessage() . '</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Стили для установки фиксированной высоты для изображений */
    .product-img {
        height: 200px; /* Выберите желаемую высоту */
    }
</style>
</body>
