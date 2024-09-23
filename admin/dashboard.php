<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashbord design</title>
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/akar-icons-fonts/1.1.20/css/akar-icons.css">
    
</head>
<body>
    <div class="sidebar">
        <div class="logo"><h4>MOVIE Rating</h4></div>
        <ul class="menu">
           <li class="active">
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
            <a href="movies_table.php">
            <!-- <i class="fa-solid fa-gift"></i> -->
            <i><img src="../admin/icons/movies.png" class="side-icon"></i>
                <span>Movies</span>
            </a>
           </li>
           <li>
            <a href="users_table.php">
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
           <li>
            <a href="language_table.php">
            <!-- <i class="fa-sharp fa-solid fa-cart-plus"></i> -->
            <i><img src="../admin/icons/addlanguage.png" class="side-icon"></i>
                <span>Add Language</span>
            </a>
           </li>
           <li>
            <a href="type_table.php">
            <!-- <i class="fa-sharp fa-solid fa-cart-plus"></i> -->
            <i><img src="../admin/icons/addtype.png" class="side-icon"></i>
                <span>Add Type</span>
            </a>
           </li>
           
           <li class="logout">
            <?php
               if(isset($_SESSION['user_type'])){
             echo'<a href="../logout.php" onclick="return confirm(\'You Are Sure You Want To Logout?\');">
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
        <?php include "header.php" ?>
        <!-- card-container -->
        <div class="card-container">
        <h3 class="main-title">Today data</h3>
        <div class="card-wrapper">
            <div class="payment-card light-red">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Total Users</span>
                        <span class="amount-value">
                         <?php
                          $select_users=mysqli_query($conn,"select * from `users`")or die('query failed');
                          $row_count=mysqli_num_rows($select_users);
                          echo $row_count ;
                         ?>
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-users icon"></i> -->
                    <img src="../admin/icons/users.png" class="icon">
                </div>
                
            </div>

            <div class="payment-card light-purple">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Total Movies</span>
                        <span class="amount-value">
                        <?php
                          $select_movies=mysqli_query($conn,"select * from `movies`")or die('query failed');
                          $row_count=mysqli_num_rows($select_movies);
                          echo $row_count ;
                         ?>
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-gift icon dark-purple"></i> -->
                    <img src="../admin/icons/film.png" class="icon dark-purple">
                </div>
                
            </div>

            <div class="payment-card light-green">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Total Series</span>
                        <span class="amount-value">
                        0
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-truck icon dark-green"></i> -->
                    <img src="../admin/icons/movie.png" class="icon dark-green">
                </div>
                
            </div>

            <div class="payment-card light-blue">
                <div class="card-header">
                    <div class="amount">
                        <span class="title">Genre</span>
                        <span class="amount-value">
                        <?php
                          $select_genre=mysqli_query($conn,"select * from `genres`")or die('query failed');
                          $row_count=mysqli_num_rows($select_genre);
                          echo $row_count ;
                         ?>  
                        </span>
                    </div>
                    <!-- <i class="fa-solid fa-chart-line icon dark-blue"></i> -->
                    <img src="../admin/icons/addgenre.png" class="icon dark-blue">
                </div>
                
            </div>
        </div>
    </div>

    <div class="tabular-wrapper">
        <h3 class="main-title">Available User</h3>
        <div class="table-container">

        <?php
          $i = 1;
          $rows = mysqli_query($conn, "SELECT *FROM users");
          if(mysqli_num_rows($rows)>0){

           echo' <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone No</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>';
                ?>
                <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["user_id"]; ?></td>
            <td><?php echo $row["full_name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["phone_number"]; ?></td>
            <td><?php echo $row["created_at"]; ?></td>
        </tr>
          <?php 
          endforeach; 
        }
          else{
            echo"<div class='empty_text'>No User Available</div>";
          }
          ?>
            </table>
        </div>
    </div>
    </div>
</body>
</html>