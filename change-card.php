<?php
# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
    {
        # Connect to the database.
        require ('connect_db.php');
        # Initialize an error array.
        $errors = array();

        # Check for an email address:
        if ( empty( $_POST[ 'email' ] ) )
            { $errors[] = 'Enter your email address.'; }
        else
            { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }

        # Check for a card number:
        if ( empty( $_POST[ 'card_no' ] ) )
            { $errors[] = 'Enter your card number.'; }
        else
            { $card_number = mysqli_real_escape_string( $link, trim( $_POST[ 'card_no' ] ) ) ; }        
        # Check for an expiry month:
        if ( empty( $_POST[ 'exp_m' ] ) )
            { $errors[] = 'Enter your expiry month.'; }
        else
            { $exp_m = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_m' ] ) ) ; }        
        # Check for an expiry year:
        if ( empty( $_POST[ 'exp_y' ] ) )
            { $errors[] = 'Enter your expiry year.'; }
        else
            { $exp_y = mysqli_real_escape_string( $link, trim( $_POST[ 'exp_y' ] ) ) ; }    
        # Check for a cvv:
        if ( empty( $_POST[ 'cvv' ] ) )
            { $errors[] = 'Enter your cvv'; }
        else
            { $cvv = mysqli_real_escape_string( $link, trim( $_POST[ 'cvv' ] ) ) ; }     

        # Check if email address already registered.
        if ( empty( $errors ) )
            {
            $q = "SELECT * FROM users WHERE email='$e'" ;
            $r = @mysqli_query ( $link, $q ) ;
            }
            # On success new password into 'users' database table.
        if ( empty( $errors ) ) 
            {
            $q = "UPDATE users SET card_number = '$card_number', exp_month = '$exp_m', exp_year = '$exp_y', cvv = '$cvv' WHERE user_id ={$_SESSION[user_id]}";
            $r = @mysqli_query ( $link, $q ) ;
        if ($r)
            {
            header("Location: user.php");
            } 
        else 
            {
            echo "Error updating record: " . $link->error;
            }
            # Close database connection.
    
            mysqli_close($link); 
            exit();
            }
# Or report errors.
  else 
  {  
    echo ' <div class="container"><div class="alert alert-dark alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h1><strong>Error!</strong></h1><p>The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</div></div>';
    # Close database connection.
    mysqli_close( $link );
  }  
}
?>
