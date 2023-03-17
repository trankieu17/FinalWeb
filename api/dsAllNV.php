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
    <title>Danh sách nhân viên</title>
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
        a i{
            font-size: 30px;
            color: red;
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
        /* res đối với table lơn */
        @media screen and (max-width:479px ){
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
                padding-right: 40%;
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
    
    <a style="text-decoreation: none; " href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>	
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2> QUẢN LÝ NHÂN VIÊN </h2>
                
                <?php 
                    $success = "";
                    $error = "";
                ?>
                <div style="margin: 10px;">
                    <button class="btn btn-primary"><a style="text-decoration: none; color: #fff;" href="../addNV.php">Thêm nhân viên</a></button>
                </div> 
                <div class="table-responsive" >
                    <table border="1" class="table table-lg table-striped text-center">
                        <thead>
                            <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                                <th>STT</th>
                                <th>Tên nhân viên</th>
                                <th>Phòng ban</th>
                                <th>Chức vụ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $stt = 1;
                                $resultList = get_all_staff();
                                if($resultList['code'] == 0){
                                    $dataNv = $resultList['data'];
                                    foreach($dataNv as $a){
                                        ?>
                                            <tr>
                                                <td data-label="STT"><?=$stt?></td>
                                                <td data-label="Tên nhân viên"><?=$a['name']?></td>            
                                                <td data-label="Phòng ban"><?=$a['maPB']?></td>
                                                <?php
                                                    if(check_truong_phong($a['name'], $a['maPB']) == true){
                                                        $chucvu = 'Trưởng phòng';
                                                    }
                                                    else{
                                                        $chucvu = 'Nhân viên';
                                                    }
                                                ?>
                                                <td data-label="Chức vụ"><?=$chucvu?></td>
                                                <td>
                                                    <a href="chiTietNV.php?name=<?=$a['name']?>" style="color: black">View information</a>
                                                </td>                        
                                        <?php
                                        $stt+=1;
                                    }
                                }else{
                                    $error = $resultList['error'];
                                }
                            ?>
                            
                                
                                
                        </tbody>
                    </table>
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
