<!--- Đăng nhập tài khoản ---->

<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }

$data = [
    'pageTitle' => 'Login Movie Insight'
];

layouts('header-login', $data);

//Kiểm tra trạng thái đăng nhập
if(isLogin()){
    redirect('?module=home&action=index');
}

if(isPost()){
    $filterAll = filter();
    
    if(!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))){
        //kiểm tra đăng nhập
        $email = $filterAll['email'];
        $password = $filterAll['password'];
        
        //truy vấn thông tin users
        $userQuery = oneRaw("SELECT password, id FROM users WHERE email = '$email'");
        if(!empty($userQuery)){
            $passwordHash = $userQuery['password'];
            $user_id = $userQuery['id'];
            if(password_verify($password, $passwordHash)){
                // Lưu user_id vào session khi chèn token thành công
                setSession('user_id', $user_id);

                $userLogin = getRows("SELECT * FROM tokenlogin WHERE user_id = '$user_id'");

                if($userLogin > 0){
                    setFlashData('msg', 'Tài khoản đang đăng nhập ở một nơi khác!');
                    setFlashData('msg_type', 'danger');
                    redirect('?module=auth&action=loginUser');
                }
                else{
                    //Tạo tokenLogin
                    $tokenLogin = sha1(uniqid().time());

                    // Lưu token vào session
                    setSession('tokenlogin', $tokenLogin);

                    //Insert vào bảng tokenlogin
                    $dataInsert = [
                        'user_id' => $user_id,
                        'token' => $tokenLogin,
                        'create_at' => date('Y-m-d H:i:s')
                    ];
                    $insertStatus = insert('tokenlogin',$dataInsert);
                    if($insertStatus){
                        //Insert thành công

                        //Lưu cái loginToken vào session
                        setSession('tokenlogin', $tokenLogin);

                        // Đặt token vào cookie để duy trì đăng nhập trong 30 ngày
                        setcookie("login_token", $tokenLogin, time() + (86400 * 30), "/");

                        redirect('?module=home&action=index');
                    }else{
                        setFlashData('msg', 'Không thể đăng nhập, vui lòng thử lại sau');
                        setFlashData('msg_type', 'danger');
                    }
                }
                

                
            }else{
                setFlashData('msg', 'Mật khẩu không chính xác.');
                setFlashData('msg_type', 'danger');
                
            }
        }else{
            setFlashData('msg', 'Email không tồn tại.');
            setFlashData('msg_type', 'danger');
            
        }
    }else{
        setFlashData('msg','Vui lòng nhập email và mật khẩu');
        setFlashData('msg_type','danger');
       
    }
    redirect('?module=auth&action=loginUser');
}

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./templates/img/icons8-movie-30.png">
    <title>Login</title>
    <style>
        .home-button{
            position: absolute;
            top: 0;
            left: 0;
            border: none;
        }
        .home-btn{
            font-size: 20px;
            color: #e70634;
            text-decoration: none;
        }
    </style>
</head>
<body>
<button class="home-button"><a class="home-btn" href="?module=home&action=index"><i class="fa-solid fa-house"></i>Home</a></button>
<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Login</h2>
        <?php
            if(!empty($msg)){
                getSmg($msg, $msg_type);
            }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email address">
            </div>
            <div class="form-group mg-form">
                <label for="">Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
            </div>     
           
            <button type="submit" class="mg-btn btn btn-primary btn-block">Login</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Forgot password</a></p>
            <p class="text-center"><a href="?module=auth&action=signup">Create new accountt</a></p>
        </form>    
    </div>
</div>
</body>
</html>







<?php
layouts('footer-login');
?>