<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; } 

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ;

include ( 'logout.html' ) ;
   
# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve selective item data from 'movie' database table. 
$q = "SELECT * FROM movie WHERE id = $id" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );

  # Check if cart already contains one movie id.
  if ( isset( $_SESSION['cart'][$id] ) )
  { 
# Add one more of this product.
    $_SESSION['cart'][$id]['quantity']++; 
    echo '<div class="container">
			<h1 class="display-4">'.$row['movie_title'].'</h1>
		<div class="row">
			<div class="col-sm-12 col-md-4">
			  <div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src='. $row['preview'].' 
					frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
					allowfullscreen>
				</iframe>
			   </div>
			</div>
			<div class="col-sm-12 col-md-4">
				<p>'.$row['further_info'].'</p>
			</div>
			<div class="col-sm-12 col-md-4">
				<h4>Book Now</h4>
				<hr>
				<h2>
				  <a href="show1.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show1'] . ' </button></a>
				  <a href="show2.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show2'] . ' </button></a>
				  <a href="show3.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show3'] . ' </button></a>
		

				</h2>
				
				<hr>
				
				<div class="col-sm-12 col-md-4">
				<h4>Movie Reviews</h4>
				<hr>
				<h2>
				<a href="mov-rev.php?movie_title='.$row['movie_title'].'"> <button type="button" class="btn btn-secondary" role="button"> This Movie </button></a>
				<a href="review.php?id='.$row['id'].'"> <button type="button" class="btn btn-secondary" role="button"> All Reviews </button></a>

				</h2>
				
			</div>
		</div></div></div></div><br><br>
		';
  }
else
  {
    # Or add one of this product to the cart.
    $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['mov_price'] ) ;
 echo '<div class="container">
			<h1 class="display-4">'.$row['movie_title'].'</h1>
		<div class="row">
			<div class="col-sm-12 col-md-4">
			  <div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src='. $row['preview'].' 
					frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
					allowfullscreen>
				</iframe>
			   </div>
			</div>
			<div class="col-sm-12 col-md-4">
				<p>'.$row['further_info'].'</p>
			</div>
			<div class="col-sm-12 col-md-4">
				<h4>Book Now</h4>
				<hr>
				<h2>
				  <a href="show1.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show1'] . ' </button></a>
				  <a href="show2.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show2'] . ' </button></a>
				  <a href="show3.php"> <button type="button" class="btn btn-secondary" role="button"> ' . $row['show3'] . ' </button></a>
				</h2>
				
			</div>
		</div>';
  }
}

# Close database connection.
mysqli_close($link);


# Display footer section.
include ( 'footer.html' ) ;
?>