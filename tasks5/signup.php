
<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require('connect.php');
if (isset($_POST['signup'])) {
    $errors = [];
    if (trim($_POST['username']) == '') {
        $errors[] = 'Введите логин';
    }
    if (trim($_POST['email']) == '') {
        $errors[] = 'Введите email';
    }
    if ($_POST['password1'] == '') {
        $errors[] = 'Введите пароль';
    }
    if ($_POST['password2'] == '') {
        $errors[] = 'Введите пароль второй раз';
    }
    if ($_POST['password1'] != $_POST['password2']) {
        $errors[] = 'Введенные пароли не совпадают';
    }

    if (empty($errors)) {
        $username = $_POST['username'];
        $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $statement = $pdo->query("SELECT * FROM users WHERE username='$username'");
        $count = $statement->fetchColumn();
        if ($count > 0) $errors[] = 'Пользователь с таким логином уже зарегистрирован, введите другой логин';

        $statement = $pdo->query("SELECT * FROM users WHERE email='$email'");
        $count = $statement->fetchColumn();
        if ($count > 0) $errors[] = 'Пользователь с таким email уже зарегистрирован, введите другой email';
        else {
            $count = $pdo->exec("INSERT INTO users (username, password, email) VALUE ('$username', '$password', '$email')");
            if ($count == 0) $errors[] = 'Не удалось записать пользователя в базу';
            else $massage = 'Регистарция прошла успешно';
        }

    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <form class="form-signin" action="signup.php" method="POST">
        <h2>Регистрация</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert"><?= array_shift($errors); ?></div>
        <?php endif; ?>
        <?php if (!empty($massage)) : ?>
            <div class="alert alert-success" role="alert"><?= $massage; ?></div>
        <?php endif; ?>
        <input type="text" name="username" class="form-control" placeholder="введите логин"
               value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
        <input type="email" name="email" class="form-control" placeholder="введите email"
               value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
        <input type="password" name="password1" class="form-control" placeholder="введите пароль"
               value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>">
        <input type="password" name="password2" class="form-control" placeholder="введите пароль еще раз"
               value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>" required>
        <button class="btn btn-lg btn-primary btn-block" name="signup" type="submit">Зарегистрироваться</button>
        <a href="login.php" class="btn btn-lg btn-outline-primary btn-block">Войти</a>
    </form>
</div>
</body>
</html>