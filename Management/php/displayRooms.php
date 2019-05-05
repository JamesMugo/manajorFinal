<?php require('../../classes/database.php');
require('../../classes/functions.php');

if(isset($_POST['propertyID'])){

  $propertyID = $_POST['propertyID'];
  $sql = "SELECT * FROM rooms WHERE rentalstatus='vacant' AND propertyno = '$propertyID'";
    $result = mysqli_query($conn,$sql);
    $menu="";

    while ($row = mysqli_fetch_array($result)) {
       $menu .="<option value = '".$row["propertyno"]."'>".$row['description']." (".$row["price"].")</option>";
    }
    echo $menu; 
      $conn->close();

}
 ?>