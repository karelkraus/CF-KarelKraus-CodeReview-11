<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['superadmin']) && !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
 header("Location: index.html");
 exit;
}
if(isset($_SESSION["user"])){
	header("Location: home.php");
	exit;
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Add animal</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<h1 class="col-8 offset-2 text-center text-warning">Add animal</h1>
			<a class="col-2 text-right p-2" href="admin.php"><button class="btn btn-warning">Back to main page</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>

	<div class="container">
		<form action="actions/a_create.php" method="post">
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="name">Name</label>
		      <input type="text" class="form-control" name="name" id="name">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="image">Image URL</label>
		      <input type="text" class="form-control" name="image" id="image">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label for="type">Type</label>
		      <input type="text" class="form-control" name="type" id="type">
		    </div>
		    <div class="form-group col-md-3">
		      <label for="size">Size</label>
		      <select id="size" name="size" class="form-control">
		        <option selected>large</option>
		        <option>small</option>
		      </select>
		    </div>
		    <div class="form-group col-md-3">
		      <label for="hobbies">Hobbies</label>
		      <input type="text" class="form-control" name="hobbies" id="hobbies">
		    </div>
		    <div class="form-group col-md-2">
		      <label for="age">Age</label>
		      <input type="number" class="form-control" name="age" id="age">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-12">
		      <label for="description">Description</label>
		      <input type="text" class="form-control" name="description" id="description">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="address">Address</label>
		    <input type="text" class="form-control" id="address" name="address">
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="city">City</label>
		      <input type="text" class="form-control" name="city" id="city">
		    </div>
		    <div class="form-group col-md-3">
		      <label for="country">Country</label>
		      <input type="text" class="form-control" name="country" id="country">
		    </div>
		    <div class="form-group col-md-3">
		      <label for="zip">Zip</label>
		      <input type="text" class="form-control" name="zip" id="zip">
		    </div>
		  </div>
		  <button type="submit" class="btn btn-primary btn-lg btn-block">Add</button>
		</form>

	<a class="btn btn-warning btn-block mt-2" href="admin.php">Back to main page</a>

	</div>

</body>
</html>

<?php ob_end_flush(); ?>