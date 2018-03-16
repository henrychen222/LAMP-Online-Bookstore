<html>
 <?php 
	include("conn.php");//import database connection

	$ISBN = $_GET['ISBN'];
      
	//searching
        $sql = "select * from books where isbn = '$ISBN'";
	$query = mysql_query($sql);
  
?>
 <head>
  <meta content='noindex,nofollow' name='robots'>
  <link rel='stylesheet' type='text/css'
    href='http://wenchen.cs.und.edu/css/1.css' />
  <title>book Info</title>
 </head>


 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg90.jpg'>

<br />
<center>
 <table width="100%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">
     
      <tr>
        <th bgcolor="#336699" width="45%">
             <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Title</font>
        </th>
        <th bgcolor="#336699" width="15%">
             <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">ISBN</font> 
        </th>
        <th bgcolor="#336699" width="10%" valign="middle">
             <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Prices</font>
        </th>
     </tr>
	 
	 <?php 
		
		if($rs = mysql_fetch_array($query)){
	  ?>
		<form method="get" action="">
			<tr bgcolor="#CCEEFF">
				<td>
					<font size="2" face="Arial, Helvetica"><a href="bookDetail.php?ISBN=<?php echo $rs['ISBN']; ?>
					&name=<?php echo $name; ?>&title=<?php echo $rs['title']; ?>"><?php echo $rs['title']; ?></a></font>
				</td>
				<td align="center" valign="middle">
					<input type="hidden" name="bookId" value="<?php echo $rs['ISBN']; ?>">
					<?php echo $rs['ISBN']; ?>
				</td>
					
				<td align="center"> 
					<input type="hidden" name="bookPrice" value="<?php echo $rs['price']; ?>">
					<font size="2" face="Arial, Helvetica">$ <?php echo $rs['price']; ?></font>
				</td>
				
			</tr>
			<input type="hidden" name="name" value="<?php echo $name; ?>">
			<input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
			<input type="hidden" name="keyWords" value="<?php echo $keyWords; ?>">
		</form>
	<?php
                                                       
		}
	?>
    
	      <form method="post" action="http://wenchen.cs.und.edu/cgi-bin/demo/2/5.pl?name= Sponge Bob"> 
                   <tr align="center" valign="middle" bgcolor="#CCEEFF">
                     <td colspan="6">
                          <font face="Verdana, Arial, Helvetica" size="0">
            			<input type="button" name="act" value="back" onclick="javascript:history.back(-1)">
		          </font>
                     </td>
		   </tr>
	      </form>
</table>
</body>
</html>

