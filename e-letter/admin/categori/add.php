<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah Kategori Surat</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$note = $_POST['note'];
						
			if(empty($kode) || empty($nama) || empty($note)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("insert into categori (kode,nama,note) values('$kode','$nama','$note')");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=categori-manage'</script>";
							}
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=categori-add"> 
			<table>
				<tr><td>Kode</td><td><input type="text" name="kode"></td></tr>
				<tr><td>Nama Kategori</td><td><input type="text" name="nama" size="50"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="note" cols="52" rows="10"></textarea></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=categori-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->
