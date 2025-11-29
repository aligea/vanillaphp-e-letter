	<?php
		## set default 
		$selpage = isset($_POST['selpage']) ? $_POST['selpage'] : 1;
		$SortField = isset($_GET['SortField']) ? $_GET['SortField'] : 'kode_disposisi'; 
		$SortOrder = isset($_GET['SortOrder']) ? $_GET['SortOrder'] : 'asc'; 
		$kata = isset($_POST['kata'])?$_POST['kata']:'';
		$cari = isset($_POST['cari'])?$_POST['cari']:'';
		
		//limit
		$rlimit = mysql_fetch_array(mysql_query("select rows from setting"));
		$limit = $rlimit['rows'];

		## menghitung jumlah data di tabel 
		$qGetRecordCount = mysql_fetch_array(mysql_query("select count(id) as id from disposisi")); 
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
		$query = "select d.id, d.kode_disposisi, d.kode_sm, sm.no_surat, sm.tgl_surat,sm.perihal,d.tgl_disposisi,d.dari,d.kepada,d.catatan_disposisi, d.status_terima,d.tgl_terima,d.penerima from disposisi d inner join surat_masuk sm on sm.nomor_sm= d.kode_sm"; 
		$query = $query . " ORDER BY $SortField $SortOrder";
		$hasil = mysql_query($query);
		$count = mysql_num_rows($hasil);
	?>

<!-- panel -->
<div class="panel">
	<div class="panel-heading">Disposisi Surat Masuk</div>
	 <form name="frm" method="post">	
		
		<!-- pencarian -->
		 <table class="filter" border="0">
			<tr>
			  <td valign="top">
				   <!-- select,button search dan all, note : select (value select harus sesuai dengan nama field di query)  -->
				   <select name="cari">
						<option value="nomor_sm" <?php if($cari=='kode_sm'){ ?>selected<?php } ?>>No Agenda Surat Masuk</option>
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
				  <input type="image" src="../../images/button/new.gif" title="buat disposisi baru" onClick="create_new();">&nbsp;
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
					No. Surat Masuk
					<img src="../../images/icon/sort_desc.gif" title="DESC" onClick="desc('kode_sm','DESC');">
					<img src="../../images/icon/sort_asc.gif" title="ASC" onClick="asc('kode_sm','ASC');">
				</th>
				<th>Kode Disposisi</th>
				<th>Tanggal Disposisi</th>
				<th>Pemberi Disposisi</th>
				<th>Tujuan Disposisi</th>
				<th>Nomor Surat</th>
				<th>Tanggal Surat</th>
				<th>Perihal</th>
				<th>Catatan Disposisi</th>
				<th>Tanggal Terima</th>
				<th>Penerima</th>
				<th>Aksi</th>
			</tr>
			
			<?php if($count==0){
					echo"<tr><td colspan=10 align=center>..:: No Record Found ::..</td></tr>";
			}else{ while($row=mysql_fetch_array($hasil)){ $no++; ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['kode_sm']; ?></td>
					<td><?php echo $row['kode_disposisi']; ?></td>
					<td><?php $DateOfExpired=date_create($row['tgl_disposisi']); echo date_format($DateOfExpired,'d F Y');?></td>
					<td><?php echo $row['dari']; ?></td>
					<td><?php echo $row['kepada']; ?></td>
					<td><?php echo $row['no_surat']; ?></td>
					<td><?php echo date_format(date_create($row['tgl_surat']),'d F Y');?></td>
					<td><?php echo $row['perihal']; ?></td>
					<td><?php echo $row['catatan_disposisi']; ?></td>
					<td><?php echo date_format(date_create($row['tgl_terima']),'d F Y');?></td>
					<td><?php echo $row['penerima']; ?></td>
					<td>
						<a href="?q=disposisi-edit&id=<?php echo $row['id']; ?>"><img src="../../images/icon/edit.gif" title="Edit"></a>&nbsp; 
						 <?php if($_SESSION['level']== 2){ ?>
						<a href="?q=disposisi-del&id=<?php echo $row['id']; ?>" onClick="return confirm('Are You Sure Want To Delete')"><img src="../../images/icon/delete.gif" title="Delete"></a>
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
	document.frm.action = 'home.php?q=disposisi-manage'
	document.frm.method = 'post';
	document.frm.submit();
}

function create_new() {	
	document.frm.action = 'home.php?q=disposisi-add'
	document.frm.method = 'post';
	document.frm.submit();
}

function desc(field,sortir){
		document.frm.action = 'home.php?q=disposisi-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
function asc(field,sortir){
	document.frm.action = 'home.php?q=disposisi-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
</script>
