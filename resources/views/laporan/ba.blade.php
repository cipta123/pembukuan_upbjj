<div class="container">
<div id="ba">
<div style="text-align: center;">
	<h3><b>Berita Acara Pemeriksaan Kas dan Rekonsiliasi</b></h3>
		<h4>Tahun 2018</h4>

</div>
<div>
<?php
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah; 
		}
?>

<div>
	<p>Pada hari ini {{ $hari }}, tanggal <u>{{ $close }}</u>  kami selaku PPK UPBJJ-UT Serang telah melakukan pemeriksaan kas <br>dengan posisi saldo BKU sebesar {{ rupiah($saldo_bku) }} dan Nomor Bukti terakhir di BKU Nomor {{ $no_bukti_terakhir }} <br>
	Adapun hasil pemeriksaan kas sebagai berikut :
	</p>
</div>
<b>I. Hasil Pemeriksaan Pembukuan Bendahara Pengeluaran Pembantu</b>
<table>
	<tr>
		<td><i>A. Saldo Kas BPP:</i></td>
	</tr>
	<tr>
		<td><u>1. Saldo BP Kas (Tunai dan Bank)</td><td>{{ rupiah($saldo_bku) }}</u></td>
	</tr>
	<tr>
		<td><u>2. Jumlah</td><td>{{ rupiah($saldo_bku) }}</u></td>
	</tr>
</table>

<table>
	<tr><td><i>B. Saldo Kas pada huruf A tersebut terdiri dari :</i></td>
</table>
<table>
	<tr>
		<td></td><td><u>1. Saldo BP UP </u></td><td>:</td><td colspan="2"><u>{{ rupiah($saldo_bpup) }}</u></td><td></td>
	</tr>
	<tr>
		<td></td><td><u>2. Saldo BP LS Bendahara</u></td><td>:</td><td colspan="2"><u>{{ rupiah($saldo_bpls) }}</u></td>
	</tr>
	<tr>
		<td></td><td><u>3. Saldo BP Pajak</u></td><td>:</td><td colspan="2"><u>0</u></td>
	</tr>
	<tr>
		<td></td><td><u>4. Saldo BP Lain-lain</u></td><td>:</td><td colspan="2"><u>{{ rupiah($saldo_bpll) }}</u></td>
	</tr>
	<tr>
		<td></td><td><u>5. Jumlah (B1+B2+B3+B4)</u></td><td>:</td><td></td><td colspan="2"><u>{{ rupiah($jumlah_saldo_detail) }}</u></td>
	</tr>
	<tr><td><i>C. Selisih Pembukuan (A4-B5)</i></td><td></td><td></td><td><u>{{ rupiah($selisih_pembukuan) }}</u></td></tr>
</table>
<hr>
<b>II. Hasil Pemeriksaan Kas</b>
<table>
	<tr><td>A. Saldo Kas pada huruf A tersebut terdiri dari :</td></tr>
	<tr>
		<td><u>1. Uang Tunai di Brankas BPP</u></td><td colspan="2"><u>{{ rupiah($saldo_bpkt) }}</u></td>
	</tr>
	<tr>
		<td><u>2. Uang di Rekening Bank BPP</td></u><td colspan="2"><u>{{ rupiah($saldo_bpbank) }}</u></td>
	</tr>
	<?php $jml_kas = $saldo_bpkt + $saldo_bpbank; ?>
	<tr>
		<td> <u>3. Jumlah Kas (A1+A2)</u></td><td colspan="2"><u>{{ rupiah($jml_kas) }}</u></td>
	</tr>
	<?php $selisih_kas = $saldo_bku - $jml_kas; ?>
	<tr><td>B. Selisih Kas antara Buku dengan Fisik (I.A-II.A)</td><td></td><td></td><td colspan="2">{{ $selisih_kas }}</td></tr>
</table>
<hr>
<b>III. Hasil Rekonsiliasi Internal (BPP dengan Bendahara Pengeluaran BLU)</b>
<table class="table-bordered table-striped">
	<tr><td>A. Pembukuan UP menurut BPP</td></tr>
	<tr>
		<td></td><td><u>1. Saldo UP</td></u><td colspan="2"><u>{{ rupiah($saldo_bpup) }}</u></td>
	</tr>
	<tr>
		<td></td><td><u>2. Kuitansi UP yang belum di-SP2D-kan</u></td><td colspan="2"><u>{{ rupiah($saldo_awal-$saldo_bpup) }}</u></td>
	</tr>
	<tr>
		<td></td><td><u>3. Jumlah UP dan Kuitansi UP (A1+A2)</u></td><td colspan="2"><u>{{ rupiah($saldo_bpup+($saldo_awal-$saldo_bpup)) }}</u></td>
	</tr>
	<tr><td>B.Pembukuan UP menurut
	 Bendahara Pengeluaran BLU</td><td></td><td colspan="2"><u>{{ rupiah($saldo_bpup +($saldo_awal-$saldo_bpup)) }}</u></td></tr>
	<tr><td width="250">C. Selisih UP Pembukuan BPP dengan Bendahara Pengeluaran BLU (A3-B) </td><td></td><td></td><td>Rp.0</td></tr>
</table>
<div><b>IV. Penjelasan atas Selisih</b></div>
<div>1.Selisih kas(IIB).....................................................................</div>
<div>2.Selisih Pembukuan (IIIC).............................................................</div><br>

<div id="ttdba">
	<div class="satu">
	Yang diperiksa,<br>
	BPP.UPBJJ-UT Serang <br>
	<br><br><br>
	Dyah Palupi S., S.Kom <br>
	NIP. 19760715 200501 2 001
</div>
	<div class="dua"></div>
	<div class="tiga"></div>
	<div class="empat">
    Pejabat Pembuat Komitmen UPBJJ-UT Serang <br>
	
	<br><br><br><br>
	Drs. Maman Sudirman, S.Pd., M.Pd <br>
	NIP. 19600212 198603 1 002
	</div>
</div>

</div>
<button id="btnPrint">print</button>
<script>
  $(function(){
            $("#btnPrint").printPreview({
                obj2print:'#ba',
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
