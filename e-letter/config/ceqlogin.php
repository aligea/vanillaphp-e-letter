<?php 
session_start();
include ("koneksi.php");
$username = $_POST['usernamesql'];
$password = $_POST['sqlpassword'];
$password2 = md5($password.$username);
$password3 = md5($username.$password2);
$login = mysql_query("select uid,name,level,username,password,status,reset from users where username='$username' and password='$password3'");
$d = mysql_fetch_array($login);

// cek username aktif atau tidak
if($d['status']==1){ echo "<script language=javascript>alert('Username $username Tidak Aktif, Silahkan Hubungi Administrator'); document.location='../';</script>"; }
else{
	// memeriksa password dan username harus sama baik huruf besar, kecil atau angka 
	if(strcmp($d['password'],$password3)==0 and strcmp($d['username'],$username)==0 && ($d['password']==$password3)){
    	mysql_query("UPDATE USERS SET hit = 0 WHERE username='$username'");
		// menyimpan data user yang login ke session
		$_SESSION['uid']=$d['uid'];
		$_SESSION['name']=$d['name'];
		$_SESSION['level']=$d['level'];
		$_SESSION['username']=$d['username'];
		$_SESSION['reset']=$d['reset'];
		// mendirect ke halaman home
		echo "<script> document.location.href='../admin/common/?q=dashboard'</script>";
	 }
	 else{
		// jika username/password salah waktu login maka otomatis hit akan bertambah dan jika lebih dari batas kesalahan password akan di blokir  
		mysql_query("UPDATE USERS SET hit = hit + 1 where username='$username'");
		$hit=mysql_fetch_array(mysql_query("SELECT hit FROM USERS WHERE username = '$username'"));
		//limit batas kesalahan password
		$rlimit = mysql_fetch_array(mysql_query("select pswd_limit from setting"));
		$batas = $rlimit['pswd_limit'];
		if($hit['hit'] > $batas)
		{
			   // blokir username
			   mysql_query("UPDATE USERS SET status = 1 WHERE username='$username'");
			   echo "<script language=javascript>alert('Username $username Telah Di Blokir, Silahkan Hubungi Administrator'); document.location='../';</script>";
		}
		else
		{
			   echo "<script>alert('Kata Sandi atau Nama User salah'); document.location='../';</script>"; 	  
		}
	 }
}
?>
