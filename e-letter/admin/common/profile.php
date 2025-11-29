<!-- panel -->
<div class="panel">
	<div class="panel-heading">Data User Personal</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			
			if(empty($password) || empty($password2)){
				 $error = 'Password must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			elseif($password != $password2){
				 $error = 'Password anda masukkan tidak sama!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
					if (preg_match("#.*^(?=.{6,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password))
					{
						$password3 = md5($password.$username);
						$password4 = md5($username.$password3);
						$sql = mysql_query("update users set password='$password4' where username='$username'");
						if($sql > 0)
						{
							$error = 'Password berhasil di update!';
							echo"<div class=alert-success>".$error."</div>";
						}
					}
					else
					{
						$error = 'password harus terdiri dari 6 karakter, huruf besar, huruf kecil dan angka!';
						echo"<div class=alert-error>".$error."</div>";
					}	
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=profil-user"> 
			<table>
				<tr><td>Username</td><td><input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" readonly></td></tr>
				<tr><td>Password Baru</td><td><input type="password" name="password"></td></tr>
				<tr><td>Ulangi Password Baru</td><td><input type="password" name="password2"></td></tr>
				<tr><td>First Name</td><td><input type="text" name="name" value="<?php echo $_SESSION['name']; ?>"></td></tr>
				<tr><td colspan="2"><input type="submit" value="Simpan" name="simpan"></td></tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->


