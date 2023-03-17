<?php

    session_start();
    require_once('db.php');
    if(!$_SESSION['username']){
        header("Location: login.php");
    }
    $username = $_SESSION["username"];
    $result = get_info_nhanvien($username);
    if($result['code'] == 0){
        $data = $result['data'];
    }
    if($data['status'] == 0){
        header("Location: updatePassword.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang nhân viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        .flex-direction{
            display: flex;
            justify-content: center;
        }

        .flex-direction > div {
            margin: 50px;
            padding: 50px;
            font-size: 30px;
        }
        .card{
            text-align: center;
            margin-top: 10px;
            padding-bottom: auto;
            border-radius: 10px;
            box-shadow:4px 4px 10px 2px rgba(0,0,0,0.2) ;
        }
        .card img{
            width : 60%;
            height: 50%;
        }

        .card:hover{
            box-shadow: 4px 12px 14px 4px rgba(0,0,0,0.3);
        }
     
        body, html{
            background: url('../images/trangchu.jpg') no-repeat;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }
     
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
        <h1 class="navbar-brand">TRANG NHÂN VIÊN </h1>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-list-4">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            <img src="<?=$data['image'] ?>" alt="Hinh dai dien" width="40" height="40" class="rounded-circle" float="right"> 
                            <span style="color:while;"> <?=$data['name']?></span>
                    </a>
                    
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="api/chiTietNV.php">Thông tin cá nhân</a>
                        <a class="dropdown-item" href="updatePassword.php">Đổi mật khẩu</a>
                        <a class="dropdown-item" href="updateImage.php">Đổi hình đại diện</a>
                        <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                    </div>
                </li>   
            </ul>
        </div>
    </nav>
    
    <div class="flex-direction">
        <div class ="row">
            <?php 
                if(check_truong_phong($data['name'], $data['maPB']) == false){
            ?>
                <div class="col-12 col-md-6 ">
                    <div class="card" style=" background: white"  onclick="location.href='api/taskNV.php'" >
                        <div class="card-body text-center">
                            <img src="images/anh4.jpg" >
                            <p></p><h4>NHIỆM VỤ</h4>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card" style=" background: white" onclick="location.href='api/nghiphep.php'">
                        <div class="card-body text-center">
                            <img src="images/anh3.jpg" >
                            <p></p><h4>XIN NGHĨ PHÉP</h4>
                        </div>
                    </div>     
                </div>
            <?php
                }else{
            ?>
               
                <?php
                    if(check_truong_phong($data['name'], $data['maPB']) == true){
                ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card" style="background: white ;" onclick="location.href='api/quanLyTask.php'">
                            <div class="card-body text-center">
                                <img src="images/anh1.jpg" >  
                                <p></p><h4>QUẢN LÝ NHIỆM VỤ</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card" style="background: white ;" onclick="location.href='api/nghiphep.php'">
                            <div class="card-body text-center">
                                <img src="images/anh3.jpg" >
                                <p> </p><h4>ĐƠN XIN NGHĨ PHÉP</h4>
                            </div>
                        </div>     
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card" style="background: white ; " onclick="location.href='api/duyetNghi.php'">
                            <div class="card-body text-center">
                                <img src="images/anh2.jpg" >
                                <p></p><h4>DUYỆT ĐƠN XIN NGHỈ</h4>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            <?php
                }
            ?>
        </div>
    </div>
    
    <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
        <?php
        if(!empty($error)){
            echo "<div class='alert alert-danger'>$error</div>";
        }else if(!empty($success)){
            echo "<div class='alert alert-success'>$success</div>";
        }
        ?>
    </p>

</body>
</html>
