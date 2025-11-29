<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Surat Keluar</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$uid = $_POST['uid'];
			$nomor_sk = $_POST['nomor_sk'];
			$tgl_terima = date_create($_POST['tgl_terima']);
			$tgl_terima2 = date_format($tgl_terima,'Y-m-d');
			$dari = $_POST['dari'];
			$no_surat = $_POST['no_surat'];
			$lampiran = $_POST['lampiran'];
			$perihal = $_POST['perihal'];
			$jenisSurat = $_POST['jenisSurat'];
			$tujuan = $_POST['tujuan'];
			$keterangan = $_POST['keterangan'];
			
			if(empty($nomor_sk) || empty($tgl_terima) || empty($dari) || empty($no_surat) || empty($perihal) || empty($tujuan) ||empty($jenisSurat) || empty($_FILES["fileScan"]["tmp_name"])){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						if(empty($_FILES["fileScan"]["tmp_name"])){
							$namafile = $_POST['namafile'];
						}else{	
							$gambar=$_FILES["fileScan"]["tmp_name"];
							$dirup="../../document/surat-keluar/";
							$namafile=$_FILES["fileScan"]["name"];
							$dirup=$dirup.$namafile;
							move_uploaded_file($gambar,$dirup);
						}	
						$sql = mysql_query("update surat_keluar set nomor_sk='$nomor_sk',tgl_terima='$tgl_terima2',dari='$dari',no_surat='$no_surat',lampiran='$lampiran', file_scan=$file_scan,idjenis_surat=$idjenis_surat,perihal=$perihal,tujuan=$tujuan,keterangan=$ketera where id='$uid'");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=suratk-manage'</script>";
							}
			}
		}
		?>
		
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$sql = mysql_query("select * from surat_keluar where id='$id'");
			$rsql = mysql_fetch_array($sql); 
		?>	
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=suratk-edit" enctype="multipart/form-data"> 
			<table>
				<tr><td>Nomor Agenda Surat Keluar</td><td><input type="text" name="nomor_sk"></td></tr>
				<tr>
					<td>Tanggal Terima</td>
					<td><input type="text" name="tgl_terima" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglSurat);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr><td>Dari</td><td><input type="text" name="dari"></td></tr>
				<tr><td>Nomor Surat</td><td><input type="text" name="no_surat"></td></tr>
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
				<tr><td>tujuan</td><td><input type="text" name="tujuan"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="keterangan" cols="52" rows="5"></textarea></td></tr>				
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=suratk-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['id']; ?>" name="uid" />
		</form><!--end form isian-->
</div><!--end panel-->


<iframe width=174 height=189 name="gToday:normal:../../librari/calender/agenda.js" id="gToday:normal:../../librari/calender/agenda.js" src="../../librari/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">