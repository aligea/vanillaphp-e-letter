	<?php
		## set default 
		$selpage = isset($_POST['selpage']) ? $_POST['selpage'] : 1;
		$SortField = isset($_GET['SortField']) ? $_GET['SortField'] : 'nomor_sm'; 
		$SortOrder = isset($_GET['SortOrder']) ? $_GET['SortOrder'] : 'asc'; 
		$kata = isset($_POST['kata'])?$_POST['kata']:'';
		$cari = isset($_POST['cari'])?$_POST['cari']:'';
		
		//limit
		$rlimit = mysql_fetch_array(mysql_query("select rows from setting"));
		$limit = $rlimit['rows'];

		## menghitung jumlah data di tabel 
		$qGetRecordCount = mysql_fetch_array(mysql_query("select count(id) as id from surat_masuk")); 
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
		sm.id
		,sm.nomor_sm
		,sm.tgl_terima
		,sm.pengirim
		,sm.no_surat
		,sm.tgl_surat
		,sm.perihal
		,jns.nama as jenis_surat
		,sm.file_scan
		,sm.tujuan
		from surat_masuk sm inner join jenis_surat jns on jns.id = sm.idjenis_surat"; 
		// pencarian
		if(isset($kata) and $kata != ""){
		   $query = $query." where sm.$cari LIKE '%$_POST[kata]%'";
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
	<div class="panel-heading">Surat Masuk</div>
	 <form name="frm" method="post">	
		
		<!-- pencarian -->
		 <table class="filter" border="0">
			<tr>
			  <td valign="top">
				   <!-- select,button search dan all, note : select (value select harus sesuai dengan nama field di query)  -->
				   <select name="cari">
						<option value="nomor_sm" <?php if($cari=='nomor_sm'){ ?>selected<?php } ?>>No Agenda Surat Masuk</option>
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
					No. Agenda Surat Masuk
					<img src="../../images/icon/sort_desc.gif" title="DESC" onClick="desc('nomor_sm','DESC');">
					<img src="../../images/icon/sort_asc.gif" title="ASC" onClick="asc('nomor_sm','ASC');">
				</th>
				<th>Tgl. Terima</th>
				<th>Pengirim</th>
				<th>No. Surat</th>
				<th>Tanggal Surat</th>
				<th>Jenis Surat</th>
				<th>Perihal</th>
				<th>File</th>
				<th>Tujuan</th>
				<th>Aksi</th>
			</tr>
			
			<?php if($count==0){
					echo"<tr><td colspan=10 align=center>..:: No Record Found ::..</td></tr>";
			}else{ while($row=mysql_fetch_array($hasil)){ $no++; ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nomor_sm']; ?></td>
					<td><?php $DateOfExpired=date_create($row['tgl_terima']); echo date_format($DateOfExpired,'d F Y');?></td>
					<td><?php echo $row['pengirim']; ?></td>
					<td><?php echo $row['no_surat']; ?></td>
					<td><?php echo date_format(date_create($row['tgl_surat']),'d F Y');?></td>
					<td><?php echo $row['jenis_surat']; ?></td>
					<td><?php echo $row['perihal']; ?></td>
					<td><a href="../../surat-masuk/<?php echo $row['file_scan']; ?>" target="_blank"><?php echo $row['file_scan']; ?></a></td>
					<td><?php echo $row['tujuan']; ?></td>
					<td>
						<a href="javascript:void(null);" onClick="itemwindow=PopWindow('../suratMasuk/cetak.php?id=<?php echo $row['id']; ?>','Preview','860','640','scrollbars=yes,status=yes,resizable=yes'); arrNewPop[arrNewPop.length] = itemwindow;"><img src="../../images/icon/print.gif" title="Cetak"></a>&nbsp;
						<a href="?q=suratm-edit&id=<?php echo $row['id']; ?>"><img src="../../images/icon/edit.gif" title="Edit"></a>&nbsp; 
						 <?php if($_SESSION['level']== 2){ ?>
						<a href="?q=suratm-del&id=<?php echo $row['id']; ?>" onClick="return confirm('Are You Sure Want To Delete')"><img src="../../images/icon/delete.gif" title="Delete"></a>
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
	document.frm.action = 'home.php?q=suratm-manage'
	document.frm.method = 'post';
	document.frm.submit();
}

function create_new() {	
	document.frm.action = 'home.php?q=suratm-add'
	document.frm.method = 'post';
	document.frm.submit();
}

function desc(field,sortir){
		document.frm.action = 'home.php?q=suratm-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
function asc(field,sortir){
	document.frm.action = 'home.php?q=suratm-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
</script>
