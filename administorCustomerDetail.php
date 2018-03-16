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
	<tr bgcolor="#CCEEFF">
             <td align="left" colspan="5">
                 <font face="Verdana, Arial, Helvetica" color="blue" size="4"> &nbsp; Customer who had bought “ <?php echo $title ?> ”</font>
             </td>
	</tr>
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
		include("conn.php");//import database connection
		$sql = "select s.*, b.title
							  from shopping_history s
							  join books b
								on s.bookId = isbn
							 where customerId = $customerId";
		$query = mysql_query($sql);
		
		while($rs = mysql_fetch_array($query)){
	 ?>
		 
	 
	    <tr bgcolor="#CCEEFF">
		<td align="center" valign="middle">
		      <font size="-1" face="Arial, Helvetica"><?php echo $rs['bookId']; ?></font>
		</td>
		<td align="center" valign="middle">
		       <font size="-1" face="Arial, Helvetica">
                                <!--show a book detail when click it-->
				<a href="bookDetail.php?ISBN=<?php echo $rs[bookId];?>"><?php echo $rs['title']; ?></a>
                       </font>
		</td>
		<td align="center"> 
		       <font size="-2" face="Arial, Helvetica"><?php echo $rs['quentity']; ?></font>
		</td>		
	    </tr>

	  <?php
		 }
	  ?>

 <form method="post" action="http://wenchen.cs.und.edu/cgi-bin/demo/2/5.pl?name= Sponge Bob"> 
     <tr align="center" valign="middle" bgcolor="#CCEEFF">
        <td colspan="5">
          <font face="Verdana, Arial, Helvetica" size="0">
            <input type="button" name="act" value="Back" onclick="javascript:history.back(-1)">
          </font>
        </td>
      </tr>
   </form>

 
</table>
</body>
</html>

