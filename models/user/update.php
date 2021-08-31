<?php 
   ob_start();
if (isset($_POST['send'])) {
 
    require_once("../../config/connection.php");
    require_once("functions.php");
    header("Content-type:application/json");

    $id = $_POST['idUser'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $active = $_POST['active'];
    $role = $_POST['role'];

    $errors = [];
    $code = 404;
    $data = [];

    $reUser = "/^[\d\w\_\-\.@]{5,50}$/";

    if($username==""){
        array_push($errors, "Username is required!");
    }
    else if (!preg_match($reUser, $username)) {
        array_push($errors, "Username in bad format!-At least 5 characters! <br/>");
    }

    if($email==""){
        array_push($errors, "Email is required!");
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email in bad format!Gotta have @ in it and 2 domains after!Like this: try.again@gmail.com <br/>");
    }

    if (count($errors)>0) {
        $data = $errors;
        $code = 422;
    } 
    else {
        try {
            updateUser($id,$username,$email,$active,$role);
            // $data=["message"=>"Uspeh!Uspeh!Uspeli smo jej!"];
            $data=["message"=>"Successfully updated user!"];
            $code = 201;

        } catch (PDOException $e) {
            $code = 500; 
            $data=["error"=>"Something wrong with the database, we're sorry..."];
            catchErrors($e->getMessage());
        }
    }
    http_response_code($code);
    echo json_encode($data);
}
else{
    header("Location:../../index.php?page=register");
}
?>