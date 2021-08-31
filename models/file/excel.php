<?php
    require_once ("../../config/connection.php");
    if(isset($_POST["dugmeExcel"])){
        $lists=queryExecute("SELECT l.id_list as id,l.name as listName,c.name as catName,i.src as imgPath FROM list l INNER JOIN category c on l.category_ID=c.id_category INNER JOIN image i on l.image_ID=i.id_image");

        // $excel_file = new COM("excel.Application");
        // $excel_file -> Visible = true;
        // $excel_file -> DisplayAlerts = 1;
        // $workbook = $excel_file -> Workbooks -> Add();
        // $worksheet = $excel_file -> Worksheets("Sheet1");
        // $worksheet -> activate;

        // $niz=["Id"=>"A1","Name"=>"B1","Category"=>"C1","Image"=>"D1"];
        // foreach($niz as $index=>$n){
        //     $do = $worksheet -> Range("$n");
        //     $do -> activate;
        //     $do -> Value = "$index";
        // }

        // $brojac = 2;
        // foreach($lists as $l)
        // {
        //     $cell_id = $worksheet ->Range("A{$brojac}");
        //     $cell_id -> activate;
        //     $cell_id -> Value = $l -> id;
        //     $cell_name = $worksheet -> Range("B{$brojac}");
        //     $cell_name -> activate;
        //     $cell_name -> Value = $l -> listName;
        //     $cell_category = $worksheet ->Range("C{$brojac}");
        //     $cell_category -> activate;
        //     $cell_category -> Value = $l -> catName;
        //     $cell_img = $worksheet -> Range("D{$brojac}");
        //     $cell_img -> activate;
        //     $cell_img -> Value = $l -> imgPath;
        //     $brojac++;
        // }

        // $sum = $worksheet -> Range("E1");
        // $sum -> activate;
        // $sum -> Value = "Sum";

        // $count_list = $worksheet -> Range("E2");
        // $count_list -> activate;
        // $count_list -> Value = count($lists);

        // // $workbook -> _SaveAs("list");
        // $workbook -> Saved = true;
        // $workbook -> Save();
        // // $workbook -> Close;
        // // $excel_file -> Workbooks -> Close();
        // // $excel_file -> Quit();
        // unset($workbook);
        // unset($worksheet);
        // unset($excel_file);
        // header("Location: ../../index.php");

        $ispis = '';
         $ispis .= "<table>
         <tr>
         <td>Id</td>
         <td>Name</td>
         <td>Category</td>
         <td>Image</td>
         </tr>";
         foreach($lists as $l){
         $ispis .= "<tr>
         <td>".$l->id."</td>
         <td>".$l->listName."</td>
         <td>".$l->catName."</td>
         <td>".$l->imgPath."</td>
         </tr>";
         }
         header("Content-type: application/xls");
         header("Content-Disposition: attachment;Filename=lists.xls");
         echo $ispis; 
    }
    else{
        header("Location: ../../index.php?page=list");
    }
?>