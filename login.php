<?php session_start();

if (isset($_SESSION['user'])) {
    header('Location: content.php');
}

$errores = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = filter_var(strtolower($_POST['user']), FILTER_SANITIZE_STRING);
    $password = hash('sha512' , $_POST['password']);

    try {
    $conexion = new PDO('mysql:host=localhost;dbname=login_users', 'root', '');

    } catch (PDOException $e){
        echo "ERROR " . $e -> getMessage();
    }
    
    $statement = $conexion -> prepare('SELECT * FROM users WHERE user = ? AND password = ?');
    $statement -> execute([$user, $password]);
    $result = $statement -> fetch();

    if ($result !== false) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
    } else {
        $errores .= '<li>ERROR: el usuario y/o contraseña son incorrectos</li>';
    }
}

require 'views/login.view.php';

?>