<?php
require('inc/header.php');
require('admin/inc/db_config.php');

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
    <link rel="stylesheet" href="javasocorip/windy.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital@1&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Tre Homestay</title>
</head>

<body>
    <section class="product">
            <?php
                 if(!isset($_GET['id'])){
                     redirect('index.php');

                 } else if(!(isset($_SESSION['login']) && $_SESSION['login'] == true)){
                    redirect('index.php');

                 }

                 //filter and get user data
            
                $data = filteration($_GET);
                $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=?  AND  `removed`=?",[$data['id'],1,0],'iii');

                  if(mysqli_num_rows($room_res)==0){
                      redirect('index.php');
                  }
                $room_data = mysqli_fetch_assoc($room_res);

                $_SESSION['room'] =[
                    "id" => $room_data['id'],
                    "name" => $room_data['name'],
                    "price" => $room_data['price'],
                    "payment" => null,
                    "available" => false,
                ];
                echo $_SESSION['uId'];

                $u_Res = select("SELECT * FROM `user_cred` WHERE `id`=? ",[$_SESSION['uId']],'i');

                $userdata = mysqli_fetch_assoc($u_Res);





            ?>
        <div class="grid-2">
            <div class="img-group item-l">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel" style="width: 600px;">
                    <div class="carousel-inner" >
                        <?php
                            $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                            $thumb_q = mysqli_query($con,"SELECT * FROM `room_images`  WHERE `room_id`='$room_data[id]' AND `thumb`='1'");
            
                            if(mysqli_num_rows($thumb_q)>0){
                                $thumb_res = mysqli_fetch_assoc($thumb_q);
                                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                            }
                            echo<<<data
                                <div class="card p-3 shadow-sm rounded">
                                <img src='$room_thumb'>
                                <h5 class="display-3">$room_data[name]</h5>
                                <h6 class="display-4">$room_data[price] VNĐ</h6>
                                </div>

                            data;
            
                        
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
            <?php ?>
            <div class="item-r">
            
                <div style="font-size: 30px; margin-bottom: 10px; font-weight: 600;">CONFRIM BOOKING</div>
                <div class="under-name">
                    <span style="margin-right:5px ;">4.9</span>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                    <i class="fa-solid fa-star" style="color: #f2cb07;"></i>
                </div>

                <!--php code -->
                <form action="pay_now.php" method="post" id="booking_form">
                    <h6 class="mb-2"> BOOKING DETAILS</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="name" class="form-control" value="<?php echo $userdata['name'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label"> Phone Number</label>
                                <input type="number" class="form-control" value="<?php echo $userdata['phone'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">CHECKIN</label>
                                <input name="checkin" onchange="check_availability()" type="date" class="form-control shadow-none"  required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">CHECKOUT</label>
                                <input name="checkout" onchange="check_availability()" type="date" class="form-control shadow-none"  required>
                            </div>
                            <div class="col-12">
                                <div class="spinner-border text-warning mb-3 d-none" id="info_loader" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <h6 class="mb-3 text-danger" id="pay_info">Provide check-in & check-out data !</h6>
                                <button name="pay_now" class="btn w-100 text-dark custom-bg shadow-none" disabled>PAY NOW</button>
                            </div>


                        </div>
                </form>
                <div class="des">
                    <div class="ico">
                        <i class="fa-solid fa-brush" style="color: rgb(146, 146, 232);"></i>
                    </div>
                    <div class="infor">
                    <?php
                        $login=0;
                        if(isset($_SESSION['login']) && $_SESSION['login']==true){
                            $login=1;
                        }



                        echo<<<book
                        
                        <button onclick='checkLoginToBook($login,$room_data[id])' class='btn ' > BOOK NOW</button>
                        
                        book;

                    ?>
                    
                    </div>
                </div>
                    
            </div> 
    </section>
    <script>
        let booking_form = document.getElementById('booking_form');
        let info_loader = document.getElementById('info_loader');
        let pay_info = document.getElementById('pay_info');

        function check_availability(){
            let checkin_val =booking_form.elements['checkin'].value;
            let checkout_val =booking_form.elements['checkout'].value;


            booking_form.elements['pay_now'].setAttribute('disabled',true);
            if(checkin_val !='' && checkout_val!=''){

                pay_info.classList.add('d-none');
                pay_info.classList.replace('text-dark','text-danger');

                info_loader.classList.remove('d-none');

                let data = new FormData();
                data.append('check_availability','');
                data.append('check_in',checkin_val);
                data.append('check_out',checkout_val);

                let xhr = new XMLHttpRequest();
                xhr.open("POST","ajax/confirm_booking.php",true);

                xhr.onload = function()
                {
                    let data = JSON.parse(this.responseText);
                    if(data.status == 'check_in_out_equal'){
                        pay_info.innerText = "You Cannot Check OUT on the same day";
                    }
                    else if(data.status == 'check_out_earlier'){
                        pay_info.innerText = "Check out date is earlier than check in date";
                    }else if(data.status == 'check_in_earlier'){
                        pay_info.innerText = "Check in date is earlier than today  date";
                    }
                    else if(data.status == 'unavailable'){
                        pay_info.innerText = "Room not available for this check in date";
                    }
                    else{
                        pay_info.innerHTML = "No. of Days: "+data.days+"<br>Total Amount to Pay: "+data.payment;
                        pay_info.classList.replace('text-danger','text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disabled');
                    }
                    pay_info.classList.remove('d-none');
                    info_loader.classList.add('d-none');

                }
                xhr.send(data);
            }

        }



    </script>
    <!--contact section ends-->
    <!--footnote starts-->
    <div class="footerr">

        <div class="creditt">
        <h5 class="h5-room" text-align: right> GIOI THIEU</h5>
        <h5>
        <?php echo $room_data['description'];
                            
                             ?></h5>
        </div>
    </div>
    
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