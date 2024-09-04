<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Audience;
use App\Models\Campaign;

class MarketauthmoduleController extends Controller
{
    // Method for GET /campaign
    public function showCampaignPage()
    {
        $audiences = Audience::all();

        return view('frontend.campaign', ['audiences' => $audiences]);
    }

    //     public function storeCampaign(Request $request)
    // {
    //     // Validate the request data
    //     $data = $request->validate([
    //         'audience' => 'required|exists:audiences,id',
    //         'channel' => 'required|in:email,whatsapp,sms',
    //         'date' => 'required|date|after:today',
    //         'subject' => 'required|string|max:255',
    //         'body' => 'required|string',
    //     ]);

    //     // Determine the action (save or publish)
    //     if ($request->action == 'save') {
    //         // Save logic - flag is 0 for 'save'
    //         \App\Models\Campaign::create([
    //             'audience_id' => $data['audience'],
    //             'channel' => $data['channel'],
    //             'date' => $data['date'],
    //             'subject' => $data['subject'],
    //             'body' => $data['body'],
    //             'flag' => 0, // Set flag to 0 for 'save'
    //         ]);

    //         return redirect()->back()->with('success', 'Campaign saved successfully!')->withInput();
    //     } elseif ($request->action == 'publish') {
    //         \App\Models\Campaign::create([
    //             'audience_id' => $data['audience'],
    //             'channel' => $data['channel'],
    //             'date' => $data['date'],
    //             'subject' => $data['subject'],
    //             'body' => $data['body'],
    //             'flag' => 1, // Set flag to 1 for 'publish'
    //         ]);

    //         return redirect()->back()->with('success', 'Campaign published successfully!')->withInput();
    //     }
    // }

    public function storeCampaign(Request $request)
    {
        // Validate the request data
        $data = $request->validate([
            'campaign_name' => 'required|string|max:255',
            'audience' => 'required|exists:audiences,id',
            'channel' => 'required|in:email,whatsapp,sms',
            'date' => 'required|date_format:Y-m-d\TH:i|after:now',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Determine the action and handle accordingly
        switch ($request->action) {
            case 'draft':
                Campaign::create([
                    'campaign_name' => $data['campaign_name'],
                    'audience_id' => $data['audience'],
                    'channel' => $data['channel'],
                    'date' => $data['date'],
                    'subject' => $data['subject'],
                    'body' => $data['body'],
                    'flag' => 0,
                ]);
                return redirect()->back()->with('success', 'Campaign saved as draft successfully!')->withInput();
            case 'publish':
                $currentDateTime = \Carbon\Carbon::now();
                $selectedDateTime = \Carbon\Carbon::parse($data['date']);

                if ($selectedDateTime->isToday() && $selectedDateTime->diffInMinutes($currentDateTime, false) < 10) {
                    return redirect()->back()->withErrors(['date' => 'The selected time must be at least 10 minutes in the future.'])->withInput();
                }
                Campaign::create([
                    'campaign_name' => $data['campaign_name'],
                    'audience_id' => $data['audience'],
                    'channel' => $data['channel'],
                    'date' => $data['date'],
                    'subject' => $data['subject'],
                    'body' => $data['body'],
                    'flag' => 1, // Published
                ]);
                return redirect()->back()->with('success', 'Campaign published successfully!')->withInput();
            case 'send':
                Campaign::create([
                    'campaign_name' => $data['campaign_name'],
                    'audience_id' => $data['audience'],
                    'channel' => $data['channel'],
                    'date' => $data['date'],
                    'subject' => $data['subject'],
                    'body' => $data['body'],
                    'flag' => 2, // Sent
                ]);
                return redirect()->back()->with('success', 'Campaign sent and processing started successfully!')->withInput();
            default:
                return redirect()->back()->withErrors(['action' => 'Invalid action selected.'])->withInput();
        }
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

    public function careateAudience(Request $request)
    {
        $audienceName = $request->input('audience_name');

        if (Audience::where('audience_name', $audienceName)->exists()) {
            return response()->json(['error' => 'Audience with this name already exists'], 400);
        }

        Audience::create([
            'audience_name' => $audienceName,
            'lead_ids' => $request->input('lead_ids')
        ]);

        return response()->json(['success' => 'Audience created successfully']);
    }

    public function filteredAllLeadList(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'call_center' => 'required|integer',
            'lead_status' => 'required|integer',
            'lead_type' => 'required|integer',
        ]);

        // Initialize filter values
        $call_center_id = $validatedData['call_center'];
        $lead_status_id = $validatedData['lead_status'];
        $lead_type_id = $validatedData['lead_type'];

        try {
            // Fetch leads based on filters
            $leadlists = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email', 'zone_id', 'state_id', 'lead_type_id', 'lead_data', 'BM_id')
                ->where('lead_status_id', $lead_status_id)
                ->where('callcenter_id', $call_center_id)
                ->where('lead_type_id', $lead_type_id)
                ->get();

            // Process each lead to add additional data
            foreach ($leadlists as $lead_lst) {
                // Fetch related data
                $lead_type_nm = DB::table('tbl_lead_type')->where('id', $lead_lst->lead_type_id)->select('id', 'lead_type_name')->first();
                $lead_status_nm = DB::table('tbl_lead_status')->where('id', $lead_status_id)->select('id', 'lead_status_name')->first();
                $call_center_nm = DB::table('tbl_callCenter')->where('id', $call_center_id)->select('id', 'call_center_name')->first();
                $zone = DB::table('tbl_zone')->where('id', $lead_lst->zone_id)->select('id', 'zone_name')->first();
                $state = DB::table('tbl_state')->where('id', $lead_lst->state_id)->select('id', 'state_name')->first();
                $reprt = DB::table('tbl_report')->where('lead_id', $lead_lst->id)->select('hot_count', 'nurturing_count', 'did_not_pick_count', 'lead_days_count', 'distributor_days_count')->first();

                // Assign additional data to lead
                $lead_lst->lead_state = $state ?: (object) ['id' => null, 'state_name' => 'No State'];
                $lead_lst->zone_id = $zone ?: (object) ['id' => null, 'zone_name' => 'No Zone'];
                $lead_lst->lead_type_name = $lead_type_nm;
                $lead_lst->lead_status_name = $lead_status_nm;
                $lead_lst->call_center_name = $call_center_nm;
                $lead_lst->reprt = $reprt;

                // If lead status is 1 or 4, fetch BM name
                if (in_array($lead_status_id, [1, 4])) {
                    $BM_name = DB::table('tbl_distributor')->select('distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('id', $lead_lst->BM_id)->first();
                    $lead_lst->BM_name = $BM_name ?: (object) ['id' => null, 'bm_name' => 'No BM Name', 'distributor_name' => 'No Distributor Name', 'bm_mobile' => 'No BM Mobile', 'bm_email' => 'No BM Email'];
                }
            }

            // Fetch dropdown options
            $call_centerlist = DB::table('tbl_callCenter')->select('id', 'call_center_name')->get();
            $lead_status_list = DB::table('tbl_lead_status')->get();
            $lead_type_list = DB::table('tbl_lead_type')->select('id', 'lead_type_name')->get();

            // Return view with data
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
            // Handle exception and return error response
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // Method for POST /audience
    public function handleAudience(Request $request)
    {
        try {
            // Fetch all audiences
            $audiences = DB::table('audiences')
                ->select('id', 'audience_name', 'lead_ids', 'created_at', 'updated_at')
                ->orderBy('id', 'DESC')
                ->get();

            // foreach ($audiences as $audience) {
            //     $audience->lead_ids = unserialize($audience->lead_ids);
            // }

            return view('frontend.allAudiencesAdminShow', ['audiences' => $audiences]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    // ! new changes
   


    // // Method for GET /campaigns/drafts
    // public function showDraftCampaigns()
    // {
    //     // Dummy data for draft campaigns
    //     $draftCampaigns = [
    //         ['id' => 1, 'name' => 'Draft Campaign 1'],
    //         ['id' => 2, 'name' => 'Draft Campaign 2'],
    //     ];

    //     return view('frontend.draftCampaigns', ['draftCampaigns' => $draftCampaigns]);
    // }

    // // Method for GET /campaigns/published
    // public function showPublishedCampaigns()
    // {
    //     // Dummy data for published campaigns
    //     $publishedCampaigns = [
    //         ['id' => 3, 'name' => 'Published Campaign 1'],
    //         ['id' => 4, 'name' => 'Published Campaign 2'],
    //     ];

    //     return view('frontend.publishedCampaigns', ['publishedCampaigns' => $publishedCampaigns]);
    // }

    // // Method for GET /campaigns/sent
    // public function showSentCampaigns()
    // {
    //     // Dummy data for sent campaigns
    //     $sentCampaigns = [
    //         ['id' => 5, 'name' => 'Sent Campaign 1'],
    //         ['id' => 6, 'name' => 'Sent Campaign 2'],
    //     ];

    //     return view('frontend.sentCampaigns', ['sentCampaigns' => $sentCampaigns]);
    // }
}
