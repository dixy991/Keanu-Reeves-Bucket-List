<?php 
   ob_start();
if (isset($_POST['send'])) {
 
    require_once "../../config/connection.php";
    require_once "functions.php";
    header("Content-type:application/json");

    $id = $_POST['idCat'];

    $data=[];

    try {
        deleteCat($id);
        $data=["message"=>"Successfully deleted user!"];
        $code = 201;
    } catch (PDOException $e) {
        $code = 500; 
        $data=["error"=>"Something wrong with the database, we're sorry..."];
        catchErrors($e->getMessage());
    }
    
    http_response_code($code);
    echo json_encode($data);
}
else{
    header("Location:../../index.php?page=admin-category");
}

?>