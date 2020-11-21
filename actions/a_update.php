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
	$id = $_POST['id'];
	$id_loc = $_POST['id_location'];

	$sql = "UPDATE `animal` SET `name`='$name',`image`='$image',`size`='$size',`type`='$type',`description`='$description',`hobbies`='$hobbies', `age`='$age' WHERE id_animal = {$id}";

	$sql2 = "UPDATE `location` SET `city`='$city',`zip`='$zip',`address`='$address',`country`='$country' WHERE id_location = {$id_loc}";


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit animal data</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Edit animal data</h1>
			<a class="col-2 text-right p-2" href="../admin.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>


	<div class="container" style="min-height: 80vh">
		<?php  
			if($conn -> query($sql) === TRUE && $conn -> query($sql2) === TRUE) {

				echo "<h2 class='text-primary text-center mb-5'>Data was updated</h2>" ;
				echo "<a class='btn btn-primary btn-lg btn-block mt-2' href='../update.php?id=".$id."'>Back to edit mode</a>";
        		echo "<a class='btn btn-warning btn-lg btn-block mt-2' href='../index.php'>Back to main page</a>";
			}else {
				echo "Error while updating record : ". $conn->error;
			}


			$conn -> close();

		?>
		
	</div>

</body>
</html>

<?php ob_end_flush(); ?>