<?php
ob_start();
session_start();
include_once 'actions/db_connect.php';

if( !isset($_SESSION['user' ]) ) {
	header("Location: index.html");
	exit;
	}

$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);  


if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM animal WHERE id_animal = {$id}";
   $result = $conn -> query($sql);
   $data = $result -> fetch_assoc();

   $conn -> close();	

   }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Adopt now</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Animal adoption</h1>
			<a class="col-2 text-right p-2" href="home.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>


	<div class="container" style="min-height: 80vh">
	<h1 class="text-center">Do you want to adopt <?php echo $data['name'] ?>?</h1>

	<form action="actions/a_adopt.php" method="post">
		<input type="hidden" name="id" value="<?php echo $data['id_animal'] ?>">
		<input class="btn btn-danger btn-lg btn-block" type="submit" value="Yes, adopt">
	</form>

	<a class="btn btn-warning btn-lg btn-block mt-2" href="home.php">No, go back</a>

	</div>

</body>
</html>