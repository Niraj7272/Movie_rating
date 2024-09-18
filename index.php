<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php
        include 'header.php';
    ?>
    <div class="home_mainbox">
        <div class="home_box">
            <div class="home_firstbox">
                <img src="hovervideos/three.jpg" alt="" id="slideimage">
            </div>
            <script>
        function first(){
            document.getElementById("slideimage").src="hovervideos/oneposter.jpeg";
        }
        function second(){
            document.getElementById("slideimage").src="hovervideos/twoposter.jpeg";
        }
        function third(){
            document.getElementById("slideimage").src="hovervideos/threeposter.jpeg";
        }
        function fourth(){
            document.getElementById("slideimage").src="hovervideos/fourposter.jpeg";
        }
        function fifth(){
            document.getElementById("slideimage").src="hovervideos/three.jpg";
        }
        setInterval(first,4000);
        setInterval(second,8000);
        setInterval(third,12000);
        setInterval(fourth,16000);
        setInterval(fifth,20000);
    
    </script>
            <div class="home_second">
                 <h1 class="up_next">Up Next</h1>
                 <div class="home_second-box">
                    <img src="hovervideos/oneposter.jpeg" width="40%" alt="" id="slideimages"><br>
                    <img src="hovervideos/twoposter.jpeg" width="40%" alt="" id="slideimages2"><br>
                    <img src="hovervideos/threeposter.jpeg" width="40%" alt="" id="slideimages3"><br>
                    <img src="hovervideos/fourposter.jpeg" width="40%" alt="" id="slideimages3">
                 </div>
                 <script>
        function first(){
            document.getElementById("slideimages").src="hovervideos/twoposter.jpeg";
        }
        function second(){
            document.getElementById("slideimages").src="hovervideos/threeposter.jpeg";
        }
        function third(){
            document.getElementById("slideimages").src="hovervideos/fourposter.jpeg";
        }
        function fourth(){
            document.getElementById("slideimages").src="hovervideos/three.jpg";
        }
        function fifth(){
            document.getElementById("slideimages").src="hovervideos/oneposter.jpeg";
        }
        setInterval(first,4000);
        setInterval(second,8000);
        setInterval(third,12000);
        setInterval(fourth,16000);
        setInterval(fifth,20000);
    
    </script>
    <script>
        function first(){
            document.getElementById("slideimages2").src="hovervideos/threeposter.jpeg";
        }
        function second(){
            document.getElementById("slideimages2").src="hovervideos/fourposter.jpeg";
        }
        function third(){
            document.getElementById("slideimages2").src="hovervideos/three.jpg";
        }
        function fourth(){
            document.getElementById("slideimages2").src="hovervideos/oneposter.jpeg";
        }
        function fifth(){
            document.getElementById("slideimages2").src="hovervideos/twoposter.jpeg";
        }
        setInterval(first,4000);
        setInterval(second,8000);
        setInterval(third,12000);
        setInterval(fourth,16000);
        setInterval(fifth,20000);
    
    </script>
    <script>
        function first(){
            document.getElementById("slideimages3").src="hovervideos/fourposter.jpeg";
        }
        function second(){
            document.getElementById("slideimages3").src="hovervideos/three.jpg";
        }
        function third(){
            document.getElementById("slideimages3").src="hovervideos/oneposter.jpeg";
        }
        function fourth(){
            document.getElementById("slideimages3").src="hovervideos/twoposter.jpeg";
        }
        function fifth(){
            document.getElementById("slideimages3").src="hovervideos/threeposter.jpeg";
        }
        setInterval(first,4000);
        setInterval(second,8000);
        setInterval(third,12000);
        setInterval(fourth,16000);
        setInterval(fifth,20000);
    
    </script>
    <script>
        function first(){
            document.getElementById("slideimages3").src="hovervideos/three.jpg";
        }
        function second(){
            document.getElementById("slideimages3").src="hovervideos/oneposter.jpeg";
        }
        function third(){
            document.getElementById("slideimages3").src="hovervideos/twoposter.jpeg";
        }
        function fourth(){
            document.getElementById("slideimages3").src="hovervideos/threeposter.jpeg";
        }
        function fifth(){
            document.getElementById("slideimages3").src="hovervideos/fourposter.jpeg";
        }
        setInterval(first,4000);
        setInterval(second,8000);
        setInterval(third,12000);
        setInterval(fourth,16000);
        setInterval(fifth,20000);
    
    </script>
    
    
    
            </div>
        </div>
    </div>
    <?php
        include 'newtailer.php';
    ?>
    <?php
        include 'toprating.php';
    ?>
    <?php
        include 'mostpopular.php';
    ?>
    <?php
        include 'footer.php';
    ?>
</body>
</html>