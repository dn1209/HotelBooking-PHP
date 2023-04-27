<?php
require('inc/header.php');
require('admin/inc/db_config.php');
if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
    redirect('index.php');

 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="dot.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital@1&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>BOOKING USER</title>
</head>
<body>
<?php
    $query = "SELECT * FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE (bo.booking_status = 'confirm') AND (bo.user_id=?)";

    

    $result = select($query,[$_SESSION['uId']],'i');

    while($data = mysqli_fetch_assoc($result)){
        $date = date("d-m-Y",strtotime($data['datentime']));
        $checkin = date("d-m-Y",strtotime($data['check_in']));
        $checkout = date("d-m-Y",strtotime($data['check_out']));
        $i =1;

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
                    <b>Chech-in:</b> $checkin
                    <br>
                    <b>Check-out:</b> $checkout
                    <br>
                    <b>Ngày Đặt :</b> $date
                </td>
        ";
        $i++;
    }

?>
<?php

    $query2 = "SELECT * FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE (bo.booking_status = 'pending') AND (bo.user_id=?)";

    $result2 = select($query2,[$_SESSION['uId']],'i');


    while($dataa = mysqli_fetch_assoc($result2)){
        $datea = date("d-m-Y",strtotime($dataa['datentime']));
        $checkina = date("d-m-Y",strtotime($dataa['check_in']));
        $checkouta = date("d-m-Y",strtotime($dataa['check_out']));

        $ia=1;
        $table_dataa .="
            <tr>
                <td>$ia</td>
                <td>
                    <span class ='badge bd-primary text-dark'>
                        Oder ID: $dataa[order_id]
                    </span>
                    <br>
                    <b>Tên:</b> $dataa[user_name]
                    <br>
                    <b>Số Phone :</b> $dataa[phonenum]
                </td>
                <td>
                    <b>Tên Phòng:</b> $dataa[room_name]
                    <br>
                    <b>Tổng Tiền:</b> $dataa[total_pay]
                    <br>
                    <b>Giá Tiền/Đêm</b> $dataa[price]
                </td>
                <td>
                    <b>Chech-in:</b> $checkina
                    <br>
                    <b>Check-out:</b> $checkouta
                    <br>
                    <b>Ngày Đặt :</b> $datea
                </td>
        ";
        $ia++;
    }


?>




<section class="about" id="about" style="background-color: #669966">
    <h1 class="heading" style="background-color: #669966"><span>BOOKING</span>  </h1>
    <div class="row" >
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col ms-auto p-4 overfollow-hidden">
                <h3 class="mb-4">Đã Xác Nhận</h3>
                <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">THÔNG TIN NGƯỜI ĐẶT</th>
                                        <th scope="col">THÔNG TIN PHÒNG</th>
                                        <th scope="col">CHECK-IN/OUT</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                <?php
                                echo $table_data;
                                ?>
                                </tbody>
                            </table>
                        </div>


                
            </div>
            
        </div>
    </div>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col ms-auto p-4 overfollow-hidden">
                <h3 class="mb-4">Chưa Xác Nhận</h3>
                <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">THÔNG TIN NGƯỜI ĐẶT</th>
                                        <th scope="col">THÔNG TIN PHÒNG</th>
                                        <th scope="col">CHECK-IN/OUT</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                <?php
                                echo $table_dataa;
                                ?>
                                </tbody>
                            </table>
                        </div>


                
            </div>
            
        </div>
    </div>
    </div>
    
</section>




</body>
</html>