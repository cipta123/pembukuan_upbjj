<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buku_master;
use App\Buku_transaksi;
use DB;

class entryController extends Controller
{
    public function entry_process_1(Request $request){
    	if ($request->ajax()) {
            $tgl = $request->input('tanggal');
                
                $No_bukti = $request->input('No_bukti');
                $Uraian =  $request->input('Uraian');
                $Kredit = $request->input('Kredit');
              $Kredit = explode(".", substr($Kredit,3));$Kredit=implode($Kredit);$Kredit=floatval($Kredit);
                $Debet  = $request->input('Debet');
                $Debet = explode(".", substr($Debet,3));$Debet=implode($Debet);$Debet=floatval($Debet);
                $BKU =$request->input('BKU');
                $BPKT =$request->input('BPKT');
                $BPBANK =$request->input('BPBANK');
                $BPUP =$request->input('BPUP');
                $BPLS =$request->input('BPLS');
                $BPLL =$request->input('BPLL');
                $Pajak =$request->input('Pajak');
                $Rpajak =$request->input('Rpajak');
                $tanda_sukses = $request->only(['tanda_sukses']);

            
            $data_primary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit,
              'BKU'=>$BKU,'BP Kas Tunai'=>$BPKT,'BP Bank'=>$BPBANK,'BP UP'=>$BPUP,'BP LS Bendahara'=>$BPLS,'BP Lain Lain'=>$BPLL,'Pajak'=>$Pajak);
           $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
          

    //--------------------------------------------BKU------------------------------------------------//
           if ($BKU==1) {
                       
          $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
          DB::table('bku')->insert($data_secondary);
           } 
           //------------------------------------------LPM_Cair--------------------------------------------//
           
           //----------------------------------------BP Kas Tunai----------------------------------------------//
          if ($BPKT==1) {
           if(substr($No_bukti,0,3)== "cek" || substr($No_bukti,0,3)== "Cek"){
               $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet);
               DB::table('bp_kas_tunai')->insert($data_secondary);
              }else{
              $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
               DB::table('bp_kas_tunai')->insert($data_secondary);
               }
             }
           
           //------------------------------------masuk BP_BANK----------------------------------------------//
           if ($BPBANK==1) {
          if(substr($No_bukti,0,3)== "cek" || substr($No_bukti,0,3)== "Cek"){
               $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Kredit'=>$Kredit);
               DB::table('bp_bank')->insert($data_secondary);
              }else{
              $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
               DB::table('bp_bank')->insert($data_secondary);
               }
             }
           
           //---------------------------masuk BP UP-----------------------------------------------------//
           if ($BPUP==1) {
                 
            $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
               DB::table('bp_up')->insert($data_secondary);
           }
           //-----------------------------------BPLS----------------------------------------//
           if ($BPLS==1) {
             
            $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
               DB::table('bp_ls')->insert($data_secondary);
           }
           //-----------------------------------BPLL----------------------------------------------//
           if ($BPLL==1) {
               
      
            $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
               DB::table('pajak')->insert($data_secondary);
           }
           //----------------------------------------------------------------------------------------//
           
           if ($Pajak==1) {
              if ($Rpajak=="PPN") {
                $Column="PPN";
              }elseif($Rpajak=="PPh21"){
                $Column="PPh21";
              }elseif($Rpajak=="PPh22"){
                $Column="PPh22";
              }elseif($Rpajak=="PPh23"){
                $Column="PPh23";
              }elseif($Rpajak=="Pasal_4"){
                $Column="Pasal_4";
              }


             $data_secondary = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>"pungut ".$Uraian,''.$Column.''=>$Debet,'Kredit'=>$Kredit);
              DB::table('pajak')->insert($data_secondary);

              $data_ke_bku = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>"pungut ".$Uraian,'Debet'=>$Debet,'Kredit'=>$Kredit);
              DB::table('bku')->insert($data_ke_bku);

              //--------------------------------------------------------------------------------------
              $No_bukti = $No_bukti + 1;
              $data_secondary_2 = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>"setor ".$Uraian,''.$Column.''=>0,'Kredit'=>$Debet);
              DB::table('pajak')->insert($data_secondary_2);

              $data_ke_bku_2 = array('Tanggal'=>$tgl,'No_bukti'=>$No_bukti,'Uraian'=>"setor ".$Uraian,'Debet'=>0,'Kredit'=>$Debet);
              DB::table('bku')->insert($data_ke_bku_2);



              //-----------------------------masukkin ke BKU juga----------------------------------//

           }
           
           
if ($data_secondary) {
   return Response($tanda_sukses);
 }




           // json_decode($response->content(), true);
    		// echo "cipta";
    		// $termasuk = $request->termasuk;

    		// $a == dd($termasuk);

    		// return Response($a);
    		//  if ($termasuk=='Kredit') {
    		//  	return Response()->json_encode($termasuk);
    		//  }

    		// $semua= json_decode(json_encode($request->all()),true);
                  //$tgl = json_decode(json_encode($request->input('tanggal')),true);
    		// return Response(json_encode($semua['Uraian']));
    	 //$semua= $request->only(['tanggal']);
    	 //$semua[]= $request->only(['No_bukti']);
    		//return Response($No_bukti);
    	
    	}
    }
}
