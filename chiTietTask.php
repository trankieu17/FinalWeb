<?php
session_start();
require_once('db.php');
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
    <title>Thông tin chi tiết công việc</title>
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
        .nav-item .dropdown-toggle{
            max-width: 100px;
        }
        a i{
            font-size: 30px;
            color: red;
        }

        .wrap{
            display: flex;
            justify-content: center;
        }

        /* .tinhchinh{
            margin-top: 20px;
            text-align: center;
        }
        .tinhchinh .btn{
            margin-right: 30px;
            width: 300px;
            padding: 10px;
        } */
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
$result = get_info_nhanvien($username);
if($result['code'] == 0){
    $data = $result['data'];
}
?>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
    <a href="index.php" style="text-decoration: none; color: black;"><h1 class="navbar-brand">TRANG NHÂN VIÊN </h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-list-4">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <button type="button" class="btn btn-light">
                            <?= $data['name'] ?>
                        </button>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                    </div>
                </li>   
            </ul>
        </div>
    </nav>
<?php
$error = "";
$success = "";
$tenTask = $_GET['tenTask'];
$result1 = get_task_by_name($tenTask);
if($result1['code'] == 0){
    $data1 = $result1['data'];
}else{
    $error = $result1['message'];
}
?>

<?php
if(check_truong_phong($data['name'], $data['maPB']) == true){
    ?>
        <a style="text-decoreation: none;" href="api/quanlyTask.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php
}else{
    ?>
        <a style="text-decoreation: none;" href="api/taskNV.php"><i class="fas fa-arrow-circle-left"></i></a>
    <?php
}
?>
<?php
if(isset($_POST['nopTask'])){
    $nameTask = $_POST['nameTask'];
    $status = "Wait";
    $fileNop = "uploadTask/" . $_FILES['taskToNop']['name'];
    move_uploaded_file($_FILES['taskToNop']['tmp_name'], $fileNop);
    $result2 = nop_task($nameTask, $fileNop, $status);

    if($result2['code'] == 0){
        $success = $result2['message'];
    }else{
        $error = $result2['message'];
    }

}else if(isset($_POST['duyet'])){
    // print_r($_POST);

    $nameTask = $_POST['nameToDuyet'];
    $quality = $_POST['quality'];
    $status = "Completed";
    $result3 = duyet_task($nameTask, $status, $quality);
    if($result3['code'] == 0){
        $success = $result3['message'];
    }else{
        $error = $result3['message'];
    }
}else if(isset($_POST['reject'])){
    $nameTask = $_POST['tenTask'];
    $status = "Reject";
    $result4 = reject_task($nameTask, $status);
    if($result4['code'] == 0){
        $success = $result4['message'];
    }else{
        $error = $result4['message'];
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex justify-content-center">
                <div class="card">
                    <div class="card-body">
                            <h3>THÔNG TIN TASK</h3>
                            <div class="form-group">
                                <label>Tên nhân viên:</label>
                                <div class="form-control"><?=$data1['nhanvien']?></div>
                            </div>

                            <div class="form-group">
                                <label>Tên task:</label>
                                <div class="form-control"><?=$data1['tenTask']?></div>
                            </div>

                            <div class="form-group">
                                <label>Chi tiết:</label>
                                <textarea class="form-control" rows="5" cols="100">
                                    <?=$data1['descTask']?>
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Hạn nộp:</label>
                                <div class="form-control"><?=$data1['deadline']?></div>
                            </div>

                            <div class="form-group">
                                <label>Tình trạng:</label>
                                <div class="form-control"><?=$data1['status']?></div>
                            </div>

                            <div class="form-group">
                                <label>Mã của phòng ban:</label>
                                <div class="form-control"><?=$data1['maPB']?></div>
                            </div>
                            <div class="form-group">
                                <label>File nộp:</label>
                                <div class="form-control">
                                    <?php 
                                        echo "<a href='".$data1['fileTask']."'>".str_replace('uploadTask/', '', $data1['fileTask'])."</a>";
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
               

                            <?php
                                if(check_truong_phong($data['name'], $data['maPB']) == true){
                                    $check_status_truong_phong = array("New", "Completed", "In Progress");
                                    if(!in_array($data1['status'], $check_status_truong_phong)){
                                        ?>
                                        <div class="wrap">
                                            <div class="tinhchinh">
                                            <button type="submit" name="duyet" onclick="update_name_for_duyet_task('<?=$data1['tenTask']?>')" data-toggle="modal" data-target="#confirm-quality" class="btn btn-success">Duyệt</button>
                                            </div>
                                            <div class="tinhchinh">
                                                <form method="post">
                                                    <input type="hidden" name="tenTask" value="<?=$data1['tenTask']?>">
                                                    <button type="submit" name="reject" class="btn btn-danger">Từ chối</button>
                                                </form>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                }else{
                                    $check_status = array("New", "Wait", "Completed");
                                    if(!in_array($data1['status'], $check_status)){
                                        ?>
                                            <div class="tinhchinh">
                                                <span>
                                                    <i 
                                                        onclick="update_name_for_nop_task('<?=$data1['tenTask']?>')" 
                                                        class="fas fa-file-upload" style="cursor: pointer; font-size: 50px;" 
                                                        class="fa fa-trash action" data-toggle="modal" data-target="#confirm-nop">
                                                    </i>
                                                </span>
                                                <span>Nộp task</span>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

        <!-- confirm nop task -->
            <div class="modal fade" id="confirm-nop">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Nộp task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <input type="file" name="taskToNop" id="taskToNop">
                        </div>
                    
                        <div class="modal-footer">
                            <input type="hidden" name="nameTask" id="nameToNop">
                            <button type="submit" name="nopTask" class="btn btn-danger">Nộp</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                        </div>
                    </form>            
                    </div>
                </div>
            </div>

        <!-- confirm đánh giá task -->
            <div class="modal fade" id="confirm-quality">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title">Duyệt task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div>
                                <span><i class="fas fa-check"></i></span>
                                <span><label for="quality">Đánh giá: </label></span>
                                <select name="quality" id="quality">
                                    <option value="Bad">Bad</option>
                                    <option value="OK">OK</option>
                                    <option value="Good">Good</option>
                                </select>
                            </div>

                        </div>
                    
                        <div class="modal-footer">
                            <input type="hidden" name="nameToDuyet" id="nameToDuyet">
                            <button type="submit" name="duyet" class="btn btn-danger">Duyệt</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                        </div>
                    </form>            
                    </div>
                </div>
            </div>
    <script src="js/script.js"></script>
        </div>
    </div>
</div>
</body>
</html>