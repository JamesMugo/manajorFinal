<?php require('../../classes/database.php');?>
<?php require('../../classes/functions.php');?>
<?php

if(isset($_POST['submit'])){

  $rid = $_POST['rid'];

  $pno = $_POST['pno'];
  $desc = $_POST['desc'];
  $price = $_POST['price'];

      $query="UPDATE rooms SET propertyno='$pno',description='$desc',price='$price' WHERE roomID='$rid'";

      if (mysqli_query($conn, $query)) {
         echo "Update successful";
      } else {
         echo "Error: " . $query . "" . mysqli_error($conn);  
      }
      $conn->close();

}
 ?>