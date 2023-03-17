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
        $result = get_info_admin($username);
        if($result['code'] == 0){
            $data = $result['data'];
        }
    ?>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
        <h1 class="navbar-brand">TRANG GIÁM ĐỐC</h1>
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
        $maPB = $_GET['maPB'];
        $result = get_info_1phongban($maPB);
        if($result['code'] == 0){
            $data = $result['data'];
        }
    ?>
    <a style="text-decoreation: none;" href="./phongban.php"><i class="fas fa-arrow-circle-left"></i></a>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-ms-6">
                <div class="d-flex justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <form novalidate method="post" enctype="multipart/form-data">
                                <h3>THÔNG TIN PHÒNG BAN</h3>
                                <div class="form-group">
                                    <label>Mã phòng ban:</label>
                                    <div class="form-control"><?=$data['maPB']?></div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Tên phòng ban:</label>
                                    <div class="form-control"><?=$data['namePB']?></div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Mô tả:</label>
                                    <div class="form-control"><?=$data['mota']?></div>
                                </div>

                                <div class="form-group">
                                    <label>Số phòng:</label>
                                    <div class="form-control"><?=$data['sophong']?></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
