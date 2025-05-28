<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .profile-img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .logout {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 15px;
            background-color: #d9534f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout:hover {
            background-color: #c9302c;
        }
    </style>
</head>

<body>

    <h2>Bienvenido <?= htmlspecialchars($user['name']) ?></h2>

    <img class="profile-img" src="<?= htmlspecialchars($user['picture'] ?? 'default.png') ?>" alt="Foto de perfil">

    <p>Email: <?= htmlspecialchars($user['email']) ?></p>

    <a class="logout" href="index.php?action=logout">Cerrar sesión</a>

</body>

</html>
