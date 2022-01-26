
<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

include ( 'logout.html' ) ;
   
# Open database connection.
require ( 'connect_db.php' ) ;

# Retrieve items from 'bookings' database table.
$q = "SELECT * FROM booking WHERE user_id={$_SESSION[user_id]}
ORDER BY booking_date DESC" ;

$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{


    while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '
    <div>
    <br>
	<ul class="list-group list-group-flush">
	        <li class="list-group-item">
                <div class="form-group row">
                <label for="booking ref" class="col-sm-12 col-form-label">
                Booking Reference:  #EC1000' . $row['booking_id'] . '</label> 
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-group row">
                <label for="booking ref" class="col-sm-12 col-form-label">
                Total Paid:   &pound ' . $row['total'] . ' 
                </label>
                </div>
            </li>          
            <li class="list-group-item">
                <div class="form-group row">
                <label for="booking ref" class="col-sm-12 col-form-label">
                <small>'  . $row['booking_date'] . '</small>
                </label>
                </div>
            </li>
    </ul>
</div>
<br>			
';
  }

  # Close database connection.
  mysqli_close( $link ) ; 
}

include('footer.html');
?>
    