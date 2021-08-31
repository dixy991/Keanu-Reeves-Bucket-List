<?php
   ob_start();
   
   require_once("../../config/connection.php");
   require_once("functions.php");

   //manage bucket

    if(isset($_POST["dugmeDone"])){
        $id=$_POST["idBucketDo"];

        try {
            markAsDone($id);
            header("Location:../../index.php?page=bucket");
        } catch (PDOException $e) {
            catchErrors($e->getMessage());
            $_SESSION["errors"]= "Something wrong with the database, we're sorry...";
            header("Location:../../index.php?page=bucket");
        }
    }
    else{
        header("Location:../../index.php?page=bucket");
    }

    if(isset($_POST["dugmeDelete"])){
        $id=$_POST["idBucketDelete"];

        try {
            deleteIzBucket($id);
            header("Location:../../index.php?page=bucket");
        } catch (PDOException $e) {
            catchErrors($e->getMessage());
            $_SESSION["errors"]= "Something wrong with the database, we're sorry...";
            header("Location:../../index.php?page=bucket");
        }
    }else{
        header("Location:../../index.php?page=bucket");
    }
?>