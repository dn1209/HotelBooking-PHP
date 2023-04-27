<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');





if(isset($_POST['register'])){
    $data = filteration($_POST);

    

    $u_exits= select("SELECT * FROM `user_cred` WHERE `email`=? AND `phone`=? LIMIT 1",
    [$data['email'],$data['phonenum']],'si');

     if(mysqli_num_rows($u_exits)!=0){
         $u_exits_fetch = mysqli_fetch_assoc($u_exits);
         echo ($u_exits_fetch['email'] == $data['email']) ? 'email_already': 'phone_already';
         exit;
     }

    $enc_pass = password_hash($data['pass'],PASSWORD_BCRYPT);
    $query = "INSERT INTO `user_cred`( `name`, `email`,`phone`, `password`) VALUES (?,?,?,?)";

    $values = [$data['name'],$data['email'],$data['phonenum'],$enc_pass];
    if(insert($query,$values,'ssis')){
        echo 1;

    }else{
        echo 0;
    }
    
    



}

if(isset($_POST['login'])){
    $data = filteration($_POST);

    $u_exist= select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1",
    [$data['email']],'s');

    if(mysqli_num_rows($u_exist)==0){
        echo 'inv_email_mob';
    }
    else{
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['status']==0){
            echo 'inactive';
        }
        else{
            if(!password_verify($data['pass'],$u_fetch['password'])){
                echo 'invalid_pass';
            }else{
                session_start();
                $_SESSION['login'] =true;
                $_SESSION['uId']=$u_fetch['id'];
                $_SESSION['uName']=$u_fetch['name'];
                $_SESSION['uPhone']=$u_fetch['phone'];
                echo 1;


            }
        }
    }



}



?>