<?php
	class Connection{
		
		private static $host = "127.0.0.1";
		private static $dbName = "IS324GH14_Assignment_1";
		private static $user = "root";
		private static $passw = "";
		
		function Connection(){
			
		}
		
		function getAliens(){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("SELECT * FROM getRegisteredAliens;");
				$stm->execute();
				foreach($stm as $row){
					echo('<div class="box registered"><ul><li>'.$row[1].'</li><li>ssn: '.$row[0].'</li><li>race: '.$row[5].'</li><li>planet: '.$row[2].'</li><li>properties: '.$row[4].'</li><li>danger: '.$row[3].'</li></ul></div>');
				}
				
				$stm = $conn->prepare("SELECT * FROM getUnregisteredAliens;");
				$stm->execute();
				foreach($stm as $row){
					echo('<div class="box unregistered"><ul><li>'.$row[0].'</li><li>race: '.$row[3].'</li><li>danger: '.$row[1].'</li><li>properties: '.$row[2].'</li></ul></div>');
				}
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			
		}
		
		function getUser($password){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("SELECT `agentType`,`agentName`,`agentPassword` FROM Agent WHERE `agentPassword` = :p");
				$stm->bindParam(":p",$password);
				$stm->execute();
				$arr = [];
				foreach($stm as $row){
					$arr[] = $row[0];
					$arr[] = $row[1];
					$arr[] = $row[2];
				}

				return $arr;
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}

		}
		
		function getAgents(){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("SELECT * FROM getAgents");
				$stm->execute();
				
				foreach($stm as $row){
					if($row[4] == 0){
						echo('<div class="box agent"><ul><li>Agent nr: '.$row[0].'</li><li>Real name: '.$row[1].' '.$row[2].'</li><li>Skill: '.$row[3].'</li><li>Type: Field</li></ul></div>');
					}else if($row[4] == 1){
						echo('<div class="box agent"><ul><li>Agent nr: '.$row[0].'</li><li>Real name: '.$row[1].' '.$row[2].'</li><li>Skill: '.$row[3].'</li><li>Type: Coordinator</li></ul></div>');
					}else if($row[4] == 2){
						echo('<div class="box agent"><ul><li>Agent nr: '.$row[0].'</li><li>Real name: '.$row[1].' '.$row[2].'</li><li>Skill: '.$row[3].'</li><li>Type: Administrator</li></ul></div>');
					}else if($row[4] == 3){
						echo('<div class="box agent"><ul><li>Agent nr: '.$row[0].'</li><li>Real name: '.$row[1].' '.$row[2].'</li><li>Skill: '.$row[3].'</li><li>Type: Manager</li></ul></div>');
					}
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		function getRaces(){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("SELECT * FROM getRaces");
				$stm->execute();
				
				foreach($stm as $row){
					if($row[0] != "SECRET"){
						echo('<div class="box"><ul><li>'.$row[0].'</li><li>'.$row[1].'</li></ul></div>');
					}
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		function getAgentInfo($username){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("CALL getAgentInfo(:user)");
				$stm->bindParam(":user",$username);
				$stm->execute();
				$arr = [];
				foreach($stm as $row){
					echo('<div class="agentInfo">');
					if($row[5] == 0){
						echo("<ul><li>Agents Number: ".$row[0]."</li><li>Agents Firstname: ".$row[1]."</li><li>Agents Lastname: ".$row[2]."</li><li> Agents Wages: ".$row[3]."</li><li> Agents Specialities: ".$row[4]."</li><li>Agents type: Field</li></ul>");
					}else if($row[5] == 1){
						echo("<ul><li>Agents Number: ".$row[0]."</li><li>Agents Firstname: ".$row[1]."</li><li>Agents Lastname: ".$row[2]."</li><li> Agents Wages: ".$row[3]."</li><li> Agents Specialities: ".$row[4]."</li><li>Agents type: Coordinator</li></ul>");
					}else if($row[5] == 2){
						echo("<ul><li>Agents Number: ".$row[0]."</li><li>Agents Firstname: ".$row[1]."</li><li>Agents Lastname: ".$row[2]."</li><li> Agents Wages: ".$row[3]."</li><li> Agents Specialities: ".$row[4]."</li><li>Agents type: Administrator</li></ul>");
					}else if($row[5] == 3){
						echo("<ul><li>Agents Number: ".$row[0]."</li><li>Agents Firstname: ".$row[1]."</li><li>Agents Lastname: ".$row[2]."</li><li> Agents Wages: ".$row[3]."</li><li> Agents Specialities: ".$row[4]."</li><li>Agents type: Manager</li></ul>");
					}
					echo("</div>");
					
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		function getCampaigns(){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("CALL getCampaigns");
				$stm->execute();
				
				foreach($stm as $row){
					echo('<div class="box"><ul><li>'.$row[0].'</li><li>terrain details: '.$row[1].'</li><li>incident: '.$row[2].'</li><li>campaign start: '.$row[3].'</li><li>incident description: '.$row[4].'</li></ul></div>');
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		function getReports(){
			$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";",self::$user,self::$passw);
			try{
				$stm = $conn->prepare("SELECT title FROM Report");
				$stm->execute();
				$secSTM = $conn->prepare("SELECT * FROM ReportRow");
				$secSTM->execute();
				foreach($stm as $row){
					echo('<div class="box"><ul><li>'.$row[0].'</li>');
					foreach($secSTM as $secROW){
						if($secROW[2] == $row[0]){
							echo('<li>'.$secROW[1].'</li>');
						}
						else{
							break;
						}
					}
					echo('</ul></div>');
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		
		
		
		
		
		
	}
?>