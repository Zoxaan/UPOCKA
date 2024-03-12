<?php include "header.php"; ?>

<body>
<div class="container">
    <h2 class="mt-5">Добавление товара</h2>
    <form method="post" action="add_product_process.php" enctype="multipart/form-data" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">Название товара</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Изображение</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
<!-- Гифка -->
<div class="text-center mt-5">
    <img src="https://www.icegif.com/wp-content/uploads/2022/01/icegif-548.gif" alt="Funny GIF" ">
</div>
</body>

