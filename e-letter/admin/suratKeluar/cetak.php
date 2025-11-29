<?php 
// query 
include "../../config/koneksi.php";
$id = $_GET['id'];
$sql = "select * from surat_keluar where id='$id'";
$rsql = mysql_fetch_array(mysql_query($sql));
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

<form class="reports">
	<a href="##" onClick="self.print();"><img src="../../images/gif/print.gif">Print</a>
	&nbsp;&nbsp;<a href="##" onClick="window.close();" class="button">Close</a>
</form>          

<table border="0" width="80%">
	<tr class="reports">
	  <td align="right">Print Time: <?php echo date('d/m/Y H:i:s');?></td>
	</tr>
</table>

<?php
// query head from table
$sqlhead = mysql_query("select nama,alamat,npwp,fax,phone from global");
$header = mysql_fetch_array($sqlhead); 
?>

<table class="reports" border="1" cellpadding="3" cellspacing="1" width="80%">
<tr>
	<td colspan="7" align="center">
		<span style="font-size:14px;"><?php echo $header['nama']; ?></span><br>
		<span>
			<?php echo $header['alamat']; ?><br>
			NPWP : <?php echo $header['npwp']; ?><br>
			Phone : <?php echo $header['phone']; ?><br>
			Fax : <?php echo $header['fax']; ?>
		</span>
	</td>
</tr>
<tr>
	<td colspan="7" align="center"><h2>LEMBAR DISPOSISI</h2></td>
</tr>
<tr>
	<td>Indeks Berkas</td><td>:</td><td><?php echo $rsql['no_surat']; ?></td>
	<td>&nbsp;</td>
	<td>Indeks Berkas</td><td>:</td><td><?php echo $rsql['no_surat']; ?></td>
</tr>
<tr>
	<td>Indeks Berkas</td><td>:</td><td><?php echo $rsql['no_surat']; ?></td>
	<td>&nbsp;</td>
	<td>Indeks Berkas</td><td>:</td><td><?php echo $rsql['no_surat']; ?></td>
</tr>
</table>
</body>
</html>
