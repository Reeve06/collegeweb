
<?php

# Include HTML static file login.html
include ( 'login.html' ) ;


# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    # Connect to the database.
    require ('connect_db.php');
    # Initialize an error array.
    $errors = array();
    # Check for a first name.
    if (empty($_POST['first_name']))
    {
        $errors[] = 'Enter your first name.';
    }
    else
    {
        $fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
    }
    # Check for a second name.
    if (empty($_POST['last_name']))
    {
        $errors[] = 'Enter your last name.';
    }
    else
    {
        $ln = mysqli_real_escape_string($link, trim($_POST['last_name']));
    }

     # Check for a email.
    if (empty($_POST['email']))
    {
        $errors[] = 'Enter your Email.';
    }
    else
    {
        $email = mysqli_real_escape_string($link, trim($_POST['email']));
    }


# Check for a password and matching input passwords.
    if (!empty($_POST['pass1']))
    {
            if ($_POST['pass1'] != $_POST['pass2'])
        {
            $errors[] = 'Passwords do not match.';
        }
        else
        {
            $p = mysqli_real_escape_string($link, trim($_POST['pass1']));
        }
        }
        else
        {
            $errors[] = 'Enter your password.';
     }

    # Check for a card number.
        if (empty($_POST['card_number']))
        {
            $errors[] = 'Enter your Card Number.';
        }
        else
        {
            $card_no = mysqli_real_escape_string($link, trim($_POST['card_number']));
        }
     # Check for a card exp month.    
    if (empty($_POST['exp_month']))
    {
        $errors[] = 'Enter your Card Exp Month.';
    }
    else
    {
        $exp_m = mysqli_real_escape_string($link, trim($_POST['exp_month']));
    }
    # Check for a card exp year.
    if (empty($_POST['exp_year']))
    {
        $errors[] = 'Enter your Card Exp Year.';
    }
    else
    {
        $exp_y = mysqli_real_escape_string($link, trim($_POST['exp_year']));
    }
     # Check for a card cvv.
    if (empty($_POST['cvv']))
    {
        $errors[] = 'Enter your Card CVV.';
    }
    else
    {
        $cvv = mysqli_real_escape_string($link, trim($_POST['cvv']));
    }

# Check if email address already registered.
if ( empty( $errors ) )
{
  $q = "SELECT user_id FROM users WHERE email='$email'" ;
  $r = @mysqli_query ( $link, $q ) ;
  if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
}

# On success register user inserting into 'users' database table.
if ( empty( $errors ) ) 
{
  $q = "INSERT INTO users (first_name, last_name, email, pass, card_number, exp_month, exp_year, cvv, reg_date) VALUES ('$fn', '$ln', '$email', SHA2('$p',256), '$card_no', '$exp_m', '$exp_y', '$cvv', NOW() )";
  $r = @mysqli_query ( $link, $q ) ;
  if ($r)
  { echo '<h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>'; }

  # Close database connection.
  mysqli_close($link); 
  exit();
}

# Or report errors.
else 
{
  echo '<h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
  foreach ( $errors as $msg )
  { echo " - $msg<br>" ; }
  echo 'Please try again.</p>';
  # Close database connection.
  mysqli_close( $link );
}  


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
<h1>Register</h1>
<br>   
<form action="register.php" method="post">
<div class="form-group">
<h4>
<label for="exampleInputName">First Name: </label> 
<input type="text" class="form-control" id="exampleInputName" name="first_name" size="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name'];?>"> 
</h4>
</div>

<div class="form-group">
<h4>   
<label for="exampleInputName2">Last Name: </label>
<input type="text" class="form-control" id="exampleInputName" name="last_name" size="20" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name'];?>">
</h4>
</div>

<hr color="#F25F4C" >


<div class="form-group">
<h4>
<label for="exampleInputEmail2">email: </label>
<input type="email" name="email" class="form-control" id="exampleInputEmail2" size="20" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"> 

<label for="exampleInputPassword2">password : </label>
<input type="password" class="form-control" id="exampleInputPassword2" name="pass1" size="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1'];?>">

<label for="exampleInputPassword3">confirm password :</label>
<input type="password"  class="form-control" id="exampleInputPassword3" name="pass2" size="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2'];?>">
</h4>
</div>

<hr color="#F25F4C" >
<div class="form-group">
<h4>   
<label for="exampleInputCard1"> Card number:</label>    
<input type="text" class="form-control" id="exampleInputCard1" name="card_number" size="16" value="<?php if (isset($_POST['card_no'])) echo $_POST['card_no']; ?>">

<label for="exampleInputExp1"> Expiration Date:</label>  
<input type="text" class="form-control" id="exampleInputExp1" name="exp_month" size="2" value="<?php if (isset($_POST['exp_m'])) echo $_POST['exp_m']; ?>">
<input type="text" class="form-control" id="exampleInputExp1" name="exp_year" size="2" value="<?php if (isset($_POST['exp_y'])) echo $_POST['exp_y']; ?>">

<label for="exampleInputCVV1">  CVV: </label>  
<input type="text" class="form-control" id="exampleInputCVV1" name="cvv" size="3" value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>">
</h4>
</div>



<div class="form-group" align="center">
<h4>   
<button  type="submit" class="btn btn-primary" value="Register" >Register</button>   
</h4> 
</div>
</form>
</div>










<?php 
# Display footer section.
include ( 'footer.html' ) ;
?>



 
