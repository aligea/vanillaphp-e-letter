<?php
	$page = $_GET['q'];
	if($page=='dashboard'){	
		include "dashboard.php";
	}elseif($page =='profil-user'){
		include "profile.php";
	}elseif($page =='about-aplikasi'){
		include "about.php";
	
	// user
	}elseif($page =='user-manage'){
		include "../user/user.php";
	}elseif($page =='user-add'){
		include "../user/add.php";
	}elseif($page =='user-edit'){
		include "../user/edit.php";
	}elseif($page =='user-del'){
		include "../user/del.php";
	}
	
	// surat masuk
	elseif($page =='suratm-manage'){
		include "../suratMasuk/surat_masuk.php";
	}elseif($page =='suratm-add'){
		include "../suratMasuk/add.php";
	}elseif($page =='suratm-edit'){
		include "../suratMasuk/edit.php";
	}elseif($page =='suratm-del'){
		include "../suratMasuk/del.php";
	}
	
	// disposisi
	elseif($page =='disposisi-manage'){
		include "../disposisi/disposisi.php";
	}elseif($page =='disposisi-add'){
		include "../disposisi/add.php";
	}elseif($page =='disposisi-edit'){
		include "../disposisi/edit.php";
	}elseif($page =='disposisi-del'){
		include "../disposisi/del.php";
	}
	
	
	// surat keluar
	elseif($page =='suratk-manage'){
		include "../suratKeluar/surat_keluar.php";
	}elseif($page =='suratk-add'){
		include "../suratKeluar/add.php";
	}elseif($page =='suratk-edit'){
		include "../suratKeluar/edit.php";
	}elseif($page =='suratk-del'){
		include "../suratKeluar/del.php";
	}
	
	
	// approval
	elseif($page =='approval-manage'){
		include "../approval/approval.php";
	}elseif($page =='approval-add'){
		include "../approval/add.php";
	}elseif($page =='approval-edit'){
		include "../approval/edit.php";
	}elseif($page =='approval-del'){
		include "../approval/del.php";
	}
	
	
	// penomoran
	elseif($page =='penomoran-manage'){
		include "../penomoran/penomoran.php";
	}elseif($page =='penomoran-add'){
		include "../penomoran/add.php";
	}elseif($page =='penomoran-edit'){
		include "../penomoran/edit.php";
	}elseif($page =='penomoran-del'){
		include "../penomoran/del.php";
	}
	
	// categori surat
	elseif($page =='categori-manage'){
		include "../categori/categori.php";
	}elseif($page =='categori-add'){
		include "../categori/add.php";
	}elseif($page =='categori-edit'){
		include "../categori/edit.php";
	}elseif($page =='categori-del'){
		include "../categori/del.php";
	}
	
	// kelompok
	elseif($page =='kelompok-manage'){
		include "../kelompok/kelompok.php";
	}elseif($page =='kelompok-add'){
		include "../kelompok/add.php";
	}elseif($page =='kelompok-edit'){
		include "../kelompok/edit.php";
	}elseif($page =='kelompok-del'){
		include "../kelompok/del.php";
	}
	
	
	// unit
	elseif($page =='unit-manage'){
		include "../unit/unit.php";
	}elseif($page =='unit-add'){
		include "../unit/add.php";
	}elseif($page =='unit-edit'){
		include "../unit/edit.php";
	}elseif($page =='unit-del'){
		include "../unit/del.php";
	}
	
	
	// jenis surat
	elseif($page =='jenis-manage'){
		include "../jenisSurat/jenis_surat.php";
	}elseif($page =='jenis-add'){
		include "../jenisSurat/add.php";
	}elseif($page =='jenis-edit'){
		include "../jenisSurat/edit.php";
	}elseif($page =='jenis-del'){
		include "../jenisSurat/del.php";
	}
	
	//laporan
	elseif($page =='laporan'){
		include "../laporan/laporan.php";
	}
	
	

?>