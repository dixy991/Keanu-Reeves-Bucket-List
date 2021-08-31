<?php 
   ob_start();
if (isset($_POST['send'])) {

    require_once("../../config/connection.php");
    require_once("functions.php");
    require_once("../../models/list/functions.php");
    header("Content-type:application/json");
    $data=[];

    try {
        $page = ($_POST['page'] - 1) * 3;
        $idFilterKat = $_POST['idFilterKat'];
        $idSort = $_POST['idSort'];
        // $data = filterCat($id);
        $query= "SELECT *, l.name as listName FROM list l INNER JOIN image i on l.image_ID=i.id_image";
        //filtriranje
        if($idFilterKat!=0){
            $query.= " WHERE category_ID=? ORDER BY ";
        }
        else{
            $query.=" ORDER BY ";
        }
        //sortiranje
        switch ($idSort) {
            case '0':
                $query.=" id_list ";
                break;
            case '1':
                $query.=" listName ";
                break;
            case '2':
                $query.=" listName DESC ";
                break;
            
            default:
                $query.=" id_list ";
                break;
        }
        $code=201;
        $query.=" LIMIT $page,3";
        $priprema=$conn->prepare($query);
        $priprema->execute([$idFilterKat]);
        $all=$priprema->fetchAll();
        foreach($all as $al){
            $added[]=  getAddedStatistics($al->id_list); 
            $done[]=  getDoneStatistics($al->id_list); 
        }
        array_push($data,$all);
        array_push($data,$added);
        array_push($data,$done);

    } catch (PDOException $e) {
        $code = 500; 
        $data=["error"=>"Something wrong with the database, we're sorry..."];
        catchErrors($e->getMessage());
    }

    http_response_code($code);
    echo json_encode($data);
}
else{
    header("Location:../../index.php?page=list");
}
?>