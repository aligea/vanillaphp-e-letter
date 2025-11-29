<?php 
  if(isset($_POST['update'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
        $password2 = $_POST['password2'];
		       
	    if($password =='' || $password2 ==''){
            echo"<script>alert('Field must be required!');</script>";
        }
        elseif($password <> $password2){
           echo"<script>alert('password and ulangi password tidak sama!');</script>";
        }
        else{
            /* password harus terdiri dari angka, huruf (besar|kecil) dan min 6 karakter */
			if (preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)){
						$password3 = md5($password.$username);
						$password4 = md5($username.$password3);
						$pswd = mysql_query("UPDATE users SET reset= '0', password ='$password4' where uid = '$_SESSION[uid]'");
						if($pswd > 0){ 
						   $_SESSION['reset'] = 0;
						   echo "<script> document.location.href='home.php?q=dashboard'</script>";
						}
						else{ 
						  echo"<script>alert('Gagal update!');</script>"; 
						}
		    }else{
            echo "<script>alert('password harus terdiri dari 6 karakter, huruf besar, huruf kecil dan angka');</script>";
			
            }
        }
    }
?>

    <html>
    <head><title>Change Password</title>
    <style>
	/** tabel form **/
	.table-form{ 
		margin-top:155px;
		margin-left:350px;
		width:600px;
		color:#000;
		background-color: #fff;
		padding-left:10px;
		padding-right:10px;
		border:1px solid #777;
		box-shadow:#555 2px 2px;
	}
	.table-form td{
		font-family:verdana;
		font-size:12px;
		padding:6px;
		color:#000;
	}
	.table-form td input{ background-color:#eee; border:1px solid #666;}
	.table-form td span { color:#900; }
	</style>
    </head>
    <body>
        <div id="content">
        <form action="home.php" method="post">
            <table class="table-form">
                <tr><th colspan="3">&nbsp; RESET PASSWORD</th></tr>
                <tr>
                	<td colspan="3"><span>Password Strict. Password must be at least 8 characters  and must contain at least one lower case letter, one upper case letter and one digit</span></td>
                </tr>
                <tr>
                	<td>Username</td><td>:</td>
                    <td><b><?php  echo $_SESSION['username']; ?></b><input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>"></td>
                </tr>
                
                <tr>
                	<td>Password<font color="red">*</font></td><td>:</td>
                    <td><input type="password" name="password"></td>
                 </tr>
                
                <tr>
                	<td>Ulangi Password <font color="red">*</font></td><td>:</td>
                    <td><input type="password" name="password2"></td>
                </tr>
                
                <tr><td colspan="3"><input type="submit" value="Update" name="update"></td></tr>
            </table> 
        </form> 
        </div>
   
    </body>
    </html>

