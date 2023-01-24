<?php

include 'configuration.php';

if(isset($_POST['submit'])){
    //creating variables that recieves data from the user


   $firstname = mysqli_real_escape_string($conn, $_POST['first_name']);
   $secondname = mysqli_real_escape_string($conn, $_POST['second_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $country = mysqli_real_escape_string($conn, $_POST['country']);

   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['password2']));

   //to the database
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

//to authenicate the data recieved
if(mysqli_num_rows($select_users) > 0){
    //to check if there is a user like that that already exists
    $message[] = 'whoops! your account already exists!';
 }else{
     //to check if the password match
    if($pass != $cpass){
        //a message to reconfrim if the two passwords match
       $message[] = 'confirm password not matched!';
    }else{
        //insertion of the data to the database
       mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
       $message[] = 'registered successfully!';
       header('location:login.php');
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
   <title>ACCOUNT REGISTRATION</title>
   
   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
//messages verification
if(isset($message)){
    foreach($message as $message){
       echo '
       <div class="mymessage">
          <span>'.$message.'</span>
          <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
       </div>
       ';
    }
 }
 ?>
 <section class="header">

<a href="home.php" class="logo">OLIVIA</a>

<nav class="navbar">
   <a href="home.php">HOME</a>
   <a href="about.php">ABOUT</a>
   <a href="package.php">PACKAGES</a>
   <a href="book.php">BOOK</a>
   c
</nav>

<div id="menu-btn" class="fas fa-bars"></div>

</section>
<div class="registration-form-container">

<i class="fas fa-times" id="register-Close"></i>

<form id="register" action="" method="post">
    <div id="result"></div>
    <h3>register your account here</h3>
    <input type="text" name="first_name" class="box" placeholder="enter your first name">
    <input type="text" name="second_name" class="box" placeholder="enter your last name">
    <input type="email" name="email" class="box" placeholder="enter your email">
    <input type="text" name="country" class="box" placeholder="enter your country">
    <input type="password" name="password" class="box" placeholder="enter your password">
    <input type="password" name="password1" class="box" placeholder="confirm your password">
    <input type="submit" value="register now" class="btn">
    <p>already have an account? <a href="login.php">login now</a></p>

    <p>welcome to <b>OLIVIA</b> <I>achieve your dreams</I></p>  
</form>



</div>
<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

