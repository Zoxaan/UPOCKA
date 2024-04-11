<?php include "../header/header.php"; ?>
<style>
    /* Стили для карты */
    #map {
        height: 400px;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow: hidden;
    }

    /* Стили для контактной информации */
    .contact-info {
        background-color: #ffd000; /* Цвет фона */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .contact-info h2 {
        color: #000; /* Цвет заголовка */
        font-size: 28px; /* Размер шрифта заголовка */
        margin-bottom: 20px;
    }

    .contact-info p {
        color: #000; /* Цвет текста */
        font-size: 18px; /* Размер шрифта текста */
        margin-bottom: 10px;
    }

    /* Стили для ссылок на карту */
    .map-link {
        color: #eee; /* Цвет текста */
        font-size: 12px; /* Размер шрифта */
        position: absolute;
        top: 0;
        left: 0;
        text-decoration: none;
        background-color: rgba(0, 0, 0, 0.5); /* Прозрачный фон */
        padding: 5px 10px;
    }

    .map-link:hover {
        background-color: rgba(0, 0, 0, 0.7); /* Прозрачный фон при наведении */
    }
</style>

<body>

<!-- Контент страницы -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Контактная информация -->
            <div class="contact-info">
                <h2>Контактная информация</h2>
                <p><strong>номер ресепшена:</strong> +7 (967) 663-30-96</p>
                <p><strong>Email:</strong> voladosas.05@mail.ru</p>
                <p><strong>Адрес:</strong> ул. Карла Либкнехта, 99/1</p>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Карта -->
            <div id="map">
                <a href="https://yandex.ru/maps/10988/belorechensk/?utm_medium=mapframe&utm_source=maps" class="map-link">Белореченск</a>
                <a href="https://yandex.ru/maps/10988/belorechensk/?ll=39.874894%2C44.776822&mode=poi&poi%5Bpoint%5D=39.868796%2C44.775259&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1020746981&utm_medium=mapframe&utm_source=maps&z=17" class="map-link">ул. Карла Либкнехта, 99/1, Белореченск</a>
                <iframe src="https://yandex.ru/map-widget/v1/?ll=39.874894%2C44.776822&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgoyMTYwMDYzNzIwEm3QoNC-0YHRgdC40Y8sINCa0YDQsNGB0L3QvtC00LDRgNGB0LrQuNC5INC60YDQsNC5LCDQkdC10LvQvtGA0LXRh9C10L3RgdC6LCDQm9C-0LzQsNC90YvQuSDQv9C10YDQtdGD0LvQvtC6LCA5IgoNEX4fQhVsGzNC&z=17.12" width="100%" height="400" frameborder="1" allowfullscreen="true"></iframe>
            </div>
        </div>
    </div>
</div>

</body>
