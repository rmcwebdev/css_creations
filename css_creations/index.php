<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Front End Examples</title>
<style></style>
<?php require("header.php"); ?>
<script>
	$(document).ready(function(){
		//user presses a key, uses key up event
		$("#realtime-code-text").keyup(function(){
			//get code text
			var code_text = $(this).val();

			//insert code into code display
			$("#example-display-container").html(code_text);
		});
	});
	
	//user clicked save code, check values
	function saveCode()
	{
		var error_message = "";
		
		//get title
		var title = $("#new-title").val();
		
		//check title
		if(title == "")
			error_message += "Please enter a title\n";
			
		//get code
		var code = $("#realtime-code-text").val();
		
		//check code
		if(code == "")
			error_message+= "Please enter code\n";
			
			
		if(error_message != "")
		{
			alert(error_message);
			return false;
		}
		else
		{
			//save code using ajax
			$.post("save-css.php",
			{
				title:title,
				code:code
			},
			function(data, status){
				alert(data);
			});
			
			return false;
		}
	}
	
	//override certain key events in textarea
	$(document).delegate('#realtime-code-text', 'keydown', function(e) {
		var keyCode = e.keyCode || e.which;
		
		//override default tab function in textarea, make it a real tab
		if (keyCode == 9) {
			e.preventDefault();
			var start = $(this).get(0).selectionStart;
			var end = $(this).get(0).selectionEnd;

			// set textarea value to: text before caret + tab + text after caret
			$(this).val($(this).val().substring(0, start)
						+ "\t"
						+ $(this).val().substring(end));

			// put caret at right position again
			//$(this).get(0).selectionStart =
			$(this).get(0).selectionEnd = start + 1;
		}
		
		//override default "enter" function in textarea, move cursor to previous line start
		if (keyCode == 13) {
			var start = $(this).get(0).selectionStart;
			var end = $(this).get(0).selectionEnd;

			// set textarea value to: text before caret + tab + text after caret
			$(this).val($(this).val().substring(0, start)
						+ "\t"
						+ $(this).val().substring(end));

			//force new line via key event simulation
			//jQuery.event.trigger({ type : 'keypress', which : character.charCodeAt(13) });
			//$("#realtime-code-text").trigger({type: 'keypress', which: character.charCodeAt(13 /*the key to trigger*/)});
			
			// put caret at right position again
			//$(this).get(0).selectionStart =
			$(this).get(0).selectionEnd = start + 1;
		}
	});
</script>
</head>

<body style="padding-top:50px;">
<?php include("menu.php"); ?>
<br>
<div class="container-fluid homepage-container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-8">
			<form action="index.php" method="post" onsubmit="return saveCode()">
				<div class="form-group">
					<input type="text" class="form-control" name="new_title" placeholder="Example Title" id="new-title">
				</div>
				<div class="form-group">
					<textarea class="form-control" rows="28" placeholder="Add code here" name="new_code" id="realtime-code-text"></textarea>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Code</button>
				</div>
			</form>
		</div>
		<div class="col-md-2" style="border:solid 1px black;padding:0px;">
			<div id="example-display-container">
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
</body>
</html>
