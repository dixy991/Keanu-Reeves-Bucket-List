<?php 
    ob_start();
    session_start();
    if (isset($_POST['dugmeLogin'])) {

        require_once("../../config/connection.php");
        require_once("functions.php");
        require_once("../file/functions.php");

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        $rePass = "/^[A-z0-9]{7,50}$/";

        if($email==""){
            array_push($errors, "Email is required!");
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email in bad format!Gotta have @ in it and 2 domains after!Like this: try.again@gmail.com <br/>");
        }

        if($password==""){
            array_push($errors, "Password is required!");
        }
        else if (!preg_match($rePass, $password)) {
            array_push($errors, "Password in bad format! At least 7 characters!**Only letters and numbers! <br/>");
        }
        
        if (count($errors)>0) {
            $_SESSION["errors"]=$errors;
            header("Location:../../index.php?page=login");
        } else {
            $password = md5($password);
            try {
                $user=findUserByEmail($email);
                var_dump($user);
                $usersPassword=$user->password;
                $usersUsername=$user->username;
                $usersId=$user->id_user;
                
                if(!$user){
                    array_push($errors, "Email doesn't exist!");
                    $_SESSION["errors"]=$errors;
                    header("Location:../../index.php?page=login");
                }
                elseif($usersPassword!=$password){
                    // poslati mejl upozorenja
                    $from= "bucket.list.with.k.r@gmail.com";
                    $name="~K.R. Bucket List ";
                    $message="Ooops, your account is in danger 'cause someone is trying to break in!";
                    createMail($from,$name,$message,$email,$usersUsername);
                    array_push($errors, "Intruder!Intruder!<br/>**Wrong password");
                    $_SESSION["errors"]=$errors;
                    header("Location:../../index.php?page=login");
                }
                $found=findUser($email,$password);
                if($found->rowCount()==1){
                    $result=$found->fetch();
                    updateVisit($result->uid);
                    $_SESSION['user']=$result;
                    header("Location:../../index.php?page=home");
                }

            } catch (PDOException $e) {
                catchErrors($e->getMessage());
                $_SESSION["errors"]= "Something wrong with the database, we're sorry...";
                header("Location:../../index.php?page=login");
            }
        }
    }
    else{
        header("Location:../../index.php?page=login");
    }

?>