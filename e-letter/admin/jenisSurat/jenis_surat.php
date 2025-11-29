	<?php
		## set default 
		$selpage = isset($_POST['selpage']) ? $_POST['selpage'] : 1;
		$SortField = isset($_GET['SortField']) ? $_GET['SortField'] : 'nama'; 
		$SortOrder = isset($_GET['SortOrder']) ? $_GET['SortOrder'] : 'asc'; 
		//limit
		$rlimit = mysql_fetch_array(mysql_query("select rows from setting"));
		$limit = $rlimit['rows'];
		## menghitung jumlah data di tabel 
		$qGetRecordCount = mysql_fetch_array(mysql_query("select count(id) as id from jenis_surat")); 
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
		$query = "select * from jenis_surat"; 
		$query = $query . " ORDER BY $SortField $SortOrder";
		$hasil = mysql_query($query);
		$count = mysql_num_rows($hasil);
	?>

<!-- panel -->
<div class="panel">
	<div class="panel-heading">Jenis Surat</div>
	 <form name="frm" method="post">	
		
		  <!-- paging -->
		  <table class="paging" style="margin-left:3px" border="0"><tr>
			  <td>
				  <input type="image" src="../../images/button/new.gif" title="buat baru" onClick="create_new();">&nbsp;
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
				<th width="50">No.</th>
				<th>
					Jenis Surat
					<img src="../../images/icon/sort_desc.gif" title="DESC" onClick="desc('nama','DESC');">
					<img src="../../images/icon/sort_asc.gif" title="ASC" onClick="asc('nama','ASC');">
				</th>
				<th width="100">Aksi</th>
			</tr>
			
			<?php if($count==0){
					echo"<tr><td colspan=3 align=center>..:: No Record Found ::..</td></tr>";
			}else{ while($row=mysql_fetch_array($hasil)){ $no++; ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nama']; ?></td>
					<td>
						<a href="?q=jenis-edit&id=<?php echo $row['id']; ?>"><img src="../../images/icon/edit.gif" title="Edit"></a>&nbsp; 
						<?php if($_SESSION['level']== 2){ ?>
						<a href="?q=jenis-del&id=<?php echo $row['id']; ?>" onClick="return confirm('Are You Sure Want To Delete')"><img src="../../images/icon/delete.gif" title="Delete"></a>
						 <?php } ?>	
					</td>
				</tr>
			<?php }} ?>	
		</table>
	</form>	
		
</div><!--end panel-->

<script>
function create_new() {	
	document.frm.action = 'home.php?q=jenis-add'
	document.frm.method = 'post';
	document.frm.submit();
}

function desc(field,sortir){
		document.frm.action = 'home.php?q=jenis-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
function asc(field,sortir){
	document.frm.action = 'home.php?q=jenis-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
</script>
