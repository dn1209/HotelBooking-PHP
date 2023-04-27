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
                <h3 class="mb-4">ELEVEN HOMESTAY</h3>



                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <h5 class="card-title m-0">THÔNG TIN PHÒNG</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                                THÊM MỚI
                            </button>
                        </div>

                        <div class="table-responsive-md " style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">TÊN</th>
                                        <th scope="col">ĐỊA CHỈ</th>
                                        <th scope="col">SỨC CHỨA</th>
                                        <th scope="col">GIÁ TIỀN/ĐÊM</th>
                                        <th scope="col">MÔ TẢ</th>

                                        <th scope="col">TRẠNG THÁI</th>
                                        
                                        <th scope="col">HÀNH ĐỘNG</th>



                                    </tr>
                                </thead>
                                <tbody id="room-data">

                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--edit image room -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">HÌNH ẢNH</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="image-alert"></div>
                <div class="border-bottom border-3 pb-3 mb-3">
                    <form id="add_image_form">
                        <label for="" class="form-label fw-bold">ẢNH</label>
                        <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3" required>
                        <button class="btn custom-bg text-dark btn-outline-secondary shadow-none">thêm</button>
                        <input type="hidden" name="room_id">

                    </form>
                </div>
                <div class="table-responsive-md " style="height: 350px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light sticky-top">
                                        <th scope="col" width="60%">HÌNH ẢNH</th>
                                        <th scope="col">ẢNH NỀN</th>
                                        <th scope="col">XÓA</th>
                                        



                                    </tr>
                                </thead>
                                <tbody id="room-image-data">

                                </tbody>
                            </table>
                        </div>



            </div>
            
            </div>
        </div>
    </div>

    <!--add room -->

    <div class="modal fade" style="margin-left: auto;
    margin-right: auto;" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">THÊM MỚI </h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Địa Chỉ</label>
                                <input type="text" name="area" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giá Tiền/Đêm</label>
                                <input type="number" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Người Lớn (tối đa)</label>
                                <input type="number" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trẻ Con (tối đa)</label>
                                <input type="number" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col12 mb-3">
                                <label class="form-label">Mô Tả</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>


                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn custom-bg text-white btn-dark shadow-none">Xác Nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--edit room -->
    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">SỬA PHÒNG</h5>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Địa Chỉ</label>
                                <input type="text" name="area" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Giá Tiền/Đêm</label>
                                <input type="number" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Người Lớn (tối đa)</label>
                                <input type="number" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trẻ Con (tối đa)</label>
                                <input type="number" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col12 mb-3">
                                <label class="form-label">Mô Tả</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
                            <button type="submit" class="btn custom-bg text-dark btn-secondary shadow-none">Xác Nhận</button>

                        </div>

                </div>
            </form>
        </div>
    </div>

    <?php
    require('inc/script.php')
    ?>

    
    <div>
    <?php 
echo $_SERVER['DOCUMENT_ROOT'];

?>
    </div>
<script src="scripts/rooms.js">

</script>



</body>

</html>