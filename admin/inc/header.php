<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h4 class="mt-2 text-light">ADMIN PANEL</h3>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
            </button>
        <a href="logout.php" class="btn btn-light btn-sm">ĐĂNG XUẤT</a>
    </div>
    <div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
        <nav class="navbar navbar-expand-lg navbar-dark ">
         <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light">ADMIN PANEL</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column ">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">THÔNG TIN CHUNG</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks"  collapseExample>
                            <span>THÔNG TIN ĐẶT PHÒNG</span>
                            <span><i class="bi bi-caret-down-fill"></i></span>
                        </button>
                        <div class="collapse show px-3 small mb-1" id="bookingLinks">
                            <ul class="nav nav-pills flex-column rounded border border-secondary">
                                
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="new_bookings.php">YÊU CẦU ĐẶT PHÒNG</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="booking_ap.php">YÊU CẦU ĐÃ XÁC NHẬN</a>
                                </li>
                                
                                
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="user_queries.php">LIÊN HỆ TƯ VẤN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">NGƯỜI DÙNG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rooms.php">HOMESTAY</a>
                    </li>
                    
                    </ul>
                </div>
            </div>
        </nav>
    </div>
