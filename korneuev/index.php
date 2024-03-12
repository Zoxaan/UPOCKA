<?php
?>

<?php include "header.php"; ?>
    <body>
    <div class="container">

        <h1>Оргтехника</h1>
        <p>Добро пожаловать на наш сайт по продаже и обслуживанию оргтехники!</p>
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
            h2 ,h3 {
                color: #ffd000; /* Цвет заголовка */
            }
        </style>

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="width: 60%; margin: 0 auto;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://lekom.ru/lekom_maintenance/images/banner.webp" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://lekom.ru/lekom_main_page_middle/images/complex_it_solutions.webp" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://png.pngtree.com/thumb_back/fw800/background/20230524/pngtree-mobile-phone-tablet-and-laptop-on-black-background-animated-and-retouched-image_2615783.jpg" class="d-block w-100" alt="...">
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




        <!-- Маленькая картинка -->


        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <!-- Контактная информация -->
                    <h2>Контактная информация</h2>
                    <p><strong>Телефон:</strong> +7 (967) 663-30-96</p>
                    <p><strong>Email:</strong> voladosas.05@mail.ru</p>
                    <p><strong>Адрес:</strong> Улица, Город, Страна</p>
                </div>
                <div class="col-md-6">
                    <!-- Карта -->
                    <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/10988/belorechensk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Белореченск</a><a href="https://yandex.ru/maps/10988/belorechensk/house/lomany_pereulok_9/Z0AYfgBjSEUAQFpufXt2d3trZA==/?ll=39.874894%2C44.776822&utm_medium=mapframe&utm_source=maps&z=17.12" style="color:#eee;font-size:12px;position:absolute;top:14px;">Ломаный переулок, 9 — Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?ll=39.874894%2C44.776822&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgoyMTYwMDYzNzIwEm3QoNC-0YHRgdC40Y8sINCa0YDQsNGB0L3QvtC00LDRgNGB0LrQuNC5INC60YDQsNC5LCDQkdC10LvQvtGA0LXRh9C10L3RgdC6LCDQm9C-0LzQsNC90YvQuSDQv9C10YDQtdGD0LvQvtC6LCA5IgoNEX4fQhVsGzNC&z=17.12" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12 text-left max-width: 50%;">
                <h3>О нашей компании</h3>
                <p>Мы - компания, специализирующаяся на продаже и обслуживании оргтехники.</br> Наша цель - предоставить нашим клиентам высококачественную продукцию и отличный сервис.</p>
            </div>
        </div>

        <!-- Маленькая картинка -->
        <div class="row mt-3">
            <div class="col-md-12 text-left">
                <img src="https://it-usluga.ru/wp-content/uploads/2022/03/pdn.jpg" alt="Small Image" style="max-width: 300px;">
                <a href="company.php" class="btn btn-success">Подробнее</a>
            </div>
        </div>

    </div>

    </div>

    <?php include "foter.php"; ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
