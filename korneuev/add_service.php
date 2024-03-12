
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-center {
            margin-top: 50px;
        }
        .text-center img {
            max-width: 100%;
            height: auto;
        }
    </style>
<body>
<?php include "header.php"; ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Добавить услугу</h2>
    <form method="post" action="add_service_process.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">Цена:</label>
            <input type="text" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">Описание:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="bigdescription">Большое описание:</label>
            <textarea class="form-control" id="bigdescription" name="bigdescription" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Изображение:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Добавить услугу</button>
        </div>
    </form>
</div>

<div class="text-center my-5">
    <img src="https://img.wattpad.com/c0907932b682f2842c211d4af5b764c2e6c75430/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f6e4551756831364b5743377858773d3d2d3732303438383936372e313539363162656264343934313937613138373538333937363432362e676966" alt="Funny GIF">
</div>

</body>