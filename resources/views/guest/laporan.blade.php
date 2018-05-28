@extends('layouts.master')

@section('headcss')
#bku{
   width: 80%;
   margin:auto;
}





@stop
@section('content')
<div id="frm_1">
<form id="frm-laporan" method="get" action="{{ URL::to('/lap/bku_process') }}">
<label>Laporan</label>
  <select  id="BP" name="BP">
    <option value="#">-----</option>
    <option value="BKU">Buku Kas Umum</option>
    <option value="bp_kas_tunai">Buku Kas Tunai</option>
    <option value="bp_bank">BP BANK</option>
    <option value="bp_up">BP UP</option>
    <option value="bp_ls">BP LS Bendahara</option>
    <option value="bp_ll">BP Lain Lain</option>
    <option value="lpj">LPJ</option>
    <option value="ba">Berita Acara</option>
     <option value="pajak">Pajak</option>
  </select>
<label>bulan</label>
  <select  id="bulan" name="bulan">
    <option value="#">-----</option>
    <option value="01">Januari</option>
    <option value="02">Februari</option>
    <option value="03">Maret</option>
    <option value="04">April</option>
    <option value="05">Mei</option>
    <option value="06">Juni</option>
    <option value="07">Juli</option>
    <option value="08">Agustus</option>
    <option value="09">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
  </select>
  <select  id="tahun" name="tahun">
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    
  </select>

  <input type="submit" name="proses" id="proses" value="proses">
</form>
</div>

<div id="lap_bku" class="tengah">
	

</div>
@stop




@section('script')
<script>
 $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
//-----------------------------------------------------------------------//
$('#frm-laporan').on('submit',function(e){
  		e.preventDefault();
      var bp = $('#BP').val();
      if (bp=='ba') {
        var gt = "{{ URL::to('lap/ba_process') }}";
      }else if(bp=='pajak'){
        var gt = "{{ URL::to('lap/pajak_process') }}";
      }else if(bp=='lpj'){
        var gt = "{{ URL::to('lap/lpj_process') }}";
      }else{
        var gt = "{{ URL::to('lap/bku_process') }}";
      }



  		var data = $(this).serialize();
 			$.ajax({
                type : 'get',
                url  :  gt,
                data : data,
                success:function(data){
                   $('#lap_bku').html(data.html);

                    console.log(data);
                }
            });
      $(".footer").css("position", "relative");
});



</script>

@stop