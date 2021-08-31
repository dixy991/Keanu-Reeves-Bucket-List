<?php
    function getLists($page)
    {
        global $conn;
        $perPage = $conn -> prepare("SELECT *, l.name as listName FROM list l INNER JOIN image i on l.image_ID=i.id_image ORDER BY l.id_list LIMIT $page,3");
        $perPage -> execute([$page]);
        return $perPage -> fetchAll();
    }

    function countAllLists(){
        global $conn;
        $countAll=$conn->query("SELECT count(*) as allLists FROM list");
        return $countAll->fetch();
    }

    function countSpecificList($perpage){
        global $conn;
        $countAll=$conn->prepare("SELECT count(*) as allLists FROM list WHERE category_ID=?");
        $countAll->execute([$perpage]);
        return $countAll->fetch();
    }

    function insertUimages($src_small, $src,$alt){
        global $conn;
        $insert = $conn->prepare("INSERT INTO image(src_small,src,alt) VALUES(?, ?, ?)");
        $isInserted = $insert->execute([$src_small, $src,$alt]);
        return $isInserted;
    }

    function insertUlists($name, $category,$id_of_image){
        global $conn;
        $insert = $conn->prepare("INSERT INTO list(name,category_ID,image_ID) VALUES(?, ?, ?)");
        $isInserted = $insert->execute([$name, $category,$id_of_image]);
        return $isInserted;
    }

    function insertMenu($name,$path,$parent,$position){
        global $conn;
        $insert = $conn->prepare("INSERT INTO menu(name,path,parent,position) VALUES(?, ?, ?,?)");
        $insert->execute([$name,$path,$parent,$position]);
    }

    function deleteMenu($id_menu){
        global $conn;
        $demenu = $conn -> prepare("DELETE FROM menu WHERE id_menu = ?");
        $demenu -> execute([$id_menu]);
    }

    function getAddedStatistics($id_list){
        global $conn;
        $gets = $conn->prepare("SELECT count(*) as total FROM bucket WHERE list_ID=? GROUP BY list_ID order by total");
        $gets->execute([$id_list]);
        if ($gets->rowCount() > 0) return $gets->fetch();
    }

    function getDoneStatistics($id_list){
        global $conn;
        $gets = $conn->prepare("SELECT count(*) as total FROM bucket WHERE list_ID=? and done=1 GROUP BY list_ID order by total");
        $gets->execute([$id_list]);
        if ($gets->rowCount() > 0)  return $gets->fetch();
    }

    function getListsForAdmin(){
        return ("SELECT l.*,i.*,c.name as catName FROM list l INNER JOIN category c ON l.category_ID=c.id_category INNER JOIN image i on l.image_ID=i.id_image ORDER BY l.id_list");
    }

    function findListById($id_list){
        global $conn;
        $find=$conn->prepare("SELECT l.*,i.*,c.name as catName FROM list l INNER JOIN category c on l.category_ID=c.id_category INNER JOIN image i on l.image_ID=i.id_image WHERE id_list=?");
        $find->execute([$id_list]);
        return $find->fetch();
    }

    function updateList($id_list,$name,$category,$id_of_image=null){
        global $conn;
        $upit="UPDATE list SET name = ?, category_ID=?";
        if($id_of_image!=null) $upit.=",image_ID=?";
        $upit.=" WHERE id_list = ?";
        $visita = $conn -> prepare($upit);
        if($id_of_image!=null) $visita -> execute([$name,$category,$id_of_image,$id_list]);
        else $visita -> execute([$name,$category,$id_list]);
    }

    function deleteList($id_list){
        global $conn;
        $delist = $conn -> prepare("DELETE FROM list WHERE id_list = ?");
        $delist -> execute([$id_list]);
    }

    function createPicture($picture_name,$picture_tmp_name,$picture_type){
        list($sirina, $visina) = getimagesize($picture_tmp_name);
        
        $picture = null;
        switch($picture_type){
            case 'image/jpeg':
                $picture = imagecreatefromjpeg($picture_tmp_name);
                break;
            case 'image/png':
                $picture = imagecreatefrompng($picture_tmp_name);
                break;
        }

        $smallSirinaNvisina = 100;
        $bigSirinaNvisina = 160;
        // $bigVisina = ($bigSirina/$sirina) * $visina; // bigVisina : visina = bigSirina : sirina
        // $smallVisina = ($bigSirina/$sirina) * $visina;   al treba mi kvadrat...

        // NEW EMPTY
        $new_big_picture = imagecreatetruecolor($bigSirinaNvisina, $bigSirinaNvisina);
        $new_small_picture = imagecreatetruecolor($smallSirinaNvisina, $smallSirinaNvisina);
        
        // RESIZE

        imagecopyresampled($new_big_picture, $picture, 0, 0, 0, 0, $bigSirinaNvisina, $bigSirinaNvisina, $sirina, $visina);
        imagecopyresampled($new_small_picture, $picture, 0, 0, 0, 0, $smallSirinaNvisina, $smallSirinaNvisina, $sirina, $visina);

        // UPLOAD
        $src = "big_".time().$picture_name;
        $src_small = "small_".time().$picture_name;
        $alt= $picture_name;
        $path= 'assets/img/lists/';
        $big_path =  $path.$src;
        $small_path = $path.$src_small;

        switch($picture_type){
            case 'image/jpeg':
                imagejpeg($new_big_picture, '../../'.$big_path, 75);
                imagejpeg($new_small_picture, '../../'.$small_path, 75);
                break;
            case 'image/png':
                imagepng($new_big_picture, '../../'.$big_path);
                imagepng($new_small_picture, '../../'.$small_path);
                break;
        }
        if((move_uploaded_file($picture_tmp_name, '../../'.$path.$picture_name))) return array($src_small,$src,$alt);
        else return false;
        
    }
?>