<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\bku;
use DB;


class baController extends Controller
{
    public function baProcess(Request $request){
    	if ($request->ajax()) {


            
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
            
            if ($bulan_fix == 1) {
                $operator = '=';
            }else{
                 $operator = '<=';
            }

             $saldo_awal= DB::select("SELECT Debet FROM bku order by id asc limit 1 ");
            foreach($saldo_awal as $saldo_awalx){$saldo_awal = $saldo_awalx->Debet;}



            //-------------saldo bku
            $saldo_bku = DB::table('bku')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bku as $saldo_bkux){$saldo_bku = $saldo_bkux->totsaldo;}

            //------------ saldo bp_UP
            $saldo_bpup = DB::table('bp_up')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpup as $saldo_bpupx){$saldo_bpup = $saldo_bpupx->totsaldo;}

            //--------------------------------------------------------------------------------------
            $saldo_bpls = DB::table('bp_ls')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpls as $saldo_bplsx){$saldo_bpls = $saldo_bplsx->totsaldo;}
            //--------------------------------------------------------------------------------------
            $saldo_bpll = DB::table('bp_ll')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpll as $saldo_bpllx){$saldo_bpll = $saldo_bpllx->totsaldo;}
       
            //---------------------------------------------------------------------------------------
             $saldo_pajak = 0;// DB::table('pajak')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal','=',$bulan_fix)->get();
            // foreach($saldo_pajak as $saldo_pajakx){$saldo_pajak = $saldo_pajakx->totsaldo;}
            // return Response(var_dump($saldo_pajak));
            //---------------------------------------------------------------------------
            $saldo_bpkt = DB::table('bp_kas_tunai')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpkt as $saldo_bpktx){$saldo_bpkt = $saldo_bpktx->totsaldo;}
            //------------------------------------------------------------------------------
            $saldo_bpbank = DB::table('bp_bank')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpbank as $saldo_bpbankx){$saldo_bpbank = $saldo_bpbankx->totsaldo;}

            
            $jumlah_saldo_detail =  $saldo_bpup + $saldo_bpls + $saldo_bpll + $saldo_pajak;
            $selisih_pembukuan = $saldo_bku - $jumlah_saldo_detail;

      $last_no_bukti = DB::select("SELECT No_bukti FROM bku where month(Tanggal) = ".$bulan_fix." order by id desc limit 1 ");
      foreach($last_no_bukti as $last_no_buktix){$last_no_bukti = $last_no_buktix->No_bukti;}
      		//-------------------------------No Bukti terakhir

           // return Response(var_dump($last_no_bukti));

            $returnHTML = view('laporan.ba',[
            	'close'=> $tutup_bulan_fix,
            	'hari'=>$dayList[$day],
            	'no'=>1,
            	'saldo_bku'=>$saldo_bku,
            	'saldo_bpup'=>$saldo_bpup,
            	'saldo_bpls'=>$saldo_bpls,
            	'saldo_bpll'=>$saldo_bpll,
            	'saldo_pajak'=> $saldo_pajak,
            	'selisih_pembukuan'=>$selisih_pembukuan,
            	'saldo_bpkt'=>$saldo_bpkt,
            	'saldo_bpbank'=>$saldo_bpbank,
            	'jumlah_saldo_detail'=>$jumlah_saldo_detail,
            	'saldo_awal' => $saldo_awal,
            	'no_bukti_terakhir'=>$last_no_bukti
            ])->render(); 
           // return Response(var_dump($returnHTML));
              return response()->json( array('success' => true, 'html'=>$returnHTML) );



            //return Response(var_dump($tutup_bulan_fix));



         
    	}
    }
}
