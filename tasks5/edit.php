<?php

if (issert ($_POST['id'])) {
    $id = $_POST['id'];
    }else if (isset($_POST['editpost'])) {
    $id = $_POST['editpost'];   
} else {
    echo 'нет ID';
}
require ('conntct.php');
$statement = $pdo->query("SELECT* FROM posts WHERE id='$id'");
$posts = $statement->fetchALL(PDO:: FETCH_ASSOC);

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
    <div class="row">
        <h1>Редактирование статьи</h1>
    </div>
    <form action="update.php" method="POST">
        <input type="text" name="name"  value="<?=$posts[0]['name']?>"><br><br>
        <input type="hidden" value="<?= $posts[0]['id'] ?>" name="id">
        <textarea name="description" id="" cols="100" rows="10" ><?=$posts[0]['description']?></textarea><br><br>
        <input type="submit" value="Сохранить  статью">
    </form>
    <br>
    <a href="index.php"><button type="button" class="btn btn-primary btn-lg">НАЗАД К СТАТЬЯМ</button></a>
</div>
</body>
</html>
