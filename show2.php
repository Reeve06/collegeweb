<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; } 

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ;

include ( 'logout.html' ) ;

# Check if form has been submitted for update
if ($_SERVER['REQUEST_METHOD']=='POST')

{
  # Update changed quantity field values.
  foreach ( $_POST['qty'] as $id => $mov_qty )
  {
    # Ensure values are integers.
    $id = (int) $id;
    $qty = (int) $mov_qty;

    # Change quantity or delete if zero.
    if ( $qty == 0 ) { unset ($_SESSION['cart'][$id]); } 
    elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
  }  }

  # Initialise grand total variable.
    $total = 0;

    # Display the cart if not empty.
if (!empty($_SESSION['cart']))
{

    # Open database connection.
require ( 'connect_db.php' ) ;


# Retrieve booking in the cart from the 'movie' database table.
$q = "SELECT * FROM movie WHERE id IN (";
foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
$q = substr( $q, 0, -1 ) . ') ORDER BY id ASC';
      $r = mysqli_query ($link, $q);


      # Display body section with a form and a table.
  echo '<div class="container">
  <div class="row">
      <div class="col-sm">
	<div class="card bg-light mb-3">
	    <div class="card-header"> 
	          <h5 class="card-title">Booking Summary</h5>
	    </div>
	    <div class="card-body">
	    <form action="show2.php" method="post">
	  ';


      while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
      {
        # Calculate sub-totals and grand total.
        $subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $_SESSION['cart'][$row['id']]['price'];
                $total += $subtotal;
    

# Display the row/s:
echo " <ul class=\"list-group list-group-flush\"> 
<li class=\"list-group-item\">
  <div class=\"form-group row\">
<label for=\"movie_title\" class=\"col-sm-12 col-form-label\">Movie Title:    {$row['movie_title']}</label> 
</div>
</li>
       <li class=\"list-group-item\">
 <div class=\"form-group row\">
<label for=\"show time\" class=\"col-sm-12 col-form-label\">Starting @ {$row['show2']}</label> 			  
  </div>
</li>
</ul>
<br>
<div class=\"input-group mb-3\">
<input type=\"text\" class=\"form-control\" name=\" qty[{$row['id']}]\" value=\" {$_SESSION['cart'][$row['id']]['quantity']}\" aria-label=\"qty\" aria-describedby=\"basic-addon2\">
<div class=\"input-group-append\">
<input type=\"submit\" name=\"submit\" class=\"btn btn-secondary\" value=\"Update\">
</div>
</div>
</form> ";
}
# Display the total.
echo '<ul class="list-group list-group-flush">
<li class="list-group-item">
<div class="form-group row">
<label for="Total" class="col-sm-12 col-form-label">To Pay:  &pound; '.number_format($total,2).'</label> 			  
</div>
</li>
<li class="list-group-item">
<a href="checkout.php?total='.$total.'"><button type="button" class="btn btn-secondary btn-block" role="button">Book Now</button></a>
</li>
</ul>
</form>
</div></div></div></div></div>  ';  }


else
{ 
# Or display a message.
echo '<div class="container">
	<div class="alert alert-secondary" role="alert">
	<h2>No reservations have been made.</h2>
	<a href="home.php" class="alert-link">View What\'s On Now </a>
		</div> ' ;  }

# Display footer section.
include ( 'footer.html' ) ;
?>

