<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class LeadAssignController extends Controller
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
    // public function update_NewLead_CallCenter(Request $request){
    //     print_r($request->all());
    // }
    public function update_NewLead_CallCenter(Request $request){
        // print_r($request->all());
        // die();
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
            'reminder_set'=> 'nullable',
            
            
        ]);
        try{
            $istTime = Carbon::now();
            // $user->email = $validatedData['email'];
            if($validatedData['reminder_set']){
                $dateTime = new \DateTime($validatedData['reminder_set']);
                $formattedReminderSet = $dateTime->format('Y-m-d H:i:s');
            }
            else{
                $formattedReminderSet = $istTime;
            }
           
      

                $lead = DB::table('tbl_lead')->where('id',$validatedData['lead_id'])->first();
                if($lead){
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
                        'total_time_taken' => $validatedData['formattedTime'],
                        'lead_assign_by' => Session::get('userdata')->id,
                        'next_date_call'=> $formattedReminderSet,
                        'updated_at'=>$istTime
                       
                    ]);
                    if($lead_arr){
                        if($validatedData['lead_status'] == 2){

                            $lead_log_ins = DB::table('lead_log')->insert(['lead_id'=>$validatedData['lead_id'],'lead_status_id'=> $validatedData['lead_status'],'lead_type_id' => $validatedData['lead_type'],'time_taken_duration' => $validatedData['formattedTime'],'created_by_id' => Session::get('userdata')->id,'call_description'=>$validatedData['lead_data'],'lead_action_dates'=>$istTime,'created_at'=>$istTime]);
                            $lead_discusn_tbl = DB::table('tbl_lead_discsn')->select('call_count')->where('lead_id',$validatedData['lead_id'])->first();
                            $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$validatedData['lead_id'])->first();
                            if($lead_discusn_tbl){
                                $lead_discusin_update = DB::table('tbl_lead_discsn')->where('lead_id',$validatedData['lead_id'])->update(['description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> $lead_discusn_tbl->call_count + 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }else{
                                $lead_discusin_ins = DB::table('tbl_lead_discsn')->insert(['lead_id'=>$validatedData['lead_id'],'description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }
                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['nurturing_count'=>$report_tbl->nurturing_count + 1,'lead_days_count'=>$difference_in_days]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>0,'nurturing_count'=>1,'dead_count'=>0,'closed_count'=>0,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>0,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                            
                        }elseif($validatedData['lead_status'] == 1){
                            $lead_log_ins = DB::table('lead_log')->insert(['lead_id'=>$validatedData['lead_id'],'lead_status_id'=> $validatedData['lead_status'],'lead_type_id' => $validatedData['lead_type'],'time_taken_duration' => $validatedData['formattedTime'],'created_by_id' => Session::get('userdata')->id,'call_description'=>$validatedData['lead_data'],'lead_action_dates'=>$istTime,'created_at'=>$istTime]);
                            $lead_discusn_tbl = DB::table('tbl_lead_discsn')->select('call_count')->where('lead_id',$validatedData['lead_id'])->first();
                            $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$validatedData['lead_id'])->first();
                            if($lead_discusn_tbl){
                                $lead_discusin_update = DB::table('tbl_lead_discsn')->where('lead_id',$validatedData['lead_id'])->update(['description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> $lead_discusn_tbl->call_count + 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }else{
                                $lead_discusin_ins = DB::table('tbl_lead_discsn')->insert(['lead_id'=>$validatedData['lead_id'],'description'=> $validatedData['lead_data'],'call_duration'=> $validatedData['formattedTime'],'total_duration'=> $validatedData['formattedTime'],'call_count'=> 1,'created_at'=> $istTime,'lead_status_id' => $validatedData['lead_status']]);
                            }
                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['hot_count'=>$report_tbl->hot_count + 1,'updated_at'=>$istTime,'lead_days_count'=>$difference_in_days,'distributor_days_count'=> 1]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>1,'nurturing_count'=>0,'dead_count'=>0,'closed_count'=>0,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>1,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

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
                                $report_tbl_update = DB::table('tbl_report')->where('lead_id',$validatedData['lead_id'])->update(['closed_count'=>$report_tbl->closed_count + 1,'updated_at'=>$istTime,'lead_days_count'=>$difference_in_days]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$validatedData['lead_id'],'callcenter_id'=>$lead->callcenter_id,'zone_id'=>$lead->zone_id,'hot_count'=>0,'nurturing_count'=>0,'dead_count'=>0,'closed_count'=>1,'did_not_pick_count'=>0,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>0,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                        }
                       
                    


                    } 
                    $lead_details = DB::table('tbl_lead')
                    ->where('id',$validatedData['lead_id'])->select('callcenter_id')->first();
                    if (Session::get('userdata')->role_id == 1  && $lead_details->callcenter_id == 1){
                        return redirect()->route('callCenter_1_page')->with('success', 'Lead is updated and assigned.');}
                elseif (Session::get('userdata')->role_id == 1  && $lead_details->callcenter_id == 2){
                    return redirect()->route('callCenter_2_page')->with('success', 'Lead is updated and assigned.');}
                elseif (Session::get('userdata')->role_id == 1  && $lead_details->callcenter_id == 3){
                    return redirect()->route('callCenter_3_page')->with('success', 'Lead is updated and assigned.');
                }
                elseif (Session::get('userdata')->role_id == 1  && $lead_details->callcenter_id == 4){
                  
                    return redirect()->route('callCenter_4_page')->with('success', 'Lead is updated and assigned.');
                }
                else{
               
                 
                    return redirect()->route('allLeadsCallCenterPage')->with('success', 'Lead is updated and assigned.');}
                }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    
    }

    public function fetchCallCenter(){
        $call_center_list=DB::table("tbl_callCenter")->get();
        return response()->json([
            'success' => true,
            'data' => $call_center_list
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    //  print_r($request->all());
           $id = $request->input('id');
       $zone = $request->input('zone_id');
//=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
$istTime = Carbon::now();
    $updt_leadArr = DB::table('tbl_lead')->where('id',$id)->update(['callcenter_id'=> $zone,'is_new'=>'1','updated_at'=>$istTime]);
        // Return a response indicating success or failure
        return response()->json(['success' => true]); // Modify based on your logic
    }

    /**
     * Remove the specified resource from storage.
     
     */
    
    

     public function call_not_receivd($id){
        $istTime = Carbon::now();
    
        try { 
           
           
            $lead_exist = DB::table('tbl_lead')->where('id', $id)->select('id','lead_type_id', 'lead_status_id','zone_id','callcenter_id','lead_date')->first();
            $givenDate = $lead_exist->lead_date;
            $difference_in_days = $this->calculateDateDifference($givenDate);
    
            if($lead_exist){
                $insrt_lead_log = DB::table('lead_log')->insert([
                    'lead_id' => $id,
                    'lead_status_id' => $lead_exist->lead_status_id,
                    'lead_type_id' => $lead_exist->lead_type_id,
                    'created_by_id' => Session::get('userdata')->id,
                    'call_description' => 'Did not pick up the call.',
                    'lead_action_dates' => $istTime,
                    'created_at' => $istTime,
                ]);
                $lead_updt = DB::table('tbl_lead')->where('id', $id)->update(['lead_data'=>'Did not pick up the call.','updated_at'=>$istTime,'last_lead_updated_date'=>$istTime]);
                $lead_discsn_table = DB::table('tbl_lead_discsn')->where('lead_id',$id)->select('call_count')->first();
                // print_r($lead_discsn_table);
                // die();
                $report_tbl = DB::table('tbl_report')->select('*')->where('lead_id',$id)->first();
                            if($report_tbl){
                                //update use where condition this time
                                $report_tbl_ins = DB::table('tbl_report')->where('lead_id',$id)->update(['did_not_pick_count'=>$report_tbl->did_not_pick_count + 1,'updated_at'=>$istTime,'lead_days_count'=>$difference_in_days]);

                            }else{
                                $report_tbl_ins = DB::table('tbl_report')->insert(['lead_id'=>$id,'callcenter_id'=>$lead_exist->callcenter_id,'zone_id'=>$lead_exist->zone_id,'hot_count'=>0,'nurturing_count'=>0,'dead_count'=>0,'closed_count'=>0,'did_not_pick_count'=>1,'lead_days_count'=>$difference_in_days,'distributor_days_count'=>0,'lead_date'=>$givenDate,'updated_at'=>$istTime]);

                            }
                if($lead_discsn_table){
                    $lead_discusin_ins = DB::table('tbl_lead_discsn')->where('lead_id',$id)->update(['call_count'=> $lead_discsn_table->call_count + 1]);
                }else{
                    $lead_discusin_ins = DB::table('tbl_lead_discsn')->insert(['lead_id'=>$id,'description'=> 'Did not pick up the call.','call_duration'=>'00:00:00','total_duration'=> '00:00:00','call_count'=> 1,'created_at'=> $istTime,'lead_status_id' => $lead_exist->lead_status_id]);
                }
               
                if ($insrt_lead_log && $lead_updt && $lead_discusin_ins && $report_tbl_ins) {
                    
                   
                        return redirect()->back()->with('success', 'Lead is inserted to be call not received ');
                    
                    
                } else {
                    return redirect()->back()->with('error', 'Failed to insert lead log');
                }
            } else {
                return redirect()->back()->with('error', 'Lead does not exist');
            }
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        
            $deleted = DB::table('tbl_lead')->where('id', $id)->delete();
    
            return response()->json(['success' => true]);
       
        //
    }
}
