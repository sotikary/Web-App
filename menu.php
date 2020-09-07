<!DOCTYPE html>
<html>
  <head>
    <head>
      <title>Web App</title>
      <meta charset="utf-8">
	    <link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/yourcode.js"></script>


      <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>
  </head>
  <body>
	<?php
	session_start();
if(!isset($_SESSION["name"])) {
	rdrct ("Session is expired. Please sign in again.");
} 



function rdrct($message) {
	 echo '<script type="text/javascript">alert("' . $message . '")
    window.location.href = "login.php"
    </script>';
 // die(Header( "refresh:5;url=data_entry.php" ));
  }
	?>
  <section>

  <nav> 
  <input type="checkbox" id="check" style ="display:none !important;"/>
	<label for="check" class="checkbtn">
	<i class="fa fa-bars" aria-hidden="true"></i>
	</label>
    <label class='sp-default-logo logo col-xs-5'>
		<img src='images/logo.png' style="max-width:250px;"		>
	</label>
	
	   <ul>
            <li>
                <a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a>
            </li>
            <li>
                <a href="data_entry.php"><i class="fa fa-address-book"></i> Data Entry </a>
            </li>
            <li>
                <a href="charts.php"><i class="fa fa-bar-chart"></i> Graph Details</a>
            </li>
      </ul>

  	  	<div class="topbar">
		   <ul>
            <li>
                <a href="index.php"><i class="fa fa-tachometer"></i> Dashboard</a>
            </li>
            <li>
                <a href="charts.php"><i class="fa fa-bar-chart"></i> Graph Details</a>
            </li>
		</ul>
	</div>

  </nav>
  

  </section>
  </body>

     <!--<div class="wrapper">
    <div class="sidebar">
        <h2>Wep App</h2>




    </div>
	
	
 <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="data_entry.php"><i class="fa fa-trash" aria-hidden="true"></i>  Delete Historical data <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="charts.php"><i class="fa fa-user" aria-hidden="true"></i>  Login as</a>
            </li>
            
          </ul>
        </div>
      </nav>
</div>


  

  
    <div class="container">

      </div> -->
</html>