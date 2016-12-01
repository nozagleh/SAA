<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			$(function(){
				$(".box").on('click',function(){
					$(".box").hide();
					$(this).addClass('bigBox');
					$(this).show();
				});
				$(".bigBox:hover").on('click',function(){
					$(this).hide();
					});
			});
		</script>
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
				height: 100%;
				width: 100%;
				min-height: 100%;
				display: block;
				z-index: -100;
			}
			
			.menu{
				min-height: 100%;
				width: 250px;
				background-color: #333333;
				float: left;
				color: #fff;
				box-shadow: 5px 0px 10px rgba(0,0,0,0.7);
				z-index: 4;
				position: fixed;
			}
			nav{
				width: 100%;
			}
			nav a{
				text-decoration: none;
				color: #fff;
				width: 235px;
				font-weight: 300;
				font-size: 1.5em;
				text-transform: uppercase;
				letter-spacing: 2px;
				display: block;
				padding-left: 15px;
				padding-top: 15px;
				padding-bottom: 15px;
			}
			nav a:hover{
				background-color: #fff;
				color: #000;
				font-size: 1.7em;
			}
			nav a p{
				display: none; 
				text-transform: none;
				font-size: 0.5em;
				font-weight: 300;
			}
			nav a:hover>p{
				display: block;
			}
			
			.menu img{
				width: 100%;
				height: auto;
				display: block;
				margin: 0 auto;
			}
			.wrapper{
				background-color: #a4a4a4;
				min-height: 100%;
				width: calc(100% - 250px);
				display: block;
				right: 0;
				position: absolute;
				z-index: 2;
				padding-top: 10px;
			}
			
			.box{
				height: 200px;
				width: calc(20% - 30px);
				margin-top: 6px;
				margin-left: 10px;
				margin-right: 10px;
				margin-bottom: 6px;
				display: inline-block;
				background-color: orange;
			}
			.box:hover{
				padding: 3px 5px 3px 5px;
				margin: 3px 5px 3px 5px;
				background-color: indianred;
			}
			
			.bigBox,.bigBox:hover{
				display: block !important;
				height: 800px;
				width: 800px;
				margin: 0 auto;
				margin-top: 5%;
			}
			
			#close{
				display: block;
				height: 50px;
				width: 50px;
				position: relative;
				top: 0;
				left: 0;
				background-color: blue;
			}

		</style>
	</head>
	<body>
		<div class="display">
		<div class="menu">
			<img src="images/logo.png" />
			<nav>
				<a href="">Home</a>
				<a href="">Aliens<p>Get information about each alien registered</p></a>
				<a href="">Agents<p>Get information about every agent working at the agency</p></a>
				<a href="">Planets<p>Information about every planet</p></a>
			</nav>
		</div>
		<div class="wrapper">
		<?php
			include 'connector.php';
			$stm = $dbConn->prepare("SELECT * name,DESC FROM aliens");
			$stm->execute();
			
			foreach($stm as $row){
				echo('<div class="box"><h1>'.$row[0].'</h1><p>'.$row[1].'</p></div>');
			}
		?>
		</div>
		</div>
	</body>
</html>