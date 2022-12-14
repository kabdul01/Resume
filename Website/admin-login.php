<?php

session_start();

if(isset($_SESSION["username"])){
    header("Location: http://localhost/final/admin-homepage.php");
}

?>

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
    <script src="https://kit.fontawesome.com/ba2108e224.js" crossorigin="anonymous"></script>
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
          
          <h3 class="heading">Admin Login</h3>
           
          <!-- Login Form -->
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="text" id="login"  name="username" placeholder="username">
            <input type="password" id="password"  name="password" minlength="6" placeholder="password"><br>
            <input type="submit"  name="login" value="LOGIN"><br>
            <a href="admin-signup.php">New User? Sign Up</a>
          </form>
       
          <?php
          
           if(isset($_POST['login'])){
            $conn = mysqli_connect("localhost","root","","admin") or die("Connection Failed");

            $username = mysqli_real_escape_string($conn, $_POST['username']);
             $password=md5($_POST['password']);

             $sql="SELECT username,user_id FROM users WHERE username='{$username}' AND password='{$password}'";
             $result=mysqli_query($conn, $sql) or die("query failed");

             if(mysqli_num_rows($result) > 0){
               while($row=mysqli_fetch_assoc($result)){
                 session_start();
                 $_SESSION["username"]=$row['username'];
                 $_SESSION["user_id"]=$row['user_id'];
                 
                 header("Location: http://localhost/final/admin-homepage.php");
               }
             }
             else{
               echo '<div class="alert alert-danger">Username or password incorrect</div>';
             }
           }

          ?>
      
        </div>
      </div>

</body>
</html>