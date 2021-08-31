<?php 
   ob_start();
   require_once "../../config/connection.php";
   require_once "functions.php";

    if (isset($_POST['send'])) {
    
        header("Content-type:application/json");

        $id = $_POST['idList'];

        $data=[];

        try {
            deleteList($id);
            // $data=["message"=>"Uspeh!Uspeh!Uspeli smo jej!"];
            $data=["message"=>"Successfully deleted list!"];
            $code = 201;
        } catch (PDOException $e) {
            $code = 500; 
            $data=["error"=>"Something wrong with the database, we're sorry..."];
            catchErrors($e->getMessage());
        }
        
        http_response_code($code);
        echo json_encode($data);
    }

else if (isset($_POST['sendMenu'])) {
 
        header("Content-type:application/json");
    
        $id = $_POST['idMenu'];
    
        $data=[];
    
        try {
            deleteMenu($id);
            // $data=["message"=>"Uspeh!Uspeh!Uspeli smo jej!"];
            $data=["message"=>"Successfully deleted menu item!"];
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