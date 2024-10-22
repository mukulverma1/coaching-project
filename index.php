<?php 
require_once 'connection.php';
// SESSION_START();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    
  <!-- navbar Section start -->
   <?php 
      include ('navbar.php');
   ?>
   <!-- navbar Section end -->



   <!-- slideShow Section start -->
   <?php 
     include('slideShow.php')
   ?>
   <!-- slideShow Section end -->



    <!-- Teacher Card Section Start -->
    <?php 
      include ('pagination.php');
    ?>
    <!-- Teacher Card Section End -->

    <?php
    include ('animated-number-section.php');
    ?>

    <?php
    include ('contactUs.php');
    ?>

    <!-- footer section start -->
    <?php 
      include ('footer.php');
    ?>
   <!-- footer section end -->


</body>
</html>