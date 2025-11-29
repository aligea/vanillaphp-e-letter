<?php
if($_GET['excel']==1){
  header("Content-type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=Report");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
  header("Pragma: public"); 
}

// query 
include "../../config/koneksi.php";

$datefrom=date_create($_POST['datefrom']); 
$datefrom2=date_format($datefrom,'Y-m-d');
$datefrom3 = date_format($datefrom,'d-m-Y');
$dateto=date_create($_POST['dateto']); 
$dateto2=date_format($dateto,'Y-m-d');
$dateto3 = date_format($dateto,'d-m-Y');

if($_POST['jenisSurat'] == 1){
	$field = 'Tgl. Terima';
	$jenisSurat = 'Surat Masuk';
	$sql = "select sm.no_agenda,sm.tgl_terima as date,sm.pengirim,sm.no_surat,sm.tgl_surat,sm.ringkasan_pokok,sm.tujuan,jns.nama as jenisSurat from surat_masuk sm inner join jenis_surat jns on sm.idjenis_surat = jns.id  where sm.tgl_surat >= '$datefrom2' and sm.tgl_surat <= '$dateto2' order by sm.tgl_surat asc";
	$rsql = mysql_query($sql);
	$countsql = mysql_num_rows($rsql);
	
}elseif($_POST['jenisSurat'] == 2){
	$field = 'Tgl. Pengiriman';
	$jenisSurat = 'Surat Keluar';
	$sql = "select 
	sk.no_agenda,
	sk.tgl_kirim as date,
	sk.pengirim,
	sk.no_surat,
	sk.tgl_surat,
	sk.ringkasan_pokok,
	sk.tujuan,
	jns.nama as jenisSurat 
	from surat_keluar sk inner join jenis_surat jns on sk.idjenis_surat = jns.id  where sk.tgl_surat >= '$datefrom2' and sk.tgl_surat <= '$dateto2' order by sk.tgl_surat asc";
	$rsql = mysql_query($sql);
	$countsql = mysql_num_rows($rsql);
}
?>

<html>
<head>
<title>Untitled Document</title>
<style>
.reports {
	font-family : verdana;
	font-size : 8pt;
	width:80%;
	border-collapse:collapse;
	}
.borderStyle {
	border-bottom: 1px solid #CCCCCC; 
	border-left: 1px solid #CCCCCC; 
	border-top: 1px solid #CCCCCC;
}
	
.borderStyle5 {
	border-bottom: 1px solid #CCCCCC; 
	border-left: 1px solid #CCCCCC; 
	border-top: 1px solid #CCCCCC;
	border-right: 1px solid #CCCCCC;
}
</style>
</head>
<body>
<?php if($_GET['excel']==0){ ?>
	<form class="reports">
		<a href="##" onClick="self.print();"><img src="../../images/icon/print.gif">Print</a>
		&nbsp;&nbsp;<a href="##" onClick="window.close();" class="button">Close</a>
	</form>          
<?php } ?>

<table border="0" width="80%">
	<tr class="reports">
	  <td align="right" colspan="10">Print Time: <?php echo date('d/m/Y H:i:s');?></td>
	</tr>
</table>

<?php
// query head from table
$sqlhead = mysql_query("select nama,alamat,npwp,fax,telp from about");
$header = mysql_fetch_array($sqlhead); 
?>

<table class="reports" border="1" cellpadding="3" cellspacing="1" width="80%">
<tr>
	<td colspan="11" align="center">
		<span style="font-size:16px;"><?php echo $header['nama']; ?></span><br>
		<span>
			<?php echo $header['alamat']; ?><br>
			NPWP : <?php echo $header['npwp']; ?><br>
			Phone : <?php echo $header['telp']; ?><br>
			Fax : <?php echo $header['fax']; ?>
		</span>
	</td>
</tr>
	<tr>
		<td colspan="11" align="center">
			<span style="font-size:16px;">Laporan <?php echo $jenisSurat; ?></span><br>
			Periode Surat Dari <?php echo $datefrom3; ?> Sampai <?php echo $dateto3; ?> 
		</td>
	</tr>
	<tr>
		<th>No.</th>
		<th>No. Agenda</th>
		<th><?php echo $field; ?></th>
		<th>Pengirim</th>
		<th>No. Surat</th>
		<th>Tgl. Surat</th>
		<th>Jenis Surat</th>
		<th>Ringkasan Pokok</th>
		<th>Tujuan</th>
		<th>Tgl, Paraf</th>
		<th>Ket</th>
	</tr>
	<?php 
	if($countsql==0){
		echo"<tr class=wrn><td colspan=11 align=center>..:: No Record Found ::..</td></tr>";
	}
	else
	{
		$no=0;
		while($row = mysql_fetch_array($rsql)) {$no++; ?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $row['no_agenda']; ?></td>
			<td><?php echo date_format(date_create($row['date']),'d F Y');?></td>
			<td><?php echo $row['pengirim']; ?></td>
			<td><?php echo $row['no_surat']; ?></td>
			<td><?php echo date_format(date_create($row['tgl_surat']),'d F Y');?></td>
			<td><?php echo $row['jenisSurat']; ?></td>
			<td><?php echo $row['ringkasan_pokok']; ?></td>
			<td><?php echo $row['tujuan']; ?></td>
			<td></td>
			<td></td>
		</tr>
	<?php }} ?>

</table>
</body>
</html>
