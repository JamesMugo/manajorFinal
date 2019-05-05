<?php 
session_start();
require('database.php');


if(isset($_POST['register'])){
	registerUsers();
}

if (isset($_POST['addroom'])) {
	$propertyno = $_POST['propertyno'];
	$description = $_POST['description'];
	$price = $_POST['price'];

	if(isset($_SESSION["staffID"])){
	  $logged_in_user_id = $_SESSION["staffID"];

	  $query="INSERT INTO rooms(staffID, propertyno, description, price) VALUES ('$logged_in_user_id','$propertyno','$description','$price')";

	    if (mysqli_query($conn, $query)) {
	       echo "Room added successfully";
	    } else {
	       echo "Error: " . $query . "" . mysqli_error($conn);  
	    }
	    $conn->close();
	  }else{
	    if(headers_sent()){
	        die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
	      } else{
	        exit(header("location: login.php"));
	      }
	  }
}

//adding the property owners
if (isset($_POST['addowners'])) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$idNumber = $_POST['id'];
	$propertyOwned = $_POST['propertyOwned'];
	$location = $_POST['location'];
	$number_of_rooms = $_POST['number_of_rooms'];
  //$agreement = $_POST['agreement'];

                  //validate image
      //validate image
    if (isset($_FILES['agreement']) && !empty($_FILES["agreement"]['tmp_name'])) {

      $prod_image = saveToSever("agreement");
      if($prod_image != false){
        $prod_img = $prod_image;
          $ok = true; 
      } else{
        echo "couldnt upload to server";
      }
      //$prod_img = $_POST['prod_img'];
      
    }

  if(isset($_SESSION["staffID"])){
    $logged_in_user_id = $_SESSION["staffID"];

    $query = "call insertOwners('$logged_in_user_id' ,'$firstname', '$lastname', '$idNumber', '$propertyOwned', '$location', '$number_of_rooms', '$prod_img')";

    if (mysqli_query($conn, $query)) {
         echo "Property owner addition requested. Wait for admin approval!";
         //header("Refresh:2");
      } else {
         echo "Error: " . $query . "" . mysqli_error($conn);  
      }
      $conn->close();
  }else{
    if(headers_sent()){
        die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
      } else{
        exit(header("location: login.php"));
      }
  }
}

//adding the tenants 
if(isset($_POST['addtenant'])){

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $nationalid = $_POST['nationalid'];
  $contacts = $_POST['contacts'];
  $propertyno = $_POST['propertyno'];
  $houseno = $_POST['houseno'];


  if(isset($_SESSION["staffID"])){
  $logged_in_user_id = $_SESSION["staffID"];

  $roomAvailable = "SELECT FROM rooms WHERE rentalstatus='vacant'";
  $check = mysqli_query($conn, $roomAvailable);

   if(mysqli_num_rows($check) == 0) {
   	echo "no rooms added for this property";
   }else{
	  $query = "call insertTenant('$logged_in_user_id','$firstname','$lastname','$nationalid','$contacts','$propertyno','$houseno')";

	    if (mysqli_query($conn, $query)) {
	       echo "Tenant addition requested. Wait for admin approval!";
	    } else {
	       echo "Error: " . $query . "" . mysqli_error($conn);  
	    }
	}


    $conn->close();
  }else{
    if(headers_sent()){
        die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
      } else{
        exit(header("location: login.php"));
      }
  }

}

//adding the property
if(isset($_POST['addproperty'])){

  $ownerid = $_POST['ownerid'];
  $description = $_POST['description'];
  $capacity = $_POST['capacity'];
  $location = $_POST['location'];



  if(isset($_SESSION["staffID"])){
  $logged_in_user_id = $_SESSION["staffID"];

  $query="INSERT INTO property(staffID, ownerid, description, capacity, location) VALUES ('$logged_in_user_id','$ownerid','$description', '$capacity','$location')";

    if (mysqli_query($conn, $query)) {
       echo "Property addition requested. Wait for admin approval!";
    } else {
       echo "Error: " . $query . "" . mysqli_error($conn);  
    }
    $conn->close();
  }else{
    if(headers_sent()){
        die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
      } else{
        exit(header("location: login.php"));
      }
  }

}


function sessionCheck(){
	if (!isset($_SESSION["staffID"])) {
		header("location: login.php");
	}
}

function displayUser(){
	if (sessionCheck()==false) {
		echo $_SESSION["firstname"];
		echo " ";
		echo $_SESSION["lastname"];
	}
}

function displayPic(){
	if (sessionCheck()==false) {
		echo $_SESSION["profileImg"];
	}
}

function saveToSever($tag_name){
	    $image = addslashes($_FILES[$tag_name]['tmp_name']);
        $name  = addslashes($_FILES[$tag_name]['name']);
        $image = file_get_contents($image);
        $uploaddir = '../img/';
        $uploadfile = $uploaddir . basename($_FILES[$tag_name]['name']);

        if (move_uploaded_file($_FILES[$tag_name]['tmp_name'], $uploadfile)) {
            	return $uploadfile;
            }
            else { return false;}
} 

function calculateWorth(){
	global $conn; 

	$sql = "SELECT SUM(price) as Revenue_Expected FROM rooms";
	$result = mysqli_query($conn,$sql);

	$data = mysqli_fetch_array($result);

	if ($data['Revenue_Expected'] == "") {
		echo "$ 0";
	}else
	echo "KES ".$data['Revenue_Expected'];
}

function revenueRaised(){
	global $conn; 

	$sql = "SELECT SUM(price) as Revenue_Raised FROM rooms where rentalstatus='occupied'";

	$result = mysqli_query($conn,$sql);

	$data = mysqli_fetch_array($result);

	if ($data['Revenue_Raised'] == "") {
		echo "$ 0";
	}else
	echo "KES ".$data['Revenue_Raised'];
}

function pendingOwners(){
	global $conn;

	$sql = "SELECT COUNT(approval_status) as pendingPowners FROM owners WHERE approval_status='No'";
	$result = mysqli_query($conn,$sql);

	$data = mysqli_fetch_array($result);
	echo "Owners: ".$data['pendingPowners'];
}
function pendingTenants(){
	global $conn;

	$sql = "SELECT COUNT(id) as Pending_tenants FROM tenants WHERE approval_status='No'";
	$result = mysqli_query($conn,$sql);

	$data = mysqli_fetch_array($result);
	echo "Tenants: ".$data['Pending_tenants'];
}
function pendingProperty(){
	global $conn;

	$sql = "SELECT COUNT(propertyno) as Pending_property FROM property WHERE approval_status='No'";
	$result = mysqli_query($conn,$sql);

	$data = mysqli_fetch_array($result);
	echo "Property: ".$data['Pending_property'];
}

function drpProp(){
	global $conn;

	
	$sql = "SELECT propertyno FROM property WHERE approval_status='Yes'";
    $result = mysqli_query($conn,$sql);
    $menu="";

    while ($row = mysqli_fetch_array($result)) {
    	 $menu .="<option>".$row['propertyno']."</option>";
    }
    echo $menu;                 
}

function dropHse(){
	global $conn;

	$sql = "SELECT roomID FROM rooms WHERE rentalstatus='vacant'";
    $result = mysqli_query($conn,$sql);
    $menu="";

    while ($row = mysqli_fetch_array($result)) {
    	 $menu .="<option>".$row['propertyno']."</option>";
    }
    echo $menu; 
}

function propertyOwnersCount(){

	$servername = 'localhost';
	$username = "root";
	$password = '';
	$dbname = 'manajor';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	if (isset($_SESSION["staffID"])) {
		$logged_in_user_id = $_SESSION["staffID"];

			$sql = "SELECT COUNT(ownerID) as landlords FROM owners WHERE staffID='$logged_in_user_id'";
			$result = $conn->query($sql);

			if ($result ->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo $row["landlords"]. "<br>";
			    }
			} else {
			    echo "0 results fetched";
			}
			$conn->close();
	}

	/*global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];

		$sql = "SELECT COUNT(ownerID) as landlords FROM owners WHERE staffID='$logged_in_user_id'";
		$result = mysqli_query($conn,$sql);

		if(mysqli_num_rows($result) > 0){
			$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo $data['landlords'];
		}
	}*/
}

function tenantsCount(){

	$servername = 'localhost';
	$username = "root";
	$password = '';
	$dbname = 'manajor';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	if (isset($_SESSION["staffID"])) {
		$logged_in_user_id = $_SESSION["staffID"];

			$sql = "SELECT COUNT(id) as tenant FROM tenants WHERE staffID='$logged_in_user_id'";
			$result = $conn->query($sql);

			if ($result ->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo $row["tenant"]. "<br>";
			    }
			} else {
			    echo "0 results fetched";
			}
			$conn->close();
	}
	/*global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];

		$sql = "SELECT COUNT(id) as tenant FROM tenants WHERE staffID='$logged_in_user_id'";
		$result = mysqli_query($conn,$sql);

		if ($result) {
			$data = mysqli_fetch_array($result);
			echo $data['tenant'];
		}
	}*/
}

function propertyCount(){
		$servername = 'localhost';
		$username = "root";
		$password = '';
		$dbname = 'manajor';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		if (isset($_SESSION["staffID"])) {
			$logged_in_user_id = $_SESSION["staffID"];

				$sql = "SELECT COUNT(propertyno) as plot FROM property WHERE staffID='$logged_in_user_id'";
				$result = $conn->query($sql);

				if ($result ->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo $row["plot"]. "<br>";
				    }
				} else {
				    echo "0 results fetched";
				}
				$conn->close();
		}
	/*global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];

		$sql = "SELECT COUNT(propertyno) as plot FROM property WHERE staffID='$logged_in_user_id'";
		$result = mysqli_query($conn,$sql);

		if ($result) {
			$data = mysqli_fetch_array($result);
			echo $data['plot'];
		}
	}*/
}

function vacantCount(){
		$servername = 'localhost';
		$username = "root";
		$password = '';
		$dbname = 'manajor';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		if (isset($_SESSION["staffID"])) {
			$logged_in_user_id = $_SESSION["staffID"];

				$sql = "SELECT COUNT(roomID) as vacant FROM rooms WHERE staffID='$logged_in_user_id' AND rentalstatus='vacant'";
				$result = $conn->query($sql);

				if ($result ->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	echo "VACANT: ".$row['vacant'];
				    }
				} else {
				    echo "0 results fetched";
				}
				$conn->close();
		}
	/*global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];

		$sql = "SELECT COUNT(roomID) as vacant FROM rooms WHERE staffID='$logged_in_user_id' AND rentalstatus='vacant'";
		$result = mysqli_query($conn,$sql);

		if ($result) {
			$data = mysqli_fetch_array($result);
			echo "VACANT: ".$data['vacant'];
		}
	}*/
}

function occupiedCount(){
		$servername = 'localhost';
		$username = "root";
		$password = '';
		$dbname = 'manajor';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		if (isset($_SESSION["staffID"])) {
			$logged_in_user_id = $_SESSION["staffID"];

				$sql = "SELECT COUNT(roomID) as rented FROM rooms WHERE staffID='$logged_in_user_id' AND rentalstatus='occupied'";
				$result = $conn->query($sql);

				if ($result ->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				        echo "OCCUPIED: ".$row['rented'];
				    }
				} else {
				    echo "0 results fetched";
				}
				$conn->close();
		}
	/*global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];

		$sql = "SELECT COUNT(roomID) as plot FROM rooms WHERE staffID='$logged_in_user_id' AND rentalstatus='occupied'";
		$result = mysqli_query($conn,$sql);

		if ($result) {
			$data = mysqli_fetch_array($result);
			echo "OCCUPIED: ".$data['plot'];
		}
	}*/
}

function registerUsers(){
	global $conn; 

	  $FirstName = $_POST['FirstName'];
	  $LastName = $_POST['LastName'];
	  $Username = $_POST['Username'];
	  $InputEmail = $_POST['InputEmail'];
	  $InputPassword = $_POST['InputPassword'];
	  $RepeatPassword = $_POST['RepeatPassword'];

	  $pass = md5($InputPassword);

	if($_POST['InputPassword'] == $_POST['RepeatPassword']){
	  $query="INSERT INTO staff(firstname, lastname, username, password, email, usertype) VALUES ('$FirstName','$LastName','$Username','$pass','$InputEmail','regular')";

	  if (mysqli_query($conn, $query)) {
	    //header('Location: login.php');
	     echo "New user added successfully";
	  } else {
	     echo "Error: " . $query . "" . mysqli_error($conn);
	  }
	  $conn->close();

}
}

function manageUsers(){
	global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];
		$query = "SELECT * FROM staff LIMIT 10";
		$result = mysqli_query($conn,$query);

		echo "<div class='table-responsive'>
		  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
		    <thead class=\"p-3 bg-gray-400\">
		        <tr>
		            <td>First Name</td>
		            <td>Last Name</td>
		            <td>Username</td>
		            <td>Email</td>
		            <td>Rights</td>
		            <td>Actions</td>
		        </tr>
		    </thead>
		    <tbody class=\"p-3 bg-gray-200\"> ";
		
		       
		       //echo "<h3> Heeeeyyyyy".$logged_in_user_id."</h3>";
		        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);
		    if($result){

		        while($row = mysqli_fetch_array($result)) {
		       
		            echo "<tr>
		                <td>".$row['firstname']."</td>
		                <td>". $row['lastname']."</td>
		                <td>".$row['username']."</td>
		                <td>".$row['email']."</td>
		                <td>".$row['usertype']."</td>
		                <td><button onclick=\"edit('".$row['staffID']."','".$row['firstname']."', '".$row['lastname']."', '".$row['username']."', '".$row['email']."', '".$row['usertype']."')\"<a href=\"#\" class=\"btn btn-primary btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-flag\"></i></span><span class=\"text\">Edit</span></a></button> <button onclick=\"window.location.href='php/removeuser.php?staffID=".$row['staffID']."';\"<a href=\"#\" class=\"btn btn-danger btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">Delete</span></a></button></td>
		            </tr>";
		        }
		    }
		    

		    echo "</tbody>
		  </table>
		</div>";
} else{
		if(headers_sent()){
			die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
		} else{
			exit(header("location: login.php"));
		}

	}
}


function displayContent(){
	global $conn;

	if(isset($_SESSION["staffID"])){
		$logged_in_user_id = $_SESSION["staffID"];
		$query = "SELECT * FROM owners WHERE approval_status='Yes' AND staffID = '$logged_in_user_id' LIMIT 10";
		$result = mysqli_query($conn,$query);

		echo "<div class='table-responsive'>
		  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='10%'>
		    <thead class=\"p-3 bg-gray-400\">
		        <tr>
		            <td>Owner Id</td>
		            <td>First Name</td>
		            <td>Last Name</td>
		            <td>Property</td>
		            <td>Number of Rooms</td>
		            <td>Actions</td>
		        </tr>
		    </thead>
		    <tbody class=\"p-3 bg-gray-200\"> ";
		
		       
		       //echo "<h3> Heeeeyyyyy".$logged_in_user_id."</h3>";
		        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);
		    if($result){

		        while($row = mysqli_fetch_array($result)) {
		       
		            echo "<tr>
		                <td>". $row['ownerID'] ."</td>
		                <td>".$row['firstname']."</td>
		                <td>". $row['lastname']."</td>
		                <td>".$row['propertyOwned']."</td>
		                <td>".$row['number_of_rooms']."</td>
		                <td><button onclick=\"editOwners(".$row['ownerID'].", '".$row['firstname']."', '".$row['lastname']."', '".$row['propertyOwned']."', '".$row['number_of_rooms']."')\"<a href=\"#\" class=\"btn btn-primary btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-flag\"></i></span><span class=\"text\">Edit</span></a></button> | <button onclick=\"window.location.href='php/removeowner.php?ownerID=".$row['ownerID']."';\" <a href=\"#\" class=\"btn btn-danger btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">Delete</span></a></button></td>
		            </tr>";
		        }
		    }
		    

		    echo "</tbody>
		  </table>
		</div>";
} else{
		if(headers_sent()){
			die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
		} else{
			exit(header("location: login.php"));
		}

	}

}


function displayTenants(){
	global $conn;

	if(isset($_SESSION["staffID"])){
	$logged_in_user_id = $_SESSION["staffID"];
	$query = "SELECT * FROM tenants WHERE approval_status='Yes' AND staffID = '$logged_in_user_id' LIMIT 10";
	$result = mysqli_query($conn,$query);

	echo "<div class='table-responsive'>
	  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
	    <thead class=\"p-3 bg-gray-400\">
	        <tr>
	            <td>Tenant Id</td>
	            <td>First Name</td>
	            <td>Last Name</td>
	            <td>National Id.</td>
	            <td>Phone Number</td>
	            <td>Property Number</td>
	            <td>House Number</td>
	            <td>Actions</td>
	        </tr>
	    </thead>
	    <tbody class=\"p-3 bg-gray-200\"> ";
	
	       
	        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);
	    if ($result) {
	        while($row = mysqli_fetch_array($result)) {
	       
	            echo "<tr>
	                <td>". $row['id'] ."</td>
	                <td>".$row['firstname']."</td>
	                <td>". $row['lastname']."</td>
	                <td>".$row['nationalid']."</td>
	                <td>".$row['contacts']."</td>
	                <td>".$row['propertyno']."</td>
	                <td>".$row['houseno']."</td>
	                <td><button onclick=\"editTenants(".$row['id'].", '".$row['firstname']."', '".$row['lastname']."', '".$row['nationalid']."', '".$row['contacts']."','".$row['propertyno']."','".$row['houseno']."')\"<a href=\"#\" class=\"btn btn-primary btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-flag\"></i></span><span class=\"text\">Edit</span></a></button> <button onclick=\"window.location.href='php/removetenant.php?id=".$row['id']."';\"<a href=\"#\" class=\"btn btn-danger btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">Delete</span></a></button></td>
	            </tr>";
	        }
	    }	    

	    echo "</tbody>
	  </table>
	</div>";
} else{
		if(headers_sent()){
			die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
		} else{
			exit(header("location: login.php"));
		}

	}

}

function displayProperty(){
	global $conn;

	if(isset($_SESSION["staffID"])){
	$logged_in_user_id = $_SESSION["staffID"];
	$query = "SELECT * FROM property WHERE approval_status='Yes' AND staffID = '$logged_in_user_id' LIMIT 10";
	$result = mysqli_query($conn,$query);

	echo "<div class='table-responsive'>
	  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
	    <thead class=\"p-3 bg-gray-400\">
	        <tr>
	            <td>Property Id</td>
	            <td>Owner Id</td>
	            <td>Property Owned</td>
	            <td>Capacity</td>
	            <td>Location</td>
	            <td>Actions</td>
	        </tr>
	    </thead>
	    <tbody class=\"p-3 bg-gray-200\"> ";
	
	       
	        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);
	    if ($result) {
	        while($row = mysqli_fetch_array($result)) {
	       
	            echo "<tr>
	                <td>". $row['propertyno'] ."</td>
	                <td>". $row['ownerid']."</td>
	                <td>".$row['description']."</td>
	                <td>".$row['capacity']."</td>
	                <td>".$row['location']."</td>
	                <td><button onclick=\"editProperty(".$row['propertyno'].", '".$row['ownerid']."', '".$row['description']."', '".$row['capacity']."', '".$row['location']."')\"<a href=\"#\" class=\"btn btn-primary btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-flag\"></i></span><span class=\"text\">Edit</span></a></button> <button onclick=\"window.location.href='php/removeproperty.php?propertyno=".$row['propertyno']."';\"<a href=\"#\" class=\"btn btn-danger btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">Delete</span></a></button></td>
	            </tr>";
	        }
	    }
	    

	    echo "</tbody>
	  </table>
	</div>";
} else{
		if(headers_sent()){
			die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
		} else{
			exit(header("location: login.php"));
		}

	}

}

//displays the rooms all the rooms registered 
function displayRooms(){
	global $conn;

	if(isset($_SESSION["staffID"])){
	$logged_in_user_id = $_SESSION["staffID"];
	$query = "SELECT * FROM rooms WHERE rentalstatus='vacant' AND staffID = '$logged_in_user_id' LIMIT 10";
	$result = mysqli_query($conn,$query);

	echo "<div class='table-responsive'>
	  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
	    <thead class=\"p-3 bg-gray-400\">
	        <tr>
	            <td>Room Number</td>
	            <td>Plot Number</td>
	            <td>Specifics</td>
	            <td>Rent</td>
	            <td>Vacancy</td>
	            <td>Actions</td>
	        </tr>
	    </thead>
	    <tbody class=\"p-3 bg-gray-200\"> ";
	
	       
	        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);
	    if ($result) {
	        while($row = mysqli_fetch_array($result)) {
	       
	            echo "<tr>
	                <td>". $row['roomID'] ."</td>
	                <td>".$row['propertyno']."</td>
	                <td>". $row['description']."</td>
	                <td>".$row['price']."</td>
	                <td>".$row['rentalstatus']."</td>
	                <td><button onclick=\"editRoom(".$row['roomID'].", '".$row['propertyno']."', '".$row['description']."', '".$row['price']."', '".$row['rentalstatus']."')\"<a href=\"#\" class=\"btn btn-primary btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-flag\"></i></span><span class=\"text\">Edit</span></a></button> <button onclick=\"window.location.href='php/removeroom.php?roomID=".$row['roomID']."';\"<a href=\"#\" class=\"btn btn-danger btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">Delete</span></a></button></td>
	            </tr>";
	        }
	    }
	    

	    echo "</tbody>
	  </table>
	</div>";
} else{
		if(headers_sent()){
			die("Hmmmmmm. It seems your session has timed out....<a href='login.php'> Click here to Login Again</a>");
		} else{
			exit(header("location: login.php"));
		}

	}

}





// return user array from their id
function getUserById($id){
	global $conn;
	$query = "SELECT * FROM staff WHERE id=" . $staffID;
	$result = mysqli_query($conn, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

function approveAddition(){
	global $conn;
	$query = "SELECT * FROM owners WHERE approval_status='No' LIMIT 10";
	$result = mysqli_query($conn,$query);

	echo "<div class='table-responsive'>
	  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
	    <thead class=\"p-3 bg-gray-400\">
	        <tr>
	            <td>Customer Id</td>
	            <td>First Name</td>
	            <td>Last Name</td>
	            <td>Property</td>
	            <td>Number of Rooms</td>
	            <td>Actions</td>
	        </tr>
	    </thead>
	    <tbody class=\"p-3 bg-gray-200\"> ";
	
	       
	        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);

	        while($row = mysqli_fetch_array($result)) {
	       
	            echo "<tr>
	                <td>". $row['ownerID'] ."</td>
	                <td>".$row['firstname']."</td>
	                <td>". $row['lastname']."</td>
	                <td>".$row['propertyOwned']."</td>
	                <td>".$row['number_of_rooms']."</td>
	                <td><button onclick=\"window.location.href='php/adminUpdate.php?status=Yes&ownerID=".$row['ownerID']."';\">APPROVE</button> <button onclick=\"window.location.href='php/adminUpdate.php?status=Blocked&ownerID=".$row['ownerID']."';\">DECLINE</button></td>
	            </tr>";
	        }
	    

	    echo "</tbody>
	  </table>
	</div>";

}

function approveTenantsAddition(){
		global $conn;
		$query = "SELECT * FROM tenants WHERE approval_status='No' LIMIT 10";
		$result = mysqli_query($conn,$query);

		echo "<div class='table-responsive'>
		  <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
		    <thead class=\"p-3 bg-gray-400\">
		        <tr>
			        <td>Tenant Id</td>
		            <td>First Name</td>
		            <td>Last Name</td>
		            <td>National Id.</td>
		            <td>Phone Number</td>
		            <td>House Number</td>
		            <td>Actions</td>
		        </tr>
		    </thead>
		    <tbody class=\"p-3 bg-gray-200\"> ";
		
		       
		        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);

		        while($row = mysqli_fetch_array($result)) {
		       
		            echo "<tr>
			            <td>". $row['id'] ."</td>
		                <td>".$row['firstname']."</td>
		                <td>". $row['lastname']."</td>
		                <td>".$row['nationalid']."</td>
		                <td>".$row['contacts']."</td>
		                <td>".$row['houseno']."</td>
		                <td><button onclick=\"window.location.href='php/approveTenants.php?status=Yes&id=".$row['id']."';\">APPROVE</button> <button onclick=\"window.location.href='php/approveTenants.php?status=Blocked&id=".$row['id']."';\">DECLINE</button></td>
		            </tr>";
		        }
		    

		    echo "</tbody>
		  </table>
		</div>";
	}

function approvePropertyAddition(){
	global $conn;
	$query = "SELECT * FROM property WHERE approval_status='No' LIMIT 10";
	$result = mysqli_query($conn,$query);

	echo "<div class='table-responsive'>
	    <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
	    <thead class=\"p-3 bg-gray-400\">
	        <tr>
	        	<td>Property Id</td>
	            <td>Property Owned</td>
	            <td>Owner Id</td>
	            <td>Capacity</td>
	            <td>Location</td>
	            <td>Actions</td>
	        </tr>
	    </thead>
	    <tbody class=\"p-3 bg-gray-200\"> ";
	
	       
	        // $row = mysqli_fetch_array($ ,MYSQLI_ASSOC);
	        while($row = mysqli_fetch_array($result)) {
	       
	            echo "<tr>
	            	<td>". $row['propertyno'] ."</td>
	                <td>".$row['description']."</td>
	                <td>". $row['ownerid']."</td>
	                <td>".$row['capacity']."</td>
	                <td>".$row['location']."</td>
	                <td><button onclick=\"window.location.href='php/approveProperty.php?status=Yes&propertyno=".$row['propertyno']."';\">APPROVE</button> <button onclick=\"window.location.href='php/approveProperty.php?status=Blocked&propertyno=".$row['propertyno']."';\">DECLINE</button></td>
	            </tr>";
	        }
	    
	    echo "</tbody>
	  </table>
	</div>";
}
?>