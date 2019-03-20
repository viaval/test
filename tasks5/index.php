<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require('connect.php');
$statement = $pdo->query("SELECT * FROM posts ");
$posts = $statement->fetchAll(PDO:: FETCH_ASSOC);
if (isset($_SESSION['logged_user_id'])) $sessionUserId = $_SESSION['logged_user_id'];

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
</head>
<body>

<div class="container">
    <?php if (isset($_SESSION['logged_user_id'])) : ?>
        <?php $statement = $pdo->query("SELECT * FROM users WHERE id = '$sessionUserId'");
        $user = $statement->fetchAll(PDO:: FETCH_ASSOC);
        $userName = $user[0]['username'];
        ?>
        <div class="alert alert-success" role="alert"><?= $userName ?>, Вы авторизованы</div>
        <a href="logout.php" class="btn btn-lg btn-outline-primary btn-block">Выйти</a>
    <?php else : ?>
        <form class="form-signin">
            <a href="login.php" class="btn btn-lg btn-outline-primary btn-block">Войти</a>
            <a href="signup.php" class="btn btn-lg btn-outline-primary btn-block">Зарегистрироваться</a>
        </form>
    <?php endif; ?>


    <div class="row">
        <h1>Мои статьи</h1>
    </div>
    <div class="row">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4 ">
                <h2><?php echo $post["name"] ?></h2>
                <p><?php echo $post["description"] ?></p>
                <!--                <p>--><?php //echo $post["id_author"] ?><!--</p>-->
                <!--                <p>--><?php //echo $post["id"] ?><!--</p>-->
                <a href="#">Читать далее</a>
                <?php if (isset($_SESSION['logged_user_id'])): ?>
                    <?php if (($_SESSION['logged_user_id'] == $post['id_author']) or ($_SESSION['logged_user_id'] == '1')): ?>
                        <div class="d-flex justify-content-around">
                            <form action="delete.php" method="POST">
                                <input type="hidden" value="<?php echo $post["id"] ?>" name="id">
                                <input type="submit" value="Удалить">
                            </form>
                            <form action="edit.php" method="POST">
                                <input type="hidden" value="<?php echo $post["id"] ?>" name="id">
                                <input type="submit" value="Редактировать">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <?php if (isset($_SESSION['logged_user_id'])): ?>
        <div class="row">
        <div class="col-md-4">
            <h4>Добавление статьи</h4>
            <form action="create.php" method="POST">
                <input type="text" name="name" placeholder="Добавьте заголовок статьи"><br><br>
                <textarea name="description" id="" cols="30" rows="10" placeholder="Добавьте статью"></textarea><br><br>
                <input type="submit" value="Добавить статью">
            </form>
        </div>
        <?php if ($_SESSION['logged_user_id'] == '1') : ?>
            <div class="col-md-4">
                <h4>Удаление статьи</h4>
                <form action="delete.php" method="post">
                    <select size="1" name="deletepost" required>
                        <option value="1" disabled>Выберите статью</option>
                        <?php foreach ($posts as $post): ?>
                            <option value="<?php echo $post["id"] ?>"><?php echo $post["name"] ?></option>
                        <?php endforeach; ?>
                    </select><br><br>
                    <input type="submit" value="Удалить">
                </form>
            </div>
            <div class="col-md-4">
                <h4>Правка статьи</h4>
                <form action="edit.php" method="post">
                    <select size="1" name="editpost" required>
                        <option value="1" disabled>Выберите статью</option>
                        <?php foreach ($posts as $post): ?>
                            <option value="<?php echo $post["id"] ?>"><?php echo $post["name"] ?></option>
                        <?php endforeach; ?>
                    </select><br><br>
                    <input type="submit" value="Открыть">
                </form>
            </div>

            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>