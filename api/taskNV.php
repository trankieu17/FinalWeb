<?php

    session_start();
    require_once('../db.php');
    if(!$_SESSION['username']){
        header("Location: ../login.php");
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
        if(isset($_POST['startDo'])){
            $status = "In progress";
            $nameTask = $_POST['nameTask'];
            $resultStart = start_task($nameTask, $status);
            if($resultStart['code'] == 0){
                $success = $resultStart['message'];
            }else{
                $error = $resultStart['message'];
            }
        }    
    ?>

    <?php
    if(check_truong_phong($data['name'], $data['maPB']) == false){
        $nameOfNv = $data['name'];
        $maPBOfNv = $data['maPB'];
        ?>
        <a style="text-decoreation: none;" href="../admin.php"><i class="fas fa-arrow-circle-left"></i></a>
        <div class="container">
            <br>
        <h2> TASK </h2>
        <h5>Các Task hiện có: </h5>
        <br>
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                    <th>STT</th>
                    <th>Tên task </th>
                    <th>Tình trạng</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;
                    $resultList = get_task_by_nhan_vien($nameOfNv, $maPBOfNv);
                    if($resultList['code'] == 0){
                        $dataOfTask = $resultList['data'];
                        if(count($dataOfTask) > 0 && is_array($dataOfTask)){
                            foreach ($dataOfTask as $row1) {
                                ?>
                                <tr>
                                    <td><?=$stt?></td>
                                    <td data-label="Tên task"><a style="text-decoration: none; color: black;" href="../chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                                    <td data-label="Tình trạng"><?=$row1['status']?></td>
                                    <td data-label="Trạng thái">
                                        <?php 
                                            if($row1['status'] == "New"){
                                                ?>
                                                    <form method="post">
                                                        <input type="hidden" name="nameTask" value="<?=$row1['tenTask']?>">
                                                        <input class="btn btn-primary" name="startDo" type="submit" value="Start">
                                                    </form>
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
                        }
                    }else{
                        ?>
                            <div class="alert alert-primary"><?php echo $resultList['message']?></div>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>

        <h5>Các Task đã hoàn thành: </h5>
        <br>
        <div class="table-responsive">
            <table class="table table-lg table-striped text-center">
                <thead>
                <tr style="background-image: linear-gradient(#F4A460,#FFFFCC);">
                    <th>STT</th>
                    <th>Tên task </th>
                    <th>Tình trạng</th>
                    <th>Quality</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;
                    $resultList = get_task_completed_by_nhanvien($data['name'], $data['maPB'], "Completed");
                    if($resultList['code'] == 0){
                        $dataOfTask = $resultList['data'];
                        foreach ($dataOfTask as $row1) {
                            ?>
                            <tr>
                                <td><?=$stt?></td>
                                <td data-label="Tên task"><a style="text-decoration: none; color: black;" href="../chiTietTask.php?tenTask=<?=$row1['tenTask']?>"><?=$row1['tenTask']?></a></td>
                                <td data-label="Tình trạng"><?=$row1['status']?></td>
                                <td data-label="Quality"><?=$row1['quality']?></td>
                                
                            </tr>
                            <?php
                            $stt += 1;
                        }
                    }else{
                        ?>
                            <div class="alert alert-primary"><?php echo $resultList['message']?></div>
                        <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
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
</body>
</html>