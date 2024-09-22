<?php
include '../config.php';
session_start();
$user_id=$_SESSION["user_id"];

$select_user=mysqli_query($conn,"Select * from `users` WHERE user_id='$user_id'");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addusers Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<div class="sidebar">
        <div class="logo"><h4>Movie Rating</h4></div>
        <ul class="menu">
        <li>
            <a href="dashboard.php">
                <!-- <i class="fas fa-tachometer-alt"></i> -->
                <i><img src="../admin/icons/dashboard.png" class="side-icon"></i>
                <span>Dashboard</span>
            </a>
           </li>
           <li>
            <a href="../profile.php">
                <!-- <i class="fas fa-user"></i> -->
                <i><img src="../admin/icons/profile.png" class="side-icon"></i>
                <span>Profile</span>
            </a>
           </li>
           <li>
            <a href="../movies.php">
            <!-- <i class="fa-solid fa-gift"></i> -->
            <i><img src="../admin/icons/movies.png" class="side-icon"></i>
                <span>Movies</span>
            </a>
           </li>
           <li>
            <a href="userstable.php">
            <!-- <i class="fa-solid fa-user-plus"></i> -->
            <i><img src="../admin/icons/add-user.png" class="side-icon"></i>
                <span>Users</span>
            </a>
           </li>
           <li>
            <a href="genre_table.php">
            <!-- <i class="fa-solid fa-truck"></i> -->
            <i><img src="../admin/icons/addgenre.png" class="side-icon"></i>
                <span>Add Genre</span>
            </a>
           </li>
           <li class="active">
            <a href="language_table.php">
            <!-- <i class="fa-sharp fa-solid fa-cart-plus"></i> -->
            <i><img src="../admin/icons/addlanguage.png" class="side-icon"></i>
                <span>Add Language</span>
            </a>
           </li>
           <li>
            <a href="add_type.php">
            <!-- <i class="fa-sharp fa-solid fa-cart-plus"></i> -->
            <i><img src="../admin/icons/addtype.png" class="side-icon"></i>
                <span>Add Type</span>
            </a>
           </li>
           
           <li class="logout">
            <?php
               if(isset($_SESSION['user_type'])){
             echo'<a href="logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');">
             <i><img src="../admin/icons/log-out.png" class="side-icon"></i>
                <span>Logout</span>
            </a>';
               }
            ?>
           </li>
        </ul>
    </div>
<!-- main body section -->
    <div class="main-content">
        <div class="header-wrapper">
            <div class="header-title">
                <h2>Language</h2>
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

        <div class="tabular-wrapper">
        <h3 class="main-title">Language List</h3>
        <a href="add_language.php" class="add-admin-btn">Add Language</a>
        <div class="table-container">

        <?php
          $i = 1;
          $rows = mysqli_query($conn, "SELECT * FROM language");
          if(mysqli_num_rows($rows)>0){

           echo' <table>
                <thead>
                    <tr>
                        <th>SI No</th>
                        <th>Language Title</th>
                        <th>Action</th>
                    </tr>
                </thead>';
                ?>
                <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["language_title"]; ?></td>
            <td>
                <a href="category_delete.php?delete=<?php echo $row['language_id']?>" 
                class="delete_product_btn" onclick="return confirm('Are you sure you want to delete');">
                <i class="fas fa-trash"></i></a>

            </td>
        </tr>
          <?php 
          endforeach; 
        }
          else{
            echo"<div class='empty_text'>No Language Available</div>";
          }
          ?>
            </table>
        </div>
    </div>
</div>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
</body>
</html>