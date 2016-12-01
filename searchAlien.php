<?php
	header ("content-type: application/json; charset=utf-8");
	$conn = new PDO("mysql:host=127.0.0.1;dbname=IS324GH14_Assignment_1;","root","");
	
	$stm = $conn->prepare("CALL getAliensByName(:name);");
	$name = "%".$_POST['input']."%";
	$stm->bindValue(":name",'%'.$name.'%');
	//$stm = $conn->prepare("SELECT * FROM RegisteredAlien WHERE `alienName` LIKE '%j%'");
	$stm->execute();
	$arr = [];
	foreach($stm as $row){
		$str = ("<li>".$row[0]."</li><li>ssn: ".$row[1]."</li><li>home planet: ".$row[2]."</li><li>properties: ".$row[3]."</li><li>danger level: ".$row[4]."</li>");
		$arr[] = $str;
	}
	//print_r($arr);
	echo json_encode($arr);
?>