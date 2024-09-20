<?php
error_reporting(0);
session_start();
include "../config.php";
$user_id=$_SESSION["user_id"];

$select_user=mysqli_query($conn,"Select * from `users` WHERE user_id='$user_id'");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);
   
?>

<div class="header-wrapper">
            <div class="header-title">
                <span>Admin</span>
                <h2>Dashboard</h2>
            </div>
            <div class="user-info">
                <a href="../profile.php"><img src="../admin/profile/<?php echo $fetch_user['profile_image']?>" alt=""></a>
            <select onchange="location = this.value;">
                <option value="../profile.php">profile</option>
                <option value="../index.php">Home</option>
                <option value="../logout.php" onclick="return confirm('You Are Sure You Want To Logout?');">Logout</option>
            </select>

            </div>
        </div>