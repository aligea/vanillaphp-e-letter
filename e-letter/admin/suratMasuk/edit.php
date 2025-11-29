<!-- panel -->
<div class="panel">
	<div class="panel-heading">Ubah Data Surat Masuk</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$uid = $_POST['uid'];
			$nomor_sm = $_POST['nomor_sm'];
			$tglterima = date_create($_POST['tglterima']);
			$tglterima2 = date_format($tglterima,'Y-m-d');
			$pengirim = $_POST['pengirim'];
			$noSurat = $_POST['noSurat'];
			$tglSurat=date_create($_POST['tglSurat']); 
			$tglSurat2=date_format($tglSurat,'Y-m-d');
			$lampiran = $_POST['lampiran'];
			$perihal = $_POST['perihal'];
			$jenisSurat = $_POST['jenisSurat'];
			$tujuan = $_POST['tujuan'];
			$keterangan = $_POST['keterangan'];
			
			if(empty($nomor_sm) || empty($tglterima) || empty($pengirim) || empty($noSurat) || empty($perihal)|| empty($tujuan) || empty($jenisSurat)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						if(empty($_FILES["fileScan"]["tmp_name"])){
							$namafile = $_POST['namafile'];
						}else{	
							$gambar=$_FILES["fileScan"]["tmp_name"];
							$dirup="../../document/surat-masuk/";
							$namafile=$_FILES["fileScan"]["name"];
							$dirup=$dirup.$namafile;
							move_uploaded_file($gambar,$dirup);
						}	
						$sql = mysql_query("update surat_masuk set nomor_sm='$nomor_sm',tgl_terima='$tglterima2',pengirim='$pengirim',no_surat='$noSurat',tgl_surat='$tglSurat2',lampiran='$lampiran',file_scan='$namafile',perihal='$perihal',idjenis_surat='$jenisSurat',tujuan='$tujuan',keterangan='$keterangan'  where id='$uid'");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=suratm-manage'</script>";
							}
			}
		}
		?>
		
		<?php
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$sql = mysql_query("select * from surat_masuk where id='$id'");
			$rsql = mysql_fetch_array($sql); 
		?>	
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=suratm-edit" enctype="multipart/form-data"> 
			<table>
				<tr><td>Nomor Agenda Surat Masuk</td><td><input type="text" name="nomor_sm" value="<?php echo $rsql['nomor_sm']; ?>"></td></tr>
				<tr><td>Tanggal Penerimaan</td>
				<td><input type="text" name="tglterima" size="15" value="<?php $DateOfExpired=date_create($rsql['tgl_terima']); echo date_format($DateOfExpired,'d F Y');?>" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglSurat);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a></td></tr>
				<tr>
				<tr><td>Pengirim Surat</td><td><input type="text" name="pengirim" size="50"value="<?php echo $rsql['pengirim']; ?>"></td></tr>
				<tr><td>Nomor Surat</td><td><input type="text" name="noSurat"value="<?php echo $rsql['no_surat']; ?>"></td></tr>
				<tr><td>Tanggal Surat</td>
				<td><input type="text" name="tglSurat" size="15" value="<?php $DateOfExpired=date_create($rsql['tgl_surat']); echo date_format($DateOfExpired,'d F Y');?>" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglSurat);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a></td></tr>
				<tr>
				<tr><td>Lampiran</td><td><input type="text" name="lampiran" value="<?php echo $rsql['lampiran']; ?>"></td></tr>
				<tr>
					<td>File Surat (scan)</td>
					<td>
						<i><?php echo $rsql['file_scan']; ?></i> &nbsp; 
						<input type='hidden' name='MAX_FILE_SIZE' value='20000000'><input type="file" name="fileScan">
						<input type='hidden' name='namafile' value="<?php echo $rsql['file_scan']; ?>">
					</td>
				</tr>
				<tr><td>Perihal Surat</td><td><textarea name="perihal" rows="5" cols="52"><?php echo $rsql['perihal']; ?></textarea></td></tr>
				<td>Jenis Surat</td>
					<td>
						<?php 
							// query select jenis surat
							$qcat = mysql_query("select id, nama from jenis_surat"); 
							echo"<select name='jenisSurat'>";
								echo"<option value=''> --- pilih --- </option>";
							while($rcat = mysql_fetch_array($qcat)){ ?>
								<option value="<?php echo $rcat['id'];?>" <?php if($rcat['id']==$rsql['idjenis_surat']){ ?>selected<?php } ?>><?php echo $rcat['nama'];?></option>
							<?php }	
							echo "</select>";
						?>
					</td>
				</tr>
				<tr><td>Tujuan</td><td><input type="text" name="tujuan" value="<?php echo $rsql['tujuan']; ?>"></td></tr>
				<tr><td>Keterangan</td><td><textarea name="keterangan" rows="5" cols="52"><?php echo $rsql['keterangan']; ?></textarea></td></tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=suratm-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $rsql['id']; ?>" name="uid" />
		</form><!--end form isian-->
</div><!--end panel-->


<iframe width=174 height=189 name="gToday:normal:../../librari/calender/agenda.js" id="gToday:normal:../../librari/calender/agenda.js" src="../../librari/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">