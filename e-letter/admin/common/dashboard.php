<?php
	// query count surat masuk dan keluar
	$qmasuk = mysql_fetch_array(mysql_query("select count(id) as id from surat_masuk"));
	$qkeluar = mysql_fetch_array(mysql_query("select count(id) as id from surat_keluar"));
?>
<div id="dashboard">
	<div class="dashboard-head"><span>Beranda</span></div>
	
	<div class="dashboard-page">
		<div class="dashboard-page-1"><span><?php echo $qmasuk[0]; ?></span><br><br><a href="?q=suratm-manage">Surat Masuk</a></div>
		<div class="dashboard-page-2"><span><?php echo $qkeluar[0]; ?></span><br><br><a href="?q=suratk-manage">Surat Keluar</a></div>
	</div>
</div>