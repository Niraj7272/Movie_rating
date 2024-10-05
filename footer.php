<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="footer_mainbox">
        <div class="footer_firstbox">
            <?php
                if(isset($_SESSION['email'])){
                    echo '';
                }else{
                    echo '<a href="login.php">Sign in for more access</a>';
                }
            ?>
            
        </div>
        <div class="footer_secondbox">
            2024 Copyright © Rating Pro.@Niraj Chaudhary & @Ankit Tamang.
        </div>
        
    </div>
</body>
</html>