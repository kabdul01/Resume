<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- stylesheet -->
    <link rel="stylesheet" href="admin.css">

    <!--fontawesome-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="admin.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Dayspring</title>
    <link rel="icon" type="image/icon" href="images/logo.jpeg">
</head>
<body>
    
    <header>
    
    <nav class="navbar   home">
      <div class="navbar-brand " href="#">
        <h2 >DAYSPRING  ORPHANAGE</h2>
      </div>
    </nav>
    
    </header>

    
    <div class="wrapper">
        <div id="formContent">
          
          <h3 class="heading">Admin Sign Up</h3>
           
          <!-- Login Form -->
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" id="login"  name="firstname" placeholder="firstname">
            <input type="text" id="login"  name="lastname" placeholder="lastname">
            <input type="text" id="login"  name="email" placeholder="email">
            <input type="text" id="login"  name="username" placeholder="username">
            <input type="password" id="password"  name="password" minlength="6" placeholder="password">
            <input type="submit"  name="signup" value="Sign Up">
          </form>

          <?php

if(isset($_POST['signup'])){
  $conn = mysqli_connect("localhost","root","","admin") or die("Connection Failed");

  $fname =mysqli_real_escape_string($conn,$_POST['firstname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lastname']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $user = mysqli_real_escape_string($conn,$_POST['username']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  

  $sql = "SELECT username FROM users WHERE username = '{$user}'";

  $result = mysqli_query($conn, $sql) or die("Query Failed.");

  if(mysqli_num_rows($result) > 0){
    echo '<div class="alert alert-danger">username already exists</div>';
  }else{
    $sql1 = "INSERT INTO users (first_name,last_name, email, username, password)
              VALUES ('{$fname}','{$lname}','{$email}','{$user}','$password')";
    if(mysqli_query($conn,$sql1) or die("couldnt load")){
      header("Location: http://localhost/final/admin-login.php");
    }else{
      echo '<div class="alert alert-danger">Could not add user</div>';
    }
  }
}
?>
        </div>
    </div>

</body>
</html>

