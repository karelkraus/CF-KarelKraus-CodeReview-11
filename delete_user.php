<?php  
	ob_start();
	session_start();
	require_once 'actions/db_connect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['superadmin']) && !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
	 header("Location: index.html");
	 exit;
	}
	if(isset($_SESSION["admin"])){
		header("Location: admin.php");
		exit;
	}
	if(isset($_SESSION["user"])){
		header("Location: home.php");
		exit;
	}


	if($_GET['id']) {
		$id = $_GET['id'];

		$sql = "SELECT * FROM users WHERE userId = {$id}";
		$result = $conn -> query($sql);

		$data = $result -> fetch_assoc();

		$conn -> close();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete item</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Delete <?php echo $data['userType'] ?></h1>
			<a class="col-2 text-right p-2" href="superadmin.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>

	<div class="container" style="min-height: 80vh">
	<h2 class="text-danger text-center mb-3">Do you want to delete: <?php echo $data['userName'] ?>?</h2>

	<form action="actions/a_delete_user.php" method="post">
		<input type="hidden" name="id" value="<?php echo $data['userId'] ?>">
		<input class="btn btn-danger btn-lg btn-block" type="submit" value="Yes, delete">
	</form>

	<a class="btn btn-warning btn-lg btn-block mt-2" href="manage.php">No, go back to management</a>
	</div>

</body>
</html>

<?php ob_end_flush(); ?>