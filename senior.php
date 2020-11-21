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
</head>
<body>

	<div class="container-fluid bg-light upBar">
		<div class="row mb-5">
			<a class="col-2 text-left p-2" href="home.php"><button class="btn btn-warning" >All animals</button></a>
			<h1 class="col-8 text-center text-warning">Adopt your animal today</h1>
			<a class="col-2 text-right p-2" href="general.php"><button class="btn btn-primary" >Young animals</button></a>
			<a href="actions/a_signout.php?logout" class="col-2 offset-10 text-right">Sign out <i class="fa fa-sign-out" aria-hidden="true"></i></a>
		</div>
	</div>
	


	<div class="swiper-container">
    <div class="swiper-wrapper">
	<?php 
	$sql = "SELECT * FROM animal WHERE available = 'yes' AND age > 7";
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

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>


<?php ob_end_flush(); ?>