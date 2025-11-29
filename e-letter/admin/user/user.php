	<?php
		## set default 
		$selpage = isset($_POST['selpage']) ? $_POST['selpage'] : 1;
		$SortField = isset($_GET['SortField']) ? $_GET['SortField'] : 'username'; 
		$SortOrder = isset($_GET['SortOrder']) ? $_GET['SortOrder'] : 'asc'; 
		$kata = isset($_POST['kata'])?$_POST['kata']:'';
		$cari = isset($_POST['cari'])?$_POST['cari']:'';
		//limit
		$rlimit = mysql_fetch_array(mysql_query("select rows from setting"));
		$limit = $rlimit['rows'];
		//menghitung jumlah data di tabel 
		$qGetRecordCount = mysql_fetch_array(mysql_query("select count(uid) as id from users")); 
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

		//query 
		$query = "select * from users"; 
		// pencarian
		if(isset($kata) and $kata != ""){
		   $query = $query." where $cari LIKE '%$_POST[kata]%'";
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
	<div class="panel-heading">User</div>
	 <form name="frm" method="post">	
		
		<!-- pencarian -->
		 <table class="filter" border="0">
			<tr>
			  <td valign="top">
				   <!-- select,button search dan all, note : select (value select harus sesuai dengan nama field di query)  -->
				   <select name="cari">
						<option value="username" <?php if($cari=='username'){ ?>selected<?php } ?>>Username</option>
						<option value="name" <?php if($cari=='name'){ ?>selected<?php } ?>>Name</option>
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
				  <input type="image" src="../../images/button/new.gif" title="buat user baru" onClick="create_new();">&nbsp;
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
					Username
					<img src="../../images/icon/sort_desc.gif" title="DESC" onClick="desc('name','DESC');">
					<img src="../../images/icon/sort_asc.gif" title="ASC" onClick="asc('name','ASC');">
				</th>
				<th>Nama</th>
				<th>Status</th>
				<th>Level</th>
				<th>Aksi</th>
			</tr>
			
			<?php if($count==0){
					echo"<tr><td colspan=5 align=center>..:: No Record Found ::..</td></tr>";
			}else{ while($row=mysql_fetch_array($hasil)){ $no++; ?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['username']; ?></td>
					<td><b><?php echo $row['name']; ?></td>
					<td><?php if($row['status']==0){ echo "Aktif";} else { echo "Tidak Aktif";} ?></td>
					<td><?php if($row['level']==2){ echo "Admin";} else { echo "User";} ?></td>
					<td>
						<a href="?q=user-edit&uid=<?php echo $row['uid']; ?>"><img src="../../images/icon/edit.gif" title="Edit"></a>&nbsp; 
						<a href="?q=user-del&uid=<?php echo $row['uid']; ?>" onClick="return confirm('Are You Sure Want To Delete')"><img src="../../images/icon/delete.gif" title="Delete"></a>
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
	document.frm.action = 'home.php?q=user-manage'
	document.frm.method = 'post';
	document.frm.submit();
}

function create_new() {	
	document.frm.action = 'home.php?q=user-add'
	document.frm.method = 'post';
	document.frm.submit();
}

function desc(field,sortir){
		document.frm.action = 'home.php?q=user-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
function asc(field,sortir){
	document.frm.action = 'home.php?q=user-manage&SortOrder=' +sortir+ '&SortField=' +field
	document.frm.method = 'post';
	document.frm.submit();
	
}
</script>
