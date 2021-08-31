<?php
    function getMenu(){
        return ("select * from menu where parent is null order by position");
    }

    function getSubmenu($id_menu){
        global $conn;
        $submenu = $conn->prepare("SELECT * FROM menu WHERE parent=? ORDER BY position");
        $submenu->execute([$id_menu]);
        if ($submenu->rowCount() > 0) {
            $submenu = $submenu->fetchAll();
            return $submenu;
        }
    }

    function getWholeMenu(){
        return ("select * from menu order by position");
    }

    function getCategories(){
        return ("select * from category");
    }

    function insertNewCat($name){
        global $conn;
        $new_cat = $conn->prepare("INSERT INTO category(name) VALUES (?)");
        $new_cat->execute([$name]);
    }

    function deleteCat($id){
        global $conn;
        $del_cat = $conn->prepare("DELETE FROM category WHERE id_category=?");
        $del_cat->execute([$id]);
    }
?>