<?php
//This script adds css code to a json file for later retrieval
if(isset($_POST['title'],$_POST['code']))
{
	//get all json
	$json = json_decode(file_get_contents("css-examples.json"), true);
	
	//get title
	$title = $_POST['title'];

	//get code
	$code = $_POST['code'];
	
	//add json
	$json["$title"] = $code;

	//write to file
	$save_json = file_put_contents("css-examples.json", json_encode($json));
	
	if($save_json)
		echo "Json was saved successfully.";
	else
		echo "An error has occured. Please check code and try again.";
}	
?>
