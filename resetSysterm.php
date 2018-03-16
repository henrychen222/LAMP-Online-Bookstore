<?php 
	include("conn.php");
	//initialize system
		
		$sql = "delete from shopping_cart ";
		$query = mysql_query($sql);
		$sql = "delete from shopping_history ";
		$query = mysql_query($sql);
		$sql = "delete from customer ";
		$query = mysql_query($sql);
		$sql = "delete from books ";
		$query = mysql_query($sql);
             	echo "reset Systerm success!!!";
?>                      
                     	
            

