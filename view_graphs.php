<!DOCTYPE html>
<html>

<head>
 <head>
    <title>Web App</title>

      <meta charset="utf-8">
	    <link rel="stylesheet" href="style.css">
		       <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
  <style>
  
    #piechart {
        width: 100%;
		padding:20px 40px;
        min-height: 400px !important;
		    box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    -moz-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    -webkit-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    -o-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    -ms-box-shadow: 0px 15px 16.83px 0.17px rgba(0, 0, 0, 0.05);
    border-radius: 20px;
    -moz-border-radius: 20px;
    -webkit-border-radius: 20px;
    -o-border-radius: 20px;
    -ms-border-radius: 20px;
    }

    .row {
        margin: 40px auto !important;
    }
</style>
 
  
  
</head>
   <body>
   
<?php	 
include('menu.php');
$date_cur = date('Y-m-d', mktime(date('d'), date('m'), date('Y')));
$minDate = $maxDate = "";
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    if (empty ($_POST['fromdate']) && empty ($_POST['todate'])){
		died('There are empty values in the form you submitted.\n Please try again..');	
		exit();
		} else{ 

		   $minDate = $_POST['fromdate'];
           $maxDate =  $_POST['todate'] ;
		}
			
		
	
$conn = mysqli_connect('localhost','root','','webapp');
	if(!$conn){
		died ("Connection failed: \n", mysqli_connect_error());
	} 
	//else{


//}

	}



	?>   
   

<div class="row"> </div>

<div class="row">
<div class="col-md-1"> </div>

 <div class="col-xs-10 col-sm-10 col-md-10">
<div id="piechart"></div>
</div>
<div class="col-md-1"> </div>

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {packages: ['corechart','line']});  
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Steps', 'Steps per Day'],
  <?php
	$minDate = $_POST['fromdate'];
    $maxDate =  $_POST['todate'] ;   

	//change date format
	$date = str_replace('/"', '-', $minDate);  
	$newMinDate = date("Y/m/d", strtotime($date)); 
		   
		   
	$dateMax = str_replace('/"', '-', $maxDate);  
	$newMaxDate = date("Y/m/d", strtotime($dateMax)); 
		   
  		    $sql = "SELECT dateColumn, stepColumn FROM steps where dateColumn >= '$newMinDate' and dateColumn <= '$newMaxDate'";
         $query = mysqli_query($conn, $sql) or die(mysqli_error());
	//if(mysqli_num_rows($query) > 0){

          while ($result = mysqli_fetch_assoc($query)) {
			  //$data[] =$result; 
			echo "['".$result['dateColumn']."',".$result['stepColumn']."],";
	}
	
	//} 

  ?>
 
]);

          // Set chart options
            var options = {'title' : 'Total number of steps/days',
               hAxis: {
                  title: 'Date'
               },
               vAxis: {
                  title: 'Steps'
               },   
	   
			   
               backgroundColor: '#f1f8e9'
            };

            // Instantiate and draw the chart.
            var chart = new google.visualization.LineChart(document.getElementById('piechart'));
            chart.draw(data, options)
}

         google.charts.setOnLoadCallback(drawChart);

</script>

</body>


<?php
function died($error) {
	 echo '<script type="text/javascript">alert("' . $error . '")
    window.location.href = "charts.php"
    </script>';
 // die(Header( "refresh:5;url=data_entry.php" ));
  }
?>

</html>