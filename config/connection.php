<?php

require_once "config.php";

pageAccess();

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function queryExecute($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function pageAccess(){
    $open = fopen(LOG_FAJL, "a");
    $date = date('Y-m-d H:i:s');
    if($open){
        fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\n");
        fclose($open);
    }
}
function catchErrors($error)
{
    $file = @ fopen ("../data/errors.txt", "a");
    if($file)
    {
        $date = date("Y-m-d H:i:s");
        $data = $error . "\t" . $date . "\t\n";
        fwrite($file, $data);
        fclose($file);
        return true;
    }
    return false;
}
?>