<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    
    require_once ABSOLUTE_PATH.'/models/PHPMailer/src/Exception.php';
    require_once ABSOLUTE_PATH.'/models/PHPMailer/src/PHPMailer.php';
    require_once ABSOLUTE_PATH.'/models/PHPMailer/src/SMTP.php';


    function checkUser($email,$username){
        global $conn;
        $check = $conn->prepare("SELECT * FROM user WHERE email = ? OR username = ?");
        $check->execute([$email,$username]);
        $check=$check->rowCount();
        return $check;
    }

    function insertUser($username,$email, $password){
        global $conn;
        $date=date("Y-m-d H:i:s",time());
        $insertuj=$conn->prepare("INSERT INTO user(username,email,password,active,last_visit,role_ID,error) values(?,?,?,0,?,2,0)");
        $insertuj->execute([$username,$email,$password,$date]);
    }

    function findUser($email,$password){
        global $conn;
        $find=$conn->prepare("SELECT u.id_user as uid,u.username,r.name as role FROM user u inner join role r on u.role_ID=r.id_role WHERE u.email=? and u.password=?");
        $find->execute([$email,$password]);
        return $find;
    }

    function findUserByEmail($email){
        global $conn;
        $find=$conn->prepare("SELECT * FROM user WHERE email=?");
        $find->execute([$email]);
        return $find->fetch();
    }

    function findUserById($id_user){
        global $conn;
        $find=$conn->prepare("SELECT * FROM user WHERE id_user=?");
        $find->execute([$id_user]);
        return $find->fetch();
    }

    function updateVisit($id_user){
        global $conn;
        $date=date("Y-m-d H:i:s",time());
        $visita = $conn -> prepare("UPDATE user SET last_visit = ?, active=1 WHERE id_user = ?");
        $visita -> execute([$date,$id_user]);
    }

    function deleteUser($id_user){
        global $conn;
        $delus = $conn -> prepare("DELETE FROM user WHERE id_user = ?");
        $delus -> execute([$id_user]);
    }

    function updateUser($id_user,$username,$email,$active,$role){
        global $conn;
        $upus = $conn -> prepare("UPDATE user SET username = ?, email=?, active=?, role_ID=? WHERE id_user = ?");
        $upus -> execute([$username,$email,$active,$role,$id_user]);
    }

    function logout($id_user){
        global $conn;
        $errorUp = $conn -> prepare("UPDATE user SET active = 0 WHERE id_user = ?");
        $errorUp -> execute([$id_user]);
    }

    function createMail($from,$name,$message,$to,$recepient_name){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();                                           
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'bucket.list.with.k.r@gmail.com';                 
            $mail->Password   = 'youareallbreathtaking';                              
            $mail->SMTPSecure = 'tls';         
            $mail->Port       = 587;                            

            //Recipients
            $mail->setFrom($from,$name);
            $mail->addAddress($to, $recepient_name);     
            $mail->addReplyTo('bucket.list.with.k.r@gmail.com', 'For more info:');

            // Content
            $mail->isHTML(true);                                
            $mail->Subject = 'Read!';
            $mail->Body    = $message;

            $mail->send();
        } catch (Exception $e) {;
            catchErrors($mail->ErrorInfo);
            catchErrors($e->getMessage());
        }
    }

    function getUsers(){
        return ("SELECT u.*,r.name as role FROM user u INNER JOIN role r on u.role_ID=r.id_role");
    }
    function getRoles(){
        return ("SELECT * FROM role");
    }
?>