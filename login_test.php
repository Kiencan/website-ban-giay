<?php
    session_start();
    include "../website-ban-giay/includes/connect.php";

    if(isset($_POST['dangnhap'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "select * from user where user='$username' and pass = '$password' ";
        
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;  
            header('location:trangchu.php');
        } else {
            echo "Sai pass cmmr !";
        }
    }
?>



<form action="login_test.php" method="post">
    <label>Username </label>
    <input type="text" name="username">

    <label>Password </label>
    <input type="password" name="password">

    <button type="submit" name="dangnhap">Đăng Nhập</button>
    <button type="submit" name="dangky"><a href="dangky.php">Đăng ký </a></button>
</form>