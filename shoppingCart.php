<html>
 <head>
  <meta content='noindex,nofollow' name='robots'>
  <link rel="stylesheet" type="text/css"
    href="http://wenchen.cs.und.edu/css/1.css" />
	
  <title>shopping cart</title>
 </head>
  <?php 
	include("conn.php");//import database connection
	$name = $_GET['name'];
	$customerId = $_GET['customerId'];
	
	
	
	//add to shopping cart
	if(!empty($_GET['add'])){
		$bookId = (String)$_GET['bookId'];
		$bookPrice = $_GET['bookPrice'];
		$sql = "select * from shopping_cart where customerId=$customerId and bookId='$bookId'";
		$query = mysql_query($sql);
		if($rs = mysql_fetch_array($query)){
			$sql = "update shopping_cart set bookNum = bookNum+1 where customerId=$customerId and bookId='$bookId'";
			
		}
		
		$query = mysql_query($sql);
	}
	//delete from shopping cart
	if(!empty($_GET['delete']) && $_GET['bookNum']>=1){
		$bookId = $_GET['bookId'];
		$bookPrice = $_GET['bookPrice'];
		$sql = "select * from shopping_cart where customerId=$customerId and bookId='$bookId'";
		$query = mysql_query($sql);
		$rs = mysql_fetch_array($query);
		if( $rs['bookNum']>1 ){
			$sql = "update shopping_cart set bookNum = bookNum-1 where customerId=$customerId and bookId='$bookId'";
		}else{
			$sql = "delete from shopping_cart where customerId=$customerId and bookId='$bookId'";
		}
		$query = mysql_query($sql);
		
	}
	
	
	
	//获取list_All传过来的 需要购买的 ISBN ,看是否已存在，若不存在添加进购物车
	$ISBNSS = $_POST['ISBN'];
	$prices = $_POST['bookPrice'];
	
	if(count($ISBNSS)>0){
		for($i=0;$i<count($ISBNSS);$i++){
			$ISBNSS[$i]."<br>";
			$sqlTemp = "select * from shopping_cart where bookId = '$ISBNSS[$i]' and customerId = $customerId ";
			$queryTemp = mysql_query($sqlTemp);
			$rsTemp = mysql_fetch_array($queryTemp);
			if($rsTemp){
				
			}else{
				$sqlTemp2 = "insert into shopping_cart  (customerId,bookId,bookPrice,bookNum) values ($customerId,'$ISBNSS[$i]',$prices[$i],1)";
				$queryTemp2 = mysql_query($sqlTemp2);	
				$sqlArrayNo ++;
			}
		}
	}
	
	

	//获取当前页面的$sqlArray[],用于数据库支付操作
  
	$sqlArray = $_POST['sqlArray'];

	if(!empty($_POST['payAll'])){
		$sql = "delete from shopping_cart  where customerId=$customerId ";
		$query = mysql_query($sql);
		$arrlength=count($sqlArray);
		
		for($x=0;$x<$arrlength;$x++){
			$sqlDill = $sqlArray[$x];
			mysql_query($sqlDill);
		}
		
	}

?>
 <font size='0'><br /></font>

 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg4.png'>

   <table width='100%' height='80%' >
		
      <tr>
        <td align='center' valign='middle'>

		 <table width="75%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">
            
				<tr bgcolor="#CCEEFF">
			          <td colspan="4"><?php echo $name; ?>‘s shoppingcart" </td>
                  
				</tr>
				<tr bgcolor="#336699">
					
					<td><font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">title</font></td>
				       
					<td><font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">amount</font></td>
				       
					<td><font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">price</font></td>
					
					<td><font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Operate</font></td>
				</tr>

				<?php 
					//循环打印shopping_cart列表
					$sql = "select * From (select b.* ,s.customerId,s.bookNum from books b right join shopping_cart s on  b.ISBN = s.bookId)a
						where customerId = $customerId order by title ";
					$query = mysql_query($sql);
					
					while($rs = mysql_fetch_array($query)){
						$whileIsbn = $rs['ISBN'];
						$whileCustomerId = $rs['customerId'];
						$whileTitle = $rs['title'];
						$whilebookAmount = $rs['bookNum'];
						$whilePrice = $rs['price'];
						
						$whileSql = "select * from shopping_history where bookId = '".$whileIsbn."' and customerId = $whileCustomerId";
						
						$whileQuery = mysql_query($whileSql);
						if($whileRs = mysql_fetch_array($whileQuery)){
							$sqlTemp= "update shopping_history set quentity = quentity+$whilebookAmount 
										where bookId = '".$whileIsbn."' and customerId = $whileCustomerId";
							
						}else{
							$sqlTemp= "insert into shopping_history (bookId,customerId,quentity) values('".$whileIsbn."',$whileCustomerId,$whilebookAmount)";
							
						}
				?>
					<form method="get" action="">
					<tr bgcolor="#CCEEFF">
						
						<!--title-->
						<td>
							<a href="bookDetail.php?ISBN=<?php echo $whileIsbn; ?>"><?php echo $whileTitle; ?></a>
						</td>
						<!--bookAmount-->
						<td>
							<font size="2" face="Arial, Helvetica"><?php echo $whilebookAmount; ?></font>
							<input type="hidden" name="bookNum" value="<?php echo $whilebookAmount; ?>">
						</td>
						<!--price-->
						<td>
							<font size="2" face="Arial, Helvetica">$:<?php echo $whilePrice; ?></font>
						</td>
						<td align="center"> 
						<!--operate-->
						<input type="submit" size="2" name="add" value="+">
						&nbsp;<input type="submit" size="1" name="delete" value="-">
						</td>
					</tr>
					
					<input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
					<input type="hidden" name="bookId" value="<?php echo $rs['ISBN']; ?>">
					</form>
					
				<?php
					
					$array[] = $sqlTemp;
					}
					
				?> 
				
				<form method="post" action="">
					
				<?php
					//html 通过表单将php数组传到另一个页面：多个sqlArray[]
					for($ii=0;$ii<count($array);$ii++){
					
						echo "<input type='hidden' name='sqlArray[]' value=\"".$array[$ii]."\">";	
						
					}
				
				?> 
							
				<tr bgcolor="#336699">
					<td> 
						<font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">total Num</font>
					</td>
					<td>
						<?php 
						$sql = "select sum(price*bookNum) as totalPrice,sum(bookNum) as totalBookNum From (select b.* ,s.customerId,s.bookNum from books b right join shopping_cart s on  b.ISBN = s.bookId)a
							where customerId = $customerId order by title ";
							$query = mysql_query($sql);
							$rs = mysql_fetch_array($query);
						?>
						
						<font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF"><?php echo $rs['totalBookNum']; ?></font>
					</td>
					<td>
						<font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">$:<?php echo $rs['totalPrice']; ?></font>
					</td>
					<td>
						<font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF"></font>
					</td>
				</tr>

				</table>
				
					&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
				  
					<input type="hidden" name="name" value="<?php echo $name; ?>">
					<input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
					<input type="submit" name="payAll" value="pay" >
					&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
					&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
					<input type="button" value="home" onclick="location.href='Login.php'">
			
				</tr>

			</form>
		</table>
		
	</body>
</html>
