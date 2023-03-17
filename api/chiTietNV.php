<?php 
    session_start();
    require_once('../db.php');
    if(!$_SESSION["username"]){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết nhân viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
         * {
            box-sizing: border-box;
        }
        body {font-family: "Lato", sans-serif;}
        .nav-item .dropdown{
            margin-right: 80px;
        }
        .nav-item .dropdown-toggle .dropdown-menu{
            max-width: 50px;
        }
        a i{
            font-size: 30px;
            color: red;
        }
	    .card{
            background: #DDDDDD;
            width: 100%;
            margin-bottom: 50px;
        }
        h3{
            text-align: center;
        }
        body, html{
            background: url('../images/background1.jpg') no-repeat;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }
    </style>
</head>
<body>
    <?php 
        $username = $_SESSION["username"];
        if($username == "admin"){
            $nameNV = $_GET['name'];
            $result = get_info_admin($username);
            if($result['code'] == 0){
                $data = $result['data'];
            }
            ?>
               <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
                    <h1 class="navbar-brand">TRANG GIÁM ĐỐC </h1>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-list-4">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                    <button type="button" class="btn btn-light">
                                        <?= $data['name'] ?>
                                    </button>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
                                </div>
                            </li>   
                        </ul>
                    </div>
                </nav>
            <?php

        }else{
            $result = get_info_nhanvien($username);
            if($result['code'] == 0){
                $data = $result['data'];
            }
            ?>
                <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
                    <h1 class="navbar-brand">TRANG NHÂN VIÊN </h1>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-list-4">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                    <button type="button" class="btn btn-light">
                                        <?= $data['name'] ?>
                                    </button>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="../logout.php">Đăng xuất</a>
                                </div>
                            </li>   
                        </ul>
                    </div>
                </nav>
            <?php
        }
    ?>
    
    <?php 
        $error = "";
        $success = "";
        if($username == "admin"){
            $resultGetInfo = get_all_info_nhanvien($nameNV);
            if($resultGetInfo['code'] == 0){
                $data1 = $resultGetInfo['data'];
            }else{
                $error = $resultGetInfo['message'];
            }
            ?>
                <a style="text-decoreation: none;" href="./dsAllNV.php"><i class="fas fa-arrow-circle-left"></i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center">
                                <div class="card">
                                    <div class="card-body">
                                        <form novalidate method="post" enctype="multipart/form-data">
                                            <h3>THÔNG TIN NHÂN VIÊN</h3>
                                            <div class="form-group">
                                                <label>Tên nhân viên:</label>
                                                <div class="form-control"><?=$data1['name']?></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Tên account:</label>
                                                <div class="form-control"><?=$data1['username']?></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Mã của phòng ban:</label>
                                                <div class="form-control"><?=$data1['maPB']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Chứng minh nhân dân:</label>
                                                <div class="form-control"><?=$data1['cmnd']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Email:</label>
                                                <div class="form-control"><?=$data1['email']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Số điện thoại:</label>
                                                <div class="form-control"><?=$data1['sdt']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Địa chỉ:</label>
                                                <div class="form-control"><?=$data1['diachi']?></div>
                                            </div>
                                            
                                        </form>
                                        <?php 
                                            if(isset($_POST['reset'])){
                                                $nameToReset = $_POST['nameNVToReset'];
                                                $pwdReset = $_POST['pwd'];
                                                $resultReset = reset_password($nameToReset, $pwdReset);
                                                if($resultReset['code'] == 0){
                                                    $success = $resultReset['message'];
                                                }else{
                                                    $error = $resultReset['message'];
                                                }
                                            }
                                        ?>
                                        <button name="reset" data-toggle="modal" data-target="#confirm-reset-password" type="submit" 
                                        onclick="update_confirm_reset_password('<?=$data1['username']?>', '<?=$data1['name']?>')" class="btn btn-primary">
                                        Reset Password
                                        </button>
                                        <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                                            <?php
                                                if(!empty($error)){
                                                    echo "<div class='alert alert-danger'>$error</div>";
                                                }else if(!empty($success)){
                                                    echo "<div class='alert alert-success'>$success</div>";
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }else{
            $resultGetInfo = get_info_nhanvien($username);
            if($resultGetInfo['code'] == 0){
                $data1 = $resultGetInfo['data'];
            }else{
                $error = $resultGetInfo['message'];
            }
            ?>
                <a style="text-decoreation: none;" href="dsNVPB.php?maPB=<?=$data1['maPB']?>"><i class="fas fa-arrow-circle-left"></i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center">
                                <div class="card">
                                    <div class="card-body">
                                        <form novalidate method="post" enctype="multipart/form-data">
                                            <h3>THÔNG TIN NHÂN VIÊN</h3>
                                            <div class="form-group">
                                                <label>Tên nhân viên:</label>
                                                <div class="form-control"><?=$data1['name']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Chứng minh nhân dân:</label>
                                                <div class="form-control"><?=$data1['cmnd']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Email:</label>
                                                <div class="form-control"><?=$data1['email']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Số điện thoại:</label>
                                                <div class="form-control"><?=$data1['sdt']?></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Địa chỉ:</label>
                                                <div class="form-control"><?=$data1['diachi']?></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Tên account:</label>
                                                <div class="form-control"><?=$data1['username']?></div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Mã của phòng ban:</label>
                                                <div class="form-control"><?=$data1['maPB']?></div>
                                            </div>
                                            <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                                                <?php
                                                    if(!empty($error)){
                                                        echo "<div class='alert alert-danger'>$error</div>";
                                                    }
                                                ?>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    ?>
    <div class="modal fade" id="confirm-reset-password">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Reset nhân viên</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                    Bạn có chắc rằng muốn reset password nhân viên <strong id="name-to-reset-password">image.jpg</strong>
                    </div>
            
                    <div class="modal-footer">
                        <input type="hidden" name="nameNVToReset" id="nameNVToReset">
                        <input type="hidden" name="pwd" id="pwd">
                        <button type="submit" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                    </div>
               </form>            
            </div>
         </div>
      </div>
      <script src="../js/script.js"></script>
</body>
</html>
