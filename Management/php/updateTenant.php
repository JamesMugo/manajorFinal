<?php require('../../classes/database.php');?>
<?php require('../../classes/functions.php');?>
<?php

if(isset($_POST['submit'])){

  $tenid = $_POST['tenid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $identity = $_POST['identity'];
  $contacts = $_POST['contacts'];
  $propertyno = $_POST['propertyno'];
  $hseno = $_POST['hseno'];
  $payment_status = $_POST['payment_status'];

      $query="UPDATE tenants SET firstname='$firstname',lastname='$lastname',nationalid='$identity',contacts='$contacts',propertyno='$propertyno', houseno='$hseno', payment_status='$payment_status' WHERE id='$tenid'";

      if (mysqli_query($conn, $query)) {
         echo "Update successful";
      } else {
         echo "Error: " . $query . "" . mysqli_error($conn);  
      }
      $conn->close();

}
 ?>