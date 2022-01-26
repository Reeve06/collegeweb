<?php # DISPLAY COMPLETE LOGGED IN PAGE.


    # Access session.
    session_start() ;

    # Redirect if not logged in.
    if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

  
    # Set page title and display header section.
    $page_title = 'Upcoming Movies' ;
    include ( 'logout.html' ) ;
    echo '<div class="container">
			<h1 class="text-center">Upcomig Movies</h1>
      <br>
				<div class="row">';

    # Open database connection.
    require ( 'connect_db.php' ) ;

    # Retrieve movies from 'movie' database table.
    $q = "SELECT * FROM coming_soon" ;
    $r = mysqli_query( $link, $q ) ;
    if ( mysqli_num_rows( $r ) > 0 )
    {

        # Display body section.
        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
          echo '  
  
              
      <div class="col-md-3 d-flex justify-content-center">
      <div class="card text-center" style="width: 18rem;">
         <img src='. $row['img'].' class="card-img-top" alt="Movie" >  
         <div class="card-body">
           <h5 class="card-title">'. $row['movie_title'].'</h5>
           
        
         </div>  
 
     </div> 
       </div> 
      </div><! -- closing row -->
    <br >
    <br></div> 
     
     
     ';

    }

    # Close database connection.
    mysqli_close( $link) ; 
}

# Or display message.
else { echo '<p>There are currently no movies showing.</p>' ; }

# Display body section.
#echo "<h1>What's On</h1><p>You are now logged in, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";

# Display footer section.
include ( 'footer.html' ) ;

?>

