<?php
session_start();
require '../config.php';
$select_user=mysqli_query($conn,"Select * from `type`");
mysqli_num_rows($select_user);
$fetch_user=mysqli_fetch_assoc($select_user);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movies page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="add_movie_main_container_body">
    <div class="add_movie_main_container">
        <form action="">
            <h1>Add MOVIES</h1>
            <input type="text" placeholder="Enter Movie Name" name="moviename" required class="inputbox">
            <input type="text" placeholder="Date of release" name="releasedate" required class="inputbox">
            <select name="type" class="inputboxone">
            <?php
            $select_type=mysqli_query($conn,"select * from `type`");
             while($row_type=mysqli_fetch_assoc($select_type)){
                echo "<option value='{$row_type['type_title']}'>{$row_type['type_title']}</option>";
            }
            ?>
        </select>  

        <select name="language" class="inputboxone">
            <?php
            $select_type=mysqli_query($conn,"select * from `language`");
             while($row_type=mysqli_fetch_assoc($select_type)){
                echo "<option value='{$row_type['language_title']}'>{$row_type['language_title']}</option>";
            }
            ?>
        </select>  <br>
            
        
        <?php
        // echo "<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
        // <label for="vehicle1">
        //     $select_type=mysqli_query($conn,"select * from `genre`");
        //      while($row_type=mysqli_fetch_assoc($select_type)){
        //         "<option value='{$row_type['name']}'>{$row_type['name']}</option>";
        //     }
        //     </label><br>";
            ?>

        
        </form>
    </div>
</body>
</html>