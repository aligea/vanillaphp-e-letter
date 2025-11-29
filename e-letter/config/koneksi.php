<?php
/********************************************************************************************************
* koneksi
* dbsite : database
* localhost : 127.0.0.1
* password : kosong
********************************************************************************************************/
date_default_timezone_set("Asia/Jakarta");
$local = '127.0.0.1';
$root = 'root';
$pass ='';
$database ='db_letter';
mysql_connect("$local","$root","$pass") or die("xampp error");
mysql_select_db("$database") or die("tidak bisa access database");
?>