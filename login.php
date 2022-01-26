

<?php # DISPLAY COMPLETE LOGIN PAGE.

# Include HTML static file login.html
include ( 'login.html' ) ;

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<h5 id="err_msg">Oops! There was a problem:<br></h5>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo '<h5>Please try again or <a href="register.php">Register</a></h5>' ;
}
?>
<!doctype html>
<html lang="en-GB">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
   <link rel="stylesheet" href="mystyle.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
   <script src="https://kit.fontawesome.com/bb3ef965c3.js" crossorigin="anonymous"></script> 
</head>
<body>
<div class="card-body">
<h1>Login</h1>

<form action="login_action.php" method="post">
  <div class="form-group">
      <h4>
    <label for="exampleInputEmail1">Email address  </label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </h4>
  </div>
  <h4>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
    </h4>
  </div>
  <h4  >
  <div class="form-group" align="center">
  <button  type="submit" class="btn btn-primary" value="Login" >Submit</button>
</h4></div>
</form>
</div><br>





<?php 
# Display footer section.
include ( 'footer.html' ) ;
?>