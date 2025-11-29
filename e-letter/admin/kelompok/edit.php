<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Data Kelompok</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$uid = $_POST['uid'];
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$no_rubrik = $_POST['no_rubrik'];
						
			if(empty($kode) || empty($nama) || empty($no_rubrik)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("update kelompok set kode='$kode',nama='$nama',no_rubrik='$no_rubrik' where uid='$uid'");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=kelompok-manage'</script>";
							}
			}
		}
		?>
		
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$sql = mysql_query("select * from kelompok where id='$id'");
			$rsql = mysql_fetch_array($sql); 
		?>	
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=kelompok-edit"> 
			<table>
				<tr><td>Kode</td><td><input type="text" name="kode" value="<?php echo $rsql['kode']; ?>"></td></tr>
				<tr><td>Nama Kelompok</td><td><input type="text" name="nama" size="50"value="<?php echo $rsql['nama']; ?>"></td></tr>
				<tr><td>Nomor Rubrik</td><td><input type="text" name="no_rubrik" size="50"value="<?php echo $rsql['no_rubrik']; ?>"></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=kelompok-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['id']; ?>" name="uid" />
		</form><!--end form isian-->
</div><!--end panel-->

