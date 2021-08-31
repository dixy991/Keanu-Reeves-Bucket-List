<?php 
   ob_start();
if (isset($_POST['send'])) {
 
    require_once("../../config/connection.php");
    require_once("functions.php");
    header("Content-type:application/json");

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $code = 404;
    $data = null;

    $rePass = "/^[A-z0-9]{7,50}$/";
    $reUser = "/^[\d\w\s\_\-\.@]{5,50}$/";

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
        array_push($errors, "Email in bad format!Gotta have @ in it and domains!Like this: try.again@gmail.com <br/>");
    }

    if($password==""){
        array_push($errors, "Password is required!");
    }
    else if (!preg_match($rePass, $password)) {
        array_push($errors, "Password in bad format! At least 7 characters!**Only letters and numbers! <br/>");
    }

    if (count($errors)>0) {
        $data = $errors;
        $code = 422;
    } 
    else {
        $password = md5($password);
        try {
            $check=checkUser($email,$password);

            if ($check>=1) {
                $code=409;
            }else{
                insertUser($username,$email, $password);
                // $data=["message"=>"Uspeh!Uspeh!Uspeli smo jej!"];
                $code = 201;
                $data=["message"=>"Successfully registered!Almost welcome(when you login)"];
            }
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