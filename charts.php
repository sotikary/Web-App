

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

		  <h1> <i class="fa fa-line-chart" aria-hidden="true"></i> <br />
		  Please select a date range and view the graphs 


		  </h1>
          </div>
          <div class="panel-body">

            <form  method="post" action="view_graphs.php">
			  <div class="form-row">

              <div class="form-group col-md-6 align-items-center">
                <label for="date ">From Date:</label>
                <input
                  type="date"
                  class="form-control"
                  id="fromdate"
                  name="fromdate"
				  value="dd/mm/yy"
				  max = "<?php echo $date_cur;?>"
				  />
              </div>
              <div class="form-group col-md-6">
                <label for="number">To date:</label>
                     <input
                  type="date"
                  class="form-control"
                  id="todate"
                  name="todate"
				  value="dd/mm/yy"
				  max = "<?php echo $date_cur;?>"
                />
              </div>
			  
			</div>				                             
			<div class="form-group form-button">
               <input type="submit"  class="form-submit" name="submit" />
			 </div> 

			</form>
			</div>
          </div>
 
        </div>
		</div>
	<div class="col-md-1"> </div>

      </div>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    if (!empty ($_POST['fromdate']) && !empty ($_POST['todate'])){
		
	$minDate = $_POST['fromdate'];
    $maxDate =  $_POST['todate'] ;   
		//check the Date range
		if ($minDate > $maxDate){
			died("lLl");
		} 
	
	}
}
function died($error) {
	 echo '<script type="text/javascript">alert("' . $error . '")
    window.location.href = "data_entry.php"
    </script>';
  }	

?>

  </body>
  

</html>



