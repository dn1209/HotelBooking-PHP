<?php
require('inc/header.php');
require('admin/inc/db_config.php');?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="javasocorip/windy.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>ELEVEN HOMESTAY</title>
</head>

<body>
    <section class="product">
            <?php
            
                 if(!isset($_GET['id'])){
                     redirect('index.php');

                 }
                $data = filteration($_GET);
                $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=?  AND  `removed`=?",[$data['id'],1,0],'iii');

                  if(mysqli_num_rows($room_res)==0){
                      redirect('index.php');
                  }
                $room_data = mysqli_fetch_assoc($room_res);






            ?>
        <div class="grid-2">
            <div class="img-group item-l">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel" style="width: 600px;">
                    <div class="carousel-inner" >
                        <?php   
                            $room_img = ROOMS_IMG_PATH."thumbnail.jpg";
                            $img_q = mysqli_query($con,"SELECT * FROM `room_images` 
                             WHERE `room_id`='$room_data[id]'");
                            
                            if(mysqli_num_rows($img_q)>0){

                                $active_class='active';


                              while($img_res = mysqli_fetch_assoc($img_q)){
                                echo"<div class='carousel-item $active_class w'>
                                        <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100' >
                                    </div>";
                                    $active_class='';
                              }

                                
                            }
                            else{
                                echo"   <div class='carousel-item active'>
                                            <img src='$room_img' class='d-block w-100' >
                                        </div>";
                            }
                        
                        
                        ?>
                        
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <?php
            
            $price = number_format($room_data['price'], 0, ',', '.') ;
            ?>
            <div class="item-r">
            
                <div style="font-size: 30px; margin-bottom: 10px; font-weight: 600;"><?php echo $room_data['name'] ?></div>
                <div class="under-name">
                    <span style="margin-right:5px ;">4.9</span>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                </div>

                <!--php code -->
                

                

                <div class="des">
                    <div class="ico">
                        <i class="fa-solid fa-location-dot" style="color: rgb(146, 146, 232);"></i>
                    </div>
                    <div class="infor">
                    <?php echo $room_data['area'] ?>
                    </div>
                </div>
                <div class="des">
                    <div class="ico">
                        <i class="fa-solid fa-brush" style="color: rgb(146, 146, 232);"></i>
                    </div>
                    <div class="infor"><h4>
                        
                        
                    <?php echo $room_data['adult'];
                            echo' người lớn';
                    ?>
                    <?php echo $room_data['children'];
                            echo' trẻ con';
                    ?>
                    <br>
                    <?php
                        echo $room_data['description'];
                    ?>

                    </h4>
                    </div>
                </div>
                <div class="des">
                    <div class="ico">
                        <i class="fa-solid fa-dollar-sign" style="color: rgb(146, 146, 232);"></i>
                    </div>
                    <div class="infor">
                        <div style="font-weight: 500; margin-bottom: 5px;">Giá tiền:</div>
                        <ul class="layout-li" style="margin-left: 20px;">
                            <li><?php echo $price;
                            
                        ?> VNĐ</li>
                        </ul>
                        
                    </div>
                </div>
                <div class="des">
                    <div class="ico">
                        
                    </div>
                    <div class="infor">
                    <?php
                        $login=0;
                        if(isset($_SESSION['login']) && $_SESSION['login']==true){
                            $login=1;
                        }



                        echo<<<book
                        
                        <button onclick='checkLoginToBook($login,$room_data[id])' class='btn btn-outline-secondary btn-lg text-dark ' > BOOK NOW</button>
                        
                        book;

                    ?>
                    
                    </div>
                </div>
                    
            </div> 
    </section>
    <!--contact section ends-->
    <!--footnote starts-->
    <section class="footer">
    
        <div class="credit">Copyright © Nhóm 11 2023 <span> | Developed by: Nhóm 11</span></div>
    </section>
    
    <script>
        
        const element = document.querySelectorAll('.input-date');
        element[0].valueAsNumber = Date.now()-(new Date()).getTimezoneOffset()*60000;
        element[1].valueAsNumber = Date.now()-(new Date()).getTimezoneOffset()*60000;

        document.querySelector('#search-btn').onclick = () => {
            searchForm.classList.toggle('active');
        }
        const base=document.querySelector('.base')
        const small=document.querySelectorAll('.small')
        small.forEach(item=>{
            item.addEventListener('mouseover',()=>{
                base.src=item.src
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    
</body>

</html>