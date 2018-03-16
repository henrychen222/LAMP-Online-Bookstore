<html>
<?php 
	echo $name = $_GET['name'];
	     $title = $_GET['title'];
		
?>
 <head>
  <meta content='noindex,nofollow' name='robots'>
  <title>XXX书的购买者</title>
 </head>

 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg90.jpg'>


<br />
 <table width="95%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">
	<tr bgcolor="#CCEEFF">
       <td align="left" colspan="5">
          <font face="Verdana, Arial, Helvetica" color="blue" size="4"> &nbsp; Customer who had bought “ <?php echo $title ?> ”</font>
       </td>
	 </tr>
	 <tr>
       
       <th bgcolor="#336699" width="15%">
          <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">Title</font> 
       </th>
       <th bgcolor="#336699" width="50%">
          <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">CustomerId</font>
       </th>
       <th bgcolor="#336699" width="17%">
          <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">CustomerName</font> 
       </th>
       <th bgcolor="#336699" width="17%" valign="middle">
          <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">TotalPrices</font>
       </th>
     </tr>
	 <?php 
		include("conn.php");//import database connection
		$sql = 'select * from books order by title';
		$query = mysql_query($sql);
		
		echo 1;
		echo "<br>";
		
		
		while($rs = mysql_fetch_array($query)){
	?>
		 
	 
	    <tr bgcolor="#CCEEFF">
			
			<td align="center" valign="middle">
			        <font size="-1" face="Arial, Helvetica"><a href="detail.html"><?php echo $rs['title']; ?></a></font>
			</td>
			<td>
				<?php echo $rs['customerId']; ?>
			</td>
			<td align="center" valign="middle">
			        <font size="-1" face="Arial, Helvetica"><a href="customerDetail.html"><?php echo $rs['customerId']; ?></a></font>
			</td>
			<td align="center"> 
				<font size="-2" face="Arial, Helvetica">$ <?php echo $rs['price']; ?></font>
				
			</td>
				
		</tr>
	<?php
		}
	?>

 <form method="post" action="http://wenchen.cs.und.edu/cgi-bin/demo/2/5.pl?name= Sponge Bob"> 
     <tr align="center" valign="middle" bgcolor="#CCEEFF">
        <td colspan="5">
          <font face="Verdana, Arial, Helvetica" size="0">
            <input type="submit" name="act" value="Buy"> &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" name="act" value="List"> &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" name="act" value="Main"> &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="submit" name="act" value="Help"> &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="reset"             value="Reset">
          </font>
        </td>
      </tr>
   </form>

 
</table>

  <br /><br /><br /><br /><br />
 </body>
</html>

