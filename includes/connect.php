<!-- Kết nối với database -->

<?php
    $server ='localhost';
    $user = 'root';
    $password = '';
    $database = '3h1a';

    $conn = new mysqli($server, $user, $password, $database);

    if($conn) {
        mysqli_query($conn, "SET NAMES 'utf8' ");
    }
?>