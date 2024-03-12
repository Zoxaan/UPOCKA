<?php include "header.php"; ?>

    <style>
        .category-container {
            margin-top: 50px;
        }

        .category-container .category {
            text-align: center;
            margin-bottom: 30px;
        }

        .category a {
            text-decoration: none; /* Убираем подчеркивание ссылок */
            color: white; /* Устанавливаем белый цвет текста для ссылок */
            position: relative; /* Устанавливаем позиционирование относительно ссылки */
        }

        .category a:hover {
            color: #ffd000; /* Устанавливаем зеленый цвет текста для ссылок при наведении */
        }

        .category a::after {
            content: ''; /* Создаем псевдоэлемент для линии */
            display: block;
            width: 0; /* Начальная ширина линии */
            height: 2px; /* Толщина линии */
            background-color: #ffd000; /* Зеленый цвет линии */
            position: absolute; /* Позиционируем относительно ссылки */
            bottom: -5px; /* Располагаем линию под текстом ссылки */
            left: 0; /* Выравниваем линию по левому краю ссылки */
            transition: width 0.3s; /* Анимируем изменение ширины */
        }

        .category a:hover::after {
            border-top: 4px solid #ffd000; /* Зеленый цвет линии */
            width: 100%; /* Увеличиваем ширину линии при наведении */
        }

        .category img {

            width: 100%; /* Устанавливаем ширину изображения на 100% ширины родительского контейнера */
            height: 300px; /* Фиксированная высота изображения */
            object-fit: cover; /* Заполнение изображения в пределах заданных размеров без изменения пропорций */
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row category-container">
        <div class="col-md-6 category">
            <a href="uslugi.php">
                <img src="https://lekom.ru/lekom_repair/images/title_2_bg.webp" alt="Services">
                <h2>Услуги</h2>
            </a>
        </div>
        <div class="col-md-6 category">
            <a href="tovars.php">
                <img src="https://img.freepik.com/premium-photo/compilation-electronic-gadgets-black-background_893571-15167.jpg" alt="Products">
                <h2>Товары</h2>
            </a>
        </div>
    </div>
</div>
<?php include "foter.php"; ?>
</body>
