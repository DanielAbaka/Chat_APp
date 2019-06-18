<?php 
include 'db.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat App</title>

	<link rel="stylesheet" type="text/css" href="style.css">
	<script>
		function ajax() {

			var req = new XMLHttpRequest();

			req.onreadystatechange = function(){

				if(req.readyState == 4 && req.status == 200){

					document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET','chat.php',true);
			req.send();
		}
		setInterval(function(){ajax()},1000);

	</script>
</head>
<body onload="ajax();">
	<div id="container">
		<div id="chat_box">
			<div id="chat"></div>
		</div>
		<form action="index" method="post">
			<input type="text" name="name" placeholder="Enter Name" required>
			<textarea name="message" placeholder="Enter Message" required></textarea>
			<input type="submit" name="sent" value="send it">
		</form>
		<?php 
			if (isset($_POST['sent'])) {
				$name = $_POST['name'];
				$message = $_POST['message'];

				$query = "INSERT INTO chat_tbl (name,message)VALUES('$name','$message')";
				$run = $con->query($query);
				if ($run) {
					echo "<embed loop='false' src='chat.mp3' hidden='true' autoplay='true'/>";
				}
			}
		 ?>
	</div>
</body>
</html>