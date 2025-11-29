<script>
var arrNewPop = new Array()
function parsing(){
    	var frm = document.frmSearch;
	
		if(frm.datefrom.value == '' || frm.dateto.value == ''){
			alert('Periode Surat must be required!');
		}else{
			var tmpAction = frm.action;
			var tmpTarget = frm.target;
			var strURL = "../laporan/cetak.php?excel=0";
			PrmAttr = "title='DisplayReport', scrollBars=yes,location=no,status=yes,toolbar=no,resizable=yes";
			document.frmSearch.action = strURL;
			arrNewPop[arrNewPop.length]=window.open ('', "stok", PrmAttr);
			frm.target = 'stok';
			frm.submit();		
			frm.action = tmpAction;
			frm.target = tmpTarget;
		}	
}

function excel(){
	var frm = document.frmSearch;
		if(frm.datefrom.value == '' || frm.dateto.value == ''){
				alert('Periode Surat must be required!');
		}else{
			var tmpAction = frm.action;
			var tmpTarget = frm.target;
			var strURL = "../laporan/cetak.php?excel=1";
			document.frmSearch.action = strURL;
			frm.submit();		
			frm.action = tmpAction;
			frm.target = tmpTarget;
		}	
	}

</script>

<!-- panel -->
<div class="panel">
	<div class="panel-heading">Laporan Manajemen Surat</div>
		<!-- form isian -->
		 <form method="post" name="frmSearch" class="table-form"> 
			<table>
				<tr>
					<td>Kategori Surat:</td>
					<td>
						<select name="jenisSurat">
							<option value="1">Surat Masuk</option>
							<option value="2">Surat Keluar</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Periode Surat:</td>
					<td>
					Dari &nbsp;<input type="text" name="datefrom" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmSearch.datefrom);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					&nbsp;&nbsp;&nbsp;
					Sampai &nbsp; <input type="text" name="dateto" size="15" readonly style="vertical-align:middle;"> <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.frmSearch.dateto);return false;" ><img name="popcal" align="absmiddle" src="../../librari/calender/date.gif" width="25" height="25" border="0" alt=""></a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="button" value="Menampilkan Laporan" onClick="parsing();">&nbsp; 
						<input type="button" value="Export To MS Excel" onClick="excel();">&nbsp;
					</td>
				</tr>
			</table>
		</form><!--end form isian-->
</div><!--end panel-->


<iframe width=174 height=189 name="gToday:normal:../../librari/calender/agenda.js" id="gToday:normal:../../librari/calender/agenda.js" src="../../librari/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">

