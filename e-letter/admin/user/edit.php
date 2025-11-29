<!-- panel -->
<div class="panel">
	<div class="panel-heading">Edit User</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan']))
		{
			$uid = $_POST['uid'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			$name = $_POST['name'];
			$status = $_POST['status'];
			$level = $_POST['level'];
						
			if(empty($name))
			{
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else
			{
				if(empty($_POST['reset']))
				{
						$sql = mysql_query("update users set username='$username',name='$name',status='$status',level='$level' where uid='$uid'");
						if($sql > 0)
						{
							echo "<script> document.location.href='home.php?q=user-manage'</script>";
						}
				}
				else
				{
					$reset = $_POST['reset'];
					
					if(empty($password) || empty($password2))
					{
						 $error = 'Field must be required!';
						 echo"<div class=alert-error>".$error."</div>";
					}
					elseif($password != $password2)
					{
						 $error = 'Password anda masukkan tidak sama!';
						 echo"<div class=alert-error>".$error."</div>";
					}
					else
					{
						if (preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password))
						{
							$password3 = md5($password.$username);
							$password4 = md5($username.$password3);
							$sql = mysql_query("update users set password='$password4',name='$name',status='$status',level='$level',reset='1',hit='0' where uid='$uid'");
							if($sql > 0)
							{
								echo "<script> document.location.href='home.php?q=user-manage'</script>";
							}
						}
						else
						{
							$error = 'password harus terdiri dari 6 karakter, huruf besar, huruf kecil dan angka!';
							echo"<div class=alert-error>".$error."</div>";
						}
					}	
				}
			}
		}
		?>
		
		<!-- query update -->
		<?php
			if(isset($_GET['uid'])){ $uid = $_GET['uid'];}
			$sql = mysql_query("select * from users where uid='$uid'");
			$rsql = mysql_fetch_array($sql);
		?>
		
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=user-edit"> 
			<table>
				<tr><td>Username</td><td><input type="text" name="username" value="<?php echo $rsql['username']; ?>" readonly></td></tr>
				<tr><td>Reset Password?</td><td><input type="checkbox" name="reset" value="yes" onClick="doChangePass()"> Yes &nbsp;</td></tr>
				<tr id="chanpassword" style="display: none;"><td>Password</td><td><input type="password" name="password"></td></tr>
				<tr id="chanpassword2" style="display: none;"><td>Ulangi Password</td><td><input type="password" name="password2"></td></tr>
				<tr><td>Nama</td><td><input type="text" name="name" value="<?php echo $rsql['name']; ?>"></td></tr>
				<tr>
					<td>Status User</td>
					<td>
						<select name="status">
							<option value="0" <?php if($rsql['status']==0){ ?>selected<?php } ?>>Aktif</option>
							<option value="1" <?php if($rsql['status']==1){ ?>selected<?php } ?>>Tidak Aktif</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Level</td>
					<td>
						<select name="level">
							<option value="2" <?php if($rsql['level']==2){ ?>selected<?php } ?>>Admin</option>
							<option value="1" <?php if($rsql['level']==1){ ?>selected<?php } ?>>User</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=user-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['uid']; ?>" name="uid">
		</form><!--end form isian-->
</div><!--end panel-->


<script type="text/javascript">
function doChangePass() 
{
	var tmp1 = document.getElementById('chanpassword');
	var tmp2 = document.getElementById('chanpassword2');
	var thisform = document.frm;
	if(thisform.reset.checked)
	{
	    tmp1.style.display = "";
		tmp2.style.display = "";
	}
	else
	{
	    tmp1.style.display = "none";
		tmp2.style.display = "none";
	}
}
</script>