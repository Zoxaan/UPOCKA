
<?php
// Подключение к базе данных
$servername = "localhost";
$username = "zoxan";
$password = "123";
$dbname = "textovarorg";

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit;
}
include "header.php";
// Получение списка пользователей
$stmt = $db->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>
<body>
<h2>Просмотр пользователей</h2>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }

    .btn-primary:hover {
        animation: glow 1s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 10px #000000;
        }
        to {
            box-shadow: 0 0 20px #000000, 0 0 30px #000000, 0 0 40px #000000;
        }
    }


    .btn-danger:hover {
        animation: glow 1s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 10px #000000;
        }
        to {
            box-shadow: 0 0 20px #000000, 0 0 30px #000000, 0 0 40px #ffd000;
        }
    }
</style>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Роль</th>
        <th>Изменить роль</th>
        <th>Удалить</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['mail']; ?></td>
            <td style="color: <?php echo $user['role'] == 'admin' ? 'rgb(0, 128, 0)' : 'rgb(255, 0, 0)'; ?>"><?php echo $user['role']; ?></td>
            <td>
                <form method="post" action="change_role.php" onsubmit="return confirm('Вы уверены, что хотите изменить роль этого пользователя?');">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <input type="hidden" name="role" value="<?php echo $user['role'] == 'admin' ? 'user' : 'admin'; ?>">
                    <button type="submit" class="btn btn-primary" style="background-color: <?php echo $user['role'] == 'admin' ? 'rgb(0, 128, 0)' : 'rgb(255, 0, 0)'; ?>; border-color: <?php echo $user['role'] == 'admin' ? 'rgb(0, 128, 0)' : 'rgb(255, 0, 0)'; ?>; color: white;">Изменить роль</button>
                </form>
            </td>
            <td>
                <form method="post" action="delete_user.php" onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?');">
                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                    <button type="submit" class="btn btn-danger" style="background-color: rgb(255, 0, 0); border-color: rgb(255, 0, 0); color: white;">Удалить</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>