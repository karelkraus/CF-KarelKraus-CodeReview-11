<?php  
ob_start();
session_start();
include_once 'db_connect.php';

if( !isset($_SESSION['user' ]) ) {
	header("Location: index.html");
	exit;
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Animal adoption</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Animal adoption</h1>
			<a class="col-2 text-right p-2" href="../home.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>


	<div class="container" style="min-height: 80vh">
		<?php  
			if ($_POST) {
				$id_animal = $_POST['id'];
				$id_user = $_SESSION['user'];
				echo $id_animal;
				echo $id_user;

				$sql = "INSERT INTO adoption (fk_user_id, fk_animal_id) VALUES ('$id_user','$id_animal')";
				$sql2 = "UPDATE animal SET available='no' WHERE id_animal = {$id_animal}";
				if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
					echo "<h2 class='text-dark text-center mb-5'>The animal was adopted</h2>";
			        echo "<a class='btn btn-warning btn-lg btn-block mt-2' href='../home.php'>Back to main page</a>";
				}else {
					echo "Error updating record : " . $conn->error;
				}

				$conn -> close();
			}

		?>
		
	</div>

</body>
</html>