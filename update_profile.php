<?php  
include 'config.php'; // Adjust the path as needed
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve the current user data from the "users" table.
$select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
if (mysqli_num_rows($select) > 0) {
    $row = mysqli_fetch_assoc($select);
    $current_hashed_password = $row['password']; // Fetch hashed password properly
} else {
    die("User not found.");
}

if (isset($_POST['update_profile'])) {
    $alert = [];

    // Update Name and Email
    $update_name  = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($conn, $_POST['update_email']);
    
    if ($update_name !== $row['name']) {
        $update_nm = mysqli_query($conn, "UPDATE `users` SET name = '$update_name' WHERE id = '$user_id'");
        if ($update_nm) {
            $alert[] = "Name update successful!";
            $_SESSION['user_name'] = $update_name;
        } else {
            $alert[] = "Name update failed: " . mysqli_error($conn);
        }
    }
    
    if ($update_email !== $row['email']) {
        if (filter_var($update_email, FILTER_VALIDATE_EMAIL)) {
            $update_em = mysqli_query($conn, "UPDATE `users` SET email = '$update_email' WHERE id = '$user_id'");
            if ($update_em) {
                $alert[] = "Email update successful!";
                $_SESSION['user_email'] = $update_email;
            } else {
                $alert[] = "Email update failed: " . mysqli_error($conn);
            }
        } else {
            $alert[] = "$update_email is not a valid email!";
        }
    }
    
    // Update Profile Image (if a new image is selected)
    $image      = $_FILES['update_image']['name'];
    $image_size = $_FILES['update_image']['size'];
    $image_tmp  = $_FILES['update_image']['tmp_name'];
    if (!empty($image)) {
        $image_folder = 'uploaded_img/'.$image;
        if ($image_size > 2000000) {
            $alert[] = "Image size is too large!";
        } else {
            $update_img = mysqli_query($conn, "UPDATE `users` SET img = '$image' WHERE id = '$user_id'");
            if ($update_img) {
                move_uploaded_file($image_tmp, $image_folder);
                $alert[] = "Image update successful!";
            } else {
                $alert[] = "Image update failed: " . mysqli_error($conn);
            }
        }
    }
    
    // // Update Password
    // $old_pass     = mysqli_real_escape_string($conn, $_POST['old_pass']);
    // $new_pass     = mysqli_real_escape_string($conn, $_POST['new_pass']);
    // $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_pass']);
    
    // if (!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass)) {
    //     // Verify the old password correctly
    //     if (!password_verify($old_pass, $current_hashed_password)) {
    //         $alert[] = "Old password does not match!";
    //     } elseif ($new_pass !== $confirm_pass) {
    //         $alert[] = "New password and confirm password do not match!";
    //     } else {
    //         // Hash the new password
    //         $new_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
    //         $update_pass = mysqli_query($conn, "UPDATE `users` SET password = '$new_hashed' WHERE id = '$user_id'");
    //         if ($update_pass) {
    //             $alert[] = "Password update successful!";
    //         } else {
    //             $alert[] = "Password update failed: " . mysqli_error($conn);
    //         }
    //     }
    // }
    
    // Refresh user data after updates
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'");
    if (mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>
   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <?php 
        if (isset($alert)) {
            foreach ($alert as $msg) {
                echo '<div class="alert">'.$msg.'</div>';
            }
        }
    ?>

    <div class="update-profile">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Show the current image -->
            <img src="uploaded_img/<?php echo $row['img']; ?>" alt="Profile Image">
            <div class="flex">
                <div class="inputBox">
                    <span>Username :</span>
                    <input type="text" name="update_name" value="<?php echo $row['name']; ?>" class="box">
                    
                    <span>Your Email :</span>
                    <input type="email" name="update_email" value="<?php echo $row['email']; ?>" class="box">
                    
                    <span>Update Your Pic :</span>
                    <input type="file" name="update_image" accept="image/*" class="box">
                </div>
                <!-- <div class="inputBox">
                    <span>Old Password :</span>
                    <input type="password" name="old_pass" class="box">
                    
                    <span>New Password :</span>
                    <input type="password" name="new_pass" class="box">
                    
                    <span>Confirm Password :</span>
                    <input type="password" name="confirm_pass" class="box">
                </div> -->
            </div>
            <div class="flex btns">
                <input type="submit" value="Update Profile" name="update_profile" class="btn">
                <a href="home.php" class="delete-btn">Go Back</a>
                <a href="login.php" class="delete-btn">Logout</a>
            </div>
            
        </form>
    </div>
</body>
</html>
