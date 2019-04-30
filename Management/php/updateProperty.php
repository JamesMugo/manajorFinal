<?php require('../../classes/database.php');?>
<?php require('../../classes/functions.php');?>
<?php

if(isset($_POST['submit'])){

  $propid = $_POST['propid'];

  $ownersid = $_POST['ownersid'];
  $description = $_POST['description'];
  $capacity = $_POST['capacity'];
  $location = $_POST['location'];

      $query="UPDATE property SET ownerid='$ownersid', description='$description',capacity='$capacity',location='$location' WHERE propertyno='$propid'";
      echo $query;

      if (mysqli_query($conn, $query)) {
         echo "Update successful";
      } else {
         echo "Error: " . $query . "" . mysqli_error($conn);  
      }
      $conn->close();

}
 ?>