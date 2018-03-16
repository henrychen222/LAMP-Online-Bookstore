<html>
<?php 
	$customerId = $_GET['customerId'];
?>

 <head>
  <meta content='noindex,nofollow' name='robots'>
  <title>XXX shopping list</title>
 </head>

 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg90.jpg'>


<br />
 <table width="95%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">
	
	 <?php 
			include("conn.php");//import database connection
				$sql = "select * from customer where id = $customerId";
				$query = mysql_query($sql);
				$rs = mysql_fetch_array($query);
	 ?>
           <!--line 1-->
	 <tr bgcolor="#CCEEFF">
            <td align="left" colspan="3">
			<font face="Verdana, Arial, Helvetica" color="blue" size="4"> &nbsp; Customer Detail  </font>
                              &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		              &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		                ID:&nbsp;<?php echo $rs['id'];?>
		              &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		              &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		                Name:&nbsp;<?php echo $rs['name'];?>
            </td>
	 </tr>

          <!--line 2-->
	 <tr>
            <th bgcolor="#336699" width="10%">
                       <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">ISBN</font>
            </th>
            <th bgcolor="#336699" width="30%">
                       <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">TITLE</font> 
            </th>
            <th bgcolor="#336699" width="20%" valign="middle">
                       <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">QUENTITY</font>
            </th>
         </tr>
	 
	 <?php 
		$sql = "select s.*, b.title
							  from shopping_history s
							  join books b
								on s.bookId = isbn
							 where customerId = $customerId";
		$query = mysql_query($sql);
		
		while($rs = mysql_fetch_array($query)){
	 ?>
		 
	    <!--line 3-->
	    <tr bgcolor="#CCEEFF">
			<td align="center" valign="middle">
				<font size="-1" face="Arial, Helvetica"><?php echo $rs['bookId']; ?></font>
			</td>
			<td align="center" valign="middle">
				 <font size="-1" face="Arial, Helvetica"><a href="bookDetail.php?ISBN=<?php echo $rs['bookId'];?>">
				 <?php echo $rs['title']; ?></a></font>
			</td>
			<td align="center"> 
				 <font size="-2" face="Arial, Helvetica"><?php echo $rs['quentity']; ?></font>
			</td>		
	     </tr>
	<?php
		}
		$sql = "select *
				  from (select sum(price * quentity) as totalPrice, customerId
						  from (select s.*, b.price
								  from shopping_history s
								  join books b
									on s.bookId = b.isbn) a
						 group by customerId) d
				 where customerId = $customerId";
		$query = mysql_query($sql);
		$rs = mysql_fetch_array($query);
	 ?>
             
             <!-- line 4 -->
	     <tr bgcolor="#CCEEFF">
                         <td align="center" valign="middle" colspan="2">
				 <font  >All of your shopping history is here , and you had payed :</font>
			 </td>
			 <td align="center"> 
				 <font  >$ :<?php echo $rs['totalPrice']; ?></font>
			 </td>
	     </tr>

 <form method="post" action="http://wenchen.cs.und.edu/cgi-bin/demo/2/5.pl?name= Sponge Bob"> 
     <tr align="center" valign="middle" bgcolor="#CCEEFF">
        <td colspan="3">
          <font face="Verdana, Arial, Helvetica" size="0">
            <input type="button" name="act" value="Back" onclick="javascript:history.back(-1)">
          </font>
        </td>
      </tr>
   </form>
 
</table>
</body>
</html>

