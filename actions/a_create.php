<?php
ob_start();
session_start();
require_once 'db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['superadmin']) && !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
 header("Location: index.html");
 exit;
}
if(isset($_SESSION["user"])){
	header("Location: home.php");
	exit;
}



if ($_POST) {
	$name = $_POST['name'];
	$image = $_POST['image'];
	$size = $_POST['size'];
	$type = $_POST['type'];
	$description = mysqli_real_escape_string($conn,$_POST['description']);
	$hobbies = $_POST['hobbies'];
	$age = $_POST['age'];
	$city = $_POST['city'];
	$zip = $_POST['zip'];
	$address = $_POST['address'];
	$country = $_POST['country'];

	$locat = "SELECT id_location FROM location WHERE address='$address'";
		$result = mysqli_query($conn, $locat);
		$data = $result -> fetch_assoc();
		$count = mysqli_num_rows($result);
		if($count!=0) {
			$sqlA = "INSERT INTO `animal`(`name`, `image`, `size`, `type`, `description`, `hobbies`, `fk_location`, `age`) VALUES ('$name','$image','$size','$type','$description','$hobbies','$data[id_location]','$age')";
			if($conn->query($sqlA)===TRUE) {
				$messageA = "Animal added to database";
			} else {$error = "error";}
		}else{
			$sql = "INSERT INTO `location`(`city`, `zip`, `address`, `country`) VALUES ('$city','$zip','$address','$country')";

			if($conn->query($sql)===TRUE) {
				$message = "Address added to database";
			}

			$addressID = $conn->insert_id;

			$sql2 = "INSERT INTO `animal`(`name`, `image`, `size`, `type`, `description`, `hobbies`, `fk_location`, `age`) VALUES ('$name','$image','$size','$type','$description','$hobbies','$addressID','$age')";

			if($conn->query($sql2)===TRUE) {
				$message2 = "Animal added to database";
			}

		}

	
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Add animal</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Create item</h1>
			<a class="col-2 text-right p-2" href="../admin.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>


	<div class="container" style="min-height: 80vh">

		<h1 class="text-center text-info"><?php  echo $messageA;?><?php  echo $error;?></h1>
		<h1 class="text-center text-success"><?php  echo $message;?></h1>
		<h1 class="text-center text-info"><?php  echo $message2;?></h1>
		
	</div>

</body>
</html>