<html>
<?php 
	$name = $_GET['name'];
	$title = $_GET['title'];
	$bookId = $_GET['ISBN'];
		
?>
 <head>
  <meta content='noindex,nofollow' name='robots'>
  <title>customer of XXX book</title>
 </head>

 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg90.jpg'>
<br />
 <table width="95%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">
      <tr bgcolor="#CCEEFF">
          <td align="left" colspan="5">
             <font face="Verdana, Arial, Helvetica" color="blue" size="4"> &nbsp; Customer who had bought“ <?php echo $title ?>”</font>
          </td>
	 </tr>
	 <tr>
              <th bgcolor="#336699" width="10%">
          <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">CustomerId</font>
       </th>
       <th bgcolor="#336699" width="30%">
          <font size="-1" face="Verdana, Arial, Helvetica" color="#FFFFFF">CustomerName</font> 
       </th>
      </tr>
	 <?php 
		include("conn.php");//import database connection
	               $sql = "select * , count(distinct customerId) from (select  s.bookId, c.id as customerId, c.name as customerName from shopping_history s left join customer c
			on s.customerId = c.id where s.bookId ='$bookId' order by customerName)a group by customerId";
		echo "<br>";	
		$query = mysql_query($sql);
		
		while($rs = mysql_fetch_array($query)){
	?>
	    <tr bgcolor="#CCEEFF">
			<td align="center" valign="middle">
			      <font size="-1" face="Arial, Helvetica"><?php echo $rs['customerId']; ?></font>
			</td>
			<td align="center" valign="middle">
			      <font size="-1" face="Arial, Helvetica"><?php echo $rs['customerName']; ?></font>
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

