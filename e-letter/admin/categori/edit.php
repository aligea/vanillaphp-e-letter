<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Kategori Surat</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$uid = $_POST['uid'];
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$note = $_POST['note'];
						
			if(empty($kode) || empty($nama) || empty($note)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("update categori set kode='$kode',nama='$nama',note='$note' where id='$uid'");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=categori-manage'</script>";
							}
			}
		}
		?>
		
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$sql = mysql_query("select * from categori where id='$id'");
			$rsql = mysql_fetch_array($sql); 
		?>	
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=categori-edit"> 
			<table>
				<tr><td>Kode</td><td><input type="text" name="kode" value="<?php echo $rsql['kode']; ?>"></td></tr>
				<tr><td>Nama</td><td><input type="text" name="nama" size="50"value="<?php echo $rsql['nama']; ?>"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="note" cols="52" rows="10"><?php echo $rsql['note']; ?></textarea></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=categori-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['id']; ?>" name="uid" />
		</form><!--end form isian-->
</div><!--end panel-->

