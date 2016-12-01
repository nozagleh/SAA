<?php
    $host='127.0.0.1';
    $user='root';
    $pass='';
    $string = '';
    try{
        $dbConn = new PDO("mysql:host=".$host.";dbname=aliens",$user,$pass);
    }catch(PDOException $e){
        $string = $e->getMessage();
        return $string;
    }
?>