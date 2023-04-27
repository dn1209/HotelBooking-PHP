<?php
require('inc/essentials.php');
require('inc/db_config.php');

adminLogin();
if(isset($_GET['seen'])){
    $frm_data = filteration($_GET);
    if($frm_data['seen']=='all'){
        $q = "UPDATE `user_queries` SET `seen`=? ";
        $values = [1];
        if(update($q,$values,'i')){
            alert('success','da doc tat ca');
        }else{
            alert('error','chua doc duoc thu lai di');
        }
    }else{
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `id`=?";
        $values = [1,$frm_data['seen']];
        if(update($q,$values,'ii')){
            alert('success','da doc');
        }else{
            alert('error','chua doc duoc thu lai di');
        }
    }
}
if(isset($_GET['del'])){
    $frm_data = filteration($_GET);
    if($frm_data['del']=='all'){
        $q = "DELETE FROM `user_queries` ";
        if(mysqli_query($con,$q)){
            alert('success','da xoa tat ca');
        }else{
            alert('error','chua xoa duoc');
        }
    }else{
        $q = "DELETE FROM `user_queries` WHERE `id`=?";
        $values = [$frm_data['del']];
        if(delete($q,$values,'i')){
            alert('success','da xoa');
        }else{
            alert('error','chua xoa duoc');
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>ELEVENHOMESTAY</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light ">
    <?php
    require('inc/header.php');
    ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overfollow-hidden">
                <h3 class="mb-4">LIÊN HỆ KHÁCH HÀNG</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark rounded-pill shadow-none btn-sm"> doc tat ca</a>
                            <a href="?del=all" class="btn btn-dark rounded-pill shadow-none btn-sm"> xoa tat ca</a>

                        </div>

                        <div class="table-responsive-md " style="height: 450px; overflow-y: scroll;">
                        <table class="table table-hover border">
                            <thead class="sticky-top">
                                <tr class="bg-dark text-light">
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số Điện Thoại</th>
                                <th scope="col">Lời Nhắn</th>
                                <th scope="col">Ngày Gửi</th>
                                <th scope="col">Hành Động</th>



                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $q = "SELECT * FROM `user_queries` ORDER BY `id` DESC";
                                $data = mysqli_query($con,$q);
                                $i=1;
                                while($row = mysqli_fetch_assoc($data)){
                                    $seen='';
                                    if($row['seen']!=1){
                                        $seen = "<a href='?seen=$row[id]' class='btn btn-sm rounded-pill btn-primary'> ĐỌC";
                                    }
                                    $seen.= "<a href='?del=$row[id]' class='btn btn-sm rounded-pill btn-danger'> XÓA";
                                    echo<<<query
                                    <tr>
                                        <td>$i</td>
                                        <td>$row[name]</td>
                                        <td>$row[email]</td>
                                        <td>$row[phone]</td>
                                        <td>$row[message]</td>
                                        <td>$row[date]</td>
                                        <td>$seen</td>

                                    <tr>
                                    query;
                                    $i++;
                                }


                                ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    require('inc/script.php')
    ?>
    <script src="scripts/setting.js">
      
    </script>
</body>

</html>