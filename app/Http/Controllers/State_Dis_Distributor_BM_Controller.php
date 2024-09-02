<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class State_Dis_Distributor_BM_Controller extends Controller
{
    //
   public function createState(){
    $zones = DB::table('tbl_zone')->select('id','zone_name')->get();
    return view('frontend.createState',['zones'=>$zones]);

   }

   public function editpage(string $id){
    try{
    $bm_detail = DB::table('tbl_distributor')->select('id','bm_name','bm_email','bm_mobile','distributor_name')->where('id',$id)->first();
    // echo "<pre>";
    // print_r($bm_detail);
    // echo "</pre>";
    // die();
    return view('frontend.editBM',['bm_detail'=>$bm_detail]);
} catch(\Exception $e){
    //$e->getMessage()
        return redirect()->back()->with('error','Something went wrong!' );
    }
   }
//    public function updateBmDist(Request $request,string $id){
//     $validatedData = $request->validate([
//         'distributor_name' => 'required',
//         'bm_name' => 'required',
//         'bm_mobile' => 'required',
//         'bm_email' => 'required',
   
//     ]);
//     try{
//         $bm_dist_exist = DB::table('tbl_distributor')->where('id',$id)->first();
//         if($bm_dist_exist){
//             $dist_pin_map_exist = DB::table('tbl_distributor_pin_maps')->where('distributor_id',$id)->first();
//             if($dist_pin_map_exist){
//                 $bm_dist_update = DB::table('tbl_distributor')->where('id',$id)->update(['bm_name'=>$validatedData['bm_name'],'bm_email'=>$validatedData['bm_email'],'bm_mobile'=>$validatedData['bm_mobile'],'distributor_name'=>$validatedData['distributor_name']]);
//                 $dist_pin_map_update =  DB::table('tbl_distributor_pin_maps')->where('distributor_id',$id)->update(['bm_name'=>$validatedData['bm_name'],'bm_email'=>$validatedData['bm_email'],'bm_mobile'=>$validatedData['bm_mobile']]);
//             }else{
//                 $bm_dist_update = DB::table('tbl_distributor')->where('id',$id)->update(['bm_name'=>$validatedData['bm_name'],'bm_email'=>$validatedData['bm_email'],'bm_mobile'=>$validatedData['bm_mobile'],'distributor_name'=>$validatedData['distributor_name']]);
//             }
//             return redirect()->back()->with('success', 'Distributor-BM is updated.');
//         }else{
//             return redirect()->back()->with('error', 'Distributor-BM is not found.');
//         }

//     }
//     catch(\Exception $e){
//         return redirect()->back()->with('error', $e->getMessage());
//     }
//    }
public function updateBmDist(Request $request, string $id)
{
    
    $validatedData = $request->validate([
        'distributor_name' => 'required|regex:/^[\pL\s]+$/u',
        'bm_name' => 'required|regex:/^[\pL\s]+$/u',
        'bm_mobile' => 'required|size:10',
        'bm_email' => 'required|email',
    ]);
    
    

    try {
        $bm_dist_exist = DB::table('tbl_distributor')->where('id', $id)->exists();

        if (!$bm_dist_exist) {
            return redirect()->back()->with('error', 'Distributor-BM is not found.');
        }

        $bm_dist_update_data = [
            'bm_name' => $validatedData['bm_name'],
            'bm_email' => $validatedData['bm_email'],
            'bm_mobile' => $validatedData['bm_mobile'],
            'distributor_name' => $validatedData['distributor_name']
        ];

        DB::table('tbl_distributor')->where('id', $id)->update($bm_dist_update_data);

        $dist_pin_map_update_data = [
            'bm_name' => $validatedData['bm_name'],
            'bm_email' => $validatedData['bm_email'],
            'bm_mobile' => $validatedData['bm_mobile']
        ];

        if (DB::table('tbl_distributor_pin_maps')->where('distributor_id', $id)->exists()) {
            DB::table('tbl_distributor_pin_maps')->where('distributor_id', $id)->update($dist_pin_map_update_data);
        }

        return redirect()->route('fetchBmList')->with('success', 'Distributor-BM is updated.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong!');
    }
}





}
