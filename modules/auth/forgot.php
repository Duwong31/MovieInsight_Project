<!------ Quên mật khẩu ------>

<!--- Đăng nhập tài khoản ---->

<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }

$data = [
    'pageTitle' => 'Forgot password'
];

layouts('header-login', $data);

//Kiểm tra trạng thái đăng nhập
if(isLogin()){
    redirect('?module=home&action=index');
}

if(isPost()){
    $filterAll = filter();
    if(!empty($filterAll['email'])){
        $email = $filterAll['email'];
        
        $queryUser = oneRaw("SELECT id FROM users WHERE email = '$email'");
        if(!empty($queryUser)){
            $userId = $queryUser['id'];

            //Tạo forgotToken 
            $forgotToken = sha1(uniqid().time());

            $dataUpdate = [
                'forgotToken' => $forgotToken
            ];
            $updateStatus = update('users', $dataUpdate, "id=$userId");
            if($updateStatus){
                //Tạo link reset,  khôi phục mật khẩu
                $linkReset = _WEB_HOST.'?module=auth&action=reset&token='.$forgotToken;
                
                //gửi mail cho người dùng
                $subject = 'Yêu cầu khôi phục mật khẩu';
                $content = 'Chào bạn.</br>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để đổi lại mật khẩu: </br>';
                $content .= $linkReset .  '</br>';
                $content .= 'Trân trọng cảm ơn!';

                $sendEmail = sendMail($email, $subject, $content);

                if($sendEmail){
                    setFlashData('msg', 'Vui lòng kiểm tra email để xem hướng dẫn đặt lại mật khẩu!');
                    setFlashData('msg_type', 'success');
                }else{
                    setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sau!(email)');
                    setFlashData('msg_type', 'danger');
                }

            }else{
                setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sau');
                setFlashData('msg_type', 'danger');
            }
        }else{
            setFlashData('msg', 'Địa chỉ email không tồn tại trong hệ thống!');
            setFlashData('msg_type', 'danger');
        }
    }else{
        setFlashData('msg', 'Vui lòng nhập địa chỉ email.');
        setFlashData('msg_type', 'danger');
    }
    redirect('?module=auth&action=forgot');
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
        <h2 class="text-center text-uppercase">Forgot password</h2>
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
            
            <button type="submit" class="mg-btn btn btn-primary btn-block">Send</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=loginUser">Login</a></p>
            <p class="text-center"><a href="?module=auth&action=signup">Create new account</a></p>
        </form>    
    </div>
</div>
</body>
</html>





<?php
layouts('footer-login');
?>