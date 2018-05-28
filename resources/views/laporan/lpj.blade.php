<div class="container">
<div id="lpj">
<div style="text-align: center;">

	<h3><b>LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENGELUARAN PEMBANTU</b></h3>
		<h4>Tahun 2018</h4>

</div>

<?php
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah; }
?>

	<table>		
			<tr><td>Departemen/Lembaga</td><td>:</td><td>Kementrian, Riset dan Pendidikan Tinggi</td></tr>
			<tr><td>Unit Organisasi</td><td>:</td><td>DITJEN DIKTI</td></tr>
			<tr><td>Prop/Kab/Kota</td><td>:</td><td>BANTEN  / Tanggerang Selatan</td></tr>
			<tr><td>Satuan Kerja</td><td>:</td><td>UNIVERSITAS TERBUKA/UPBJJ-UT SERANG</td></tr>
			<tr><td>Tgl dan No.RKA-UK</td><td>:</td><td></td></tr>
			<tr><td>Tahun Anggaran</td><td>:</td><td>2018</td></tr>
			<tr><td>KPPN</td><td>:</td><td>(139) KPPN Jakarta V</td></tr>
	</table>

<p><b>I. Keadaan Pembukuan bulan pelaporan dengan saldo akhir BKU sebesar {{ rupiah($saldo_bku_total) }} dan No.Bukti Terakhir {{ $no_bukti_terakhir }}</b></p>
<table class="table table-bordered table-hover table-striped table-sm">
	<thead>
		<tr>
			<th>No</th>
			<th>Jenis Buku Pembantu</th>
			<th>saldo awal</th>
			<th>Penambahan</th>
			<th>Pengurangan</th>
			<th>Saldo Akhir</th>
		</tr>
   </thead>
  <tbody>
<tr>
	<td>(1)</td><td>(2)</td><td>(3)</td><td>(4)</td><td>(5)</td><td>(6)</td>
</tr>

<tr>
	<td>A</td><td>BP Kas, BPP dan UM Perjadin</td><td></td><td></td><td></td><td>{{ rupiah($tot_sblmnya_bku+$total_debet_bku-$total_kredit_bku) }}</td>	
</tr>
<tr>
	<td></td><td>1. BP Kas (Tunai dan Bank)</td><td>{{ rupiah($tot_sblmnya_bku) }}</td><td>{{ rupiah($total_debet_bku) }}</td><td>{{ rupiah($total_kredit_bku) }}</td><td>{{ rupiah($tot_sblmnya_bku+$total_debet_bku-$total_kredit_bku) }}</td>
</tr>
<tr>
	<td></td><td>2. BP UM Perjadin</td><td></td><td>0</td><td>0</td><td>0</td>
</tr>
<!--  //////////////////////////////////////////////// BP selain kas//////////////////////////////////////-->
<tr>
	<td>B</td><td>BP Selain Kas,BPP, dan UM ,Perjadin</td><td></td><td></td><td></td><td>{{ rupiah(($tot_sblmnya_bpup+$total_debet_bpup-$total_kredit_bpup)+($tot_sblmnya_bpls+$total_debet_bpls-$total_kredit_bpls)+($tot_sblmnya_bpll+$total_debet_bpll-$total_kredit_bpll) ) }}</td>	
</tr>
<tr>
	<td></td><td>1. BP UP*)</td><td>{{ rupiah($tot_sblmnya_bpup) }}</td><td>{{ rupiah($total_debet_bpup) }}</td><td>{{ rupiah($total_kredit_bpup) }}</td><td>{{ rupiah($tot_sblmnya_bpup+$total_debet_bpup-$total_kredit_bpup) }}</td>
</tr>
<tr>
	<td></td><td>2. BP LS Bendahara</td><td>{{ rupiah($tot_sblmnya_bpls) }}</td><td>{{ rupiah($total_debet_bpls) }}</td><td>{{ rupiah($total_kredit_bpls) }}</td><td>{{ rupiah($tot_sblmnya_bpls+$total_debet_bpls-$total_kredit_bpls) }}</td>
</tr>
<tr>
	<td></td><td>3. BP Pungutan Pajak</td><td></td><td>{{ rupiah($total_pajak_kredit) }}</td><td>{{ rupiah($total_pajak_kredit) }}</td><td>{{ rupiah($total_pajak_kredit-$total_pajak_kredit) }}</td>
</tr>
<tr>
	<td></td><td>4. BP Lain-lain</td><td>{{ rupiah($tot_sblmnya_bpll) }}</td><td>{{ rupiah($total_debet_bpll) }}</td><td>{{ rupiah($total_kredit_bpll) }}</td><td>{{ rupiah($tot_sblmnya_bpll+$total_debet_bpll-$total_kredit_bpll) }}</td>
</tr>
 </tbody>
</table>


<table>
	<tr><td><b>II. Keadaan Kas pada akhir bulan pelaporan</b></td></tr>
	<tr>
		    <td>1. Uang tunai di brankas</td><td></td><td>{{ rupiah($saldo_bpkt_total) }}</td>
	</tr>
	<tr>
	       <td>2. Uang di rekening bank</td><td></td><td>{{ rupiah($saldo_bpbank_total)}}</td>
	</tr>
	<tr>
		<td>3. Jumlah kas</td><td></td><td></td><td></td><td>{{ rupiah($saldo_bpbank_total + $saldo_bpkt_total)}}</td>
	</tr>
</table>

<table>
	<tr><td><b>III. Selisih Kas</b></td></tr>
	<tr>
		    <td>1. Saldo akhir BP Kas (I.A1.kol 6)</td><td></td><td>{{ rupiah($saldo_bpbank_total + $saldo_bpkt_total) }}</td>
	</tr>
	<tr>
	       <td>2. Jumlah Kas (II.3)</td><td></td><td>{{ rupiah($saldo_bpbank_total + $saldo_bpkt_total)}}</td>
	</tr>
	<tr>
		<td>3. Selisih kas</td><td></td><td></td><td></td><td>{{  rupiah(($saldo_bpbank_total + $saldo_bpkt_total)-($saldo_bpbank_total+$saldo_bpkt_total)) }}</td>
	</tr>
</table>

<table>
	<tr><td><b>IV. Hasil Rekonsiliasi Internal dengan BPP.UP</b></td></tr>
	<tr>
		    <td>1. Saldo UP </td><td></td><td>{{ rupiah($tot_sblmnya_bpup+$total_debet_bpup-$total_kredit_bpup) }}</td>
	</tr>
	<tr>
	       <td>2. Kuitansi UP </td><td></td><td>{{ rupiah(($ketetapan_UP)-($tot_sblmnya_bpup+$total_debet_bpup-$total_kredit_bpup)) }}</td>
	</tr>
	<tr>
		<td>3. Jumlah UP</td><td></td><td></td><td></td><td>{{ rupiah($ketetapan_UP) }}</td>
	</tr>
	<tr>
		<td>4. Saldo UP menurut BPP.UP</td><td></td><td></td><td></td><td>{{ rupiah($ketetapan_UP) }}</td>
	</tr>
	<tr>
		<td>5. Selisih pembukuan UP</td><td></td><td></td><td></td><td>{{ rupiah($ketetapan_UP-$ketetapan_UP) }}</td>
	</tr>
</table>


<table>
	<tr>
		<td><b>V. Pembukuan dan Fisik kas telah Diperiksa oleh KPA dengan hasil sebagai berikut :</b></td>
	</tr>
	<tr>
		<td>1. Pembukuan dan fisik kas sesuai</td>
	</tr>
	<tr>
		<td>2.</td>
	</tr>
</table>
<hr>

<div id="ttdlpj">
	<div class="satu">
	Mengetahui<br>
	Kuasa Pengguna Anggaran<br>
	<br><br><br>
	mamen sudirmen <br>
	NIP. 19760715 200501 2 001
</div>
	<div class="dua"></div>
	<div class="tiga"></div>
	<div class="empat">
    {{ $hari }}, {{ $close }} <br>
	
	<br><br><br><br>
	Drs. Maman Sudirman, S.Pd., M.Pd <br>
	NIP. 19600212 198603 1 002
	</div>
</div>
	</div>
   <button id="btnPrint">print</button>
</div>
<script>
  $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#lpj',
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







 
