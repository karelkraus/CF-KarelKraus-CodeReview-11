<?php  
	require_once 'db_connect.php';

	$search = $_POST['search'];

	$sql = "SELECT * FROM animal WHERE available = 'yes' AND name LIKE '".$search."%'";
	$result = mysqli_query($conn,$sql);
	$rows = $result->fetch_all(MYSQLI_ASSOC);

	if($result->num_rows != 0 && $search != "") {
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
	}else {
		echo "<h1 class='text-center text-danger'>No result</h1>";
	} 



?>