<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bku;
use DB;

class lapController extends Controller
{
    public function bkuProcess(Request $request){
    	if ($request->ajax()) {

    	     	$BP = $request->input('BP');
            //---------------------------------//
            $bulan =  $request->input('bulan');
            $bulan_fix = substr($bulan,1,1);
            //---------------------------------//
            $tahun = $request->input('tahun');
            //-------------------cari  tanggal Closing ------------------//
            $bulanx = $bulan + 1;
            $tutup_bula = "0"."$bulanx";
            $hari_ini = date("Y-m-d");
            $tutup_bulan = date('Y-'.$tutup_bula.'-01', strtotime($hari_ini));
            $tutup_bulan_fix = date('d F Y', strtotime($tutup_bulan));
            $day = date('D', strtotime($tutup_bulan));
            $dayList = array(
                'Sun' => 'Minggu',
                'Mon' => 'Senin',
                'Tue' => 'Selasa',
                'Wed' => 'Rabu',
                'Thu' => 'Kamis',
                'Fri' => 'Jumat',
                'Sat' => 'Sabtu'
            );


            //----------------------------------------------------------/////
           //return Response(var_dump($tutup_bulan_fix));
        
            if ($BP=="BKU") {
                $table='bku';
                $view = 'bku';
            } elseif ($BP=="bp_kas_tunai") {
                 $table='bp_kas_tunai';
                 $view='bpkt';
            } elseif ($BP=="bp_bank") {
                $table='bp_bank';
                $view='bp_bank';
            } elseif ($BP=="bp_up") {
                 $table ='bp_up';
                 $view ='bp_up';
            } elseif ($BP=="bp_ls") {
                 $table='bp_ls';
                 $view ='bp_ls';
            } elseif ($BP=="bp_ll") {
                $table='bp_ll';
                $view ='bp_ll';
            }

            elseif ($BP=="lpj") {
              $table = 'bku';
              $saldo_awal = DB::select("SELECT Debet FROM bku order by Tanggal asc limit 1 ");
              $BKU = DB::select("SELECT Tanggal,No_bukti,Uraian,Debet FROM bku where DEBET <> 0");
              $returnHTML = view('laporan.lpj',['close'=> $tutup_bulan_fix,'hari'=>$dayList[$day],'BKU'=>$BKU,'saldo_a'=>$saldo_awal,'no'=>1])->render(); 
              return response()->json( array('success' => true, 'html'=>$returnHTML) );
            }

           //table content ngambil dari sini ----------------------------//
            $BKU = DB::Select("SELECT x.`Tanggal` ,x.`No_bukti` ,x.`Uraian`, x.`Debet` , x.`Kredit` , SUM(y.`bal`) as saldo FROM ( SELECT *,Debet-Kredit bal FROM ".$table." ) x JOIN ( SELECT *,Debet-Kredit bal FROM ".$table." ) y ON y.`id` <= x.`id` where month(x.`Tanggal`) = $bulan_fix GROUP BY x.`id`");

          //-----------------Mencari bulan sebelum bulan yang di request----------------------//
           if ($bulan_fix > 1) {
         //-----------------End Mencari bulan sebelum bulan yang di request----------------------//

     $tot_seblmnya= DB::table($table)->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal','<',$bulan_fix)->get();
              foreach($tot_seblmnya as $totawal){$tot_sblmnya = $totawal->totsaldo;}

//-----------------------KHUSUS UNTUK BUKU KAS UMUM-------------------------//
        //--------Mencari Total Awal Buku kas umum dari bulan sebelum----------//


              $tot_awal_bku = DB::table('bku')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal','<',$bulan_fix)->get();
              foreach($tot_awal_bku as $totawal){$tot_sblmnya_bku = $totawal->totsaldo;}
        //--------end Total Awal dari bulan sebelum bulan yang di request  dengan Var $tot_sblmnya 
              $tot_awal_bpkt = DB::table('bp_kas_tunai')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal','<',$bulan_fix)->get();
              foreach($tot_awal_bpkt as $totawal){$tot_sblmnya_bpkt = $totawal->totsaldo;}
              //----------------------------------------------------------------------------------
              $tot_awal_bpbank = DB::table('bp_bank')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal','<',$bulan_fix)->get();
              foreach($tot_awal_bpbank as $totawal){$tot_sblmnya_bpbank = $totawal->totsaldo;}





              //Hitung Saldo Kas untuk Buku Kas Umum---------------
              $saldo_kas =   DB::table('bp_kas_tunai')->select(DB::raw('sum(kredit) as totkredit,sum(debet)+'.$tot_sblmnya_bpkt.' as totdebet,sum(debet)+'.$tot_sblmnya_bpkt.'-sum(kredit) as totsaldox'))->whereMonth('Tanggal','=',$bulan_fix)->get();
              foreach($saldo_kas as $saldo_ka){$saldo_kas = $saldo_ka->totsaldox;}
              
              

              $saldo_bank =  DB::table('bp_bank')->select(DB::raw('sum(kredit) as totkredit,sum(debet)+'.$tot_sblmnya_bpbank.' as totdebet,sum(debet)+'.$tot_sblmnya_bpbank.'-sum(kredit) as totsaldoz'))->whereMonth('Tanggal','=',$bulan_fix)->get();
              foreach($saldo_bank as $saldo_ban){$saldo_bank = $saldo_ban->totsaldoz;}
              //return Response($saldo_bank);
             

              //------- Total yang ditampilkan di bagian bawah table selain bulan Januari-------------
             $tot = DB::table($table)->select(DB::raw('sum(kredit) as totkredit,sum(debet)+'.$tot_sblmnya.' as totdebet,sum(debet)+'.$tot_sblmnya.'-sum(kredit) as totsaldo'))->whereMonth('Tanggal','=',$bulan_fix)->get();
             //------------------End total-----------------------------------------------------------//
             $returnHTML = view('laporan.'.$view.'',['close'=> $tutup_bulan_fix,'hari'=>$dayList[$day],'BKU'=>$BKU,'saldo_kas'=>$saldo_kas,'saldo_bank'=>$saldo_bank,'tot'=>$tot])->render(); 

             
             return response()->json( array('success' => true, 'html'=>$returnHTML));

           }else{

            $saldo_kas = DB::table('bp_kas_tunai')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldox'))->whereMonth('Tanggal','=',$bulan_fix)->get();
            foreach($saldo_kas as $saldo_ka){$saldo_kas = $saldo_ka->totsaldox;}

            $saldo_bank = DB::table('bp_bank')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldoz'))->whereMonth('Tanggal','=',$bulan_fix)->get();
            foreach($saldo_bank as $saldo_ban){$saldo_bank = $saldo_ban->totsaldoz;}
          

            $tot = DB::table($table)->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal','=',$bulan_fix)->get();

            $returnHTML = view('laporan.'.$view.'',['close'=> $tutup_bulan_fix,'hari'=>$dayList[$day],'BKU'=>$BKU,'tot'=>$tot,'saldo_kas'=>$saldo_kas,'saldo_bank'=>$saldo_bank])->render(); 

            //return Response(var_dump($returnHTML));
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
    		//return Response(var_dump($tahun));

          }
    	}

    }
}

//--------------------------------------return HTML to ajax----------------------------------------//
// $returnHTML = view('job.userjobs',[' userjobs'=> $userjobs])->render();// or method that you prefere to return data + RENDER is the key here
         //   return response()->json( array('success' => true, 'html'=>$returnHTML) );