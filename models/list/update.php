<?php 
   ob_start();
if (isset($_POST['changeList'])) {
 
    require_once("../../config/connection.php");
    require_once("functions.php");

    $id = $_POST['idList'];
    $name = $_POST['editName'];
    $category = $_POST['editCategory'];

    $errors = [];
    $allowed = ['image/jpg', 'image/jpeg', 'image/png'];
    
    $jelPoslataSLika=strlen($_FILES["editPicture"]["tmp_name"]);

    if($jelPoslataSLika!=0){
        $picture_name = $_FILES['editPicture']['name'];
        $picture_tmp_name = $_FILES['editPicture']['tmp_name'];
        $picture_type = $_FILES['editPicture']['type'];
        $picture_size = $_FILES['editPicture']['size'];
        
        if(!in_array($picture_type, $allowed)){
        array_push($errors, "Oh no! Only jpg/jpeg/png formats allowed!");
        }
        if($picture_size > 3000000){
            array_push($errors, "Too big! Gotta be less than 3MB!");
        }
    }

    if($name==""){
        array_push($errors, "Name is required!");
    }

    if (count($errors)>0) {
        $_SESSION["errors"]=$errors;
        header("Location:../../index.php?page=admin-list");
    } 
    else {
        if($jelPoslataSLika!=0){
            list($src_small,$src,$alt)=createPicture($picture_name,$picture_tmp_name,$picture_type);
        }
        try {
            
            $conn->beginTransaction();
            
            if($jelPoslataSLika!=0){
                $isInserted = insertUimages($src_small, $src,$alt);
                $id_of_image=$conn->lastInsertId();
            }
            
            updateList($id,$name,$category,$id_of_image);
            
            $conn->commit();
            
            header("Location:../../index.php?page=admin-list");

        } catch (PDOException $e) {
            
            header("Location:../../index.php?page=admin-list");
            catchErrors($e->getMessage());
        }
    }
}
else{
    header("Location:../../index.php?page=admin-panel");
}
?>