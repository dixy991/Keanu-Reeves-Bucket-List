<?php

if(isset($_POST['send'])){
    
    require_once "../../config/connection.php";
    require_once "functions.php";
    header("Content-type:application/json");

    $id=$_POST["idList"];

    $errors = [];

    try {
        $user=findListById($id);
        $code=201;
        $data=$user;
        
    } catch (PDOException $e) {
        $code = 500; 
        $data=["error"=>"Something wrong with the database, we're sorry..."];
        catchErrors($e->getMessage());
    }
    
    http_response_code($code);
    echo json_encode($data);
    
}
else{
    header("Location:../../index.php?page=admin-list");
}