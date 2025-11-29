<?php 
// query 
include "../../config/koneksi.php";
$id = $_GET['id'];
$sql = "select * from surat_masuk where id='$id'";
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
$sqlhead = mysql_query("select nomor_sm,tgl_surat,no_surat, perihal from surat_masuk");
$header = mysql_fetch_array($sqlhead); 
?>

<table class="reports" border="1" cellpadding="3" cellspacing="1" width="80%">
<tr>
	<td colspan="7" align="center"><h2>FORM DISPOSISI SURAT</h2></td>
</tr>
<tr>
	<td colspan="7" align="left">
		<span>
			No. Agenda Surat Masuk	: <?php echo $header['nomor_sm']; ?><br>
			No. Surat				: <?php echo $header['no_surat']; ?><br>
			Tanggal Surat			: <?php echo $header['tgl_surat']; ?><br>
			Perihal					: <?php echo $header['perihal']; ?>
		</span>
	</td>
</tr>

<tr>
	<td><b>Kolom Disposisi :</b></td>
</tr>
<tr height="400px">

</tr>
</table>
</body>
</html>
