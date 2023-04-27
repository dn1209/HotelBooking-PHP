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
                <h3 class="mb-4">YÊU CẦU ĐẶT PHÒNG</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <h5 class="card-title m-0">THÔNG TIN ĐẶT PHÒNG</h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">THÔNG TIN NGƯỜI ĐẶT</th>
                                        <th scope="col">THÔNG TIN PHÒNG</th>
                                        <th scope="col">CHECK-IN/OUT</th>
                                        <th scope="col">HÀNH ĐỘNG</th>



                                    </tr>
                                </thead>
                                <tbody id="table-data">

                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--edit image room -->
    <!--edit booking-->
   
    <!--edit room -->
    
    <?php
    require('inc/script.php')
    ?>

    
    <div>
    <?php 
echo $_SERVER['DOCUMENT_ROOT'];

?>
    </div>
<script src="scripts/new_bookings.js">

</script>



</body>

</html>