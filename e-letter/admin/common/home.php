<?php 
	include "../../config/koneksi.php";
	session_start();
	if(!$_SESSION['uid']==true){  
	   header("location:../../"); 
	}
	
	
	if($_SESSION['reset'] == 1){ 
			require_once "change_pswd.php";
	} else{  
		
		// query global
		$sql = mysql_query("select banner from setting");
		$rglobal = mysql_fetch_array($sql);
	?>
		<html>
		<head>
			<title>Beranda</title>
			<link rel="stylesheet" type="text/css" href="../../css/styhome.css" />
			<script type="text/javascript" src="../../js/popUp.js"></script>
			<body>
				<div id="container">

					<div id="header-top">
						Welcome,  &nbsp; <?php echo strtoupper($_SESSION['name']); ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?q=profil-user">Profile</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="../../config/out.php">Logout</a>
					</div>
					
					<!--header-->
					<div id="header">
						<!-- info instansi-->
						<div id="header-logo">
						  <span><?php echo $rglobal['banner']; ?></span>
						</div>
						
						<div id="header-menu">
						   <!-- menu navigasi --->
							<div id='cssmenu'>
								<ul>
									  <li class='active'><a href='?q=dashboard'><span>Beranda</span></a></li>
								      <li class='active has-sub'><a href='#'>Surat Masuk</a>
											<ul>
											 <li><a href='?q=suratm-manage'>Register Surat Masuk</a></li>
											 <li><a href='?q=disposisi-manage'>Disposisi</a></li>
											 <li><a href='?q=kelompok-manage'>Rekap Surat Masuk</a></li>
											</ul>
										</li>
								      <li class='active has-sub'><a href='#'>Surat Keluar</a>
											<ul>
											 <li><a href='?q=suratk-manage'>Register Surat Keluar</a></li>
											 <li><a href='?q=jenis-manage'>Approval</a></li>
											 <li><a href='?q=kelompok-manage'>Rekap Surat Keluar</a></li>
											</ul>
									  </li>
								      <li class='active has-sub'><a href='#'>Penomoran</a>
											<ul>
											 <li><a href='?q=penomoran'>Register Penomoran</a></li>
											 <li><a href='?q=laporan'>Rekap Penomoran</a></li>
											</ul>
									  
									  </li>
								   
								   <!-- menu akses hanya admin saja -->
								   <?php if($_SESSION['level']== 2){ ?>
									   <li class='active has-sub'><a href='#'>Pengaturan</a>
										  <ul>
											 <li><a href='?q=user-manage'>Users</a></li>
											 <li><a href='?q=jenis-manage'>Jenis Surat</a></li>
											 <li><a href='?q=kelompok-manage'>Kelompok</a></li>
											  <li><a href='?q=unit-manage'>Unit</a></li>
											 <li><a href='?q=about-aplikasi'>Instansi Pengguna</a></li>
										  </ul>
									   </li>
								   <?php } ?>	
								   
								</ul>
							</div> <!-- end menu-->   
					</div>
					<!-- end header-->
				</div>	

				<div id="raw">
					<div class="konten">
						<?php
							include "konten.php";
						?>		
					</div><!-- end konten -->
				</div><!--end raw-->

				<div id="footer"> Copyright &copy; 2016 PT. Bank Negara Indonesia(Persero)Tbk</div>


			</div><!-- end container-->
		  </body>
		 </html>
	<?php } ?>    