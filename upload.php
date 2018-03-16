<html>
 <head>
  <meta name="robots" content="noindex,nofollow">
  <link rel="stylesheet" type="text/css"
    href="http://wenchen.cs.und.edu/css/1.css" />
  <title>Upload interface</title>
 </head>

 <body text="#000000" vLink="#3366CC" link="#3366CC" bgColor="#ffffff" alink="#3366CC" background="http://wenchen.cs.und.edu/figure/bg577.jpg">
   <br /><br /><br /><br />

 <center>
    <table width="85%" cellspacing="0" cellpadding="10" border="0" bgcolor="#CCEEFF" class="shadow">
      <tr bgcolor="#336699">
        <th id="header" align="left" colspan="2">
          <font face="Verdana, Arial, Helvetica" color="white" size="2"> &nbsp; Upload a Book List.</font>
        </th>
      </tr>
	  
    <form action="uploadOperate.php" method="post" enctype="multipart/form-data">
      <tr bgcolor="#CCEEFF">
        <td width="70%" valign="middle">
          <font face="Verdana, Arial, Helvetica" size="2"> &nbsp; A book list (XML): <br /><br class="s" />  &nbsp;
               
			   <input type="file" name="file" id="file" size="60"> <br /><br class="s" />
          </font>
         </td>
       <td width="30%" align="center" valign="middle">
			
          <input type="submit" name="act" value="Upload">
           <br /><br class="s" />
	  <input type="submit" name="act" value="Check the upload">
           <br /><br class="s" />
</form>
          <input type="submit" name="act" value="back" onclick="javascript:history.back(-1)">
           <br /><br class="s" />
       </td>
     </tr>
   
 
</table>
</center>
<br />

 </body>
</html>
