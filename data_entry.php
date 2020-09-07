<!DOCTYPE html>
<html>
  <head>
    <title>Web App</title>

      <meta charset="utf-8">
	    <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">


  </head>
  <body>
  <?php 
include('menu.php');
$date_cur = date('Y-m-d', mktime(date('d'), date('m'), date('Y')));
?>

    <div class="container">
	<div class="row"> </div>
      <div class="row">
	  
	  	  <div class="col-md-1"> </div>

	  <div class="col-xs-12 col-sm-12 col-md-10">
        <div class="panel">
          <div class="panel-heading text-center">

		  <h1> <i class="fa fa-database" aria-hidden="true"></i> <br />
		  Please enter a number of steps for a specific date

		  </h1>
          </div>
          <div class="panel-body">

            <form  method="post" action="">

              <div class="form-group align-items-center">
                <label for="date">Date:</label>
                <input
                  type="date"
                  class="form-control"
                  id="dateS"
                  name="dateS"
				  value="dd/mm/yy"
				  max = "<?php echo $date_cur;?>"
                />
              </div>
              <div class="form-group">
                <label for="number">Steps:</label>
                <input
                  type="number"
                  class="form-control"
                  id="steps"
                  name="steps"
				  value="Specify steps/day"
				  min="1"
				  max="50000"
				  placeholder="Enter steps"
                />
              </div>
			  
			<div class="form-group">
			    <label for="activity">Choose an activity:</label>
				<select id="activity" name="activity"  class="form-control" required>
				    <option value="">Select an activity </option>
					<option value="Running">Running</option>
					<option value="Walking">Walking</option>
					<option value="Biking">Biking</option>
					<option value="Other">Other</option>

				</select>
			</div>				                             
			<div class="form-group form-button">
               <input type="submit"  class="form-submit" name="submit"/>
			 </div>  
            </form>
          </div>
 
        </div>
		</div>
	<div class="col-md-1"> </div>

      </div>
    </div


  </body>
  
 
  <?php	 
$checkDate = $steps = $activity = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']) && isset($_SESSION['name'])) {
	

    if (empty ($_POST['dateS']) || empty ($_POST['steps'])){
		died('There are empty values in the form you submitted.\n Please try again..');	
		exit();
		} 
		
	$checkDate = $_POST['dateS'];
    $steps =  $_POST['steps'] ;
    $activity =  $_POST['activity'] ;
	//$session = $_SESSION['name'];

	//database connection
$conn = mysqli_connect('localhost','root','','webapp');
	if(!$conn){
		died ("Connection failed: \n", mysqli_connect_error());
	} else {

	if (check_if_date_exists ( 'steps', 'dateColumn', $checkDate, $conn )){
		$stmt = mysqli_prepare($conn, "INSERT INTO steps (dateColumn, stepColumn, name, activiity) VALUES (?, ?, ?, ?)" );
        mysqli_stmt_bind_param($stmt, 'siss', $checkDate, $_POST['steps'], $_SESSION['name'], $activity);
			if ( !$stmt ) {
			   died('mysqli error: '.mysqli_error($conn));	
			}
			if ( !mysqli_execute($stmt) ) {
				died ('stmt error: '.mysqli_stmt_error($stmt));
			}
		//mysqli_stmt_execute($stmt);	
		//died('The row is inserted.', mysqli_stmt_affected_rows($stmt));
		mysqli_stmt_close($stmt);		
		// close connection 
		mysqli_close($conn);
	} else{
		died ("You have already entered steps for this date. Please select a new unique date..");
	}

}

}
//check if date exists
function check_if_date_exists ($table, $column, $value, $conn) {
	$session = $_SESSION['name'];
    $query = mysqli_query($conn,"SELECT * FROM steps WHERE dateColumn ='$value' and name = '$session'");
	if(mysqli_num_rows($query) > 0){
	return false;
	} else{
		return true;

/*$stmt = mysqli_prepare($conn, "INSERT INTO steps (dateColumn, stepColumn) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'si', $checkDate, $steps);
		mysqli_stmt_execute($stmt);

			if ( !$stmt ) {
				died('mysqli error: '.mysqli_error($conn));	
			}
			if ( !mysqli_execute($stmt) ) {
				died ('stmt error: '.mysqli_stmt_error($stmt));
			}
		//mysqli_stmt_execute($stmt);	
		died('The row is inserted.\n', mysqli_stmt_affected_rows($stmt));
		mysqli_stmt_close($stmt);		
		// close connection 
		mysqli_close($conn); */
	}
}

function died($message) {
	 echo '<script type="text/javascript">alert("' . $message . '")
    </script>';
  }
	?>

</html>

