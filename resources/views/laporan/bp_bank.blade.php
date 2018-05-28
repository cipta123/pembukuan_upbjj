<div class="container">
<div id="bpbank">
<div style="text-align: center;"><h3><b>BUKU PEMBANTU BANK</b></h3></div>



<?php
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah; 
		}
?>
	<table>		
			<tr><td>Departemen/Lembaga</td><td>:</td><td>Kementrian, Riset dan Pendidikan Tinggi</td></tr>
			<tr><td>Unit Organisasi</td><td>:</td><td>Universitas terbuka</td></tr>
			<tr><td>Prop/Kab/Kota</td><td>:</td><td>Tanggerang Selatan</td></tr>
			<tr><td>Satuan Kerja</td><td>:</td><td>UPBJJ- UT Serang</td></tr>
			<tr><td>Tgl dan No.RKA-UK</td><td>:</td><td></td></tr>
			<tr><td>Tahun Anggaran</td><td>:</td><td>2018</td></tr>
	</table>

<table class="table table-bordered table-hover table-striped table-sm">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>No Bukti</th>
			<th>Uraian</th>
			<th>Debet</th>
			<th>Kredit</th>
			<th>Saldo</th>
		</tr>
   </thead>
  <tbody>
<?php $no = 1;?>
@foreach($BKU as $laps)
<?php   $date = strtotime($laps->Tanggal);    $date_fix = date('M,j ', $date);   

		$saldoawal =  $laps->Debet - $laps->Kredit;
	
?>	
                    	<tr>
                    			<td>  {{ $no }}</td>
                    			<td>{{ $date_fix }}</td>
                    			<td>{{ $laps->No_bukti }}</td>
                    			<td>{{ $laps->Uraian }}</td>
                    			<td>{{ rupiah($laps->Debet) }}</td>
                    			<td>{{ rupiah($laps->Kredit) }}</td>
                    			<td>{{ rupiah($laps->saldo)}}</td>
                    	</tr>
                    	<?php $no++;?>
 @endforeach

 @foreach($tot as $tots)
 <tr>
 	<td></td><td></td><td></td><td>Total</td><td>{{ rupiah($tots->totdebet) }}</td><td>{{ rupiah($tots->totkredit) }}</td><td>{{ rupiah($tots->totsaldo) }}</td>
 </tr>
@endforeach

 </tbody>
		</table>
	</div>
  <button id="btnPrint">print</button>
</div>

<script>
  $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#bpbank',
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