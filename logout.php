

<?php # DISPLAY COMPLETE LOGGED OUT PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Home' ;
include ( 'logout.html' ) ;


# Clear existing variables.
$_SESSION = array() ;

# Destroy the session.
session_destroy() ;

# Display body section.
echo '  <div align="center"><h1>Goodbye!</h1><h4>You are now logged out.</h4><p><a href="login.php">
<button type="submit" class="btn btn-primary" value="Login">Login Back</button>
</a>

</div><br>' ;


# Display footer section.
include ( 'footer.html' ) ;

?>
