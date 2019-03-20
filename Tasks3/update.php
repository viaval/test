<?php

$data = [
    "id"=>$GET['id'],
    "title"=>$POST['title'],
    "content"=>$POST['content']
        
    ];
 require 'database/QueryBuilder.php';
 $db = new QueryBuilder;
 $task=$db->updateTask($data);
 
     
     header("Location:./"); exit;
     

