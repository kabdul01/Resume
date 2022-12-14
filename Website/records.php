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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="admin.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Dayspring</title>
    <link rel="icon" type="image/icon" href="images/logo.jpeg">
</head>
<body>
</header>
<header>
    
    <nav class="navbar   home">
      <div class="navbar-brand " href="#">
        <h2 >DAYSPRING  ORPHANAGE</h2>
      </div>
    </nav>
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

<div id="main-content">
    <h2>Volunteer Records</h2>
    <?php
      $conn = mysqli_connect("localhost","root","","index") or die("Connection failed : " . mysqli_connect_error());

      $sql = "SELECT * FROM records";
      $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

      if(mysqli_num_rows($result) > 0)  {
    ?>
    <table class=" table-striped table-bordered" cellpadding="5px">
        <thead class="thead-dark">
        
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Date</th>
        <th>Time</th>
        <th>Operation</th>

        </thead>
        <tbody>
          <?php
            while($row = mysqli_fetch_assoc($result)){
          ?>
            <tr>
                
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['time']; ?></td>
                <td>
                    <a  href="<?php $_SERVER['PHP_SELF'] ?>?del=<?php echo $row['firstname'] ?>" class="btn btn-sm btn-danger">Delete</a>
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
</div>
<!-- js bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>

<!-- delete record  -->
<?php 
include 'config.php';

if(isset($_GET['del'])){
  $fname = $_GET['del']; 
  $query= "DELETE FROM records WHERE firstname='$fname'";
  $result=mysqli_query($conn,$query) or die("not deleted".mysqli-error($conn));
  if($result) echo "";
}
else{
  echo "";
}
?>

