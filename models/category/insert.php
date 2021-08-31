<?php

if(isset($_POST['dugmeCreateCat'])){
    
    require_once "../../config/connection.php";
    require_once "functions.php";

    $name=$_POST["name"];

    $errors = [];

    try {
        $result=insertNewCat($name);
        $_SESSION["success"]= "Successfully inserted!";
        header("Location:../../index.php?page=admin-category");
    } catch (PDOException $e) {
        //sve ovo uvek u txt error fajl
        catchErrors($e->getMessage());
        $_SESSION["errors"]= "Something wrong with the database, we're sorry...";
        header("Location:../../index.php?page=admin-category");
    }
}
else{
    header("Location:../../index.php?page=admin-category");
}