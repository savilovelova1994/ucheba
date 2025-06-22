<?php
require_once('db.php');
if (isset($_COOKIE['User'])){
    header("Location: /profile.php");
    exit();
}

$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'site_db');

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];
    
    if (!$login || !$pass) die ("All fields are required!");

    $sql = "SELECT * FROM users WHERE username = '$login' AND pass = '$pass'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        setcookie('User', $login, time() + 7200);
        header("Location: /profile.php");
    } else {
        echo "Incorrect username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login page</title>   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
    <div class="container d-flex justify-content-center allign-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Login:</h1>
                <form action="login.php" method="POST" class="d-flex flex-column gap-3">
                    <input type="text" name="login" class="form-control user-input" placeholder="login">
                    <input type="password" name="password" class="form-control user-input" placeholder="password">
                    <button class="btn btn-primary" type="submit" name="submit">Register</button>
                    <p class="mt-3">Don't have an account? <a href="/registration.php">Sign up</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>