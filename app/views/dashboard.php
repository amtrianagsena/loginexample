<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Bienvenido <?= htmlspecialchars($user['name']) ?></h2>
    <img src="<?= $user['picture'] ?>" alt="Foto de perfil">
    <p>Email: <?= $user['email'] ?></p>
    <a href="index.php?action=logout">Cerrar sesión</a>

</body>

</html>