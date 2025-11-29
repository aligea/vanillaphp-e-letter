<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah Jenis Surat</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$nama = $_POST['nama'];
			$keterangan = $_POST['keterangan'];
			if(empty($nama)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("insert into jenis_surat (nama, keterangan) values('$nama','$keterangan')");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=jenis-manage'</script>";
							}
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=jenis-add"> 
			<table>
				<tr><td>Jenis Surat</td><td><input type="text" name="nama" size="50"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="keterangan" rows="5" cols="52"></textarea></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=jenis-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->
