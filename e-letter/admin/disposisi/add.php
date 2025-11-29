<!-- panel -->
<div class="panel">
	<div class="panel-heading">Tambah Data Disposisi Surat Masuk</div>
		
		<?php
		// proses update
		if(isset($_POST['simpan'])){
			$kode_disposisi = $_POST['kode_disposisi'];
			$kode_sm= $_POST['kode_sm'];
			$tgldisposisi = date_create($_POST['tgldisposisi']);
			$tgldisposisi2 = date_format($tgldisposisi,'Y-m-d');
			$dari = $_POST['dari'];
			$kepada = $_POST['kepada'];
			$tgl_surat=date_create($_POST['tgl_surat']); 
			$tgl_surat2=date_format($tgl_surat,'Y-m-d H:i:s');
			$catatan_disposisi = $_POST['catatan_disposisi'];
			$status_terima = $_POST['status_terima'];
			$tglterima = date_create($_POST['tglterima']);
			$tglterima2 = date_format($tglterima2,'Y-m-d');
			$penerima = $_POST['penerima'];		
			
			if(empty($kode_sm) || empty($tgl_disposisi) || empty($dari) || empty($kepada) || empty($tgl_surat) ||empty($catatan_disposisi)){
				 $error = 'Field must be required!';
				 echo"<div class=alert-error>".$error."</div>";
			}
			else{
						
						$sql = mysql_query("insert into disposisi(kode_disposisi,kode_sm,tgl_disposisi,dari,kepada,tgl_surat,catatan_disposisi,status_terima,tgl_terima,penerima) values('kode_disposisi','kode_sm','tgl_disposisi','dari','kepada','tgl_surat','catatan_disposisi','status_terima','tgl_terima','penerima')");
							if($sql > 0){
								echo "<script> document.location.href='home.php?q=disposisi-manage'</script>";
							}
			}
		}
		?>
		
		<!-- form isian -->
		<form name="frm" class="table-form" method="post" action="?q=disposisi-add" enctype="multipart/form-data"> 
			<table>
				<tr><td>Kode Disposisi</td><td><input type="text" name="kode_disposisi"></td></tr>
				<tr><td>Kode Surat Masuk</td><td><input type="text" name="kode_sm"></td></tr>
				<tr>
					<td>Tanggal Disposisi</td>
					<td><input type="text" name="tgl_disposisi" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglterima);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr><td>Pemberi Disposisi</td><td><input type="text" name="dari"></td></tr>
				<tr><td>Tujuan Disposisi</td><td><input type="text" name="kepada"></td></tr>
				<tr>
					<td>Tanggal Surat</td>
					<td><input type="text" name="tglSurat" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglSurat);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr><td>Catatan Disposisi</td><td><textarea name="catatan_disposisi" rows="5" cols="52"></textarea><</tr>
				<tr>
					<td>Status Terima</td>
					<td>
						<select name="status_terima">
							<option value="0">Belum Terima</option>
							<option value="1">Sudah Terima</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tanggal Terima</td>
					<td><input type="text" name="tglterima" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frm.tglSurat);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr><td>Penerima</td><td><input type="text" name="penerima"></td>
				
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" value="Simpan" name="simpan">
						<a href="?q=disposisi-manage" style="text-decoration:none"><input type="button" value="Kembali"></a>
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->


<iframe width=174 height=189 name="gToday:normal:../../librari/calender/agenda.js" id="gToday:normal:../../librari/calender/agenda.js" src="../../librari/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">