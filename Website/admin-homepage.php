<?php

session_start();

if(!isset($_SESSION["username"])){
    header("Location: http://localhost/final/admin-login.php");
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
    <title>Homepage</title>
    <link rel="icon" type="image/icon" href="images/logo.jpeg">
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

    <div class="navbar navbar-expand-lg bar">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
       <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="admin-homepage.php">Admins</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="records.php">Volunteer Records</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="gallery.php">Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="admin-signup.php">Add Admin</a>
                  </li>
                </ul>
      <div class="navbar-brand ms-auto">
        <a href="logout.php">Log Out</a>
      </div>
    </div>
    <div id="content">
      <h2 >Admins</h2>
      <?php
      $conn = mysqli_connect("localhost","root","","admin") or die("Connection failed : " . mysqli_connect_error());

      $sql = "SELECT * FROM users";
      $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

      if(mysqli_num_rows($result) > 0)  {
    ?>
    <table class=" table-striped table-bordered" cellpadding="5px">
        <thead class="thead-dark">
        
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>User Name</th>
        <th>Operation</th>

        </thead>
        <tbody>
          <?php
            while($row = mysqli_fetch_assoc($result)){
          ?>
            <tr>
                
                <td><?php echo $row['first_name']; ?></td>
                <td><?php echo $row['last_name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td>
                    <a  href="<?php $_SERVER['PHP_SELF'] ?>?del=<?php echo $row['username'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
          <?php } ?>
        </tbody>
    </table>
  <?php }else{
    echo "<h2>No Record Found</h2>";
  }
  mysqli_close($conn);
  ?>
      
    </div>

     <!-- js bootstrap-->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>

<!-- delete admin  -->
<?php 
$conn = mysqli_connect("localhost","root","","admin") or die("Connection Failed");

if(isset($_GET['del'])){
  $uname = $_GET['del']; 
  $query= "DELETE FROM users WHERE username='$uname'";
  $result=mysqli_query($conn,$query) or die("not deleted".mysqli-error($conn));
  if($result) echo "";
}
else{
  echo "";
}
?>
