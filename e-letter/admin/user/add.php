<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah User</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$username = strtoupper($_POST['username']);
			$password = $_POST['password'];
			$password2 = $_POST['password2'];
			$name = $_POST['name'];
			$level = $_POST['level'];
			$status = $_POST['status'];
			$reset = 1;
			
			if(empty($password) || empty($password2) || empty($name)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			elseif($password != $password2){
				 $error = 'Password anda masukkan tidak sama!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
				$password3 = md5($password.$username);
				$password4 = md5($username.$password3);
				$cekUsername=mysql_num_rows(mysql_query("SELECT username FROM USERS WHERE username='$username'"));
					if($cekUsername > 0){
							$error = 'username sudah ada!';
							echo"<div class=alert-error>".$error."</div>";
					}else{
						$sql = mysql_query("insert into users (username,password,name,level,status,reset,hit) values('$username','$password4','$name','$level','$status','$reset',0)");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=user-manage'</script>";
							}
					}		
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=user-add"> 
			<table>
				<tr><td>Username</td><td><input type="text" name="username"></td></tr>
				<tr><td>Password</td><td><input type="password" name="password"></td></tr>
				<tr><td>Ulangi Password</td><td><input type="password" name="password2"></td></tr>
				<tr><td>Nama</td><td><input type="text" name="name"></td></tr>
				<tr>
					<td>Status User</td>
					<td>
						<select name="status">
							<option value="0">Aktif</option>
							<option value="1">Tidak Aktif</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Level</td>
					<td>
						<select name="level">
							<option value="3">Admin Divisi</option>
							<option value="3">Admin Kelompok</option>
							<option value="2">Admin</option>
							<option value="1">Sekretaris</option>
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
		</form><!--end form isian-->
</div><!--end panel-->
