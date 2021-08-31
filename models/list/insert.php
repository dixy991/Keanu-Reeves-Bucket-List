<?php

if(isset($_POST['dugmeCreate'])){
    
    require_once "../../config/connection.php";
    require_once "functions.php";

    //za listu

    $name=$_POST["name"];
    $category=$_POST["category"];

    //za im(i)dz

    $picture_name = $_FILES['picture']['name'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size'];

    $errors = [];

    $allowed = ['image/jpg', 'image/jpeg', 'image/png'];

    if(!in_array($picture_type, $allowed)){
        array_push($errors, "Oh no! Only jpg/jpeg/png formats allowed!");
    }
    if($picture_size > 3000000){
        array_push($errors, "Too big! Gotta be less than 3MB!");
    }

    if(count($errors) > 0){
        $_SESSION["errors"]=$errors;
        if($_SESSION["user"]->role=="user")header("Location: ../../index.php?page=list");
        else header("Location: ../../index.php?page=admin-list");
        //bagic
    }
    else{
        list($src_small,$src,$alt)=createPicture($picture_name,$picture_tmp_name,$picture_type);

        try {
            $conn->beginTransaction();

            $isInserted = insertUimages($src_small, $src,$alt);
            $id_of_image=$conn->lastInsertId();
            $isInserted2 = insertUlists($name, $category,$id_of_image);

            $conn->commit();

            if(($isInserted)&&($isInserted2)){
                if ((isset($_SESSION['user']) && $_SESSION['user']->role =='user')) header("Location: ../../index.php?page=list");
                else header("Location: ../../index.php?page=admin-list");
                
            }
            
        } catch(PDOException $ex){
            $_SESSION["errors"]=["Something wrong with the database, we're sorry..."];
            catchErrors($ex->getMessage());
            if($_SESSION["user"]->role=="user")header("Location: ../../index.php?page=list");
                else header("Location: ../../index.php?page=admin-list");
        }
        
    }

}

//menu

else if(isset($_POST['dugmeCreateMenu'])){
    
    require_once "../../config/connection.php";
    require_once "functions.php";

    //za listu

    $name=$_POST["nameMenu"];
    $path=$_POST["namePath"];
    $parent=$_POST["numParent"]==0?null:$_POST["numParent"];
    $position=$_POST["numPosition"];
    
    $regP="/^[0-9]+$/";
    $errors=[];

    if (($name == "")||($path == "")||($position=="")) {
        $errors[]="Must not be empty values!";
    }
    else if((!preg_match($regP,$position))){
        $errors[]="Must be only number value!";
    }
    if(($parent!=null)&&((!preg_match($regP,$parent)))){
        $errors[]="Must be only number value!";
    }
    
    if(count($errors) > 0){
        $_SESSION["errors"]=$errors;
        header("Location: ../../index.php?page=admin-menu");
    }
    else{
        try {
            
            insertMenu($name,$path,$parent,$position);
            header("Location: ../../index.php?page=admin-menu");
            
        } catch(PDOException $ex){
            $_SESSION["errors"]=["You can't add to non-existent parent!"];
            catchErrors($ex->getMessage());
            header("Location: ../../index.php?page=admin-menu");
        }
        
    }

}
else{
    header("Location: ../../index.php?page=admin-panel");
}


