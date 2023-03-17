<?php 
    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
    }else if($_SESSION['username'] != "admin"){
        header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách nhân viên phòng ban</title>
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
        a i{
            font-size: 30px;
            color: red;
        }
        .h2{
            text-align: center;
        }
        body, html{
            background: url('../images/background.jpg') no-repeat;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }
        @media screen and (max-width: 540px){
            .h2{
                font-size: 10px;
            }
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
        <div class="nav-item" onclick="location.href='../admin.php'">
            <h1 class="navbar-brand">TRANG GIÁM ĐỐC </h1>
        </div>
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
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin: 10px;">
                    <a style="text-decoreation: none;" href="phongban.php"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
                <div>
                    <?php
                        $maPB = $_GET['maPB'];
                        $result = get_info_1phongban($maPB);
                        if($result['code'] == 0){
                            $data = $result['data'];
                        }
                    ?>
                    <h2 style="text-align:center;">Danh sách nhân viên <?=$data['namePB']?></h2>
                </div>
                <?php 
                    $success = "";
                    $error = "";
                    $maPB = $_GET['maPB'];

                    if(isset($_POST['boNhiem'])){
                        $nameBoNhiem = $_POST['nameNVToBoNhiem'];
                        $duocnghiTP = 15;
                        $resultBoNhiem = choose_truong_phong($nameBoNhiem, $duocnghiTP);

                        if($resultBoNhiem['code'] == 0){
                            $success = $resultBoNhiem['message'];
                        }else{
                            $error = $resultBoNhiem['message'];
                        }
                    }else if(isset($_POST['huyBoNhiem'])){
                        $duocnghiNV = 12;
                        $nameOldBoNhiem = $_POST['nameNVToHuyBoNhiem'];
                        $resultHuyBoNhiem = reject_truong_phong($duocnghiNV, $nameOldBoNhiem);

                        if($resultHuyBoNhiem['code'] == 0){
                            $success = $resultHuyBoNhiem['message'];
                        }else{
                            $error = $resultHuyBoNhiem['message'];
                        }
                    }else if(isset($_POST['del'])){
                        $id = $_POST['idToDel'];
                        $result4 = delete_nhan_vien($id);

                        if($result4['code'] == 0){
                            $success = $result4['message'];
                        }else{
                            $error = $result4['message'];
                        }
                    }

                    $result3 = get_button_truongphong($maPB);
                    if($result3['code'] == 0){
                        $data3 = $result3['data'];
                    }else{
                        $error = $result3['message'];
                    }
                ?>
                <p id="errors" style="text-align: center; font-weight: bold; font-size:20px; color: red;">
                    <?php
                        if(!empty($error)){
                            echo "<div class='alert alert-danger'>$error</div>";
                        }else if(!empty($success)){
                            echo "<div class='alert alert-success'>$success</div>";
                        }
                    ?>
                </p>
                <div class="table-responsive">
                    <table border="1" class="table table-lg table-striped text-center">
                        <thead>
                            <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                                <th>STT</th>
                                <th>Tên nhân viên</th>
                                <th>Bổ nhiệm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $stt = 1;
                                $resultList = get_nhanvien_pb($maPB);
                                if ($resultList['data']->num_rows > 0) {
                                    while($row1 = $resultList['data']->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?=$stt?></td>
                                <td><?=$row1["name"]?></td>
                                <?php
                                    if($row1['chucvu'] == 'trưởng phòng'){
                                        ?>
                                        <form method="post">
                                            <input type="hidden" name="nameNVToHuyBoNhiem" value="<?=$row1['name']?>">
                                            <td><button type="submit" name="huyBoNhiem" class="btn btn-danger">Hủy bổ nhiệm</button></td>
                                        </form>
                                        <?php
                                    }else if(check_has_truong_phong($row1['maPB']) == true){
                                        ?>
                                            <td></td>
                                        <?php
                                    }else{
                                        ?>
                                        <form method="post">
                                            <input type="hidden" name="nameNVToBoNhiem" value="<?=$row1['name']?>">
                                            <td><button type="submit" name="boNhiem" class="btn btn-success">Bổ nhiệm</button></td>
                                        </form>
                                        <?php
                                    }
                                ?>
                            </tr>
                            <?php 
                                $stt += 1;    
                                }
                                }else{
                                    echo "No result found";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <div>
    </div>
                
    </div>
    <div class="modal fade" id="confirm-delete">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">Xóa nhân viên</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                  Bạn có chắc rằng muốn xóa nhân viên <strong id="file-to-delete">image.jpg</strong>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="idToDel" id="idNV">
                     <button type="submit" name="del" class="btn btn-danger">Xóa</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
      <script src="../js/script.js"></script>
</body>
</html>