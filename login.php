<?php 
    session_start();
    require_once('db.php');
    $error = "";
    if(isset($_POST['enter'])){
        $username = $_POST['username'];
        $pwd = $_POST['pwd'];
        if($username == "admin"){
            $result = login_admin($username, $pwd);
            if($result['code']==0){
                $data = $result['data'];
                $_SESSION['username'] = $data['username'];
                header('Location: admin.php');
                exit();
            }else{
                $error = $result['message'];
            }
        }else{
            $result = login($username, $pwd);
            // print_r($result);
            if($result['code']==0){
                $data = $result['data'];
                $_SESSION['username'] = $data['username'];
                header('Location: index.php');
                exit();
            }else{
                $error = $result['message'];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- boostrap thêm  -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
    .container.p-5{
    }
    .container h2{
    text-align: center;
    font-style: italic;
    font-weight: bold;
    width:100%;
    }
    body, html{
        background: url('images/anhnen.jpg') no-repeat;
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        font-family: 'Numans', sans-serif;
    } 
    .login-button{
        display: flex;
        justify-content: center;
    }
    .logo-img {

        display: flex;
        justify-content: center;
    }
    img {
        width: 35%;
    }
    .login-button{
        width: 100%;
    }
    .form-group{
        width: 100%;
    } 
    @media all and (min-width:768px ) and (max-width:1000px){
        .container.p-5{
            width:700px;
        }
        .container.p-5.form-group{
            height: 60px;
            font-size: 100px;
        }
    }
    @media screen and (min-width: 1000px){
        .container.p-5{
            width:500px;
            
        }
    }

    </style>
</head>
<body>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-12 col-ms-6">
                <form class="form-container" method="post">
                    <div class="logo-img">
                        <img src=images/logoTDT.png></img>
                    </div>
                    <h2>Đăng nhập</h2>
                    <div class="form-group">
                        <label for="username">TÀI KHOẢN:</label>
                        <input type="text" class="form-control" id="username" placeholder="Nhập tài khoản" name="username">
                    </div>
                    <div class="form-group">
                        <label for="pwd">MẬT KHẨU:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="pwd">
                    </div>
                    <div class="form-group">
                            <?php 
                                if(!empty($error)){
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                            ?>
                    </div>
                    <div class="login-button">
                        <button class="login-button btn btn-success"  type="submit" name="enter">Đăng nhập</button>
                    </div>
                    
                </form>
            
                </div>
        </div>
    </div>
    
</body>
</html>