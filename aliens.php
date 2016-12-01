<?php
	session_start();
	if(isset($_SESSION['pass'])){
		
	}else if(!isset($_SESSION['pass'])){
		header("Refresh: 0; url=error.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			$(function(){
				$("#search").focus(function(){
					$("#search").val("");
					$(".boxes").show();
					$(".boxesNew").hide();
				});
				$("#search").focusout(function(){
					$("#search").val("Search...");
					$(".boxes").show();
					$(".boxesNew").hide();
				});
			
				$("#search").keyup(function(e){
					$(".boxes").hide();
					$(".boxesNew").show();
					$(".boxesNew").html("");
					var input = $(this).val();
					$.ajax({
						type:"POST",
						url:"searchAlien.php",
						data: {input: input},
						success: function(html){
							if(html){
								$.each(html, function(i, item){
									$(".boxesNew").append('<div class="box registered"><ul>'+item+'</ul></div>');
								});
								
							}else{
								alert("error");
							}
						}
					});
					
					if($("#search").val() == ""){
						$(".boxes").show();
						$(".boxesNew").hide();
					}
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
				/*font-family: 'Source Code Pro' ;
				font-family: 'Poiret One', cursive;*/
				font-family: 'Audiowide', cursive;
			}
			
			.display{
				height: 100%;
				width: 100%;
				min-height: 100%;
				display: block;
				z-index: -100;
			}
			
			.menu{
				font-family: 'Poiret One', cursive;
				min-height: 100%;
				width: 200px;
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
				width: 185px;
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
				background-color:#595959;
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
			}
			.wrapper{
				background-color: #cdcdcd;
				min-height: 100%;
				width: calc(100% - 280px);
				display: block;
				right: 0;
				position: absolute;
				z-index: 2;
				padding-top: 10px;
			}
			
			.box{
				margin: 10px;
				padding: 10px;
				display: inline-block;
				background-color: #2f2f2f;
				color: #fff;
			}
			.box:hover{
				background-color: indianred;
			}
			
			.box ul{
				
			}
			
			.box li{
				text-align: center;
				font-weight: 700;
				margin-top: 5px;
				list-style: none;
			}
			.box li:first-child{
				font-size: 1.5em;
			}
			.registered li:nth-child(2){
				font-size: 1em;
				margin-bottom: 20px;
			}
			
			.unregistered{
				background-color: #f00c0c;
			}
			
			.search{
				width: inherit;
				height: 60px;
				margin: 0 auto;
				display: block;
				background-color: #000;
			}
			
			.search input{
				height: 60px;
				width: 50%;
				border: 0;
				outline: none;
				font-size: 3em;
				letter-spacing: 5px;
				color: #fff;
				background-color: #000;
				padding-left: 20px;
			}
			
			

		</style>
	</head>
	<body>
		<div class="display">
		<div class="menu">
			<img src="images/logo.png" />
			
			<nav>
				<?php
				echo('<a href="agentInfo.php">'.$_SESSION['user'].'<p>Agent information panel</p></a>');
			?>
				<a href="index.php">Home</a>
				<a href="#">Aliens<p>Get information about each alien registered</p></a>
				<a href="races.php">Races<p>Information on all races discovered</p></a>
				<a href="agents.php">Agents<p>Get information about every agent working at the agency</p></a>
				<a href="campaigns.php">Campaigns<p>Information about every campaign at the agency</p></a>
				<a href="reports.php">Reports<p>All reports that have been created</p></a>
				<a href="logout.php">Log out</a>
			</nav>
		</div>
		<div class="wrapper">
			<div class="search"><input type="text" name="search" id="search" value="Search..." autocomplete="off"/></div>
			<div class="boxes">
		<?php
			include 'connector.php';
			try{
				$a = new Connection();
				$a->getAliens();
			}catch(PDOException $e){
				echo ($e->getMessage());
			}
			
		?>
			</div>
			<div class="boxesNew"></div>
		</div>
		</div>
	</body>
</html>