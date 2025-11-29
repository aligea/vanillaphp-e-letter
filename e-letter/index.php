<?php
	// query global
	include "config/koneksi.php";
	$sql = mysql_query("select banner from setting");
	$rglobal = mysql_fetch_array($sql);
?>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylogin.css" />
	<script type="text/javascript">
	function flogin(){	
		if(document.frm.usernamesql.value=="" || document.frm.sqlpassword.value=="")
		{
		  alert('Password dan User ID perlu diisi!');
		  return false;
		}
		else
		{
		   document.frm.action="config/ceqlogin.php";
		   document.frm.submit();
		}
	}
	</script>
</head>
<body>
	<div id="header">
		<div class="title"><span><?php echo $rglobal['banner']; ?></span></div>
		<div class="logo"><img src="images/banner/BNI-logo.png" width="110" height="50"></div>
	</div>
	<div id="raw">
		 <div class="raw-img">
			<!-- gambar -->
			<img src="images/banner/Bank-BNI.jpg" width="540" height="320">
		</div>
		
		<div class="raw-login">
			<!-- form login--->
			<div class="raw-login-form">	
				<form name="frm" method="post">
					<table border="0" cellpadding="2" cellspacing="5">
						<tr><td colspan="3"><b>Login</b></tr>
						<tr><td>USER ID :</td><td><input type="text" name="usernamesql"></td></tr>
						<tr><td>Password :</td><td><input type="password" name="sqlpassword"></td></tr>
						<tr><td colspan="2"><input type="image" src="images/button/login.gif" name="submit" onClick="flogin();"/></td></tr>
					</table>
				</form>
			</div>	
		</div>
		
	 </div>	 
	<div id="footer">
		<span>Copyright &copy; 2013 PT. Bank Negara Indonesia(Persero)Tbk</span>
	</div>
</body>
</html>
</body>
</html>
