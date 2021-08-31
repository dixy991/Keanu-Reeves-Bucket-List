<?php 
   ob_start();
if (isset($_POST['send'])) {
 
    require_once("../../config/connection.php");
    require_once("functions.php");
    header("Content-type:application/json");

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];;

    $errors = [];
    $code = 404;
    $data = null;

    $reName = "/^[A-Z][a-z]+(\s[A-Z][a-z]+)*$/";

    if($name==""){
        array_push($errors, "Name is required! <br/>");
    }
    else if (!preg_match($reName, $name)) {
        array_push($errors, "Name in bad format!-Start with an uppercase every word! <br/>");
    }

    if($email==""){
        array_push($errors, "Email is required!");
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email in bad format!Gotta have @ in it and 2 domains after!Like this: try.again@gmail.com <br/>");
    }

    if($message==""){
        array_push($errors, "Write something...!");
    }

    if (count($errors)>0) {
        $data = $errors;
        $code = 422;
    } 
    else {
        try {
            //slanje mejla adminu
            $to= "bucket.list.with.k.r@gmail.com";
            $recepient_name="~K.R. Bucket List";
            createMail($email,$name,$message,$to,$recepient_name);
            $code = 201;
            $data=["success"=>"Successfully sent to admin!"];
        } catch (PDOException $e) {
            $code = 500; 
            catchErrors($e->getMessage());
            $data=["error"=>"Something wrong with the databasa, we're sorry..."];
        }
    }
    http_response_code($code);
    echo json_encode($data);
}
else{
    header("Location:../index.php?page=contact");
}

?>