<!--- Đăng ký tài khoản ------>

<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

if (isPost()) {
    $filterAll = filter();
    $errors = []; // mảng chứa các lỗi 

    // Validate fullname: bắt buộc phải nhập, min 5 ký tự
    if (empty($filterAll['fullname'])) {
        $errors['fullname']['required'] = 'Họ tên bắt buộc phải nhập.';
    } else {
        if (strlen($filterAll['fullname']) < 5) {
            $errors['fullname']['min'] = 'Họ tên phải có ít nhất 5 ký tự';
        }
    }

    //Email validate: bắt buộc phải nhập, đúng định dạng email, kiểm tra email đã tồn tại trong csdl chưa
    if (empty($filterAll['email'])) {
        $errors['email']['required'] = 'Email bắt buộc phải nhập.';
    } else {
        $email = $filterAll['email'];
        $sql = "SELECT id FROM users WHERE email = '$email'";
        if (getRows($sql) > 0) {
            $errors['email']['unique'] = 'Email đã tồn tại';
        }
    }

    //Validate số điện thoại: bắt buộc phải nhập, số có đúng định dạng không
    if (empty($filterAll['phone'])) {
        $errors['phone']['required'] = 'Số điện thoại bắt buộc phải nhập.';
    } else {
        if (!isPhone($filterAll['phone'])) {
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ!';
        }
    }
    //Validate password: bắt buộc phải nhập, >=8 ký tự
    if (empty($filterAll['password'])) {
        $errors['password']['required'] = 'Mật khẩu bắt buộc phải nhập.';
    } else {
        if (strlen($filterAll['password']) < 8) {
            $errors['password']['min'] = 'Mật khẩu phải lớn hơn hoặc bằng 8';
        }
    }
    //Validate password_confirm
    if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = 'Bạn phải nhập lại mật khẩu.';
    } else {
        if ($filterAll['password'] != $filterAll['password_confirm']) {
            $errors['password_confirm']['match'] = 'Mật khẩu bạn nhập lại không đúng';
        }
    }
    if (empty($errors)) {

        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'password' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('users', $dataInsert);
        if ($insertStatus) {

            //Tạo link kích hoạt
            $linkActive = _WEB_HOST . '?module=auth&action=active&token=' . $activeToken;

            //Thiết lập gửi mail
            $subject = $filterAll['fullname'] . 'Vui lòng kích hoạt tài khoản!!!';
            $content = 'Chào ' . $filterAll['fullname'] . '.</br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản: </br>';
            $content .= $linkActive . '</br>';
            $content .= 'Trân trọng cảm ơn';

            //Tiến hành gửi mail
            $sendMail = sendMail($filterAll['email'], $subject, $content);
            if ($sendMail) {
                setFlashData('smg', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản!');
                setFlashData('smg_type', 'success');
            } else {
                setFlashData('smg', 'Hệ thống gặp sự cố, vui lòng thử lại sau!');
                setFlashData('smg_type', 'danger');
            }
        } else {
            setFlashData('smg', 'Đăng ký không thành công');
            setFlashData('smg_type', 'danger');
        }

        redirect('?module=auth&action=signup');
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại dữ liệu!!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=auth&action=signup');
    }
}

$data = [
    'pageTitle' => 'Signup Movie Insight'
];

layouts('header-login', $data);

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

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
        <h2 class="text-center text-uppercase">Sign up</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">Fullname</label>
                <input type="text" name="fullname" class="form-control" placeholder="fullname" value="<?php echo old('fullname', $old) ?>">
                <?php
                echo form_error('fullname', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email address" value="<?php echo old('email', $old) ?>">
                <?php
                echo form_error('email', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Phone number</label>
                <input type="text" name="phone" class="form-control" placeholder="084-XXX-XXXX" value="<?php echo old('phone', $old) ?>">
                <?php
                echo form_error('phone', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <?php
                echo form_error('password', '<span class="error">', '</span>', $errors);
                ?>
            </div>
            <div class="form-group mg-form">
                <label for="">Confirm password</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm password">
                <?php
                echo form_error('password_confirm', '<span class="error">', '</span>', $errors);
                ?>
            </div>

            <button type="submit" class="mg-btn btn btn-primary btn-block">Sign up</button>
            <hr>

            <p class="text-center"><a href="?module=auth&action=loginUser">Login</a></p>
        </form>
    </div>
</div>
</body>
</html>



<?php
layouts('footer-login');
?>