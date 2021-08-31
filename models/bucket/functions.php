<?php
    function getGoals($id_user,$done){
        global $conn;
        $agoal = $conn -> prepare("SELECT *, l.name as listName FROM bucket b INNER JOIN list l on b.list_id=l.id_list INNER JOIN image i on l.image_ID=i.id_image WHERE b.user_ID=? and b.done=?");
        $agoal -> execute([$id_user,$done]);
        if ($agoal->rowCount() > 0) {
            $agoal = $agoal->fetchAll();
            return $agoal;
        }
    } 

    function ispisiGoals($data){
        if ($data) {
            foreach ($data as $d) {
                echo "
                    <div class='tm-row my-5 transparentno py-3'>
                    <div class='tm-col-left'>
                        <img src='assets/img/lists/$d->src_small' alt='$d->alt'>
                    </div>
                    <div class='tm-col-right px-1 mt-auto text-center'>
                        <p>$d->listName</p>
                        <div class='d-flex justify-content-center'>
                            <form method='post' action='models/bucket/change.php'>
                    ";
                if($d->done==0){
                    echo "<input type='hidden' value='$d->id_bucket' name='idBucketDo'/>
                    <button type='submit' data-idbaket='' name='dugmeDone' class='btn btn-success btn-sm px-3 plavo '>Fullfilled?</button>";
                }
                echo    "
                                <input type='hidden' value='$d->id_bucket' name='idBucketDelete'/>
                                <button type='submit' name='dugmeDelete' class='btn btn-light border-0 btn-sm px-3'>Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                ";   
            }
        }
        else{
            echo "<h5>None taken</h5>";
        }
    }

    function proveraUbucket($id_list,$id_user){
        global $conn;
        $pub = $conn->prepare("SELECT * FROM bucket WHERE list_ID=? and user_ID=?");
        $pub->execute([$id_list,$id_user]);
        if ($pub->rowCount() > 0) return false;
        return true;
    }
    
    function insertUbucket($id_list,$id_user){
        global $conn;
        $date=date("Y-m-d H:i:s",time());
        $ubaket = $conn -> prepare("INSERT into bucket(user_ID,list_ID,date,done) VALUES(?,?,?,0)");
        $ubaket -> execute([$id_user,$id_list,$date]);
    }

    function markAsDone($id_bucket){
        global $conn;
        $done = $conn -> prepare("UPDATE bucket SET done=1 WHERE id_bucket=?");
        $done -> execute([$id_bucket]);
    }

    function deleteIzBucket($id_bucket){
        global $conn;
        $delete = $conn -> prepare("DELETE FROM bucket WHERE id_bucket=?");
        $delete -> execute([$id_bucket]);
    }
?>