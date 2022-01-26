
<?php # DISPLAY COMPLETE REGISTRATION PAGE.


$page_title = 'User Area ' ;
include('logout.html');
# Access session.
session_start() ;
# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Open database connection.
require ( 'connect_db.php' ) ;

$q = "SELECT * FROM users WHERE user_id={$_SESSION[user_id]}" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	{


        echo '
        <div  class="container">
          <div class="row" >
      ';
    
      while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
      {
        echo '
        <div class="col-sm" >
          <div class="alert alert-dark" alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>	
          <h1>'  . $row['first_name'] . ' '  . $row['last_name'] . '<strong>  </h1> 
          <br>
          <h5  ><strong> User ID : EC2021 '  . $row['user_id'] . ' </strong></h5>
          <h5><strong> Email : </strong> '  . $row['email'] . ' </h5>
          <h5><strong> Registration Date : </strong> '  . $row['reg_date'] . ' </h5>
          <!-- Button trigger modal -->
        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#password">
            <i class="fa fa-edit"></i>  Change Password
        </button>
         </div>
        </div></div></div><br>
        ';
        }
    }
        else { echo '<h3>No user details.</h3>
    
        ' ; }
    

    # Retrieve items from 'users' database table.
	$q = "SELECT * FROM users WHERE user_id={$_SESSION[user_id]}" ;
	$r = mysqli_query( $link, $q ) ;
	if ( mysqli_num_rows( $r ) > 0 )
	{
        echo '<div class="col-sm">';

        while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
        {
        echo '
	
		<div class="alert alert-secondary" alert-dismissible fade show" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		   </button>
			<h1>Card Stored</h1>
      <br>
        <h5><strong> Card Holder : </strong> '  . $row['first_name'] . '  '  . $row['last_name'] . ' </h5>
        <h5><strong> Card Number : </strong> '  . $row['card_number'] . ' </h5>
        <h5><strong> Expire Date : </strong> '  . $row['exp_month'] . '   '  . $row['exp_year'] . '</h5>
        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#card">
		<i class="fa fa-credit-card"></i>  Update Card 
        </button>
		</div>
        </div></div></div><br>
        ' ;
        }
	
    # Close database connection.
    mysqli_close( $link ) ; 
    }
    else { echo '<div class="alert alert-danger" alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <h1>Card Stored</h1>
                <h3>No card stored.</h3>
            </div></div></div><br>
            
    ' ; }

# Display footer section.
include ( 'footer.html' ) ; 
?>

<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
   <form action="change-password.php" method="post">
      <div class="form-group">
       <input type="email"  name="email" 
                 class="form-control"  
                 placeholder="Confirm Email" 				
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" 
   required>
     </div>
<div class="form-group">
    <input type="password"
                name="pass1" 
	   class="form-control" 
	   placeholder="New Password"
	  value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" 
  required> 
</div>
<div class="form-group">
                <input type="password" 
		  name="pass2" 
		  class="form-control" 
		  placeholder="Confirm New Password"
		  value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" 
  required>
            </div>
</div>
    <div class="modal-footer">
        <div class="form-group">
          <input type="submit" 
    	        name="btnChangePassword" 
        class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
           </div>
         </div>
 </form>
      </div><!--Close body-->
    </div><!--Close modal-body-->
  </div><!-- Close modal-fade-->


  <div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="card" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
   <form action="change-card.php" method="post">
      <div class="form-group">
       <input type="email"  name="email" 
                 class="form-control"  
                 placeholder="Confirm Email" 				
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" 
   required>
     </div>
<div class="form-group">
    <input type="text"
                name="card_no" 
	   class="form-control" 
	   placeholder="New card num"
	  value="<?php if (isset($_POST['card_no'])) echo $_POST['card_no']; ?>" 
      
  required> 
</div>
<div class="form-group">
                <input type="text" 
		  name="exp_m" 
		  class="form-control" 
		  placeholder="New exp Month"
		  value="<?php if (isset($_POST['exp_m'])) echo $_POST['exp_m']; ?>" 
  required>
</div>

<div class="form-group">
                <input type="text" 
		  name="exp_y" 
		  class="form-control" 
		  placeholder="New exp Year"
		  value="<?php if (isset($_POST['exp_y'])) echo $_POST['exp_y']; ?>" 
  required>
</div>

<div class="form-group">
                <input type="text" 
		  name="cvv" 
		  class="form-control" 
		  placeholder="New CVV"
		  value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" 
  required>
</div>

</div>
    <div class="modal-footer">
        <div class="form-group">
          <input type="submit" 
    	        name="btnChangePassword" 
        class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
           </div>
         </div>
 </form>
      </div><!--Close body-->
    </div><!--Close modal-body-->
  </div><!-- Close modal-fade--> 
    