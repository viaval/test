<?php

$pdo  = new PDO('mysql:host=localhost;dbname=test2000; charset = utf8', 'root', '',

array (PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES\'UTF8\''));
session_start();

