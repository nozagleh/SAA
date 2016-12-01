<?php
	session_start();
	if(isset($_SESSION['pass'])){
		header( "refresh:2;url=index.php" );
	}else{
		header( "refresh:2;url=splash.php" );
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
		<style type="text/css">
			*{margin: 0;padding: 0;}
			html,body{
				height: 100%;
				min-height: 100%;
			}
			body{
				width: 100%;
				background-color: #cdcdcd;
				font-family: 'Source Code Pro' ;
			}
			
			.display{
				width: 100%;
				min-height: 100%;
				display: block;
				background-color: #232a85;
			}
			
			img{
				height: 500px;
				width: 500px;
				display: block;
				margin: 0 auto;
			}
			
			#logout{
				width: 280px;
				margin: 0 auto;
				height: 60px;
				color: #fff;
			}
			
			
		</style>
	</head>
	<body>
		<div class="display">
			<img src="images/logo.png" />
			<div id="logout">
				<h1>Access denied</h1>
			</div>
		</div>
	</body>
</html>