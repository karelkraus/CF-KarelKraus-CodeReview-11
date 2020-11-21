<?php 


ob_start();
session_start();
if(isset($_SESSION['user'])!=""){
	header("Location: home.php");
}
include_once 'actions/db_connect.php'; 
$error = false;
if (isset($_POST['btn-signup'])) {

	$name = trim($_POST['name']);
	$name = strip_tags($name);
	$name = htmlspecialchars($name);

	$email = trim($_POST[ 'email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$pass = trim($_POST['pass']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);

	if(empty($name)) {
		$error= true;
		$nameError = "Please enter your full name.";
	}else if (strlen($name) < 3) {
		$error = true;
		$nameError = "Name must be at least 3 characters.";
	}else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true ;
  		$nameError = "Name must contain alphabets and space.";
	}

	if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
  		$emailError = "Please enter valid email address." ;
	}else {
		$query = "SELECT userEmail FROM users WHERE userEmail='$email'";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);
		if($count!=0) {
			$error = true;
			$emailError = "Provided Email is already in use.";
		}
	}

	if (empty($pass)) {
		$error = true;
  		$passError = "Please enter password.";
	}else if (strlen($pass) < 6) {
		$error = true;
		$passError = "Password must have atleast 6 characters." ;
	}

	$password = hash('sha256' , $pass);


	if( !$error ) {
		$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
		$res = mysqli_query($conn, $query);

		if ($res) {
			$errTyp = "success";
   			$errMSG = "Successfully registered, you may login now";
   			unset($name);
   			unset($email);
   			unset($pass);
		}else {
			$errTyp = "danger";
   			$errMSG = "Something went wrong, try again later..." ;
		}

	}

}
 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style/style.css">

</head>
<body>
	
	<div class="d-flex justify-content-center align-items-center" style="height: 100vh">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" style="width: 40%">
		
			<h2 class="text-center">SIGN UP</h2>
			<hr>
			<p style="height: 10px">
			<?php 
				if(isset($errMSG)){
				echo "<div class='alert alert-".$errTyp."'>".$errMSG."</div>";
				}
			 ?>
			</p>

			<p class="text-danger" style="height: 10px"> <?php echo $nameError; ?> </p>
			<input type ="text" name="name" class="form-control" placeholder="Enter Name"maxlength="50" value="<?php echo $name?>">

			
			<p class="text-danger" style="height: 10px"> <?php echo $emailError; ?> </p>
			<input type="email" name="email" class="form-control mt-1 mb-1" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>">

			
			<p class="text-danger" style="height: 10px"> <?php echo $passError; ?> </p>
			<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15">

			

			<hr>

			<button type="submit" class="btn btn-block btn-warning" name="btn-signup">Sign Up</button>

			<hr>

			<a href="signin.php"><p class="text-center">Sign in here</p></a>

	</form>
	</div>

</body>
</html>

<?php ob_end_flush(); ?>
