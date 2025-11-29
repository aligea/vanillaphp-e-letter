<?php 
  include "config/koneksi.php"; 
  
  if(isset($_POST['update'])){
		$username = $_POST['username'];
		$resetCode = $_POST['resetCode'];
              
	    if($username =='' || $resetCode ==''){
            echo"<script>alert('Field must be required!');</script>";
        }
        else{
				$w = mysql_fetch_array(mysql_query("select * from users where username='$username' and reset_code='$resetCode'"));
				if(strcmp($w['username'],$username)==0 && strcmp($w['reset_code'],$resetCode)==0){ 
					 header("Location: resetpswd_confirm.php?u=".$w['username'].""); 
				}
				else{ 
					 echo"<script>alert('Username atau Code Reset tidak sama!');</script>"; 
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
        <form action="resetpswd.php" method="post">
            <table class="table-form">
                <tr><th colspan="3">&nbsp; Forgot Password</th></tr>
                <tr>
                	<td colspan="3"><span>Username Strict. Username must be same.</span></td>
                </tr>
                <tr>
                	<td>Username<font color="red">*</font></td><td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
				<tr>
                	<td>Code Reset<font color="red">*</font></td><td>:</td>
                    <td><input type="text" name="resetCode"></td>
                </tr>
                <tr><td colspan="3"><input type="submit" value="Save" name="update"> &nbsp;&nbsp; <a href="index.php"><input type="button" value="Cancel"></a></td></tr>
            </table> 
        </form> 
        </div>
   
    </body>
    </html>

