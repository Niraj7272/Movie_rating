<?php
session_start();
include "config.php";
$user_id=$_SESSION["user_id"];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('404! PAGE NOT FOUND'); window.location.href='login.php';</script>";
    exit();
}

if(isset($_POST['change-password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $password = md5($new_password);

    if(!empty($new_password) || !empty($confirm_password)) {

    if($new_password == $confirm_password) {
        $sql = "UPDATE users SET password = '$password' WHERE user_id = $user_id";
        mysqli_query($conn, $sql);
        echo '<script>alert("Password Updated Successfully!")</script>';
    } else {
        echo '<script>alert("Password does not match!")</script>';
    }
}else{
    echo '<script>alert("Password Empty!")</script>';
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="profile_container">
       <?php include "header.php"; ?>
       <h3 class="profile_main_heading">Change Password</h3>
       <div class="change_password_profile_box">

            <form action="changepassword.php"  method="POST">
            <div class="change_password_input_box">

               <label for="" class="profile_label">New Password</label><br>
               <input type="password" name="new_password" class="profile_input_field"><br>

               <label for="" class="profile_label">Confirm New Password</label><br>
               <input type="password" name="confirm_password" class="profile_input_field"><br><br>

               <a href="profile.php" class="Back_profile">Back</a>
               <input type="submit" name="change-password" class="save_password"  value="Change">
            </div>
            </form>

       </div>
    </div>
</body>
</html>