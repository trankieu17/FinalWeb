<?php 
    session_start();
    require_once('db.php');
    if(!$_SESSION['username']){
        header("Location: login.php");
    }else if($_SESSION['username'] != "admin"){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giám đốc</title>
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
        .functional-area{
            text-align: center;
            margin-top: 10px;
            padding-bottom: auto;
            border-radius: 10px;
            box-shadow:4px 4px 10px 2px rgba(0,0,0,0.2) ; 
        }
        .functional-area:hover {
            box-shadow: 4px 4px 10px 2px rgba(0, 0, 0, 0.5);   
            transition: 0.2s;  
        }
        .functional-area .name{
            margin-bottom: 8px;
            padding-left: 20px;
            font-weight: bold;
            font-size: 16px;
            display: block;
            text-align: center;
        }
        .functional-area img{
            width : 60%;
            height: 50%;
        }
        .flex-direction{
            display: flex;
            justify-content: center;
        }

        .flex-direction > div {
            background-color: #f1f1f1; 
            margin: 50px;
            padding: 50px;
            font-size: 30px;
        }
        body, html{
            background: url('images/trangchu.jpg') no-repeat;
            background-size: cover;
            height: 100%;
        } 
    </style>
</head>
<body>
    <?php 
        $username = $_SESSION["username"];
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
                            <img src="<?=$data['image'] ?>" alt="Hinh dai dien" width="40" height="40" class="rounded-circle" float="right"> 
                            <span style="color:while;"> <?=$data['name']?></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                    </div>
                </li>   
            </ul>
        </div>
    </nav>
    <div class="flex-direction">
        <div class ="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="functional-area" onclick="location.href='api/phongban.php'">
                    <img src="./images/dsphongban.jpg">
                    <div class="name">QUẢN LÝ PHÒNG BAN</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="functional-area" onclick="location.href='api/dsAllNV.php'">
                    <img src="./images/dsnhanvien.jpg">
                    <div class="name">QUẢN LÝ NHÂN VIÊN</div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="functional-area" onclick="location.href='api/duyetNghiAdmin.php'">
                    <img src="./images/dsdonnghiphep.jpg">
                    <div class="name">QUẢN LÝ ĐƠN NGHỈ PHÉP</div>
                </div>
            </div>
        <div> 
    </div>
        
</body>
</html>
