<html>
 <?php 
 include("conn.php");//import database connection
	$name = $_GET['name'];
	$customerId = $_GET['customerId'];
	$keyWords = trim($_GET['keyWords']);
	
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
		
                //Long Common Subsequence				
		$sql3 = "";
		$no = count($key);
		
		for($i=0;$i<$no;$i++) 
		{ 
			$strKey = "%";
			$l = 0;
			for($k=$i;$k<$no;$k++){
				
				$sql1 = "";
				$strKey = $strKey.$key[$k]."%" ;
				
				$sql1 = "select *,$l+1 as length from books where title like '$strKey'";
				$query1 = mysql_query($sql1);
				$rs1 = mysql_fetch_array($query1);
				if($rs1){
					$sql3 .= $sql1." union ";
				}
				$l++;
				
			}
		}
		$sqlLen = count($sql3);
		$sql4 = substr($sql3,0,$sqlLen-7);
		
		$sql4 = "select *,max(length) as sorting from (".$sql4.")temp group by title order by sorting desc";
		$query = mysql_query($sql4);
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
          </td>
       </tr>
<form method="get" action="">
       
       <!--line 2-->
       <tr>                                  
	  <td align="left" colspan="3">
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
	 <form method="post" action="shoppingCart.php?customerId=<?php echo $customerId; ?>">
	 <?php 
		
		while($rs = mysql_fetch_array($query)){
			$a=0;
	 ?>
		

                        <!--line 4-->
			<tr bgcolor="#CCEEFF">         
				
				<td>
					<font size="2" face="Arial, Helvetica"><a href="bookDetail.php?ISBN=<?php echo $rs['ISBN']; ?>
					&name=<?php echo $name; ?>&title=<?php echo $rs['title']; ?>"><?php echo $rs['title']; ?></a></font>
				</td>
				
                                <!--Price-->			
				<td align="center"> 
					<input type="hidden" name="bookPrice[]" value="<?php echo $rs['price']; ?>">
					<font size="2" face="Arial, Helvetica">$ <?php echo $rs['price']; ?></font>
				</td>

                                <!--Operate-->
				<td align="center"> 
					
					get:<input type="checkbox" size="2" name="ISBN[]" value="<?php echo $rs['ISBN']; ?>">
				</td>
			    </tr>
		
	<?php
		}
	?>
		
		<tr align="right" valign="middle" bgcolor="#CCEEFF">
			<td colspan="3">
			  <font face="Verdana, Arial, Helvetica" size="0">
				<input type="submit" size="2" name="subtocart" value="put into my cart" >
			  </font>
			</td>
		</tr>
	</form>

    
<form method="post" action="http://wenchen.cs.und.edu/cgi-bin/demo/2/5.pl?name= Sponge Bob"> 
     <tr align="center" valign="middle" bgcolor="#CCEEFF">
        <td colspan="4">
          <font face="Verdana, Arial, Helvetica" size="0">
	        <input type="button" value="Log out" onclick="location.href='Login.php'">
	        <input type="button" name="act" value="back" onclick="javascript:history.back(-1)">
	        <input type="button" value="source" onclick="location.href='source_List_all.html'">
          </font>
        </td>
      </tr>
</form>

 
</table>
</body>
</html>

