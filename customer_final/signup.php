<?php
include("../shared_assets/conn.php");
session_start();
if(isset($_POST['signUp'])) {
    $id = 'user'.rand(100, 900000);
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "SELECT * FROM tbl_account WHERE accountUsername = '{$username}'";
    $queryCheck = mysqli_query($conn, $sql);

    if(mysqli_num_rows($queryCheck) > 0){
        echo "<script>alert('Account has been created')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    } else{
        $query = "INSERT INTO tbl_account (accountID, accountFullname, accountUsername, accountPassword, accountEmail, accountPhone, roleID)
        VALUES ('$id', '$fullname', '$username', '$password', '$email', '$phone', 'role_2')";
        $res = mysqli_query($conn, $query);
        if($res) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM tbl_account WHERE accountUsername = '$username' AND accountPassword = '$password' AND roleID = 'role_2'";
            $query = mysqli_query($conn, $sql);
            $_SESSION['user'] = mysqli_fetch_assoc($query);
            $user = (isset($_SESSION['user']))? $_SESSION['user'] : [];
            if($query){
                $id = 'wallet'.rand(0, 100000);
                $walletBalance = 0;
                $accountID = $user['accountID'];

                $sql = "INSERT INTO tbl_account_wallet (walletID, walletBalance, accountID) VALUES ('$id', '$walletBalance', '$accountID')";
                $query = mysqli_query($conn, $sql);
                if($query){
                    $voucherID = "voucher_".rand(0, 100000);
                    $typeID = 'type_0';
                    $accountID = $user['accountID'];
                    $sql = "INSERT INTO tbl_account_voucher (voucherID, typeID, accountID) VALUES('$voucherID', '$typeID', '$accountID')";
                    $query = mysqli_query($conn, $sql);
                    echo "<script>alert('Sign up successful')</script>";
                    echo "<script>window.open('cusprofile.php','_self')</script>";
                }
            }
        }
        else {
            echo "<script>alert('Sign up failed')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}
?>