<?php
include("../shared_assets/conn.php");
session_start();
$name = $_POST['name'];
$password = $_POST['password'];
if(isset($_POST['Login'])) {
    $query = "SELECT * FROM tbl_account 
              WHERE accountUsername = '$name' AND accountPassword = '$password' AND roleID = 'role_2'";
    $res = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($res);
    $checkUser = mysqli_num_rows($res);
    if($checkUser == 1) {
        $_SESSION['user'] = $fetch;
        echo "<script>alert('Login successful')</script>";
        echo "<script>window.open('cusprofile.php','_self')</script>";
    }
    else {
        echo "<script>alert('Login failed')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
?>