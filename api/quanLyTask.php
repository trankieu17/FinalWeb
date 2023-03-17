<?php
session_start();
require_once('../db.php');
if(!$_SESSION['username']){
    header("Location: ../login.php");
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
	    h5{
            background:#CCFFFF;
            padding: 10px;
            border-radius: 5px;
        }
        .back{
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
        .status1{
            background: red;
        }
        .status2{
            background: blue;

        }
        .status3{
            background: green;
        }
        @media screen and (max-width:320px ){
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
                margin-right:9rem;
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
$result = get_info_nhanvien($username);
if($result['code'] == 0){
    $data = $result['data'];
}
?>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
        <a href="../index.php" style="text-decoration: none; color: black;"><h1 class="navbar-brand">TRANG NHÂN VIÊN </h1></a>
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
<a style="text-decoreation: none;" href="../index.php"><i class="fas fa-arrow-circle-left"></i></a>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-ms-6">
            <h2> QUẢN LÝ TASK </h2>
            <div class="table-responsive">
                <h3>Các Task hiện có: </h3>
                <br>
                <table class="table table-lg table-striped text-center">
                    <thead>
                    <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                        <th>STT</th>
                        <th>Tên task </th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stt = 1;
                    $resultList = get_all_task_by_phong_ban($data['maPB']);
                    if($resultList['code'] == 0){
                        foreach ($resultList['data'] as $row1) {
                        ?>
                        <tr>
                            <td ><?=$stt?></td>
                            <td data-label="Tên task"><a style="text-decoration: none; color: black;" href="../chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                            <td data-label="Trạng thái" ><?=$row1['status']?></td>
                            <td data-label="Action">
                                <?php 
                                    if($row1['status'] == "New"){
                                        ?>
                                            <span>
                                                <i 
                                                    style="cursor: pointer" 
                                                    onclick="add_value_id_edit(<?=$row1['id']?>, '<?=$row1['tenTask']?>','<?=$row1['descTask']?>','<?=$row1['nhanvien']?>', '<?=$row1['deadline']?>')" 
                                                    class="fas fa-edit" 
                                                    data-toggle="modal" data-target="#confirm-edit"
                                                ></i>
                                            </span>
                                            <span>
                                                <i 
                                                    style="cursor: pointer" 
                                                    onclick="update_name_delete_task('<?=$row1['tenTask']?>')" 
                                                    class="fa fa-trash action" 
                                                    data-toggle="modal" data-target="#confirm-delete">
                                                </i>
                                            </span>
                                        <?php
                                    }else{
                                        ?>
                                            <p>No Thing To Do</p>
                                        <?php
                                    }
            
                                ?>
                                
                                
                            </td>
                        </tr>
            
                        <?php
                            $stt += 1;
                        }
                    }else{
                        ?>
                            <p  style="background:#CCFFFF; padding: 10px; border-radius: 5px;">Không có dữ liệu nào hết</p>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <br>
                <h3>Các Task đã hoàn thành: </h3>
                <br>
                <table class="table table-lg table-striped text-center">
                    <thead>
                    <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                        <th>STT</th>
                        <th>Tên task </th>
                        <th>Trạng thái</th>
                        <th>Quality</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $st = 1;
                    $resultList1 = get_task_success($data['maPB']);
                    if($resultList1['code'] == 0){
                        foreach ($resultList1['data'] as $row) {
                            ?>
                            <tr>
                                <td><?=$st?></td>
                                <td data-label="Tên task"><a style="text-decoration: none; color: black;" href="../chiTietTask.php?tenTask=<?=$row['tenTask']?>"><?=$row['tenTask']?></a></td>
                                <td data-label="Trạng thái"><?=$row['status']?></td>
                                <td data-label="Quality" class="status"><?=$row['quality']?></td>
                            </tr>
            
                            <?php
                            $st += 1;
                        }
                    }else{
                        ?>
                        <p style="background:#CCFFFF; padding: 10px; border-radius: 5px;">Không có dữ liệu nào hết</p>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary"><a href="../addTask.php" style="text-decoration: none; color: white;">Giao task mới</a></button>
            </div>
        </div> 
    </div> 
 
        <?php 
            if(isset($_POST['del'])){
                $tenTask = $_POST['tenToDel'];
                $resultDel = delete_task($tenTask);
                if($resultDel['code'] == 0){
                    $success = $resultDel['message'];
                }else{
                    $error = $resultDel['message'];
                }
            }else if(isset($_POST['edit'])){
                $name = $_POST['nameTask'];
                $cTTask = $_POST['cTTask'];
                $nhanvien = $_POST['nhanvien'];
                $deadTask = $_POST['deadTask'];
                $idToEdit = $_POST['idToEdit'];
    
                $resultEdit = edit_task($name, $cTTask, $nhanvien, $deadTask, $idToEdit);
                if($resultEdit['code'] == 0){
                    $success = $resultEdit['message'];
                }else{
                    $error = $resultEdit['message'];
                }
            }
        ?>
    
        <div class="modal fade" id="confirm-delete">
             <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Xóa task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
    
                        <div class="modal-body">
                        Bạn có chắc rằng muốn xóa task <strong id="task-to-delete">image.jpg</strong>
                        </div>
                    
                        <div class="modal-footer">
                            <input type="hidden" name="tenToDel" id="tenToDel">
                            <button type="submit" name="del" class="btn btn-danger">Xóa</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                        </div>
                    </form>            
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="confirm-edit">
             <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header">
                            <h4 class="modal-title">Sửa task</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
    
                        <div class="modal-body">
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                                </div>
                                <input class="input-group-text" type="text" id="name" name="nameTask" placeholder="Nhập tên task">
                            </div>
    
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-newspaper"></i></span>
                                </div>
                                <textarea rows="5" cols="19" class="input-group-text" name="cTTask" id="desc" placeholder="Nhập chi tiết task"></textarea>
    
                            </div>
    
                            <div class="input-group form-group">
                                <select name="nhanvien" id="user">
                                    <?php
                                        $result3 = get_nhanvien_pb($data['maPB']);
                                    if ($result3['data']->num_rows > 0) {
                                        while($a = $result3['data']->fetch_assoc()) {
                                            if(check_truong_phong( $a['name'],$data['maPB']) == false){
                                    ?>
                                    <option value="<?=$a['name']?>"><?=$a['name']?></option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
    
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                </div>
                                <input id="dead" class="input-group-text" type="date" name="deadTask">
    
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <input type="hidden" name="idToEdit" id="idToEdit">
                            <button type="submit" name="edit" class="btn btn-danger">Sửa</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                        </div>
                    </form>            
                </div>
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
</div>
    <script src="../js/script.js"></script>
</body>
</html>
