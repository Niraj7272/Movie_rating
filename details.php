<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php include "header.php" ;?>
    
    <form method="post" action="">
    <div class="detail_container">
        <div class="detail_first_box">
             <img src="hovervideos/twoposter.jpeg" height="500px" width="400px" class="detail_image">
        </div>
        <div class="detail_second_box">
            <img src="hovervideos/three.jpg" height="350px" width="800px" alt="">
           <h1>GAme of thorn</h1>
           <hr><br>
           <h3>date: 20986596845</h3><br>
            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi nulla animi quidem eveniet, nihil ea sapiente modi possimus magni consectetur? Voluptatibus delectus adipisci aliquid repudiandae aspernatur in illo porro ab.</span><br><br>
            <button onclick="alert('Login To Continue')" type="submit" class="detail_add-to-watchlist-btn">Add To Watchlist</button>
            <a href="index.php" class="detail_back">Back</a>

        </div>
    </div>
    </form>
    <?php
     include 'footer.php';
    ?>
   
</body>
</html>