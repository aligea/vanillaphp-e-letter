<?php 
include "../../config/koneksi.php";

$uid = $_GET['uid']; 
$sql = mysql_query("DELETE FROM USERS WHERE uid='$uid'");
if($sql > 0) echo "<script> document.location.href='home.php?q=user-manage'</script>";
else  echo "<script> alert('Gagal Query'); </script>";

?>