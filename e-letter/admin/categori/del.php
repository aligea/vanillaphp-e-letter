<?php 
include "../../config/koneksi.php";

$id = $_GET['id']; 
$sql = mysql_query("DELETE FROM categori WHERE id='$id'");
if($sql > 0) echo "<script> document.location.href='home.php?q=categori-manage'</script>";
else  echo "<script> alert('Gagal Query'); </script>";

?>