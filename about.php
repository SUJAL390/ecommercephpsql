<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/aboutusprotein.webp" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At FitFuel Nutrition, we offer high-quality protein powders and supplements that are designed to support your fitness goals with clean, research-backed ingredients and great flavors. 
            Our products are made to help you build muscle, boost endurance, and improve overall health. With a range of delicious options, affordable prices, and a focus on sustainability, FitFuel is the reliable choice for your nutrition needs. Plus, our dedicated customer service and fast, free shipping ensure a seamless and satisfying experience every time. Choose FitFuel for premium supplements that help you reach your fitness potential.</p>

         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>"FitFuel is the best one-stop-shop for all your protein needs. Fast delivery, great prices, and a huge selection!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sujal Maharjan</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>"Fantastic store! I found my favorite protein powder at FitFuel, and the customer support was very good ."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>looza maharjan</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p> "FitFuel has an excellent selection of protein powders from top brands. It's my go-to place for everything fitness-related!"</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>srijal maharjan</h3>
      </div>


   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>