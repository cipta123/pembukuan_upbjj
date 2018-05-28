<div class="container">
<div id="pajak">
<div style="text-align: center;">

	<h2><b>BUKU PEMBANTU PAJAK</b></h2>
		

</div>

<?php
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah; 
		}
?>

	<table >		
			<tr><td>Departemen/Lembaga</td><td>:</td><td>Kementrian, Riset dan Pendidikan Tinggi</td></tr>
			<tr><td>Unit Organisasi</td><td>:</td><td>DITJEN DIKTI</td></tr>
			<tr><td>Prop/Kab/Kota</td><td>:</td><td>BANTEN  / Tanggerang Selatan</td></tr>
			<tr><td>Satuan Kerja</td><td>:</td><td>UNIVERSITAS TERBUKA/UPBJJ-UT SERANG</td></tr>
			<tr><td>Tgl dan No.RKA-UK</td><td>:</td><td></td></tr>
			<tr><td>Tahun Anggaran</td><td>:</td><td>2018</td></tr>
			<tr><td>bulan</td><td>:</td><td>Januari</td></tr>
	</table>

	<table class="table-bordered table-hover table-striped table-sm" >
		<tr>
			<th>Tanggal</th>
			<th>No Bukti</th>
			<th>Uraian</th>
			<th colspan="5" style="text-align: center">Debet</th>
			<th>Kredit</th>
			<th>saldo</th>
		</tr>
		<tr>
			<td></td><td></td><td></td>
			<th>PPN</th>
			<th>Pph 21</th>
			<th>Pph 22</th>
			<th>Pph 23</th>
			<th>Pph Pasal 4(2)</th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
		</tr>
		@foreach($Pajak as $Pajakx)
	<?php $date = strtotime($Pajakx->Tanggal);    
          $date_fix = date('M,j ', $date); ?>
		<tr>
			<td>{{ $date_fix }}</td>
			<td>{{ $Pajakx->No_bukti }}</td>
			<td>{{ $Pajakx->Uraian }}</td>
			<td>{{ $Pajakx->PPN }}</td>
			<td>{{ $Pajakx->PPh21 }}</td>
			<td>{{ $Pajakx->PPh22 }}</td>
			<td>{{ $Pajakx->PPh23 }}</td>
			<td>{{ $Pajakx->Pasal_4 }}</td>
			<td>{{ rupiah($Pajakx->Kredit) }}</td>
			<td>{{ rupiah($Pajakx->Saldo) }}</td>
			
		</tr>
		@endforeach
		

	</table>
</div>
<button id="btnPrint">print</button>
</div>
<script>
  $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#pajak',
                width:'1200'
                
                /*optional properties with default values*/
                //obj2print:'body',     /*if not provided full page will be printed*/
                //style:'',             /*if you want to override or add more css assign here e.g: "<style>#masterContent:background:red;</style>"*/
                //width: '670',         /*if width is not provided it will be 670 (default print paper width)*/
                //height:screen.height, /*if not provided its height will be equal to screen height*/
                //top:0,                /*if not provided its top position will be zero*/
                //left:'center',        /*if not provided it will be at center, you can provide any number e.g. 300,120,200*/
                //resizable : 'yes',    /*yes or no default is yes, * do not work in some browsers*/
                //scrollbars:'yes',     /*yes or no default is yes, * do not work in some browsers*/
                //status:'no',          /*yes or no default is yes, * do not work in some browsers*/
                //title:'Print Preview' /*title of print preview popup window*/                
            });
        });
</script>