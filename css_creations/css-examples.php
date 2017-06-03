<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Front End Examples</title>
<style></style>
<?php require("header.php"); ?>
<style>
	h2{
		text-align:center;}
</style>
<script>
	$(document).ready(function(){
		$(".title-btn").click(function(){

			var datapoint = $(this).text();
			
			//ajax post example name
			$.post("serve-example.php",
			{
				cssdatapoint:datapoint
			},
			function (data, status){
				//alert(data);
				//var display_html = data.replace(/<br>/g,"");
				var pre_code_html = data.replace(/</g, "&lt;");
				//var code_html = pre_code_html.replace(/&lt;br>/g, "<br>");
				
				$("#example-display-container").html(data);//.html(display_html);
				$("#code-display-container").html(pre_code_html);//.html(code_html);
			});
		});
	});
	//handle click
	
	//get json
	//display results
</script>
</head>

<body style="padding-top:50px;">
<?php include("menu.php"); ?>
<div class="container-fluid homepage-container">
	<div class="row">
		<div class="col-md-3">
			<h2 class="h2">List of CSS Examples</h2>
			<ul id="css-examples-list">
			<?php
				//retrieve css example titles from json file
				$json = json_decode(file_get_contents("css-examples.json"), true);
				foreach($json as $item)
				{
					$title = key($json);
					next($json);
					
					echo "<button class=\"btn btn-default btn-block title-btn\">$title</button>";
				}
			?>
			</ul>
		</div>
		<div class="col-md-4">
			<h2 class="h2">Example</h2>
			<div id="example-display-container" style="position:relative;">
			</div>
		</div>
		<div class="col-md-5">
			<h2 class="h2">Code</h2>
			<pre style="white-space:pre-wrap;">
			<div id="code-display-container" style="max-height:600px;overflow-y:auto;word-break:break-all;word-wrap:break-word;">
			</div>				
			</pre>
		</div>
	</div>
</div>
</body>
</html>
