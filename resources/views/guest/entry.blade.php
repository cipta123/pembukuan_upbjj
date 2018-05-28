@extends('layouts.master')
@section('head')
 .myclass {
        height: 20px;
        position: relative;
        border: 2px solid #cdcdcd;
        border-color: rgba(0,0,0,.14);
        background-color: AliceBlue ;   ;
        font-size: 14px;
    }


@stop




@section('content')

<div class="container">


    
<div class="isi"> 

<form id="frm-master" action="{{ URL::to('/entry_process_1') }}" method="POST">
  
  
  <label>Tanggal</label>
  <input type="date" name="tanggal" id="tanggal"><br>
 
  <label>No Bukti</label>
  <input type="text" name="No_bukti" id="No_bukti"><br>
  <label>Uraian</label>
  <textarea name="Uraian" cols="30" rows="3" id="Uraian"></textarea><br>
  <input type="hidden" name="tanda_sukses" id="tanda_sukses" value="sukses">
  <input type="hidden" name="tanda_gagal" id="tanda_gagal" value="gagal">
  
 
  
  <label>termasuk</label>
  <select  id="termasuk">
    <option value="#">-----</option>
    <option value="Debet">Debet</option>
    <option value="Kredit">Kredit</option>
  </select>
  
  
  

  <input type="text" name="Kredit" id="Kredit" value="0" placeholder="Kredit" class="myclass" style="display:none;">
  
  
  <input type="text" name="Debet" id="Debet" value="0" placeholder="Debet" class="myclass" style="display:none;"><br>
  
    <input type="checkbox" name="BKU" id="BKU" value="1" checked="yes"> Buku Kas Umum<br>
    <input type="checkbox" name="BPKT" id="BPKT" value="1"> BP Kas Tunai<br>
    <input type="checkbox" name="BPBANK" id="BPBANK" value="1"> BP Bank<br>
    <input type="checkbox" name="BPUP" id="BPUP" value="1"> BP UP<br>
    <input type="checkbox" name="BPLS" id="BPLS" value="1"> BP LS Bendahara<br>
    <input type="checkbox" name="BPLL"  id="BPLL" value="1"> BP Lain Lain<br>
    <input type="checkbox" name="Pajak" id="Pajak" value="1"> Pajak
    <div id="Rpajak" style="display: none">
    <input type="radio" name="Rpajak" value="PPN"> PPN
    <input type="radio" name="Rpajak" value="PPh21"> PPh 21
    <input type="radio" name="Rpajak" value="PPh22"> PPh 22
    <input type="radio" name="Rpajak" value="PPh23"> PPh 23
    <input type="radio" name="Rpajak" value="Pasal4"> Pasal 4<br>
    </div><br>
  <input type="submit" name="submit" value="simpan">
</form>


   
 </div>
</div>

@stop





@section('script')
<script>
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

 //----------------------------------------------------------------//
 $('#termasuk').on('change',function(e){
 	var a = $('#termasuk').val();
 	if (a == 'Kredit') {
 		$('#Debet').hide();
 		$('#Kredit').show();
 	}else{
 		$('#Kredit').hide();
 		$('#Debet').show();
 	}
 });
//------------------CheckBox--------------------------------------//
$('#Pajak').on('click',function(){
$("#BKU").prop('checked', false);
    $('#Rpajak').hide();
   if(this.checked){
     $('#Rpajak').show();
   }
});
//---------------------------------------------------------------//

$('#frm-master').on('submit',function(e){
  		e.preventDefault();
  		var data = $(this).serialize();
  		//var usrname = $('#username').val();
  		//var pass = $('#password').val();
     
  		var url  = $(this).attr('action');
   	    var post = $(this).attr('method');

       // alert(post);
   	    $.ajax({
   	    	type:post,
   	    	url: url,
   	    	data: data,
   	    	// data:{'username':usrname,
   	    	// 	     'password': pass,
         //         'level'   : lvl
         //     },
   	    	dataType: 'json',
   	    	success:function(data){


            if (data.tanda_sukses =="sukses") {
             alert('data berhasil di input')
              $("#No_bukti,#Uraian,#Kredit,#Debet,#termasuk").val("");
              $("#BPKT,#BPBANK,#BPUP,#BPLS,#BPLL,#Pajak").prop('checked', false);
            }else{
              alert('data gagal di input');
            }

            console.log(data);
   	    	}
   	    })

  	});


var Debet = document.getElementById('Debet');
  Debet.addEventListener('keyup', function(e){
    Debet.value = formatRupiah(this.value, 'Rp. ');
  });

// var Kredit = document.getElementById('Kredit');
//   Kredit.addEventListener('keyup', function(e){
//     Kredit.value = formatRupiah(this.value, 'Rp. ');
//   });
  
  
  /* Fungsi */
  function formatRupiah(bilangan, prefix)
  {
    var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa  = split[0].length % 3,
      rupiah  = split[0].substr(0, sisa),
      ribuan  = split[0].substr(sisa).match(/\d{1,3}/gi);
      
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
  }
  
  // function limitCharacter(event){
  //   key = event.which || event.keyCode;
  //   if ( key != 188 // Comma
  //      && key != 8 // Backspace
  //      && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
  //      && (key < 48 || key > 57) // Non digit
  //      // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
  //     ) 
  //   {
  //     event.preventDefault();
  //     return false;
  //   }
  // }

</script>

@stop