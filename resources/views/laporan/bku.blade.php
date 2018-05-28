





<div class="containers">
<div id="bku">
<div style="text-align: center;"><h2><b>BUKU KAS UMUM</b></h2></div>



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
			
			<th>Tgl</th>
			<th>NoBukti</th>
			<th>Uraian</th>
			<th width="150">Debet</th>
			<th width="150">Kredit</th>
			<th width="150">Saldo</th>
		</tr>
   </thead>
  <tbody>

@foreach($BKU as $laps)
<?php   $date = strtotime($laps->Tanggal);    
        $date_fix = date('M,j ', $date);   

		$saldoawal =  $laps->Debet - $laps->Kredit;
	
?>	
                    	<tr>
                    			<td>{{ $date_fix }}</td>
                    			<td>{{ $laps->No_bukti }}</td>
                    			<td>{{ $laps->Uraian }}</td>
                    			<td>{{ rupiah($laps->Debet) }}</td>
                    			<td>{{ rupiah($laps->Kredit) }}</td>
                    			<td>{{ rupiah($laps->saldo)}}</td>
                    	</tr>
 @endforeach

 @foreach($tot as $tots)
 <tr>
 	<td></td><td></td><td>Total</td><td>{{ rupiah($tots->totdebet) }}</td><td>{{ rupiah($tots->totkredit) }}</td><td>{{ rupiah($tots->totsaldo) }}</td>
 </tr>
@endforeach

 </tbody>
</table>

<div>
	Pada hari ini, {{ $hari }}, {{ $close }}, Buku Kas Umum (BKU) ditutup dengan  <br>
	keadaan kas sebagai berikut :
	<table>
		<tr>
		<td><b>I.Saldo Buku</b></td>
		</tr>
		<tr>
		<td><i>Jumlah Penerimaan</i></td><td width="100"></td>  <td>{{ rupiah($tots->totdebet)}}</td>
		</tr>
		<tr>
		<td><i>Jumlah Pengeluaran</i></td><td width="100"></td>   <td>{{ rupiah($tots->totkredit) }}</td>
		</tr>
	</table>
	<table>
		<?php $selisih = $tots->totdebet - $tots->totkredit ;   ?>
		<tr>
			<td width="500">selisih</td><td>{{ rupiah($selisih) }}</td>
		</tr>
	</table>
		<tr></tr>
		<table>
		<tr>
			<td><b>II.Saldo Kas</b></td>
		</tr>


		<tr>
			<td><i>Kas Tunai</i></td><td width="100"></td>  <td>{{ rupiah($saldo_kas) }}</td>
		</tr>
       

		<tr>
			<td><i>Saldo Bank</i></td><td width="100"></td>  <td>{{ rupiah($saldo_bank) }}</td>
		</tr>
		</table>
		<table>
			
		<tr>
	<td width="500"></td> <td>{{ rupiah($saldo_kas+$saldo_bank) }}</td>
		</tr>
		</table>

	
	
  </div>

 </div>
<button id="btnPrint">print</button>
</div>


<script>
  $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#bku',
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







 
