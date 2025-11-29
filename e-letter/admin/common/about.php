<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Informasi Perusahaan</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$npwp = $_POST['npwp'];
			$telp = $_POST['telp'];
			$fax = $_POST['fax'];
			$kodepos = $_POST['kodepos'];
			
			if(empty($nama) || empty($alamat) || empty($npwp) || empty($telp) || empty($fax)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
				$gambar=$_FILES["logo"]["tmp_name"];
				$dirup="../../images/banner/";
				$namafile=$_FILES["logo"]["name"];
				$dirup=$dirup.$namafile;
				move_uploaded_file($gambar,$dirup);
				
				$sql = mysql_query("update about set nama='$nama', alamat='$alamat',npwp='$npwp',fax='$fax',phone='$phone',kodepos='$kodepos',logo='$namafile'");
				if($sql > 0){
				    $error = 'Instansi Pengguna berhasil di update!';
				    echo"<div class=alert-success>".$error."</div>";
				}
			}
		}
		?>
		
		<!-- query view -->
		<?php
			$sql = mysql_query("select * from about");
			$rglobal = mysql_fetch_array($sql);
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=about-aplikasi" enctype="multipart/form-data"> 
			<table>
				<tr><td>Nama Instansi</td><td><input type="text" name="nama" value="<?php echo $rglobal['nama']; ?>" size="50"></td></tr>
				<tr><td>Alamat Instansi</td><td><textarea name="alamat" cols="40" rows="5"><?php echo $rglobal['alamat'];  ?></textarea></td></tr>
				<tr><td>NPWP </td><td><input type="text" name="npwp" value="<?php echo $rglobal['npwp']; ?>"></td></tr>
				<tr><td>Telp</td><td><input type="text" name="telp" value="<?php echo $rglobal['telp']; ?>"></td></tr>
				<tr><td>Fax</td><td><input type="text" name="fax" value="<?php echo $rglobal['fax']; ?>"></td></tr>
				<tr><td>Kode Pos</td><td><input type="text" name="kodepos" value="<?php echo $rglobal['kodepos']; ?>"></td></tr>
				<tr><td>File Logo</td><td><input type='hidden' name='MAX_FILE_SIZE' value='20000000'><input type="file" name="logo"></td></tr>
				<tr><td colspan="2"><input type="submit" value="Simpan" name="simpan"></td></tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->


