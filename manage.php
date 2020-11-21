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

	//$res=mysqli_query($conn, "SELECT * FROM users WHERE userType='user' OR userType='admin'");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Users Management</h1>
			<a class="col-2 text-right p-2" href="superadmin.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>


	<div class="container" style="min-height: 80vh">
	<table class="table table-hover table-light">
		  <thead>
		    <tr>
		  	  <th scope="col">ID</th>
		      <th scope="col">User name</th>
		      <th scope="col">User email</th>
		      <th scope="col">User type</th>
		      <th scope="col"></th>
		    </tr>
		  </thead>
	  	<tbody>

	<?php 
	$sql = "SELECT * FROM users WHERE userType='user' OR userType='admin'";
	$result = $conn->query($sql);

	if($result->num_rows > 0){
	$rows=$result->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $value ) {
		echo "	<tr>
			      <th scope='row'>".$value['userId']."</th>
			      <td>".$value['userName']."</td>
			      <td>".$value['userEmail']."</td>
			      <td>".$value['userType']."</td>
			      <td><a href='delete_user.php?id=" .$value['userId']."' class='btn btn-danger btn-block'>Delete</a></td>
			    </tr>";
	}
	}

	?>
		</tbody>
	</table>
	</div>


</body>
</html>

<?php ob_end_flush(); ?>