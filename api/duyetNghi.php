<?php 
    session_start();
    require_once('../db.php');
    $error = "";
    $success = "";
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
	    .table{
            border: 1px solid black;
        }
        body, html{
            background: url('../images/background.jpg') no-repeat;
            background-size: cover;
            background-repeat: no-repeat;
            height: 100%;
            font-family: 'Numans', sans-serif;
        }
        h2{
            color: #C71585; 
            text-align: center;
            font-weight: bold;
        }
        @media all and (max-width:479px ){
            thead{
                display:none;
            }
            td{
                display: block;
                width: 100%;
                text-align: right;
            }
            
            td:first-child{
                background: lightblue;
                color: red;
                text-align: center;
            }
            td{
                text-align: right;
                padding-left: 50%;
                position: relative;

            }
            td::before{
                content: attr(data-label);
                float: left;
                margin-right:3rem;
                font-weight: bold;
                text-align: left;
                /* padding-right: 40%; */
            }
            h3{
                font-size: 20px;
                margin-left: 20px;
            }
        }


    </style>
</head>
<body>
    <?php 
        $username = $_SESSION["username"];
        if($username == "admin"){
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

    <a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>

    <?php 
        if(isset($_POST['duyet'])){
            $nameNV = $_POST['nameNvToDuyet'];
            $status = "approved";
            $id = $_POST['id'];
            $songay = $_POST['songay'];
            $resultDuyet = approve_xin_nghi_by_truong_phong($nameNV, $status, $id, $songay);
            if($resultDuyet['code'] == 0){
                $success = $resultDuyet['message'];
            }else{
                $error = $resultDuyet['message'];
            }
            
        }else if(isset($_POST['reject'])){
            $nameNV = $_POST['nameNvToReject'];
            $status = "rejected";
            $id = $_POST['idreject'];
            $resultRejected = reject_xin_nghi_by_truong_phong($nameNV, $status, $id);
            if($resultRejected['code'] == 0){
                $success = $resultRejected['message'];
            }else{
                $error = $resultRejected['message'];
            }
        }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2> DUYỆT ĐƠN XIN NGHỈ </h2>
                <?php 
                    if(check_truong_phong($data['name'], $data['maPB']) == true){
                        ?>
                            <br>
                            <h5>Danh sách xin nghỉ của nhân viên trong phòng: </h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-lg table-striped text-center">
                                    <thead>
                                    <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                                        <th>STT</th>
                                        <th>Nhân viên</th>
                                        <th>Reason</th>
                                        <th>Số ngày</th>
                                        <th>Tình trạng</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $stt = 1;
                                        $resultList = get_don_nghiphep_truongphong($data['maPB']);
                                        if($resultList['code'] == 0){
                                            $data1 = $resultList['data'];
                                            if(count($data1) > 0 && is_array($data1)){
                                                
                                                foreach ($data1 as $row1) {
                                                    if($row1['status'] == "waiting"){
                                                        if(check_truong_phong($row1['name'], $row1['maPB']) == false){
                                                            ?>
                                                            <tr>
                                                                <td><?=$stt?></td>
                                                                <td data-label="Nhân viên"><?=$row1['name']?></td>
                                                                <td data-label="Reason"><?=$row1['reason']?></td>
                                                                <td data-label="Tình trạng"><?=$row1['songay']?></td>
                                                                <td data-label="Action"><?=$row1['status']?></td>
                                                                <td>
                                                                    <button onclick="update_name_duyet_nghi('<?=$row1['name']?>', <?=$row1['id']?>, <?=$row1['songay']?>)" class="btn btn-success"data-toggle="modal" data-target="#confirm-duyet">approve</button>
                                                                    <button onclick="update_name_reject_nghi('<?=$row1['name']?>',<?=$row1['id']?>)" class="btn btn-success" data-toggle="modal" data-target="#confirm-reject">reject</button>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $stt += 1;
                                                        }
                                                    }
                                                }
                                            }
                                        }else{
                                            ?>
                                                <div class="alert alert-danger">Không có đơn xin nghỉ phép</div>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            </br>
                        <?php
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
            </div>
        </div>
    </div>

      <!-- confirm duyệt nghỉ phép -->
    <div class="modal fade" id="confirm-duyet">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">Duyệt nghỉ phép</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <div>
                        bạn có chắc muốn duyệt đơn xin nghỉ phép cho nhân viên <strong id="nhanVienCanDuyet">Hoài Nam</strong>
                    </div>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="nameNvToDuyet" id="nameNvToDuyet">
                      <input type="hidden" name="id" id="id">
                      <input type="hidden" name="songay" id="songay">
                     <button type="submit" name="duyet" class="btn btn-danger">Duyệt</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
        <!-- confirm từ chối nghỉ phép -->
      <div class="modal fade" id="confirm-reject">
         <div class="modal-dialog">
            <div class="modal-content">
               <form method="post">
                  <div class="modal-header">
                     <h4 class="modal-title">Reject nghỉ phép</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <div class="modal-body">
                    <div>
                        bạn có chắc muốn duyệt đơn xin nghỉ phép cho nhân viên <strong id="nhanVienCanReject">Hoài Nam</strong>
                    </div>
                  </div>
            
                  <div class="modal-footer">
                      <input type="hidden" name="nameNvToReject" id="nameNvToReject">
                      <input type="hidden" name="idreject" id="idreject">
                     <button type="submit" name="reject" class="btn btn-danger">reject</button>
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                  </div>
               </form>            
            </div>
         </div>
      </div>
    <script src="../js/script.js"></script>
    
</body>
</html>