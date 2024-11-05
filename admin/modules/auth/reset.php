<!---- reset password -------->

<?php
if (!defined('_CODE')) {
    die('Access denied...');
}
$data = [
    'pageTitle' => 'Reset mật khẩu'
];
layouts('header', $data);


$token = filter()['token'];
if (!empty($token)) {
    //Truy vấn database kiểm tra token
    $tokenQuery = oneRaw("SELECT id, fullname, email FROM users WHERE forgotToken = '$token'");
    if (!empty($tokenQuery)) {
        $userId = $tokenQuery['id'];
        if (isPost()) {
            $filterAll = filter();
            $errors = []; //Mảng chứa các lỗi
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
                //Xử lý việc update mật khẩu
                $passwordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $passwordHash,
                    'forgotToken' => null,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $updateStatus = update('users', $dataUpdate, "id = '$userId'");
                if($updateStatus){
                    setFlashData('msg', 'Thay đổi mật khẩu thành công!!');
                    setFlashData('msg_type', 'success');
                    redirect('?module=auth&action=login');
                }else{
                    setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sau!!');
                    setFlashData('msg_type', 'danger');
                }
            } else {
                setFlashData('msg', 'Vui lòng kiểm tra lại dữ liệu!!');
                setFlashData('msg_type', 'danger');
                setFlashData('errors', $errors);
                redirect('?module=auth&action=reset&token='.$token);
            }
        }
$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');

?>
        <!-- Form đặt lại mật khẩu --->
        <div class="row">
            <div class="col-4" style="margin: 50px auto;">
                <h2 class="text-center text-uppercase">ĐẶT LẠI MẬT KHẨU</h2>
                <?php
                if (!empty($msg)) {
                    getSmg($msg, $msg_type);
                }
                ?>
                <form action="" method="post">

                    <div class="form-group mg-form">
                        <label for="">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        <?php
                        echo form_error('password', '<span class="error">', '</span>', $errors);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Nhập lại mật khẩu</label>
                        <input type="password" name="password_confirm" class="form-control" placeholder="Nhập lại mật khẩu">
                        <?php
                        echo form_error('password_confirm', '<span class="error">', '</span>', $errors);
                        ?>
                    </div>
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <button type="submit" class="mg-btn btn btn-primary btn-block">Gửi</button>
                    <hr>

                    <p class="text-center"><a href="?module=auth&action=login">Đăng nhập tài khoản</a></p>
                </form>
            </div>
        </div>
<?php
    }
} else {
    getSmg('Liên kết không tồn tại hoặc đã hết hạn.', 'danger');
}
?>

<?php
layouts('footer');
?>