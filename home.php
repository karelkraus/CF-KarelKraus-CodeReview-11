<?php
ob_start();
session_start();
require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user' ]) ) {
 header("Location: index.html");
 exit;
}
// select logged-in users details
$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);


$resAnimal = mysqli_query($conn, "SELECT * FROM animal WHERE available = 'yes'");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Adoption</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

	

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<a class="col-2 text-left p-2" href="general.php"><button class="btn btn-primary" >Young animals</button></a>
			<h1 class="col-8 text-center text-warning">Adopt your animal today</h1>
			<a class="col-2 text-right p-2" href="senior.php"><button class="btn btn-info" >Old animals</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>

	<div class="container">
	<form>
	  <div class="form-group">
	    <input type="text" class="form-control" name="search" id="search" placeholder="Search animal by name">
	  </div>
	</form>
	</div>
	
	
	<div class="swiper-container">
    	<div class="swiper-wrapper" id="result"></div>
	</div>

	<div class="swiper-container">
    <div class="swiper-wrapper">
	<?php 
	$sql = "SELECT * FROM animal WHERE available = 'yes'";
	$result = $conn->query($sql);

	

	if($result->num_rows > 0){
	$rows=$result->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $value ){
		
		echo "
			<div class='swiper-slide' style='width: 18rem;'>
			<div class='card' style='width: 18rem;'>
			  <img src='".$value['image']."' class='card-img-top'>
			  <div class='card-body bg-light'>
			    <h5 class='card-title'>".$value['name']."</h5>
			    <p class='card-text'><small>Type: ".$value['type']."</small></p>
			    <p class='card-text'><small>Size: ".$value['size']."</small></p>
			    <p class='card-text'>".$value['description']."</p>
			    <a href='detail.php?id=" .$value['id_animal']."' class='btn btn-info btn-block'>Show</a>
			    <a href='adopt.php?id=" .$value['id_animal']."' class='btn btn-danger btn-block'>Adopt now</a>
			  </div>
			</div>
			</div>";
	}

	}
	?>
	</div>
	</div>

	<script>
	// Variable to hold request
	var request;

		$("#search").keyup(function(event){

	   // Prevent default posting of form - put here to work in case of errors
	   event.preventDefault();

	   // Abort any pending request
	   if (request) {
	       request.abort();
	   }
	   // setup some local variables
	   var $form = $(this);

	   // Let's select and cache all the fields
	   var $inputs = $form.find("input, select, button, textarea");

	   // Serialize the data in the form
	   var serializedData = $form.serialize();

	   var search = document.getElementById('search').value;
	   if(search.length > 0) {
	   	$inputs.prop("disabled", true);

	   // Fire off the request to /form.php
	   request = $.ajax({
	       url: "actions/form.php",
	       type: "post",
	       data: serializedData
	   });

	   // Callback handler that will be called on success
	   request.done(function (response, textStatus, jqXHR){
	       // Log a message to the console
	       document.getElementById('result').innerHTML = response;
	   });

	   // Callback handler that will be called on failure
	   request.fail(function (jqXHR, textStatus, errorThrown){
	       // Log the error to the console
	       console.error(
	           "The following error occurred: "+
	           textStatus, errorThrown
	       );
	   });

	   // Callback handler that will be called regardless
	   // if the request failed or succeeded
	   request.always(function () {
	       // Reenable the inputs
	       $inputs.prop("disabled", false);
	   });
	}else {
		document.getElementById('result').innerHTML = "";
	}

	   
	});
	</script>


	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
	<script>
	    var swiper = new Swiper('.swiper-container', {
	      effect: 'coverflow',
	      grabCursor: true,
	      centeredSlides: true,
	      slidesPerView: 'auto',
	      coverflowEffect: {
	        rotate: 50,
	        stretch: 0,
	        depth: 100,
	        modifier: 1,
	        slideShadows: true,
	      },
	      pagination: {
	        el: '.swiper-pagination',
	      },
	    });
	  </script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>


<?php ob_end_flush(); ?>