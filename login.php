<?php
include 'configuration.php';
session_start();

if(isset($_POST['submit'])){

$email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
//checking if reqistration has been done
   $select_users = mysqli_query($conn, "SELECT * FROM `users`
    WHERE email = '$email' AND password = '$pass'") 
    or die('query failed');

    //
    if(mysqli_num_rows($select_users) > 0){

        $row = mysqli_fetch_assoc($select_users);
        if($row['email'] == 'email'){

            $_SESSION['first_name'] = $row['na'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
   
         }
   
      }else{
         $message[] = 'incorrect email or password!';
      }
   
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<!-- header section starts  -->

<section class="header">

   <a href="home.php" class="logo">OLIVIA</a>

   <nav class="navbar">
      <a href="home.php">HOME</a>
      <a href="about.php">ABOUT</a>
      <a href="package.php">PACKAGES</a>
      <a href="book.php">BOOK</a>
      <a href="login.php"> <i class="fas fa-user" id="login-btn"></i></a>
   </nav>

   <div id="menu-btn" class="fas fa-bars"></div>

</section>

<!-- header section ends -->
<div class="login-form-container">
<i class="fas fa-times" id="login-Close"></i>


   <form action="" method="post">
      <h3>login now</h3>
      <input type="email" name="email" placeholder="enter your email" required class="box">
      <input type="password" name="password" placeholder="enter your password" required class="box">
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</div>
<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
