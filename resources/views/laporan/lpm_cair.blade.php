
<h1>SPM CAIR</h1>
<?php
function rupiah($angka){
	$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
	return $hasil_rupiah; 
		}?>

@foreach($saldo_a as $saldo_aw)
<?php $saldoawal = $saldo_aw->Debet; ?>
@endforeach

<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>No Bukti</th>
			<th>Uraian</th>
			<th>Debet</th>
			<th>Saldo</th>
		</tr>
   </thead>
  <tbody>

  @foreach($BKU as $laps)
<?php  if ($laps->Debet == $saldoawal) {$saldoawal == $saldoawal;} else{$saldoawal += $laps->Debet;} 
            $date = strtotime($laps->Tanggal);    $date_fix = date('M,j ', $date);   ?>
<tr>
	<td>{{ $no  }}</td>
	<td>{{ $date_fix }}</td>
	<td>{{ $laps->No_bukti }}</td>
	<td>{{ $laps->Uraian }}</td>
	<td>{{ rupiah($laps->Debet) }}</td>
     <td> {{   rupiah($saldoawal)    }}</td>
</tr>
 <?php $no++; ?>
  @endforeach
  @foreach($total as $totals)
  <td></td><td></td><td></td>
  <td>TOTAL</td>
  <td>{{ rupiah($totals->total)  }}</td>

  @endforeach
