<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class nurturingLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateNurturingLead(Request $request)
    {
        
        // print_r($request->all());
        // die();
//         $reminderSet = $request->input('reminder_set');

//         // Convert the date string to a DateTime object
//         $dateTime = new \DateTime($reminderSet);

//         // Format the DateTime object in the desired format
//         $formattedReminderSet = $dateTime->format('Y-m-d H:i:s');
//         echo $formattedReminderSet;
//  die();
        $validatedData = $request->validate([
            'lead_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'lead_status' => 'required',
            'lead_type' => 'required',
            'executive_id_assign_to' =>'nullable',
            'BM_id'=>'nullable',
           
            'mobile'=>'required',
            'email'=>'required|email',
            'lead_data'=>'required',
            'formattedTime'=>'required',
            'reminder_set'=> 'required',
            
        ]);
        try{
            $istTime = Carbon::now();
            $dateTime = new \DateTime($validatedData['reminder_set']);
            $formattedReminderSet = $dateTime->format('Y-m-d H:i:s');
            $lead = DB::table('tbl_lead')->where('id',$validatedData['lead_id'])->first();
                if($lead){
   
                    $time =  $lead->time_taken;
                    $time2 = $validatedData['formattedTime'];

                    $secs = strtotime($time2)-strtotime("00:00:00");
                     $total_time_taken = date("H:i:s",strtotime($time)+$secs);
                     $givenDate = $lead->lead_date;
                     $difference_in_days = $this->calculateDateDifference($givenDate);
                 
                    $lead_arr = DB::table('tbl_lead')
                    ->where('id',$validatedData['lead_id'])
                    ->update([
                        'first_name' => $validatedData['first_name'],
                        'last_name' => $validatedData['last_name'],
                        'lead_status_id' => $validatedData['lead_status'],
                        'lead_type_id' => $validatedData['lead_type'],
                        'executive_id_assign_to' => isset($validatedData['executive_id_assign_to']) ? $validatedData['executive_id_assign_to'] : null,
                        'BM_id' => isset($validatedData['BM_id']) ? $validatedData['BM_id'] : 0,
                        'mobile' => $validatedData['mobile'],
                        'email' => $validatedData['email'],
                        'lead_data' => $validatedData['lead_data'], // Corrected key here
                        'is_new' => 2,
                        'time_taken' => $validatedData['formattedTime'],
                        'total_time_taken' => $total_time_taken,
                        'lead_assign_by' => Session::get('userdata')->id,
                        'next_date_call'=> $formattedReminderSet,
                        'updated_at'=>$istTime
                       
                    ]);
                    if($lead_arr){
                        $lead_lmt = DB::table('lead_log')->select('lead_action_dates')->where('lead_id', $validatedData['lead_id'])
                        ->where('lead_status_id', 1)->orderBy('id', 'asc')->first();
                        if($lead_lmt){
                            $hot_lead_actin_date = $lead_lmt->lead_action_dates;
                            $dif_hot_date = $this->calculateDateDifference($hot_lead_actin_date);
                           $distri_days_count = $dif_hot_date;
                        }else{
                           $distri_days_count=0;
                        }

                        if($validatedData['lead_status'] == 2){
                            
                            //insert in lead log
                            $lead_log_ins = DB::table('lead_log')->insert(['lead_id'=>$validatedData['lead_id'],'lead_status_id'=> $validatedData['lead_status'],'lead_type_id' => $validatedData['lead_type'],'time_taken_duration' => $validatedData['formattedTime'],'created_by_id' => Session::get('userdata')->id,'call_description'=>$validatedData['lead_data'],'lead_action_dates'=>$istTime,'updated_at'=>$istTime]);

                            $lead_discsn_table = DB::table('tbl_lead_discsn')->where('lead_id',$validatedData['lead_id'])->select('call_count')->first();
                            //update in lead discussion table
                            $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$validatedData['lead_id'])->first();
                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['nurturing_count'=>$report_tbl->nurturing_count + 1,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>$distri_days_count]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>0,'nurturing_count'=>1,'dead_count'=>0,'closed_count'=>0,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>$distri_days_count,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                            if($lead_discsn_table){
                                $lead_discusin_update = DB::table('tbl_lead_discsn')->where('lead_id',$validatedData['lead_id'])->update(['description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> $lead_discsn_table->call_count + 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }else{
                                $lead_discusin_ins = DB::table('tbl_lead_discsn')->insert(['lead_id'=>$validatedData['lead_id'],'description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }
                        }elseif($validatedData['lead_status'] == 1){
                            $lead_log_ins = DB::table('lead_log')->insert(['lead_id'=>$validatedData['lead_id'],'lead_status_id'=> $validatedData['lead_status'],'lead_type_id' => $validatedData['lead_type'],'time_taken_duration' => $validatedData['formattedTime'],'created_by_id' => Session::get('userdata')->id,'call_description'=>$validatedData['lead_data'],'lead_action_dates'=>$istTime,'created_at'=>$istTime]);
                            $lead_discsn_table = DB::table('tbl_lead_discsn')->where('lead_id',$validatedData['lead_id'])->select('call_count')->first();
                            $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$validatedData['lead_id'])->first();
                            if($distri_days_count == 0){
                                $distri_days_count= 1;
                            }else{
                                $distri_days_count;
                            }

                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['hot_count'=>$report_tbl->hot_count + 1,'updated_at'=>$istTime,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>$distri_days_count]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>1,'nurturing_count'=>0,'dead_count'=>0,'closed_count'=>0,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>$distri_days_count,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                            //update in lead discussion table
                            if($lead_discsn_table){
                                $lead_discusin_update = DB::table('tbl_lead_discsn')->where('lead_id',$validatedData['lead_id'])->update(['description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> $lead_discsn_table->call_count + 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }else{
                                $lead_discusin_ins = DB::table('tbl_lead_discsn')->insert(['lead_id'=>$validatedData['lead_id'],'description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }
                            
                        }elseif($validatedData['lead_status'] == 3){
                            $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$validatedData['lead_id'])->first();
                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['dead_count'=>$report_tbl->dead_count + 1,'updated_at'=>$istTime,'lead_days_count'=>$difference_in_days]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>0,'nurturing_count'=>0,'dead_count'=>1,'closed_count'=>0,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>0,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                        }else{
                            $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$validatedData['lead_id'])->first();
                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['closed_count'=>$report_tbl->closed_count + 1,'updated_at'=>$istTime,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>$distri_days_count]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>0,'nurturing_count'=>0,'dead_count'=>0,'closed_count'=>1,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>$distri_days_count,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                        }
                       
                    


                    }
                    return redirect()->route('nuturingLeadPage')->with('success', 'Lead is updated and assigned.');
                }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
