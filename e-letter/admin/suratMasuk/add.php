<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah Data Surat Masuk</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$nomor_sm = $_POST['nomor_sm'];
			$tglterima = date_create($_POST['tglterima']);
			$tglterima2 = date_format($tglterima,'Y-m-d');
			$pengirim = $_POST['pengirim'];
			$noSurat = $_POST['noSurat'];
			$tglSurat=date_create($_POST['tglSurat']); 
			$tglSurat2=date_format($tglSurat,'Y-m-d H:i:s');
			$lampiran = $_POST['lampiran'];
			$perihal = $_POST['perihal'];
			$jenisSurat = $_POST['jenisSurat'];
			$tujuan = $_POST['tujuan'];
			$keterangan = $_POST['keterangan'];
			$created_by = $_SESSION['uid'];
			$created_date = date('Y-m-d H:i:s');			
			
			if(empty($nomor_sm) || empty($pengirim) || empty($tglterima) || empty($tglSurat) || empty($tujuan) ||empty($perihal)|| empty($noSurat) || empty($_FILES["fileScan"]["tmp_name"])){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						$gambar=$_FILES["fileScan"]["tmp_name"];
						$dirup="../../document/surat-masuk/";
						$namafile=$_FILES["fileScan"]["name"];
						$dirup=$dirup.$namafile;
						move_uploaded_file($gambar,$dirup);
						
						$sql = mysql_query("insert into surat_masuk (nomor_sm,tgl_terima,pengirim,no_surat,tgl_surat,lampiran,file_scan,idjenis_surat,perihal,tujuan,keterangan,user_entry) values('$nomor_sm','$tglterima2','$pengirim','$noSurat','$tglSurat2','$lampiran','$namafile','$jenisSurat','$perihal','$tujuan','$keterangan','$user_entry')");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=suratm-manage'</script>";
							}
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=suratm-add" enctype="multipart/form-data"> 
			<table>
				<tr><td>Nomor Agenda Surat Masuk</td><td><input type="text" name="nomor_sm"></td></tr>
				<tr>
					<td>Tanggal Penerimaan</td>
					<td><input type="text" name="tglterima" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglterima);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr><td>Pengirim Surat</td><td><input type="text" name="pengirim"></td></tr>
				<tr><td>Nomor Surat</td><td><input type="text" name="noSurat"></td></tr>
				<tr>
					<td>Tanggal Surat</td>
					<td><input type="text" name="tglSurat" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglSurat);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr><td>Lampiran</td><td><input type="text" name="lampiran"></td></tr>
				<tr><td>File Surat (scan)</td><td><input type='hidden' name='MAX_FILE_SIZE' value='20000000'><input type="file" name="fileScan"></td></tr>
				<tr><td>Perihal Surat</td><td><textarea name="perihal" rows="5" cols="52"></textarea></td></tr>
				<tr><td>Jenis Surat</td>
					<td>
						<?php 
							// query select jenis surat
							$qcat = mysql_query("select id, nama from jenis_surat"); 
							echo"<select name='jenisSurat'>";
								echo"<option value=''> --- pilih --- </option>";
							while($rcat = mysql_fetch_array($qcat)){
								echo"<option value='".$rcat['id']."'>".$rcat['nama']."</option>";
							}	
							echo "</select>";
						?>
					</td>
				</tr>
				<tr><td>Tujuan</td><td><input type="text" name="tujuan"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="keterangan" rows="5" cols="52"></textarea></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=suratm-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->


<iframe width=174 height=189 name="gToday:normal:../../librari/calender/agenda.js" id="gToday:normal:../../librari/calender/agenda.js" src="../../librari/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">