<?php session_start();

if (isset($_SESSION['user'])) {
    header('Location: content.php');
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $errores = '';

    if (empty($user) || empty($password) || empty($password2) ) {
        $errores .= '<li>*Hay campos vacios</li>';
    } else {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=login_users', 'root', '');

        } catch (PDOException $e){
            echo "ERROR: " . $e -> getMessage();
        }

        $statement = $conexion -> prepare("SELECT * FROM users WHERE user = ? LIMIT 1");
        $statement -> execute([$user]);

        $result = $statement -> fetch();

        if ($result != false) { //Sí el usuario existe
            $errores .= '<li>Ya existe éste usuario.</li>';
        }

        $password = hash('sha512', $password);
        $password2 = hash('sha512', $password2);

        if ($password != $password2) {
            $errores .= '<li>Las contraseñas deben coincidir.</li>';
        }
    }

    if ($errores == '') {
        $statement = $conexion -> prepare('INSERT INTO users (id, user, password) VALUES (null, ?, ?)');
        $statement -> execute([$user, $password]);

        header('Location: login.php');
    }
}


require 'views/register.view.php';

?>