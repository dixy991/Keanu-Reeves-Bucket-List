<?php
    function count_visits(){
        $array=[];
        $count_home = 0;
        $count_steps = 0;
        $count_list = 0;
        $count_contact = 0;
        $count_register = 0;
        $count_login = 0;
        $count_bucket = 0;
        $count_new_goal = 0;
        $count_admin_panel = 0;
        $count_author = 0;
        $sum=0;
        $yesterday=strtotime("-1 day");

        @$file=file(LOG_FAJL);
        if(count($file)){
            foreach($file as $f){
                $part=explode("\t",$f);
                list($url, $rest_of_url) = array_pad(explode('.php', $part[0], 2), 2, null);
                if(!empty($rest_of_url)){
                    $page=explode("=", $rest_of_url);
                }

                if(strtotime($part[1])>=$yesterday){
                    if($page!=null){
                        switch($page[1]){
                            case "":$count_home++;$sum++;break;
                            case "home":$count_home++;$sum++;break;
                            case "steps":$count_steps++;$sum++;break;
                            case "list":$count_list++;$sum++;break;
                            case "contact":$count_contact++;$sum++;break;
                            case "register":$count_register++;$sum++;break;
                            case "login":$count_login++;$sum++;break;
                            case "bucket":$count_bucket++;$sum++;break;
                            case "create-goal":$count_new_goal++;$sum++;break;
                            case "admin-panel":$count_admin_panel++;$sum++;break;
                            case "author":$count_author++;$sum++;break;
    
                            default:$count_home++;$sum++;break;
                        }
                    }
                }
            }

            if($sum>0){
                $array["home"]=round($count_home*100/$sum,2);
                $array["steps"]=round($count_steps*100/$sum,2);
                $array["list"]=round($count_list*100/$sum,2);
                $array["contact"]=round($count_contact*100/$sum,2);
                $array["register"]=round($count_register*100/$sum,2);
                $array["login"]=round($count_login*100/$sum,2);
                $array["bucket"]=round($count_bucket*100/$sum,2);
                $array["goal"]=round($count_new_goal*100/$sum,2);
                $array["panel"]=round($count_admin_panel*100/$sum,2);
                $array["author"]=round($count_author*100/$sum,2);
            }

        }
        return $array;
    }

    function count_current_logged_in(){
        global $conn; 
        $curr=$conn->query("SELECT COUNT(*) as total FROM user WHERE active=1");
        return $curr->fetch();
    }
?>