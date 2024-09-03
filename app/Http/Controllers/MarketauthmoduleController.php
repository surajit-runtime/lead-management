<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarketauthmoduleController extends Controller
{
    // Method for GET /campaign
    public function showCampaignPage()
    {
        // Logic to display the campaign page
        return view('market_auth_module.campaign'); // Adjust with actual view
    }

    // Method for POST /drop
    public function handleDrop(Request $request)
    {
        // Logic to handle drop action
        $data = $request->all(); // Process drop data

        // Redirect or respond as needed
        return redirect()->route('campaignPage')->with('data', $data);
    }

    // Method for GET /publish
    public function showPublishPage()
    {
        // Logic to display the publish page
        return view('market_auth_module.publish'); // Adjust with actual view
    }

    // Method for POST /lead-list
    public function handleLeadList(Request $request)
{
    // Initialize variables for filters
    $call_center_id = $request->input('call_center');
    $lead_status_id = $request->input('lead_status');
    $lead_type_id = $request->input('lead_type');

    try {
        $query = DB::table('tbl_lead')
            ->select('id', 'first_name', 'last_name', 'mobile', 'email', 'zone_id', 'state_id', 'lead_type_id', 'lead_status_id', 'lead_data', 'callcenter_id', 'BM_id')
            ->where('lead_status_id', '<>', 0);

        // Apply filters based on request
        if ($call_center_id) {
            $query->where('callcenter_id', $call_center_id);
        }
        if ($lead_status_id) {
            $query->where('lead_status_id', $lead_status_id);
        }
        if ($lead_type_id) {
            $query->where('lead_type_id', $lead_type_id);
        }

        // Execute the query
        $leadlists = $query->orderBy('id', 'DESC')->get();

        foreach ($leadlists as $lead_lst) {
            $lead_type_nm = DB::table('tbl_lead_type')->where('id', $lead_lst->lead_type_id)->select('id', 'lead_type_name')->first();
            $lead_status_nm = DB::table('tbl_lead_status')->where('id', $lead_lst->lead_status_id)->select('id', 'lead_status_name')->first();
            $call_center_nm = DB::table('tbl_callCenter')->where('id', $lead_lst->callcenter_id)->select('id', 'call_center_name')->first();
            $zone = DB::table('tbl_zone')->where('id', $lead_lst->zone_id)->select('id', 'zone_name')->first();
            $state = DB::table('tbl_state')->where('id', $lead_lst->state_id)->select('id', 'state_name')->first();
            $reprt = DB::table('tbl_report')->where('lead_id', $lead_lst->id)->select('hot_count', 'nurturing_count', 'did_not_pick_count', 'lead_days_count', 'distributor_days_count')->first();

            if ($state) {
                $lead_lst->lead_state = $state;
                $lead_lst->zone_id = $zone;
            } else {
                $lead_lst->lead_state = (object) ['id' => null, 'state_name' => 'No State'];
                $lead_lst->zone_id = (object) ['id' => null, 'zone_name' => 'No Zone'];
            }

            if ($lead_lst->lead_status_id == 1 || $lead_lst->lead_status_id == 4) {
                $BM_name = DB::table('tbl_distributor')->select('distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('id', $lead_lst->BM_id)->first();
                if ($BM_name) {
                    $lead_lst->BM_name = $BM_name;
                } else {
                    $lead_lst->BM_name = (object) ['id' => null, 'bm_name' => 'No BM Name', 'distributor_name' => 'No Distributor Name', 'bm_mobile' => 'No BM Mobile', 'bm_email' => 'No BM Email'];
                }
            }

            $lead_lst->lead_type_name = $lead_type_nm;
            $lead_lst->lead_status_name = $lead_status_nm;
            $lead_lst->call_center_name = $call_center_nm;
            $lead_lst->reprt = $reprt;
        }

        // Retrieve filter options
        $call_centerlist = DB::table('tbl_callCenter')->select('id', 'call_center_name')->get();
        $lead_status_list = DB::table('tbl_lead_status')->get();
        $lead_type_list = DB::table('tbl_lead_type')->select('id', 'lead_type_name')->get();

        return view('frontend.leadList', [
            'leadlists' => $leadlists,
            'call_centerlist' => $call_centerlist,
            'lead_status_list' => $lead_status_list,
            'lead_type_list' => $lead_type_list,
            'lead_status' => $lead_status_id,
            'call_center' => $call_center_id,
            'lead_type' => $lead_type_id
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


    // Method for POST /audience
    public function handleAudience(Request $request)
    {
        // Logic to handle audience data
        $audienceData = $request->all();

        // Redirect or respond as needed
        return redirect()->route('publishPage')->with('audienceData', $audienceData);
    }
}
