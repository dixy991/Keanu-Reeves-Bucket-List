<?php 
   ob_start();
if (isset($_POST['send'])) {

    require_once("../../config/connection.php");
    require_once("functions.php");
    header("Content-type:application/json");
    $data=[];
    $idList=$_POST["idList"];
    $idUser=$_POST["idUser"];
    try {
        if(proveraUbucket($idList,$idUser)){
            insertUbucket($idList,$idUser);
            // $data=["message"=>"Uspeh!Uspeh!Uspeli smo jej!"];
            $data=["message"=>"Successfully inserted in bucket!"];
            $code=201;
        }
        else{
            $data=["message"=>"Already chosen..."];
            $code=409;
        }

    } catch (PDOException $e) {
        $code = 500; 
        catchErrors($e->getMessage());
        $data=["error"=>"Something wrong with the databasa, we're sorry..."];
    }

    http_response_code($code);
    echo json_encode($data);
}
else{
    header("Location:../../index.php?page=bucket");
}
?>