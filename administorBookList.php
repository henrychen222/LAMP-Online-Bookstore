<html>
<?php 
	echo $name = $_GET['name'];
?>
 <head>
  <meta content='noindex,nofollow' name='robots'>
   <title>Manager</title>
 </head>

 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg90.jpg'>
<br />
 <table width="95%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">
	<tr bgcolor="#CCEEFF">
            <td align="left" colspan="5">
              <font face="Verdana, Arial, Helvetica" color="blue" size="4"> &nbsp; hello : <?php echo $name ?></font>
            </td>
	</tr>
	<tr>
   
            <th bgcolor="#336699" width="50%">
              <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">Title</font>
            </th>
            <th bgcolor="#336699" width="17%">
              <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">ISBN</font> 
            </th>
            <th bgcolor="#336699" width="17%" valign="middle">
              <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">Prices</font>
            </th>
         </tr>

	 <?php 
		include("conn.php"); //import database connection
		$sql = 'select * from books order by title';             //ascending sort by title
		$query = mysql_query($sql);
		while($rs = mysql_fetch_array($query)){
	 ?>
		 
	 
	    <tr bgcolor="#CCEEFF">
						
			<td align="center" valign="middle">
                                <!--click the link show all customers who brought this book--> 
				<font size="-1" face="Arial, Helvetica"><a href="administorBookDetail.php?ISBN=<?php echo $rs['ISBN']; ?> 
				&name=<?php echo $name; ?>&title=<?php echo $rs['title']; ?>"><?php echo $rs['title']; ?></a></font>          
			</td>
			<td align="center" valign="middle">
				 <?php echo $rs['ISBN']; ?>
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
			<input type="button" name="act" value="back" onclick="javascript:history.back(-1)">
          </font>
        </td>
      </tr>
   </form>

 
</table>
</body>
</html>

