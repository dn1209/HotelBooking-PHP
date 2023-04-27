<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
session_start();

if(isset($_POST['pay_now'])){

if(!(isset($_SESSION['login'])) && $_SESSION['login'] == true){
    redirect('index.php');
}
$ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,99999);
$CUST_ID = $_SESSION['uId'];
$CUST_PHONE = $_SESSION['uPhone'];

$TXN_AMOUNT = $_SESSION['room']['payment'];
$frm_data = filteration($_POST);
$ODER_NAME =$_SESSION['uName'];
$ROOM_Name = $_SESSION['room']['name'];


$query = "INSERT INTO `booking_order`( `user_id`, `room_id`, `check_in`, `check_out`, `order_id`) 
VALUES (?,?,?,?,?)";
insert($query,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],$frm_data['checkout'],$ORDER_ID],'iisss');


$booking_id = mysqli_insert_id($con);
$query2 = "INSERT INTO `booking_details`( `booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`)
 VALUES (?,?,?,?,?,?)";
 insert($query2,[$booking_id,$ROOM_Name,$_SESSION['room']['price'],$TXN_AMOUNT,$ODER_NAME,$CUST_PHONE],'isiisi');
}

header("Location: http://localhost/homestay/user_book.php");
    exit;
?>