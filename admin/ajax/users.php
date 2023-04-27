<?php
require('../inc/essentials.php');
require('../inc/db_config.php');

adminLogin();


if(isset($_POST['get_users'])){
    $res = selectAll('user_cred');
    $i = 1;


    $data = "";
    while($row = mysqli_fetch_assoc($res)){
        $del_btn = "</button>
        <button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm' >
        XÓA     
        </button>";
        $data.="

        <tr>
            <td>$i</td>
            <td>$row[name]</td>
            <td>$row[email]</td>
            <td>$row[phone]</td>
            <td>$row[datentime]</td>
            <td>$del_btn</td>

        "
           ;
            $i++;
    }
    echo $data;


}



if(isset($_POST['remove_user'])){
    $frm_data = filteration($_POST);
    
    $res = delete("DELETE FROM `user_cred`  WHERE  `id`=? ",[$frm_data['user_id']],'i');

    if($res){
        echo 1;
    }
    else{
        echo 0;
    }
}
if(isset($_POST['search_user'])){
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";
    $res = select($query,["%$frm_data[name]%"],'s');
    $i = 1;


    $data = "";
    while($row = mysqli_fetch_assoc($res)){
        $del_btn = "</button>
        <button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none btn-sm' >
        XÓA  
        </button>";
        $data.="

        <tr>
            <td>$i</td>
            <td>$row[name]</td>
            <td>$row[email]</td>
            <td>$row[phone]</td>
            <td>$row[datentime]</td>
            <td>$del_btn</td>

        "
           ;
            $i++;
    }
    echo $data;


}
?>