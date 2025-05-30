<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Datos del usuario real desde la sesión
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 50px;
        }

        .profile-img {
            border-radius: 50%;
            width: 120px;
            height: 120px;
            object-fit: cover;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
        }

        .logout {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
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

    <h1>Bienvenido, <?= htmlspecialchars($user['name']) ?></h1>
    <img class="profile-img" src="<?= htmlspecialchars($user['picture']) ?>" alt="Foto de perfil">
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

    <!-- Botón para cerrar sesión -->
    <a class="logout" href="index.php?action=logout">Cerrar sesión</a>

</body>
</html>
