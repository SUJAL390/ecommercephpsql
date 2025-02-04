<?php 
include 'config.php';

if(isset($_POST['submit'])){
   // Escape text inputs
   $name      = mysqli_real_escape_string($conn, $_POST['name']);
   $email     = mysqli_real_escape_string($conn, $_POST['email']);
   $pass      = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass     = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   // Handle image upload (compulsory)
   $image      = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp  = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   // Check if user already exists
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   } else {
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      } else {
         // Check image size (optional, here max 2MB)
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         } else {
            // Move the uploaded image to the folder
            move_uploaded_file($image_tmp, $image_folder);
            // Insert new user with image name into the database
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type, img) VALUES('$name', '$email', '$cpass', '$user_type', '$image')") or die('query failed');
            $message[] = 'registered successfully!';
            header('location:login.php');
            exit;
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <?php
   if(isset($message)){
      foreach($message as $msg){
         echo '
         <div class="message">
            <span>'.$msg.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
   ?>
   
   <div class="form-container">
      <!-- Note the enctype for file uploads -->
      <form action="" method="post" enctype="multipart/form-data">
         <h3>Register Now</h3>
         <input type="text" name="name" placeholder="Enter your name" required class="box">
         <input type="email" name="email" placeholder="Enter your email" required class="box">
         <input type="password" name="password" placeholder="Enter your password" required class="box">
         <input type="password" name="cpassword" placeholder="Confirm your password" required class="box">
         <select name="user_type" class="box">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
         <!-- Image upload field (required) -->
         <input type="file" name="image" accept="image/*" required class="box">
         <input type="submit" name="submit" value="Register Now" class="btn">
         <p>Already have an account? <a href="login.php">Login now</a></p>
      </form>
   </div>
</body>
</html>
