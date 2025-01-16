<?php
// Các hàm chung của project
if (!defined('_CODE')) {
    die('Access denied');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function layouts($layoutName = 'header', $title = [])
{
    if (file_exists(_WEB_PATH_TEMPLATE . '/layout/' . $layoutName . '.php')) {
        require_once(_WEB_PATH_TEMPLATE . '/layout/' . $layoutName . '.php');
    }
}

function sendMail($to, $subject, $content, $from = 'kienbestdaxua@gmail.com')
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'kienbestdaxua@gmail.com';                     //SMTP username
        $mail->Password   = 'abelnoqvsexcqkis';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($from, 'Admin');
        $mail->addAddress($to);     //Add a recipient

        //Content
        $mail->CharSet = "UTF-8";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $content;

        // PHPmailer SSL certificate verify failed
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $sendMail = $mail->send();
        if ($sendMail) {
            return $sendMail;
        }
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Kiểm tra phương thức GET
function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}

// Kiểm tra phương thức POST
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

// Hàm filter lọc dữ liệu
function filter()
{
    $filterArr = [];
    if (isGet()) {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    if (isPost()) {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $key = strip_tags($key);
                if (is_array($value)) {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                } else {
                    $filterArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $filterArr;
}

// Hàm kiểm tra email
function isEmail($email)
{
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

// Hàm kiểm tra số nguyên
function isNumberInt($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    return $checkNumber;
}

// Hàm kiểm tra số thực
function isNumberFloat($number)
{
    $checkNumber = filter_var($number, FILTER_VALIDATE_FLOAT);
    return $checkNumber;
}

function isPhone($phone)
{
    // Điều kiện 1: Số đầu tiên là số 0
    $checkZero = false;
    if ($phone[0] == '0') {
        $checkZero = true;
        $phone = substr($phone, 1);
    }

    // Điều kiện 2: sau số 0 là 9 số nguyên
    $checkNumber = false;
    if (isNumberInt($phone) && strlen($phone) == 9) {
        $checkNumber = true;
    }
    if ($checkZero && $checkNumber) {
        return true;
    } else {
        return false;
    }
}

// Thông báo lỗi
function getSmg($smg, $type = 'success')
{
    echo '<div class="alert alert-' . $type . '">' . $smg . '</div>';
}

// Hàm chuyển hướng
function redirect($path = 'index.php')
{
    header('Location: ' . $path);
    exit();
}

// Hàm quay về trang trước đó
function goBack()
{
    if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        header('Location: index.php'); // Trang mặc định nếu không có HTTP_REFERER
    }
    exit();
}

// Hàm thông báo lỗi form
function form_error($fileName, $before = '', $after = '', $errors)
{
    return (!empty($errors[$fileName])) ? $before . reset($errors[$fileName]) . $after : null;
}

// Hàm ghi nhớ thông tin ô đã nhập
function old($fileName, $oldData, $default = null)
{
    return (!empty($oldData[$fileName])) ? $oldData[$fileName] : $default;
}

// Hàm kiểm tra trạng thái đăng nhập
function isLogin()
{
    $checkLogin = false;
    $tokenLogin = getSession('token_login');
    if ($tokenLogin) {

        // Kiểm tra token có giống trong database hay không
        $queryToken = oneRaw("SELECT user_id, create_at FROM token_login WHERE token = '$tokenLogin'");
        if (!empty($queryToken)) {
            $currentTime = time();

            $tokenTime = strtotime($queryToken['create_at']);
            if (($currentTime - $tokenTime) <= 7200) {
                $checkLogin = true;
            } else {
                $deleteToken = delete('token_login', "token = '$tokenLogin'");
                if ($deleteToken) {
                    removeSession('token_login');
                }
            }
        } else {
            removeSession('token_login');
        }
    }
    return $checkLogin;
}

function isAdmin()
{
    $checkAdmin = false;
    if (getSession('token_login')) {
        $tokenLogin = getSession('token_login');

        // Kiểm tra token có giống trong database hay không
        $checkAdmin = oneRaw("SELECT isAdmin FROM token_login JOIN user ON token_login.user_id = user.user_id WHERE token = '$tokenLogin' AND isAdmin = 1");
        if (!empty($checkAdmin)) {
            $checkAdmin = true;
        }
    }
    return $checkAdmin;
}

function getUserIdByToken()
{
    $userId = null;
    if (getSession('token_login')) {
        $tokenLogin = getSession('token_login');

        // Lấy user_id từ token_login trong database
        $queryToken = oneRaw("SELECT user_id FROM token_login WHERE token = '$tokenLogin'");
        if (!empty($queryToken)) {
            $userId = $queryToken['user_id'];
        } else {
            removeSession('token_login');
        }
    }
    return $userId;
}
