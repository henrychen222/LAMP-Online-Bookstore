<html>
<?php 
	echo $name = $_GET['name'];
		
		
?>
 <head>
  <meta content='noindex,nofollow' name='robots'>
  <title>all customer</title>
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
             <th bgcolor="#336699" width="15%">
                 <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">ACCOUNT ID</font> 
             </th>
             <th bgcolor="#336699" width="50%">
                 <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">ACCOUNT Name</font>
             </th>
             <th bgcolor="#336699" width="17%" valign="middle">
                 <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">Price Amount</font>
             </th>
         </tr>

	 <?php 
		include("conn.php");//import database connection
		$sql = 'select b.*, c.name
				  from (select sum(price*quentity) as amount, customerId
						 from (select s.*, b.price
							  from shopping_history s
							  join books b
						          on s.bookId = b.isbn) a
						 group by customerId) b
				  join customer c
				  on b.customerId = c.id order by name asc';
		$query = mysql_query($sql);
		
		while($rs = mysql_fetch_array($query)){
	   ?>
		 
	 
	        <tr bgcolor="#CCEEFF">
			<td align="center" valign="middle">
				<font size="-2" ><?php echo $rs['customerId']; ?></font>
			</td>
			<td align="center" valign="middle">
                                <!--click the link show all books brought by this customer--> 
				<font size="-1" ><a href="administorCustomerDetail.php?customerId=<?php echo $rs['customerId']; ?>">
				<?php echo $rs['name']; ?></a></font>
			</td>
			<td align="center" valign="middle">
				 $ <?php echo $rs['amount']; ?>
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

