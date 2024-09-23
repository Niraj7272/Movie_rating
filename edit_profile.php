<?php
session_start();
include "config.php";
$user_id=$_SESSION["user_id"];

$select_user=mysqli_query($conn,"Select * from `users` WHERE user_id='$user_id'");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);


if(isset($_POST['edit-profile'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "UPDATE users SET full_name = '$full_name', email = '$email', phone_number = '$phone_number' WHERE user_id = $user_id";
    mysqli_query($conn, $sql);
    echo '<script>alert("Profile Updated Successfully!")</script>';
   
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
       <h3 class="profile_main_heading">Edit Profile</h3>
       <div class="change_password_profile_box">
            <form action="./edit_profile.php"  method="POST">
            <div class="edit_profile_input_box">
               <label for="" class="profile_label">Full Name</label><br>
               <input type="text" name="full_name" value="<?php echo $fetch_user['full_name']?>" class="profile_input_field"><br>

               <label for="" class="profile_label">Email</label><br>
               <input type="email" name="email" value="<?php echo $fetch_user['email']?>" class="profile_input_field"><br>

               <label for="" class="profile_label">Phone No</label><br>
               <input type="number" name="phone_number" value="<?php echo $fetch_user['phone_number']?>" class="profile_input_field"><br><br>

               <a href="profile.php" class="Back_profile">Back</a>
               <button type="submit" name="edit-profile"  class="save_password">Update</button>
            </div>
            </form>

       </div>
    </div>
</body>
</html>