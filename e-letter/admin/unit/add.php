<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah Data Unit</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$kode = $_POST['kode'];
			$nama = $_POST['nama'];
			$note = $_POST['kelompok'];
						
			if(empty($kode) || empty($nama) || empty($note)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$sql = mysql_query("insert into unit (kode,nama,kelompok) values('$kode','$nama','$kelompok')");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=unit-manage'</script>";
							}
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=unit-add"> 
			<table>
				<tr><td>Kode</td><td><input type="text" name="kode"></td></tr>
				<tr><td>Nama Unit</td><td><input type="text" name="nama" size="50"></td></tr>
				<tr><td>Kelompok</td>
				
				<td>
						<?php 
							// query select kelompok
							$qcat = mysql_query("select id, kode from kelompok"); 
							echo"<select name='kelompok'>";
								echo"<option value=''> --- pilih --- </option>";
							while($rcat = mysql_fetch_array($qcat)){
								echo"<option value='".$rcat['id']."'>".$rcat['kode']."</option>";
							}	
							echo "</select>";
						?>
					</td>
				
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=unit-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->
