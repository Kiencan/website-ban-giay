<?php
    session_start();
    include "../website-ban-giay/includes/connect.php";


    if(isset($_POST['btn']) ) {
        $id = "";
        $name = $_POST['name'];
        $address = "";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $sql = "INSERT INTO user (id, name, address, email, user, pass, role) 
        VALUES ('$id', '$name', '$address', '$email', '$username', '$password', '0') ";

        $kq = mysqli_query($conn,$sql);
        header('location:login_test.php');
    }
?>

<form action="dangky.php" method="post">
    <label>Full Name</label>
    <input type="text" name="name">

    <label>Username</label>
    <input type="text" name="username">

    <label>Password</label>
    <input type="password" name="password">

    <label>Email</label>
    <input type="text" name="email">

    <button type="submit" name="btn">Sign Up</button>
</form>