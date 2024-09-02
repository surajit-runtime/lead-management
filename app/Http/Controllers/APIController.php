<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
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
    public function GetDistributorDetails(Request $request)
    {
        try {
            $distributor_id = isset($request->distributor_id) && !empty($request->distributor_id) ? $request->distributor_id : "";
            if (empty($distributor_id)) {
                return response()->json(["status" => 400, "response" => trans('Please Select Distributor.')], 200);
            }
            $checkdist = DB::table('tbl_distributor')->select('id', 'bm_name', 'bm_mobile', 'bm_email', 'distributor_name')->where('id', $distributor_id)->first();

            if ($checkdist) {
                $result['status'] = 200;
                $result['response'] = 'Distributor Details';
                $result['data'] = $checkdist;
                return response()->json($result, 200);
            } else {
                $result['status'] = 400;
                $result['response'] = 'No Distributor Details';
                return response()->json($result, 200);
            }
        } catch (Exception $e) {
            return response()->json(["status" => 400, "response" => "Unexpected please try agin."], 200);
        }
    }
    public function LeadAssignCallCenter(Request $request)
    {
        //$request = json_decode(file_get_contents("php://input"));
        // print_r($request->all());
        // die();
        try {
            $leadid = isset($request->leadid) && !empty($request->leadid) ? $request->leadid : "";
            $centerid = isset($request->centerid) && !empty($request->centerid) ? $request->centerid : "";
            if (empty($leadid)) {
                return response()->json(["status" => 400, "response" => trans('Please Select Lead.')], 200);
            }
            if (empty($centerid)) {
                return response()->json(["status" => 400, "response" => trans('Please Select Center.')], 200);
            }
            $leadIDsArr = explode(",", $leadid);
            $checkuser = DB::table('tbl_lead')->whereIn('id', $leadIDsArr)->update(['callcenter_id' => $centerid, 'is_new' => 1]);
            if ($checkuser) {
                return response()->json(["status" => 200, "response" => "successfully Assign Center."], 200);
            } else {
                return response()->json(["status" => 201, "response" => "Call Center Not Assign Please try Again."], 200);
            }

        } catch (\Exception $e) {
            return response()->json(["status" => 500, "response" => "Unexpected please try agin."], 200);
        }
    }
    public function storeNewLead()
    {
        //
        $request = json_decode(file_get_contents("php://input"));

        // dd($request);
        try {

            //$api_key = isset($request->api_key) && !empty($request->api_key) ? $request->api_key : "";
            $first_name = isset($request->first_name) && !empty($request->first_name) ? $request->first_name : "";
            $last_name = isset($request->last_name) && !empty($request->last_name) ? $request->last_name : "";


            $mobile = isset($request->mobile) && !empty($request->mobile) ? $request->mobile : "";
            $email = isset($request->email) && !empty($request->email) ? $request->email : "";
            $state = isset($request->state) && !empty($request->state) ? $request->state : '';
            $pincode = isset($request->pincode) && !empty($request->pincode) ? $request->pincode : 0;
            $address = isset($request->address) && !empty($request->address) ? $request->address : '';

            $lead_from = isset($request->lead_from) && !empty($request->lead_from) ? $request->lead_from : '';

            $lead_created_at = Carbon::now('Asia/Kolkata');
            // $office_id = isset($request->office_id) && !empty($request->office_id) ? $request->office_id  : "";


            if (empty($mobile)) {
                return response()->json(["status" => 204, "response" => trans('Mobile number is empty')], 204);
            }
            if (empty($email)) {
                return response()->json(["status" => 204, "response" => trans('Mobile number is empty')], 204);
            }

            $checkuser = DB::table('tbl_lead')
                ->where(function ($query) use ($email, $mobile) {
                    $query->where('email', $email)
                        ->orWhere('mobile', $mobile);
                })->get();

            // dd($checkuser->count());

            if ($checkuser->count() == 0) {
                $state_dist_map = DB::table('tbl_distributor_pin_maps')->select('state_id', 'district_id', 'zone_id')->where('pin_code', $pincode)->first();
                // dd($state_dist_map);
                if ($state_dist_map) {
                    $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'email' => $email, 'state_id' => $state_dist_map->state_id, 'district_id' => $state_dist_map->district_id, 'created_from' => $lead_created_at, 'lead_date' => $lead_created_at, 'is_manual' => '1', 'zone_id' => $state_dist_map->zone_id, 'pincode' => $pincode]);

                } else {
                    $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'email' => $email, 'state_id' => 0, 'district_id' => 0, 'created_from' => $lead_created_at, 'lead_date' => $lead_created_at, 'is_manual' => '1', 'zone_id' => 0, 'pincode' => $pincode]);

                }
                return response()->json(["status" => 200, "response" => trans('Lead is successfully stored.')], 200);
            } else {
                // dd("Mobile or Email is already existed.");
                return response()->json(["status" => 204, "response" => trans('Mobile or Email is already existed.')], 204);
            }
        } catch (\Exception $e) {
            return response()->json(["status" => 500, "response" => $e], 500);
        }
    }

    

// public function storeNewLead()
    // {
    //     //
    //     $request = json_decode(file_get_contents("php://input"));
    //     try {

    //         //$api_key = isset($request->api_key) && !empty($request->api_key) ? $request->api_key : "";
    //         $first_name = isset($request->first_name) && !empty($request->first_name) ? $request->first_name : "";
    //         $last_name = isset($request->last_name) && !empty($request->last_name) ? $request->last_name : "";


    //         $mobile = isset($request->mobile) && !empty($request->mobile) ? $request->mobile : "";
    //         $email = isset($request->email) && !empty($request->email) ? $request->email : "";
    //         $state = isset($request->state) && !empty($request->state) ? $request->state : '';
    //         $pincode = isset($request->pincode) && !empty($request->pincode) ? $request->pincode : '';
    //         $address = isset($request->address) && !empty($request->address) ? $request->address : '';

    //         $lead_from = isset($request->lead_from) && !empty($request->lead_from) ? $request->lead_from : '';

    //         $lead_created_at = Carbon::now('Asia/Kolkata');
    //         // $office_id = isset($request->office_id) && !empty($request->office_id) ? $request->office_id  : "";


    //         if (empty($mobile)) {
    //             return response()->json(["status" => 204, "response" => trans('Mobile number is empty')], 204);
    //         }
    //         if (empty($email)) {
    //             return response()->json(["status" => 204, "response" => trans('Mobile number is empty')], 204);
    //         }

    //         $checkuser = DB::table('tbl_lead')
    //             ->where(function ($query) use ($email, $mobile) {
    //                 $query->where('email', $email)
    //                     ->orWhere('mobile', $mobile);
    //             })->get();

    //         if ($checkuser->count() == 0) {
    //             $state_detail = DB::table('tbl_state')->where('state_name', $state)->select('id', 'zone_id')->first();
    //             if ($state_detail) {
    //                 $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'email' => $email, 'state_id' => $state_detail->id, 'address' => $address, 'created_from' => ucfirst($lead_from), 'lead_date' => $lead_created_at, 'is_manual' => '0', 'zone_id' => $state_detail->zone_id, 'pincode' => $pincode]);

    //             } else {
    //                 $leads_ins = DB::table('tbl_lead')->insert(['first_name' => $first_name, 'last_name' => $last_name, 'mobile' => $mobile, 'email' => $email, 'state_id' => '0', 'address' => $address, 'created_from' => ucfirst($lead_from), 'lead_date' => $lead_created_at, 'is_manual' => '0', 'zone_id' => '0', 'pincode' => '0']);
    //             }
    //             return response()->json(["status" => 200, "response" => trans('Lead is successfully stored.')], 200);
    //         } else {
    //             return response()->json(["status" => 204, "response" => trans('Mobile or Email is already existed.')], 204);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(["status" => 500, "response" => $e], 500);
    //     }
    // }

    /**
     * Display the specified resource.
     */


    public function fetchDailyReport()
    {
        try {
            $today = Carbon::now();
            $formattedDate = $today->format('Y-m-d');
            $callcenter_arr = [1, 2, 3, 4];
            // $formattedDate='2024-02-08';
            // Generate default array dynamically
            $defoultArr = collect($callcenter_arr)->map(function ($callcenterId) use ($formattedDate) {
                return [
                    'date' => $formattedDate,
                    'total_lead_count' => 0,
                    'hot_lead_count' => 0,
                    'nurturing_lead_count' => 0,
                    'dead_lead_count' => 0,
                    'close_lead_count' => 0,
                    'pending_leads_count' => 0,
                    'call_center_name' => "Call Center $callcenterId",
                ];
            })->toArray();

            $total_count = DB::table('tbl_lead as l')
                ->select(
                    DB::raw('DATE(l.lead_date) as date'),
                    DB::raw('COUNT(*) as total_lead_count'),
                    DB::raw('SUM(CASE WHEN l.lead_status_id = 1 THEN 1 ELSE 0 END) as hot_lead_count'),
                    DB::raw('SUM(CASE WHEN l.lead_status_id = 2 THEN 1 ELSE 0 END) as nurturing_lead_count'),
                    DB::raw('SUM(CASE WHEN l.lead_status_id = 3 THEN 1 ELSE 0 END) as dead_lead_count'),
                    DB::raw('SUM(CASE WHEN l.lead_status_id = 4 THEN 1 ELSE 0 END) as close_lead_count'),
                    DB::raw('SUM(CASE WHEN l.is_new = 1 THEN 1 ELSE 0 END) as pending_leads_count'),
                    'cc.call_center_name'
                )
                ->leftJoin('tbl_callCenter as cc', 'l.callcenter_id', '=', 'cc.id')
                ->whereDate('l.lead_date', $formattedDate)
                ->whereIn('l.callcenter_id', $callcenter_arr)
                ->groupBy('date', 'l.callcenter_id', 'cc.call_center_name')
                ->orderBy('cc.call_center_name')
                ->get();

            // Update the default array with fetched values
            foreach ($total_count as $key => $value) {
                $defoultArr[$key] = (array) $value;
            }

            $mailSent = $this->sendmail($defoultArr);

            if ($mailSent) {
                return response()->json(["status" => 200, "response" => "Mail has been sent"], 200);
            } else {
                return response()->json(["status" => 204, "response" => "Mail cannot be sent"], 204);
            }

        } catch (\Exception $e) {
            return response()->json(["status" => 500, "response" => $e->getMessage()], 500);
        }
    }
    // public function sendmail($defoultArr)
// {

    //         $data = ['defoultArr' => $defoultArr];
//         $user['to'] = "vaibhav.runtime@gmail.com";
//         $user['from'] = env('MAIL_FROM_ADDRESS');

    //         Mail::send('reportmail', $data, function ($messages) use ($user) {
//             $messages->from($user['from']);
//             $messages->to($user['to']);
//             $messages->subject('Daily Leads Report');
//         });


    // }
    public function sendmail($defoultArr)
    {
        try {
            $data = ['defoultArr' => $defoultArr];
            $user['to'] = "vaibhav.runtime@gmail.com";
            $user['from'] = env('MAIL_FROM_ADDRESS');

            Mail::send('reportmail', $data, function ($messages) use ($user) {
                $messages->from($user['from']);
                $messages->to($user['to']);
                $messages->subject('Daily Leads Report');
            });

            return true; // Mail sent successfully

        } catch (\Exception $e) {
            // Log or handle the exception as needed
            return false; // Mail sending failed
        }
    }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
