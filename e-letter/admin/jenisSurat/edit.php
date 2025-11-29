<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Jenis Surat</div>
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$uid = $_POST['uid'];
			$nama = $_POST['nama'];
			$keterangan = $_POST['keterangan'];
						
			if(empty($nama)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("update jenis_surat set nama='$nama', keterangan= $keterangan where id='$uid'");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=jenis-manage'</script>";
							}
			}
		}
		?>
		
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$sql = mysql_query("select * from jenis_surat where id='$id'");
			$rsql = mysql_fetch_array($sql); 
		?>	
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=jenis-edit"> 
			<table>
				<tr><td>ID</td><td><input type="text" name="kode" value="<?php echo $rsql['id']; ?>" readonly></td></tr>
				<tr><td>Jenis Surat</td><td><input type="text" name="nama" size="50"value="<?php echo $rsql['nama']; ?>"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="keterangan" rows="5" cols="52"><?php echo $rsql['keterangan']; ?></textarea></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=jenis-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['id']; ?>" name="uid" />
		</form><!--end form isian-->
</div><!--end panel-->

