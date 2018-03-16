<textarea>
<html>
 <?php 
 include("conn.php");//import database connection
	$name = $_GET['name'];
	$customerId = $_GET['customerId'];
	$keyWords = trim($_GET['keyWords']);
	//add to shopping cart
	if(!empty($_GET['sub1'])){
		$bookId = (String)$_GET['bookId'];
		$bookPrice = $_GET['bookPrice'];
		$sql = "select * from shopping_cart where customerId=$customerId and bookId='$bookId'";
		$query = mysql_query($sql);
		if($rs = mysql_fetch_array($query)){
			$sql = "update shopping_cart set bookNum = bookNum+1 where customerId=$customerId and bookId='$bookId'";
			
		}else{
			$sql = "insert into shopping_cart  (customerId,bookId,bookPrice,bookNum) values ($customerId,'$bookId',$bookPrice,1)";
		}
		$query = mysql_query($sql);
	}
	//delete from shopping cart
	if(!empty($_GET['sub2']) && $_GET['bookNum']>=1){
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
	//Searching
	if(empty($_GET['keyWords'])){
		$sql = "select b.* ,s.customerId,s.bookNum from books b left join shopping_cart s on  b.ISBN = s.bookId  and s.customerId = $customerId order by title ";
		$query = mysql_query($sql);
	}else{
		$keys = $_GET['keyWords'];
		$tempKey = explode(' ',$keys); 
				
		$key = Array();
		for($i=0;$i<count($tempKey);$i++){
			if($tempKey[$i]!=""){
			    Array_push($key,$tempKey[$i]);
			}
		}
		$sql = "select * from (select b.* ,s.customerId,s.bookNum from books b left join shopping_cart s on  b.ISBN = s.bookId  
			and s.customerId = $customerId order by title )a where 1=1";
			
		for($index=0;$index<count($key);$index++) 
		{ 
			if("" != $key[$index]){
				if($index==0){
					$sql = $sql." and a.title like '%$key[$index]%'";
				}else{
					$sql = $sql." or a.title like '%$key[$index]%'";
				}
			}
			
		} 
		
		$sql2 = "select t.*, s.customerId,s.bookNum from(select *,sum(0";
					
		for($index=0;$index<count($key);$index++) 
		{ 
			if("" != $key[$index]){
				$sql2 = $sql2."+(case when instr(title,'$key[$index]')>0 then 1 else 0 end)";
			}	
		}
  
		$sql2 = $sql2.")as cnt from books group by id) t left join shopping_cart s on (t.ISBN = s.bookId and s.customerId = $customerId) where cnt>0 order by cnt desc,title asc";
     			
		$query = mysql_query($sql2);
	}
?>
 <head>
  <meta content='noindex,nofollow' name='robots'>
  <link rel='stylesheet' type='text/css'
    href='http://wenchen.cs.und.edu/css/1.css' />
  <title>shopping main page</title>
 </head>


 <body text='#000000' vLink='#3366CC' link='#3366CC' bgColor='#ffffff' alink='#3366CC' background='http://wenchen.cs.und.edu/figure/bg90.jpg'>


<br />
<center>
 <table width="100%" bgcolor="navy" cellspacing="2" cellpadding="12" border="0" class="shadow">

      <!--line 1-->
      <tr bgcolor="#CCEEFF">
          <td align="left" colspan="6">
             <font face="Verdana, Arial, Helvetica" color="blue" size="4"> &nbsp; hello : <?php echo $name ?></font>
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  <a href="customerAccount.php?customerId=<?php echo $customerId; ?>&name=<?php echo $name; ?>">Customer Account</a>               <!-- turn to check his/her own account-->
		  
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		  <a href="shoppingCart.php?customerId=<?php echo $customerId; ?>&name=<?php echo $name; ?>"><img src="image/shoppingCart.jpg" /></a>  <!-- turn to shopping cart  -->
          </td>
       </tr>
<form method="get" action="">
       
       <!--line 2-->
       <tr>                                  
	  <td align="left" colspan="4">
		<input type="text" name="keyWords" value="<?php echo $_GET['keyWords'];?>" /> 
		     &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
		<input type="submit" size="2" name="search" value="search">
	  </td>
       </tr>
	       <input type="hidden" name="name" value="<?php echo $name; ?>">
	       <input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
</form> 

       <!--line 3-->         
       <tr>                                   
          <th bgcolor="#336699" width="10%">
               <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Num in cart</font>
          </th>
	  <th bgcolor="#336699" width="30%">
               <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Title</font>
          </th>
          <th bgcolor="#336699" width="10%" valign="middle">
               <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Prices</font>
          </th>
	  <th bgcolor="#336699" width="10%" valign="middle">
               <font size="3" face="Verdana, Arial, Helvetica" color="#FFFFFF">Operate</font>
          </th>
        </tr>
	 
	 <?php 
		
		while($rs = mysql_fetch_array($query)){
	 ?>
		<form method="get" action="">

                        <!--line 4-->
			<tr bgcolor="#CCEEFF">         

                                <!--Num in cart-->
				<td align="center">
					<font  face="Arial, Helvetica">
						<?php 
							if($rs['bookNum']>=1){
								echo $rs['bookNum']; 
							}else{
								echo 0;
							}
							
						?>
					</font>
					<input type="hidden" name="bookNum" value="<?php echo $rs['bookNum'] ?>">
				</td>
                                <td>
					<font size="2" face="Arial, Helvetica"><a href="bookDetail.php?ISBN=<?php echo $rs['ISBN']; ?>
					&name=<?php echo $name; ?>&title=<?php echo $rs['title']; ?>"><?php echo $rs['title']; ?></a></font>
				</td>
				
                                <!--Price-->			
				<td align="center"> 
					<input type="hidden" name="bookPrice" value="<?php echo $rs['price']; ?>">
					<font size="2" face="Arial, Helvetica">$ <?php echo $rs['price']; ?></font>
				</td>

                                <!--Operate-->
				<td align="center"> 
					<input type="submit" size="2" name="sub1" value="+">
					&nbsp;<input type="submit" size="1" name="sub2" value="-">
				</td>
			    </tr>
			<input type="hidden" name="name" value="<?php echo $name; ?>">
			<input type="hidden" name="customerId" value="<?php echo $customerId; ?>">
			<input type="hidden" name="keyWords" value="<?php echo $keyWords; ?>">
			<input type="hidden" name="bookId" value="<?php echo $rs['ISBN']; ?>">
		</form>
	<?php
		}
	?>


    
<form method="post" action="http://wenchen.cs.und.edu/cgi-bin/demo/2/5.pl?name= Sponge Bob"> 
     <tr align="center" valign="middle" bgcolor="#CCEEFF">
        <td colspan="4">
          <font face="Verdana, Arial, Helvetica" size="0">
	        <input type="button" value="home" onclick="location.href='Login.php'">
	        <input type="button" name="act" value="back" onclick="javascript:history.back(-1)">
	        <input type="button" value="source" onclick="location.href='source_List_all.php'">
          </font>
        </td>
      </tr>
</form>

 
</table>
</body>
</html>

 </textarea>
 <form method="get" action="">
    <input type="button" value="home" onclick="location.href='Login.php'">
			<input type="button" name="act" value="back" onclick="javascript:history.back(-1)">
		
          </font>
        </td>
		</tr>
	</form>

