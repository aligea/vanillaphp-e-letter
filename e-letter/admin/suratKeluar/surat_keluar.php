	<?php
		## set default 
		$selpage = isset($_POST['selpage']) ? $_POST['selpage'] : 1;
		$SortField = isset($_GET['SortField']) ? $_GET['SortField'] : 'nomor_sk'; 
		$SortOrder = isset($_GET['SortOrder']) ? $_GET['SortOrder'] : 'asc'; 
		$kata = isset($_POST['kata'])?$_POST['kata']:'';
		$cari = isset($_POST['cari'])?$_POST['cari']:'';
		//limit
		$rlimit = mysql_fetch_array(mysql_query("select rows from setting"));
		$limit = $rlimit['rows'];
		## menghitung jumlah data di tabel 
		$qGetRecordCount = mysql_fetch_array(mysql_query("select count(id) as id from surat_keluar")); 
		$TotalPage = ceil($qGetRecordCount[0] / $limit);
		if($selpage > 1){
			$StartRow = (($selpage-1)*$limit) + 0;
			$no = $StartRow;
		}else{
			$StartRow = 0;
			$no = $StartRow;
		}
		$EndRow = $StartRow+$limit-1;
		if($EndRow > $qGetRecordCount[0]){
			$EndRow = $qGetRecordCount[0];
		}

		## query 
		$query = "select  
		sk.id
		,sk.nomor_sk
		,sk.tgl_terima
		,sk.dari
		,sk.no_surat
		,sk.lampiran
		,sk.perihal
		,sk.keterangan
		,jns.nama as jenis_surat
		,sk.file_scan
		,sk.tujuan
		from surat_keluar sk inner join jenis_surat jns on jns.id = sk.idjenis_surat"; 
		// pencarian
		if(isset($kata) and $kata != ""){
		   $query = $query." where sk.$cari LIKE '%$_POST[kata]%'";
		}
		$query = $query . " ORDER BY $SortField $SortOrder";
		// pencarian di semua halaman
		if(isset($kata) and $kata == ""){
			$query = $query. " LIMIT $StartRow, $limit";
		}
		$hasil = mysql_query($query);
		$count = mysql_num_rows($hasil);
	?>

<!-- panel -->
<div class="panel">
	<div class="panel-heading">Surat Keluar</div>
	 <form name="frm" method="post">	
		
		<!-- pencarian -->
		 <table class="filter" border="0">
			<tr>
			  <td valign="top">
				   <!-- select,button search dan all, note : select (value select harus sesuai dengan nama field di query)  -->
				   <select name="cari">
						<option value="nomor_sk" <?php if($cari=='nomor_sk'){ ?>selected<?php } ?>>No. Agenda Surat Keluar</option>
						<option value="no_surat" <?php if($cari=='no_surat'){ ?>selected<?php } ?>>No. Surat</option>
					</select>
					<input type="text" name="kata" id="kata" value="<?php echo $kata; ?>" placeholder="kata kunci pencarian"/>
					
					<input type="button" class="button-3" value="Search" title="cari berdasarkan pilihan" onClick="frm.submit();" />&nbsp;
					<input type="button"  class="button-3" value="Show All" title="tampilkan semua data" onClick="showAll();" />
				</td>
			 </tr>
		  </table>
		  
		  <br>
		  
		  <!-- paging -->
		  <table class="paging" style="margin-left:3px" border="0"><tr>
			  <td>
				  <input type="image" src="../../images/button/new.gif" title="buat surat baru" onClick="create_new();">&nbsp;
			  </td>
			  <td align="right">Page:    
				<select name="selpage" onChange="is_reload();">
					<?php  if ($qGetRecordCount[0] == 0){
						echo "<option value=0>0</option>";
					}else{ 
					   for($i = 1; $i <= $TotalPage; $i++){ ?>
						   <option value="<?php echo $i;?>" <?php if ($selpage==$i){?> selected <?php }?>><?php echo $i;?></option>
				   <?php } } ?>
				</select> of <?php print($TotalPage); ?> &nbsp;
			  </td>
			</tr>
		</table>
			
		<!-- tabel -->
		<table class="table-hover">
			<tr>
				<th>No.</th>
				<th>
					No. Agenda Surat Keluar
					<img src="../../images/icon/sort_desc.gif" title="DESC" onClick="desc('nomor_sk','DESC');">
					<img src="../../images/icon/sort_asc.gif" title="ASC" onClick="asc('nomor_sk','ASC');">
				</th>
				<th>Tanggal Terima</th>
				<th>Dari</th>
				<th>No. Surat</th>
				<th>Perihal</th>
				<th>Jenis Surat</th>
				<th>Tujuan</th>
				<th>File</th>
				<th>Aksi</th>
			</tr>
			
			<?php if($count==0){
					echo"<tr><td colspan=10 align=center>..:: No Record Found ::..</td></tr>";
			}else{ while($row=mysql_fetch_array($hasil)){ $no++; ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nomor_sk']; ?></td>
					<td><?php echo date_format(date_create($row['tgl_terima']),'d F Y');?></td>
					<td><?php echo $row['dari']; ?></td>
					<td><?php echo $row['no_surat']; ?></td>
					<td><?php echo $row['perihal']; ?></td>
					<td><?php echo $row['jenis_surat']; ?></td>
					<td><?php echo $row['tujuan']; ?></td>
					<td><a href="../../surat-keluar/<?php echo $row['file_scan']; ?>" target="_blank"><?php echo $row['file_scan']; ?></a></td>
					<td>
						<a href="javascript:void(null);" onClick="itemwindow=PopWindow('../suratKeluar/cetak.php?id=<?php echo $row['id']; ?>','Preview','860','640','scrollbars=yes,status=yes,resizable=yes'); arrNewPop[arrNewPop.length] = itemwindow;"><img src="../../images/icon/print.gif" title="Cetak"></a>&nbsp;
						<a href="?q=suratk-edit&id=<?php echo $row['id']; ?>"><img src="../../images/icon/edit.gif" title="Edit"></a>&nbsp; 
						 <?php if($_SESSION['level']== 2){ ?>
							<a href="?q=suratk-del&id=<?php echo $row['id']; ?>" onClick="return confirm('Are You Sure Want To Delete')"><img src="../../images/icon/delete.gif" title="Delete"></a>
						 <?php } ?>	
					</td>
				</tr>
			<?php }} ?>	
		</table>
	</form>	
		
</div><!--end panel-->

<script>
function showAll() {
		document.frm.kata.value = "";
		document.frm.submit();
}
function is_reload() {	
	document.frm.action = 'home.php?q=suratk-manage'
	document.frm.method = 'post';
	document.frm.submit();
}

function create_new() {	
	document.frm.action = 'home.php?q=suratk-add'
	document.frm.method = 'post';
	document.frm.submit();
}

function desc(field,sortir){
		document.frm.action = 'home.php?q=suratk-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
function asc(field,sortir){
	document.frm.action = 'home.php?q=suratk-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
</script>
