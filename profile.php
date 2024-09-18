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
       <h3 class="profile_main_heading">MY PROFILE</h3>
       <div class="profile_box">
          <div class="profile_box_one">
             <h3 class="profile_heading">Basic info</h3>
            <div class="profile_input_box">

               <span class="information">Full Name:</span>
               <span class="information_answer">Nir</span><br><br>
               <span class="information">Email:</span>
               <span class="information_answer">nc72723@gmail.com</span><br><br>
               <span class="information">Address:</span>
               <span class="information_answer">Duhabi</span><br><br>
               <!-- <span class="information">User Type:</span>
               <span class="information_answer"> Admin</span><br><br><br> -->

               <a href="changepassword.php" class="profile_change_password">Change Password</a>
               <a href="edit_profile.php" class="Edit_profile">Edit Profile</a>
            </div>
          </div>
          <div class="profile_box_two">
            <a href="my_order.php" class="profile_my_orders">My Orders</a>
            <div class="profile_image">
                <h3 class="profile_pic_heading">Profile Pic</h3>
                <img src="img/user_image/<?php echo $fetch_user['user_image']?>" width="200" height="200" alt="" >
                <form action="" method="post" enctype="multipart/form-data">
                <input name="image" class="profile-upload" type="file"><br><br>
                <button name="upload_image" class="upload_profile">Upload Profile</button>
                </form>
            </div>
          </div>
       </div>
    </div>