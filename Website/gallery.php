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
    <title>Dayspring</title>
    <link rel="icon" type="image/icon" href="images/logo.jpeg">
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

<div id="content">
<h2 >Gallery</h2>
<div  class="form-group text-center">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    </div class="input-group ms-auto">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="file" name="image">
        <input type="submit" value="Upload Image" name="submit" >
    </div>    
    </form>
</div>

<?php
      $conn = mysqli_connect("localhost","root","","index") or die("Connection failed : " . mysqli_connect_error());

      $sql = "SELECT * FROM gallery";
      $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

      if(mysqli_num_rows($result) > 0)  {
    ?>
    <table class=" table-striped table-bordered" cellpadding="5px">
        <thead class="thead-dark">
        
        <th>File Name</th>
        <th>Image</th>
        <th>Operation</th>

        </thead>
        <tbody>
          <?php
            while($row = mysqli_fetch_assoc($result)){
          ?>
            <tr>
                
                <td><?php echo $row['source']; ?></td>
                <td><?php echo "<a href='$row[source]'><img src='".$row['source']."' width='100' height='100'  style=' padding: 10px;' /> "; ?></td>
                <td>
                    <a  href="<?php $_SERVER['PHP_SELF'] ?>?del=<?php echo $row['source'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            
            <?php  } ?>
        </tbody>
    </table>
  <?php 
    
      }else{
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

<?php

$conn = mysqli_connect("localhost","root","","index") or die("Connection failed : " . mysqli_connect_error());


if(isset($_FILES['image'])){
    

    $file_name=$_FILES['image']['name'];
    $file_size=$_FILES['image']['size'];
    $file_tmp=$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $folder="gallery/".$file_name;

    if(move_uploaded_file($file_tmp, $folder)){
        $query="INSERT INTO gallery VALUES('$folder')";
        $data=mysqli_query($conn,$query);
    }else{
        echo "Couldn't upload the file.";
    }

}


?>

<!-- delete image  -->
<?php 
include 'config.php';
error_reporting(0);
if(isset($_GET['del'])){
  $source = $_GET['del']; 
  $query= "DELETE FROM gallery WHERE source='$source'";
  $result=mysqli_query($conn,$query) or die("not deleted".mysqli-error($conn));
  if($result) echo "";
}
else{
  echo "";
}
?>
