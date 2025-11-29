<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah Data Kelompok</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$note = $_POST['no_rubrik'];
						
			if(empty($kode) || empty($nama) || empty($no_rubrik)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("insert into kelompok (kode,nama,no_rubrik) values('$kode','$nama','$no_rubrik')");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=kelompok-manage'</script>";
							}
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=kelompok-add"> 
			<table>
				<tr><td>Kode</td><td><input type="text" name="kode"></td></tr>
				<tr><td>Nama Kelompok</td><td><input type="text" name="nama" size="50"></td></tr>
				<tr><td>No_Rubrik</td><td><input type="text" name="no_rubrik" size="50"></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=kelompok-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->
