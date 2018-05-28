<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class pajakController extends Controller
{
    public function pajakProcess(Request $request){
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

    		$Pajak = DB::select("SELECT Tanggal,No_bukti,Uraian,PPN,PPh21,PPh22,PPh23,Pasal_4,Kredit,@Balance := @Balance + PPN + PPh21 + PPh22 + PPh23 + Pasal_4 - Kredit AS `Saldo` FROM pajak , (SELECT @Balance := 0) AS variableInit WHERE Month(Tanggal)=".$bulan." ORDER BY id ASC");
    		//return Response($BKU);

    		$returnHTML = view('laporan.pajak',['Pajak'=>$Pajak,
            	
            	'no_bukti_terakhir'=>1
            ])->render(); 
           // return Response(var_dump($returnHTML));
              return response()->json( array('success' => true, 'html'=>$returnHTML) );
    	}

    }
}
