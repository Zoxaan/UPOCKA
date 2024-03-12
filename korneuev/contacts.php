<?php include "header.php"; ?>
<link rel="stylesheet" href="style2.scss">
    <style>
        #map {
            height: 400px;
            margin-bottom: 20px;
        }
    </style>

<body>

<!-- Навигационная панель -->

<style>

     h2 {
        color: #ffd000; /* Цвет заголовка */
    }
    p {
        font-size: 18px;
    }


</style>
<!-- Контент страницы -->
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

<!-- Скрипт для отображения карты Google Maps -->
<script>
    function initMap() {
        // Координаты для центрирования карты
        var myLatLng = {lat: 51.5074, lng: -0.1278};

        // Создание карты
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: myLatLng
        });

        // Добавление маркера на карту
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Место нахождения'
        });
    }
</script>

<!-- Скрипт для подключения карты Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=ВАШ_API_КЛЮЧ&callback=initMap" async defer></script>
<?php include "foter.php"; ?>
</body>