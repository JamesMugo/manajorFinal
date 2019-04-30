<?php require('../../classes/database.php');?>
<?php require('../../classes/functions.php');


//if form has been submitted process it
if(isset($_GET['roomID'])){

  $idToRemove = $_GET['propertyno'];

      $query="DELETE FROM rooms WHERE roomID = '$idToRemove'";

      if (mysqli_query($conn, $query)) {
         header('Location: ../dashboard.php');
      } else {
         echo "Error: " . $query . "" . mysqli_error($conn);  
      }
      $conn->close();

}
?>