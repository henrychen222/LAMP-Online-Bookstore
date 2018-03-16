<html>
	<body>
		<?php
					  		  
			include("conn.php");//import database connection

			if ( $_POST['act'] == "Upload" ) {
				
				header( "Content-type: text/html" );
				if (( $_FILES["file"]["type"] == "text/xml" ) && ( $_FILES["file"]["size"] < 50000 )) {
					print_r( $_FILES["file"] ); 
					echo "<br/>";
					if ( $_FILES["file"]["error"] <= 0 ) {
						echo "Upload: <em>" . $_FILES["file"]["name"] . "</em>";
						echo "<br/>";
						echo "Type: <em>" . $_FILES["file"]["type"] . "</em>";
						echo "<br/>";
						echo "Size: <em>" . ceil( $_FILES["file"]["size"] / 1024 ) . " Kb</em>";
						echo "<br/>";
								  
						move_uploaded_file( $_FILES["file"]["tmp_name"], "upload/books.xml" );
						
						echo "Stored in: <em>upload/books.xml</em>";
						echo "<br/><br/><br/><br/><br/>";
                                              						 
						$readXML = simplexml_load_file("upload/books.xml") or die ("Error: systerm cannot get this file");
												
						foreach($readXML->children() as $item){
							$itemIsbn = $item->ISBN;
							$itemTitle = $item->title;
							$itemPrice = $item->price;
							
							$sql = "insert into books (isbn,title,price) values('$itemIsbn','$itemTitle','$itemPrice')";
							mysql_query($sql);
							
						}
						echo "upload sucess ^3^";
						echo "<script>location.href='upload.php'</script> ";
					}
					else {
					    echo "Error: " . $_FILES["file"]["error"];
					    print_r( $_FILES["file"] );
					}
				}
				else {
					echo "Invalid file";
					print_r($_FILES["file"]);                                             
				}
			}
			
			else if ( $_POST['act'] == "Check the upload" ) {
				header( "Location: upload/books.xml" );
			}
                      									
			mysql_close( );

		?>
	</body>
</html>
