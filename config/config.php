<?php

//putanja
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/krbl/templatemo_550_diagoona/");
// /storage/ssd3/703/14060703/public_html

//fajlici
define("ENV_FAJL", ABSOLUTE_PATH."/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH."/data/log.txt");
define("SEPARTOR", "&");

//baza
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv){
    $open = fopen(ENV_FAJL, "r");
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach($podaci as $key=>$value){
        $konfig = explode("=", $value);
        if($konfig[0]==$naziv){
            $vrednost = trim($konfig[1]);
        }
    }
    return $vrednost;
}
