<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\bku;
use DB;


class lpjController extends Controller
{
    public function lpjProcess(Request $request){
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
                $operator_x  = '<';
                $tot_sblmnya_bpkt = 0;
                $tot_sblmnya_bpbank = 0;
            }else{
                 $operator = '=';
                 $operator_x  = '<';

           $tot_awal_bpkt = DB::table('bp_kas_tunai')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator_x,$bulan_fix)->get();
              foreach($tot_awal_bpkt as $totawal){$tot_sblmnya_bpkt = $totawal->totsaldo;}

            $tot_awal_bpbank = DB::table('bp_bank')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator_x,$bulan_fix)->get();
              foreach($tot_awal_bpbank as $totawal){$tot_sblmnya_bpbank = $totawal->totsaldo;}

            }


            $ketetapan_UP = 75000000;
             $saldo_awal= DB::select("SELECT Debet FROM bku order by id asc limit 1 ");
            foreach($saldo_awal as $saldo_awalx){$saldo_awal = $saldo_awalx->Debet;}
            //----------- cari saldo awal dari buku pembantu-------------------------------
            $tot_awal_bku = DB::table('bku')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator_x,$bulan_fix)->get();
              foreach($tot_awal_bku as $totawal){$tot_sblmnya_bku = $totawal->totsaldo;}

             $tot_awal_bpup = DB::table('bp_up')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator_x,$bulan_fix)->get();
              foreach($tot_awal_bpup as $totawal){$tot_sblmnya_bpup = $totawal->totsaldo;}

              $tot_awal_bpls = DB::table('bp_ls')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator_x,$bulan_fix)->get();
              foreach($tot_awal_bpls as $totawal){$tot_sblmnya_bpls = $totawal->totsaldo;}

              $tot_awal_bpll = DB::table('bp_ll')->select(DB::raw('sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator_x,$bulan_fix)->get();
              foreach($tot_awal_bpll as $totawal){$tot_sblmnya_bpll = $totawal->totsaldo;}


              //-----------------------------------------------------------------------------------








            //-------------saldo bku
            $saldo_bku = DB::table('bku')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bku as $saldo_bkux){
            	$total_debet_bku   = $saldo_bkux->totdebet;
            	$total_kredit_bku = $saldo_bkux->totkredit;
            	$saldo_bku_total = $saldo_bkux->totsaldo;

            }

            //------------ saldo bp_UP
            $saldo_bpup = DB::table('bp_up')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpup as $saldo_bpupx){
            	$total_debet_bpup = $saldo_bpupx->totdebet;
            	$total_kredit_bpup = $saldo_bpupx->totkredit;
            	$saldo_bpup_total = $saldo_bpupx->totsaldo;
            }

            //--------------------------------------------------------------------------------------
            $saldo_bpls = DB::table('bp_ls')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpls as $saldo_bplsx){
            	$total_debet_bpls  = $saldo_bplsx->totdebet;
            	$total_kredit_bpls = $saldo_bplsx->totkredit;
            	$saldo_bpls_total  = $saldo_bplsx->totsaldo;
            }
            //--------------------------------------------------------------------------------------
            $saldo_bpll = DB::table('bp_ll')->select(DB::raw('sum(kredit) as totkredit,sum(debet) as totdebet,sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpll as $saldo_bpllx){
            	$saldo_bpll_total = $saldo_bpllx->totsaldo;
            	$total_debet_bpll  = $saldo_bpllx->totdebet;
            	$total_kredit_bpll = $saldo_bpllx->totkredit;
            }
       
            //---------------------------------------------------------------------------------------
         $saldo_pajak =  DB::table('pajak')->select(DB::raw('sum(kredit) as totkredit'))->whereMonth('Tanggal','=',$bulan_fix)->get();
            foreach($saldo_pajak as $saldo_pajakx){
                $total_pajak_kredit = $saldo_pajakx->totkredit;

            }
            // return Response(var_dump($saldo_pajak));
            //---------------------------------------------------------------------------
            $saldo_bpkt =  DB::table('bp_kas_tunai')->select(DB::raw('sum(kredit) as totkredit,sum(debet)+'.$tot_sblmnya_bpkt.' as totdebet,'.$tot_sblmnya_bpkt.'+sum(debet)-sum(kredit) as totsaldox'))->whereMonth('Tanggal','=',$bulan_fix)->get();
            foreach($saldo_bpkt as $saldo_bpktx){
            	$saldo_bpkt_total = $saldo_bpktx->totsaldox;}
            //------------------------------------------------------------------------------
            $saldo_bpbank = DB::table('bp_bank')->select(DB::raw('sum(kredit) as totkredit,sum(debet) +'.$tot_sblmnya_bpbank.' as totdebet,'.$tot_sblmnya_bpbank.'+ sum(debet)-sum(kredit) as totsaldo'))->whereMonth('Tanggal',$operator,$bulan_fix)->get();
            foreach($saldo_bpbank as $saldo_bpbankx){
            	$saldo_bpbank_total = $saldo_bpbankx->totsaldo;}

            
           // $jumlah_saldo_detail =  $saldo_bpup + $saldo_bpls + $saldo_bpll + $saldo_pajak;
            //$selisih_pembukuan = $saldo_bku_total - $jumlah_saldo_detail;

      $last_no_bukti = DB::select("SELECT No_bukti FROM bku where month(Tanggal) = ".$bulan_fix." order by id desc limit 1 ");
      foreach($last_no_bukti as $last_no_buktix){$last_no_bukti = $last_no_buktix->No_bukti;}
      		//-------------------------------No Bukti terakhir

           // return Response(var_dump($last_no_bukti));

            $returnHTML = view('laporan.lpj',[
            	'close'=> $tutup_bulan_fix,
            	'hari'=>$dayList[$day],
            	'no'=>1,
            	//-----------------------------------
            	 'tot_sblmnya_bku'=>$tot_sblmnya_bku,
            	'saldo_bku_total'=>$saldo_bku_total,
            	'total_debet_bku'=>$total_debet_bku,
            	'total_kredit_bku'=>$total_kredit_bku,
            	//------------------------------------
                'tot_sblmnya_bpup'=>$tot_sblmnya_bpup,
            	'saldo_bpup_total'=>$saldo_bpup_total,
            	'total_debet_bpup'=>$total_debet_bpup,
            	'total_kredit_bpup'=>$total_kredit_bpup,
            	//------------------------------------
                'tot_sblmnya_bpls'=>$tot_sblmnya_bpls,
            	'saldo_bpls_total'=>$saldo_bpls_total,
            	'total_debet_bpls'=>$total_debet_bpls,
            	'total_kredit_bpls'=>$total_kredit_bpls,
            	//--------------------------------------
                'tot_sblmnya_bpll'=>$tot_sblmnya_bpll,
            	'saldo_bpll_total'=>$saldo_bpll_total,
            	'total_debet_bpll'=>$total_debet_bpll,
            	'total_kredit_bpll'=>$total_kredit_bpll,
            	//-----------------------------------------
            	'total_pajak_kredit'=> $total_pajak_kredit,
            	//'selisih_pembukuan'=>$selisih_pembukuan,
            	'saldo_bpkt_total'=>$saldo_bpkt_total,
            	'saldo_bpbank_total'=>$saldo_bpbank_total,
            	//'jumlah_saldo_detail'=>$jumlah_saldo_detail,
                'ketetapan_UP' =>$ketetapan_UP,
            	'saldo_awal' => $saldo_awal,
            	'no_bukti_terakhir'=>$last_no_bukti
            ])->render(); 
           // return Response(var_dump($returnHTML));
              return response()->json( array('success' => true, 'html'=>$returnHTML) );



            //return Response(var_dump($tutup_bulan_fix));



         
    	}
    }
}
