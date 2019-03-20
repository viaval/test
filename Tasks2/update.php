<?php

$data = [
    "id"=>$GET['id'],
    "title"=>$POST['title'],
    "content"=>$POST['content']
        
    ];
 $pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");
   $sql ='ÚPDATE tasks SET title=:title, content=:content WHERE id=:id';
   $statement = $pdo->prepare($sql);
     $statement->execute($data);
     
     header("Location: http://localhost/MyNotes0/Tasks2/"); exsit;
     

