<!DOCTYPE html>
<html>
  <head>
    <head>
      <title>Web App</title>
      <meta charset="utf-8">
		<script src="script.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<link rel="stylesheet" href="css/signin.css">



    </head>
  </head>

<body style="">


    <div class="main">
     <!-- Sing in Form -->
        <section class="sign-in">
            <div class="container">
				<div class="row">
                <div class="signin-content">
                    <div class="signin-image col-xs-5 col-sm-9 col-md-6">
                        <figure><img src="images/signinimage.jpg" alt="sing up image" class="img-fluid"></figure>

                    </div>
                    
                    <div class="signin-form col-xs-8 col-sm-8 col-md-6">
                        <h2 class="form-title"></h2>
						<form method="POST"  action="" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="fa fa-user" aria-hidden="true"></i></label>
                                <input type="text" name="name" id="name" placeholder="Sign in with your name" maxlength="10" autocomplete="on" required="">
                            </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Sign in">
                            </div>
                        </form>
                       
                    </div>
                </div>
				</div>
            </div>
        </section>

    </div>

</body>  

<?php
session_start();
$intVar=$name="";

// Storing session data
if(count($_POST)>0) {
  $_SESSION["name"]=$_POST["name"];
  $intVar = null;
  $con = mysqli_connect('localhost','root','','webapp') or die ("Unable to connect:");
  $query = mysqli_query($con,"SELECT * FROM login WHERE name ='$name'");

if(mysqli_num_rows($query) > 0){ 
$_SESSION["name"]=$_POST["name"];
} 
else {
$stmt = mysqli_prepare($con, "INSERT INTO login (id, name) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, 'ss', $intVar, $name);
	if ( !$stmt ) {
		die('mysqli error: '.mysqli_error($con));	
	}
	if ( !mysqli_execute($stmt) ) {
		die ('stmt error: '.mysqli_stmt_error($stmt));
		}
		
		mysqli_stmt_close($stmt);		
		// close connection 
		mysqli_close($con);
}
	if(isset($_SESSION["name"])) {
		header("Location:data_entry.php");
	}

}


function died($error) {
	 echo '<script type="text/javascript">alert("' . $error . '")
    window.location.href = "data_entry.php"
    </script>';
  }
?>
</html>


