<?php 
   ob_start();
   //na kliktanje brojeva
   //filter, sort i paginacija sve idu na jednu filter-sort stranicu
   //ova je za dohvatanje paginacije, tj liste sve sto idu za paginaciju samo
    if (isset($_POST['send'])) {
        
        require_once("../../config/connection.php");
        require_once("functions.php");
        header("Content-type:application/json");

        try {
            $perpage=$_POST["perpage"];//0 na pocetku, zostale prosledjen ID za filter/sort
            if($perpage==0){
                $data=countAllLists();
            }
            else{
                $data=countSpecificList($perpage);
            }
            $code=201;

        } catch (PDOException $e) {
            $code = 500; 
            $data=["error"=>"Something wrong with the database, we're sorry..."];
            catchErrors($e->getMessage());
        }

        http_response_code($code);
        echo json_encode($data);
    }
    else{
        header("Location:../../index.php?page=register");
    }
?>