<?php
	
       $username = "wchen";
       $password = "w1149396";
       $database = "wchen";
       $host     = "mysqldev.aero.und.edu";

  // Connect to the database.
  $conn  = mysql_connect( $host, $username, $password );

  // Select a database.
  mysql_select_db( $database, $conn );

  
	
?>
