<html>
	<head>
		<meta content='noindex,nofollow' name='robots'>
		<link rel="stylesheet" type="text/css"
		href="http://wenchen.cs.und.edu/css/1.css" />
		<title>Interface I</title>
	</head>
	<font size='0'><br /></font>
	<?php
		include("conn.php");
	        $error = "";
	
		if( $_GET['act'] == "Submit" )
		{
			
			if(!empty($_GET['name'])&&!empty($_GET['password'])&&!empty($_GET['comPassword']))   //check if the name is empty or have some text
			{	
				
				if($_GET['password'] != $_GET['comPassword']){
					$error = "type different passwords";
				}else{
					$sql = "SELECT * FROM customer WHERE name = '$_GET[name]' ";					
					$query = mysql_query($sql) or die(mysql_error());					
					$rs = mysql_fetch_array($query);
					
					if(empty($rs['id']))
					{	
						$name = $_GET['name'];
						$password = $_GET['password'];
						$query = "INSERT INTO customer (name,password) VALUES ('$name','$password')";    // put data to dabtabase
						$rs = mysql_query($query) ;
						if($rs)
						{
							$success = "YOUR REGISTRATION IS COMPLETED...";
							echo "<script>location.href='Login.php?isFailed=$success'</script>";
						}else{
							echo "service is bussy...";
						}
					}else{
						$error = "SORRY...YOU ARE ALREADY REGISTERED USER...";
					}
				}
			}
		}       

	     
	?>
	<body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg4.png'>

		<table width='100%' height='80%'>
			<tr>
				<td align='center' valign='middle'>
					<table width="75%" cellspacing="0" cellpadding="15" border="0" class="shadow">
						<form method="get" action="">
							<tr bgcolor="#336699">
								<th id="header" align="left" colspan="3">
									<font face="Verdana, Arial, Helvetica" color="white" size="2"> &nbsp; Register</font>
								</th>
							</tr>
							<tr bgcolor="#CCEEFF">
								<td width="100%" valign="middle">
									<font face="Verdana, Arial, Helvetica" size="2">
										<font size="0"><br /></font>
										&nbsp; &nbsp; &nbsp; Name:
										<input type="text" name="name" size="32" > <br /><font size="0"><br /></font>
										&nbsp; &nbsp; &nbsp; Password:
										<input type="password" name="password" size="12" maxlength="12" >
										&nbsp; &nbsp; &nbsp; Confirm Password:
										<input type="password" name="comPassword" size="12" maxlength="12" >
										<?php echo $error; ?>
									</font>
									<p align="center">
										<input type="submit" name="act" value="Submit">
										&nbsp; &nbsp; &nbsp; &nbsp;
										<input type="button" name="act" value="Cancel" onclick="location.href='Login.php'">

										<br /><font size="0"><br /></font>
									</p>
								</td>
							</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
