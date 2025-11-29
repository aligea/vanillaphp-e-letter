<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Data Unit</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$uid = $_POST['uid'];
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$kelompok = $_POST['kelompok'];
						
			if(empty($kode) || empty($nama) || empty($note)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("update unit set kode='$kode',nama='$nama',kelompok='$kelompok' where id='$uid'");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=unit-manage'</script>";
							}
			}
		}
		?>
		
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$sql = mysql_query("select * from unit where id='$id'");
			$rsql = mysql_fetch_array($sql); 
		?>	
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=unit-edit"> 
			<table>
				<tr><td>Kode</td><td><input type="text" name="kode" value="<?php echo $rsql['kode']; ?>"></td></tr>
				<tr><td>Nama</td><td><input type="text" name="nama" size="50"value="<?php echo $rsql['nama']; ?>"></td></tr>
				<tr><td>Kelompok</td><td><input type="text" name="kelompok" size="50"value="<?php echo $rsql['kelompok']; ?>"></td></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=unit-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['id']; ?>" name="uid" />
		</form><!--end form isian-->
</div><!--end panel-->

