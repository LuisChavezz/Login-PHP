<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">

    <script src="https://kit.fontawesome.com/87f377c3df.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="content">
        <h1>Inicia Sesión</h1>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login" autocomplete="off">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="user" placeholder="User"/>
            </div>

            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password"/>
            </div>

            <button onclick="login.submit()">Registrarse</button>
        </form>

        <p>¿Aun no tienes una cuenta? <a href="login.php">Regístrate aquí</a></p>
    </div>
</body>
</html>