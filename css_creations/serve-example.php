<?php
//this script serves up the appropriate json data
//as specified in an ajax post request
if(isset($_POST['cssdatapoint']))
{
	$datapoint = $_POST['cssdatapoint'];
	
	//connect to json file
	$data = json_decode(file_get_contents("css-examples.json"));
	
	//get data from data point
	$example_code = $data->$datapoint;
	
	//return to sender
	echo $example_code;
}

?>
