<?php
session_start();
include 'config.php';
$user_id=$_SESSION["user_id"];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('404! PAGE NOT FOUND'); window.location.href='login.php';</script>";
    exit();
}

$select_user=mysqli_query($conn,"Select * from `users` WHERE user_id='$user_id'");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);
   
if(isset($_POST["upload_image"])){
   $image = $_POST['image'];

   if($_FILES["image"]["error"]=== 4){
       echo
       "<script> alert('Image Does Not Exist'); </script>";
   }else{
       $fileName = $_FILES["image"]["name"];
       $fileSize = $_FILES["image"]["size"];
       $tmpName = $_FILES["image"]["tmp_name"];

       $validImageExtension = ['jpg', 'jpeg', 'png'];
       $imageExtension = explode('.', $fileName);
       $imageExtension = strtolower(end($imageExtension));
       if(!in_array($imageExtension, $validImageExtension)){
           echo
           "<script> alert('Invalid Image Extension'); </script>";
       }
       else if($filesize > 1000000){
           echo
           "<script>alert('Image Size Is Too Large'); </script>";
       }else{
           $newImageName = uniqid();
           $newImageName .= '.' . $imageExtension;

           move_uploaded_file($tmpName, 'admin/profile/'. $newImageName);
           $sql = "UPDATE users SET profile_image= '$newImageName' WHERE user_id = $user_id";
    mysqli_query($conn, $sql);
    header("Location:profile.php");
          
       }
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
       <h3 class="profile_main_heading">MY PROFILE</h3>
       <div class="profile_box">
          <div class="profile_box_one">
             <h3 class="profile_heading">Basic info</h3>
            <div class="profile_input_box">

               <span class="information">Full Name:</span>
               <span class="information_answer"><?php echo $fetch_user['full_name']?></span><br><br>
               <span class="information">Email:</span>
               <span class="information_answer"><?php echo $fetch_user['email']?></span><br><br>
               <span class="information">Phone No:</span>
               <span class="information_answer"><?php echo $fetch_user['phone_number']?></span><br><br>
               <!-- <span class="information">User Type:</span>
               <span class="information_answer"> Admin</span><br><br><br> -->

               <a href="changepassword.php" class="profile_change_password">Change Password</a>
               <a href="edit_profile.php" class="Edit_profile">Edit Profile</a>
            </div>
          </div>
          <div class="profile_box_two">
            <a href="watchlist.php" class="profile_my_orders">My Watchlist</a>
            <div class="profile_image">
                <h3 class="profile_pic_heading">Profile Pic</h3>
                <img src="admin/profile/<?php echo $fetch_user['profile_image']?>" width="200" height="200" alt="" >
                <form action="" method="post" enctype="multipart/form-data">
                <input name="image" class="profile-upload" type="file"><br><br>
                <button name="upload_image" class="upload_profile">Upload Profile</button>
                </form>
            </div>
          </div>
       </div>
    </div>