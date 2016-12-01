<?php
	session_start();
	if(isset($_SESSION['pass'])){
		header( "refresh:0;url=index.php" );
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			$(function(){
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
				width: 100%;
				min-height: 100%;
				display: block;
				background-color: #232a85;
				padding-bottom: 50px;
			}
			
			img{
				height: 500px;
				width: 500px;
				display: block;
				margin: 0 auto;
			}
			
			#inputs{
				width: 280px;
				margin: 0 auto;
				height: 60px;
			}
			
			#pass{
				height: 60px;
				width: 200px;
				font-size: 3em;
				color:#fff;
				background-color: #000000;
				border: 0;
				text-align: center;
				outline: none;
				display: inline-block;
				float: left;

			}
			
			#sub{
				display: inline-block;
				height: 60px;
				width: 80px;
				border: 0;
				outline: none;
				text-align: center;
				float:right;
				font-size: 1em;
				background-color: #fff;
			}

			#wrong{color:#fff;}			
		</style>
	</head>
	<body>
		<div class="display">
			<img src="images/logo.png" />
			<div id="inputs">
				<form method="post" action="">
					<input type="password" name="pass" id="pass" maxlength="4" autofocus>
					<button type="submit" name="sub" id="sub">Confirm</button>
				</form>
				<?php
					
					include 'connector.php';
					try{
						$a = new Connection();

						if(isset($_POST['sub'])){
							if(isset($_POST['pass'])){
								$p = $_POST['pass'];
								$b = $a->getUser($p);
								if(!empty($b)){
									if($p == $b[2]){
										$_SESSION['pass'] = $b[2];
										$_SESSION['user'] = $b[1];
										$_SESSION['type'] = $b[0];
										echo("<h3 id='wrong'>Logging in...</h3>");
										header( "refresh:2;url=index.php" );
									}
								}else{
									echo("<h3 id='wrong'>Wrong Password entered!</h3>");
									}
							}
						}	
					}catch(PDOException $e){
						echo ($e->getMessage());
					}
							
				?>
			</div>
		</div>
	</body>
</html>