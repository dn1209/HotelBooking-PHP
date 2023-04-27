<?php
require('../inc/essentials.php');
require('../inc/db_config.php');

adminLogin();


if(isset($_POST['get_bookings'])){
   $query = "SELECT * FROM `booking_order` bo
   INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
   WHERE  bo.booking_status = 'confirm' ORDER BY bo.booking_id ASC";

    $res = mysqli_query($con,$query);
    $i=1;
    $table_data = "";

    while($data = mysqli_fetch_assoc($res)){
        $date = date("d-m-Y",strtotime($data['datentime']));
        $checkin = date("d-m-Y",strtotime($data['check_in']));
        $checkout = date("d-m-Y",strtotime($data['check_out']));
        
        

        $table_data .="
            <tr>
                <td>$i</td>
                <td>
                    <span class ='badge bd-primary text-dark'>
                        Oder ID: $data[order_id]
                    </span>
                    <br>
                    <b>Tên:</b> $data[user_name]
                    <br>
                    <b>Số Phone :</b> $data[phonenum]
                </td>
                <td>
                    <b>Tên Phòng:</b> $data[room_name]
                    <br>
                    <b>Giá Tiền/Đêm:</b> $data[price]
                    <br>
                    <b>Tổng Tiền:</b> $data[total_pay]
                </td>
                <td>
                    <b>CHech-in:</b> $checkin
                    <br>
                    <b>Check-out:</b> $checkout
                    <br>
                    <b>Ngày Đặt:</b> $date
                </td>
                <td>
                <button type='button' onclick=\"cancelb($data[booking_id])\" class='btn text-dark btn-outline-danger shadow-none btn-sm'>
                        XÓA
                </button>

                </td>
                 
        
        
        
        ";
        $i++;

    }

    echo $table_data;

}




if(isset($_POST['cancelb'])){
    $frm_data = filteration($_POST);
     $res = update("UPDATE `booking_order` SET `booking_status`=? WHERE `booking_id`=?",['cancelled',$frm_data['booking_id']],'si');
    if($res){
        echo 1;

    }
    else{
        echo 0;
    }
}


















if(isset($_GET['arrival'])){
    $frm_data = filteration($_GET);
    if($frm_data['arrival']=='all'){
        $q = "UPDATE `booking_order` SET `arrival`=? ";
        $values = [1];
        if(update($q,$values,'i')){
            alert('success','xac nhan dat phong');
        }else{
            alert('error','loi');
        }
    }else{
        $q = "UPDATE `booking_order` SET `arrival` = ? WHERE `booking_id`=?";
        $values = [1,$frm_data['arrival']];
        if(update($q,$values,'ii')){
            alert('success','xac nhan');
        }else{
            alert('error','chua doc duoc thu lai di');
        }
    }
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
        REMOVE     
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