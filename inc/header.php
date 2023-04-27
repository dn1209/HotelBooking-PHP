<?php
require('../homestay/admin/inc/essentials.php');
require('links.php');
session_start();

?>

<header class="header">
<nav class="navbar navbar-expand-lg navbar-#d3ad7f bg-#d3ad7f" style="color: #d3ad7f;">
  <div class="container-fluid">
  <a href="#" class="logo">
        <img src="/homestay/images/logo.png" alt="" style="height: 7rem">
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/homestay/index.php"><font size="+1">Trang Chủ</font></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homestay/index.php#about">Giới Thiệu</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="/homestay/index.php#products" tabindex="-1" aria-disabled="true">Homestay</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/homestay/index.php#contact" tabindex="-1" aria-disabled="true">Liên Hệ</a>
        </li>
        
            
      
    
      
      <?php
                
                if(isset($_SESSION['login']) && $_SESSION['login'] == true){

                    echo<<<data
                    
                            
                            <li class="nav-item">
                            <a class="nav-link" href="" tabindex="-1" aria-disabled="true">User Name: $_SESSION[uName]</a>
                             </li>
                             <li class="nav-item">
                            <a class="nav-link" href="/homestay/user_book.php" tabindex="-1" aria-disabled="true">Đơn Hàng</a>
                             </li>
                            
                              <li class="nav-item">
                            <a class="nav-link" href="/homestay/logout.php" tabindex="-1" aria-disabled="true">Đăng Xuất</a>
                            </li>
                        
                    data;
                }
                else{

                    echo<<<data
                    <button type="button" class="btn text-white btn-outline-#d3ad7f" data-bs-toggle="modal" data-bs-target="#loginModal" style="font-size: large;">
                            Đăng Nhập
                        </button>
                        
                        &nbsp;
                        &nbsp;
                        <button type="button" class="btn text-white btn-outline-#d3ad7f" data-bs-toggle="modal" data-bs-target="#registerModal" style="font-size: large;">
                            Đăng Ký
                    </button>
                    data;
                }
            ?>
        
        </ul>
    </div>
  </div>
</nav>
</header>


<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="register_form">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="number" name="phonenum" class="form-control shadow-none" required>
                    </div>

                    <div class="col12 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" rows="4" class="form-control shadow-none" required></input>
                    </div>
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
            
                
            
            </form>
        </div>
    </div>
</div>

<!--login -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login_form">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="col12 mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="pass" rows="4" class="form-control shadow-none" required></input>
                    </div>
                    
                    
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
            
                
            
            </form>
        </div>
    </div>
</div>

<script>
  function alert(type,msg){
    let bs_class = (type == 'success') ? 'alert-success':'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
            <div class="alert ${bs_class}  alert-dismissible fade show custom-alert" role="alert">
             <strong class="me-3">${msg}</strong>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    `;
    document.body.append(element);
   } 



  let register_form = document.getElementById('register_form');
  register_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();
    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('register','');


    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);

    modal.hide();


    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == "pass_mismatch"){
        alert('error',"PASSWORD UNMATCH");
      }
      else if(this.responseText == 'email_already'){
        alert('error',"Email is allready registed");
      }
      else if(this.responseText == 'phone'){
        alert('error',"Email is allready registed");
      }else if(this.responseText == 'ins_failed'){
        alert('error',"register fail");
      }else{
        alert('success',"successssss");
        register_form.reset();
      }
    }
    xhr.send(data);

  });

  let login_form = document.getElementById('login_form');
  login_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();
    data.append('email',login_form.elements['email'].value);
    data.append('pass',login_form.elements['pass'].value);
    data.append('login','');


    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);

    modal.hide();


    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/login_register.php",true);

    xhr.onload = function(){
      if(this.responseText == 'inv_email_mob'){
        alert('error',"invalid email");

      }
      else if(this.responseText == 'inactive'){
        alert('error',"ACCOUNT have been ban");
      }
      else if(this.responseText == 'invalid_pass'){
        alert('error',"sai mat khau");
      }
      else{
        let fileurl = window.location.href.split('/').pop().split('?').shift();
        if(fileurl == 'room_details.php'){
          window.location = window.location.href;
        }else{
          window.location = window.location.pathname;
          
        }
      }
    }
    xhr.send(data);

  });
  function checkLoginToBook(status,room_id){
    if(status){
      window.location.href='confirm_booking.php?id='+room_id;
    }
    else{
      alert('error',"not book");
    }


  }

    </script>