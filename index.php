<?php
require('admin/inc/db_config.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eleven Homestay</title>
   <!--font awesome cdn link --> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   custom css file link 
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
   <link rel="stylesheet" href="dot.css"> 
   <?php 
    require('inc/header.php');

?>

</head>
<body>
<!--header section starts-->

<!--header section ends-->
<!--home section starts-->
<section class="home" id="home" style="background-color: #669966">
</section>
<!--home section ends-->
<!--about section starts-->
<section class="about" id="about" style="background-color: #669966">
    <h1 class="heading" style="background-color: #669966"><span>giới thiệu</span>  </h1>
    <div class="row" >
        <div class="image" style="background-color: #669966">
            <img src="about.jpg" alt="">
        </div>
        <div class="content">
            <h3>chúng tôi có thể thỏa mãn bạn không ?</h3>
            <p>Tại Eleven Homestay chúng tôi cam kết đem lại cho bạn một không gian
                nghỉ ngơi, tĩnh dưỡng đẹp mắt, yên bình ngay 
                giữa lòng thành phố Hà Nội nhộn nhịp.
                Thỏa thích làm việc mình thích tại homestay,
                bạn sẽ có một cảm nhận rất khác. Ở đây, bạn được 
                cung cấp đầy đủ tiện nghi từ giường ngủ, Netflix, phòng tắm khép kín, tủ lạnh, phòng bếp đủ dụng cụ, điều hòa, wifi,... 
             </p>
             <p>hơn 20+ địa điểm homestay tại hà nội đang chờ bạn ghé thăm!</p>
             <a href="#" class="btn-outline-secondary text-dark">Tìm hiểu thêm</a>
        </div>
    </div>
</section>
<!--about section ends-->
<!--products section starts-->

<div class="products" id="products" style="background-color: #669966">

    <h1 class="heading">Home<span>stay</span></h1>
    
    <div class="box-container">
        <?php
            $room_res = select("SELECT * FROM `rooms` WHERE `status`=?  AND  `removed`=?",[1,0],'ii');
            while($room_data = mysqli_fetch_assoc($room_res)){

                $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                $thumb_q = mysqli_query($con,"SELECT * FROM `room_images`  WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                if(mysqli_num_rows($thumb_q)>0){
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                }


                
                $login=0;
                if(isset($_SESSION['login']) && $_SESSION['login']==true){
                    $login=1;
                }




                $book_btn = "<button onclick='checkLoginToBook($login,$room_data[id])' class='btn custom-bg text-white btn-dark shadow-none' > Book Now</button>";
                
                $price = number_format($room_data['price'], 0, ',', '.');

                //hien thi
                echo 
                "<div class='box'>
                    <div class='image'>
                        <img src='$room_thumb'>
                    </div>
                    <div class='content'>
                        <h3>$room_data[name]</h3>
                        <div class='stars'>
                        <i class='fas fa-star'></i>
                        <i class='fas fa-star'></i>
                            <i class='fas fa-star'></i>
                            <i class='fas fa-star'></i>
                            <i class='fas fa-star'></i>
                        </div>
                        <h4>$room_data[adult] người lớn</h4>
                        <h4>$room_data[children] trẻ con</h4>

                        <div class='price'>$price VNĐ <span>699.000</span> VNĐ</div>
                        <div>
                        <a href='room_details.php?id=$room_data[id]' class='btn custom-bg text-white btn-dark shadow-none btn-lg'>Xem thêm</a>
                        </div>
                        &nbsp;
                        <br>
                        <div>
                        $book_btn
                        </div>

                    </div>
                </div>"
                ;
            }

        ?>
        
    </div>
        

        

       

        
</div>
<!--products section ends-->
<!--contact section starts-->
<section class="contact" id="contact" style="background-color: #669966">
    <h1 class="heading"> <span>liên</span> hệ </h1>
    <div class="icons-container">
        <div class="icons">
            <i class="fas fa-phone"></i>
            <h3>Hotline</h3>
            <p>0987654321</p>
        </div>
        <div class="icons">
            <i class="fas fa-envelope"></i>
            <h3>Email</h3>
            <p>Elevenhomestay@gmail.com</p>
        </div>
        <div class="icons">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Địa chỉ</h3>
            <p>Cầu giấy, Hà Nội</p>
        </div> 
    </div>
    <div class="row">
        <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59585.60213526231!2d105.7909139!3d21.02867905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab5756f91033%3A0x576917442d674bfd!2zQ-G6p3UgR2nhuqV5LCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1679984395076!5m2!1svi!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <form method="POST">
            <div class="msg"></div>
            <input type="text" placeholder="Họ tên" class="box" name="name" required/>
            <input type="email" placeholder="Email" class="box" name="email" required/>
            <input type="number" placeholder="Số điện thoại" class="box" name="phone" required/>
            <textarea placeholder="Lời nhắn" class="box" id="" cols="30" rows="10" name="message" required></textarea>
            <input type="submit" value="Gửi" class="btn custom-bg text-white btn-dark shadow-none" name="send">
        </form>
    </div>
</section>
<!--contact section ends-->
<!--footnote starts-->
<section class="footer">
    <div class="credit">Copyright © Nhóm 11 2023 <span> | Developed by: Nhóm 11</span></div>
</section>

<!--footnote ends-->

<!--custom js file link-->
<script src="trangchu.js">


</script>

<?php
if(isset($_POST['send'])){
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `user_queries`(`name`, `email`, `phone`, `message`) VALUES (?,?,?,?)";
    $values = [$frm_data['name'],$frm_data['email'],$frm_data['phone'],$frm_data['message']];
    $res = insert($q,$values,'ssss');
    if($res == 1){
        alert('success','mail send');

    }else{
        alert('error','try again later');
    }
}
?>
<?php 
    require('inc/footer.php');

?>


</body>
</html>