<?php
include '../config.php';
session_start();
?>
<?php
if(isset($_POST['add_movie_genre'])){
    $name = $_POST['name'];

    $insert = "INSERT INTO genres(genre_name) VALUES('$name')";

    mysqli_query($conn, $insert);
    header('location:login.php');
} else {
    echo " ";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Genre</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="addmovietype_container_body">
    <div class="addmovietype_container">
        <form action="" method="post">
         <h1 class="addmovietype_heading">Add Movies Genre</h1>
         <input type="text" name="name" placeholder="Enter Movie Genre" class="addmovietype_inputbox" required ><br>
         <input type="submit" class="addmovietype_btn" value="Add Genre" name="add_movie_genre" >
        <a href="genre_table.php" class="addmovietype_cancel_btn">Cancel</a>
        </form>
    </div>
</body>
</html>