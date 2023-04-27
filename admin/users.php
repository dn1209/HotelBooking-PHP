<?php
require('inc/essentials.php');
adminLogin();

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
                <h3 class="mb-4">NGƯỜI DÙNG</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <h5 class="card-title m-0">QUẢN LỲ NGƯỜI DÙNG</h5>
                            <input type="text" oninput="search_user(this.value)" class="form-control shadow-none w-25 ms-auto" name="" id="">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border text-center" style="min-width: 1300px;">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">SỐ ĐIỆN THOẠI</th>
                                        <th scope="col">NGÀY ĐĂNG KÝ</th>
                                        <th scope="col">HÀNH ĐỘNG </th>



                                    </tr>
                                </thead>
                                <tbody id="user-data">

                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--edit image room -->
    <!--add room -->
    <!--edit room -->
    

    <?php
    require('inc/script.php')
    ?>

    
    <div>
    <?php 
echo $_SERVER['DOCUMENT_ROOT'];

?>
    </div>
<script src="scripts/users.js">

</script>



</body>

</html>