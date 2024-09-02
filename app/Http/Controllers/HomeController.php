<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;


class HomeController extends Controller
{
    //
    public function dashboardpage()
    {
        $total_leads = DB::table('tbl_lead')->count();
        $hot_leads_count = DB::table('tbl_lead')->where('lead_status_id', 1)->count();
        $nurturing_lead_count = DB::table('tbl_lead')->where('lead_status_id', 2)->count();
        $dead_lead_count = DB::table('tbl_lead')->where('lead_status_id', 3)->count();
        $closed_lead_count = DB::table('tbl_lead')->where('lead_status_id', 4)->count();
        $manual_lead_count = DB::table('tbl_lead')->where('is_manual', 1)->count();
        $fb_count = DB::table('tbl_lead')->where('created_from', 'Facebook')->count();
        $insta_count = DB::table('tbl_lead')->where('created_from', 'Instagram')->count();
        $web_count = DB::table('tbl_lead')->where('created_from', 'Website')->count();
        $unassigned_count = DB::table('tbl_lead')->where('callcenter_id', 0)->count();
        $pending_leads_count = DB::table('tbl_lead')->where('is_new', 1)->count();
        $currentYear = date('Y');
        // $currentYear = 2023;

        $hot_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 1)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        //    $sqlQuery = DB::table('tbl_lead as L')
        // ->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))
        // ->whereYear('L.lead_date', $currentYear)
        // ->where('L.lead_status_id', 1)
        // ->where('L.callcenter_id', $zone_wise)
        // ->groupBy(DB::raw('MONTH(L.lead_date)'))
        // ->orderBy(DB::raw('MONTH(L.lead_date)'))
        // ->toSql();

        // dd($sqlQuery);

        $hot_lead_month_wise_countArray = $hot_lead_month_wise_count->toArray();
        $nurturing_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 2)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $nurturing_lead_month_wise_countArray = $nurturing_lead_month_wise_count->toArray();

        $dead_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 3)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $dead_lead_month_wise_countArray = $dead_lead_month_wise_count->toArray();

        $closed_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 4)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $closed_lead_month_wise_countArray = $closed_lead_month_wise_count->toArray();

        $fb_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.created_from', 'Facebook')->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $fb_month_wise_countArray = $fb_month_wise_count->toArray();

        $insta_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.created_from', 'Instagram')->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $insta_month_wise_countArray = $insta_month_wise_count->toArray();

        $web_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.created_from', 'Website')->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $web_month_wise_countArray = $web_month_wise_count->toArray();

        $manual_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.is_manual', 1)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $manual_month_wise_countArray = $manual_month_wise_count->toArray();
        //    echo "<pre>";
        //       print_r($manual_month_wise_count);
        //       die();
        $ip_address = $this->getIp();
        return view('frontend.dashboard', ['total_leads' => $total_leads, 'hot_leads_count' => $hot_leads_count, 'nurturing_lead_count' => $nurturing_lead_count, 'dead_lead_count' => $dead_lead_count, 'closed_lead_count' => $closed_lead_count, 'manual_lead_count' => $manual_lead_count, 'fb_count' => $fb_count, 'insta_count' => $insta_count, 'web_count' => $web_count, 'unassigned_count' => $unassigned_count, 'pending_leads_count' => $pending_leads_count, 'hot_lead_month_wise_countArray' => $hot_lead_month_wise_countArray, 'nurturing_lead_month_wise_count' => $nurturing_lead_month_wise_count, 'dead_lead_month_wise_countArray' => $dead_lead_month_wise_countArray, 'closed_lead_month_wise_countArray' => $closed_lead_month_wise_countArray, 'fb_month_wise_countArray' => $fb_month_wise_countArray, 'insta_month_wise_countArray' => $insta_month_wise_countArray, 'web_month_wise_countArray' => $web_month_wise_countArray, 'manual_month_wise_countArray' => $manual_month_wise_countArray, 'currentYear' => $currentYear]);
    }
    public function dashboardpageZoneWise()
    {
        $zone_wise = Session::get('userdata')->zone_id;
        $total_leads = DB::table('tbl_lead')->where('callcenter_id', $zone_wise)->count();
        $hot_leads_count = DB::table('tbl_lead')->where('lead_status_id', 1)->where('callcenter_id', $zone_wise)->count();
        $nurturing_lead_count = DB::table('tbl_lead')->where('lead_status_id', 2)->where('callcenter_id', $zone_wise)->count();
        $dead_lead_count = DB::table('tbl_lead')->where('lead_status_id', 3)->where('callcenter_id', $zone_wise)->count();
        $closed_lead_count = DB::table('tbl_lead')->where('lead_status_id', 4)->where('callcenter_id', $zone_wise)->count();
        $manual_lead_count = DB::table('tbl_lead')->where('is_manual', 1)->where('callcenter_id', $zone_wise)->count();
        $fb_count = DB::table('tbl_lead')->where('created_from', 'Facebook')->where('callcenter_id', $zone_wise)->count();
        $insta_count = DB::table('tbl_lead')->where('created_from', 'Instagram')->where('callcenter_id', $zone_wise)->count();
        $web_count = DB::table('tbl_lead')->where('created_from', 'Website')->where('callcenter_id', $zone_wise)->count();
        $pending_leads_count = DB::table('tbl_lead')->where('is_new', 1)->where('callcenter_id', $zone_wise)->count();
        $new_lead = DB::table('tbl_lead')->where('is_new', 1)->where('callcenter_id', $zone_wise)->select('updated_at')->get();

        $currentYear = date('Y');
        // $currentYear = 2023;

        $hot_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 1)->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        //    $sqlQuery = DB::table('tbl_lead as L')
        // ->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))
        // ->whereYear('L.lead_date', $currentYear)
        // ->where('L.lead_status_id', 1)
        // ->where('L.callcenter_id', $zone_wise)
        // ->groupBy(DB::raw('MONTH(L.lead_date)'))
        // ->orderBy(DB::raw('MONTH(L.lead_date)'))
        // ->toSql();

        // dd($sqlQuery);

        $hot_lead_month_wise_countArray = $hot_lead_month_wise_count->toArray();
        $nurturing_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 2)->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $nurturing_lead_month_wise_countArray = $nurturing_lead_month_wise_count->toArray();

        $dead_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 3)->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $dead_lead_month_wise_countArray = $dead_lead_month_wise_count->toArray();

        $closed_lead_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.lead_status_id', 4)->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $closed_lead_month_wise_countArray = $closed_lead_month_wise_count->toArray();


        $fb_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.created_from', 'Facebook')->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $fb_month_wise_countArray = $fb_month_wise_count->toArray();

        $insta_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.created_from', 'Instagram')->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $insta_month_wise_countArray = $insta_month_wise_count->toArray();

        $web_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.created_from', 'Website')->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $web_month_wise_countArray = $web_month_wise_count->toArray();

        $manual_month_wise_count = DB::table('tbl_lead as L')->select(DB::raw('MONTH(L.lead_date) as month, COUNT(*) as count'))->whereYear('L.lead_date', $currentYear)->where('L.is_manual', 1)->where('L.callcenter_id', $zone_wise)->groupBy(DB::raw('MONTH(L.lead_date)'))->orderBy(DB::raw('MONTH(L.lead_date)'))->get();
        $manual_month_wise_countArray = $manual_month_wise_count->toArray();
        //    echo "<pre>";
        //    print_r($manual_month_wise_count);
        //    die();
        return view('frontend.dasboardZoneWise', ['total_leads' => $total_leads, 'hot_leads_count' => $hot_leads_count, 'nurturing_lead_count' => $nurturing_lead_count, 'dead_lead_count' => $dead_lead_count, 'closed_lead_count' => $closed_lead_count, 'manual_lead_count' => $manual_lead_count, 'fb_count' => $fb_count, 'insta_count' => $insta_count, 'web_count' => $web_count, 'pending_leads_count' => $pending_leads_count, 'new_lead' => $new_lead, 'hot_lead_month_wise_countArray' => $hot_lead_month_wise_countArray, 'nurturing_lead_month_wise_count' => $nurturing_lead_month_wise_count, 'dead_lead_month_wise_countArray' => $dead_lead_month_wise_countArray, 'closed_lead_month_wise_countArray' => $closed_lead_month_wise_countArray, 'fb_month_wise_countArray' => $fb_month_wise_countArray, 'insta_month_wise_countArray' => $insta_month_wise_countArray, 'web_month_wise_countArray' => $web_month_wise_countArray, 'manual_month_wise_countArray' => $manual_month_wise_countArray, 'currentYear' => $currentYear]);
    }
    public function hotLeadPage()
    {
        try {
            $hot_leads = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email', 'updated_at')
                ->where('callcenter_id', Session::get('userdata')->zone_id)
                ->where('lead_status_id', 1)
                ->orderByRaw("STR_TO_DATE(updated_at, '%Y-%m-%d %H:%i:%s') DESC")
                ->get();

            foreach ($hot_leads as $lead_ht) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $lead_ht->lead_type_id)
                    ->first();

                $lead_ht->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
            }
            $total_leads_count = DB::table('tbl_lead')->where('callcenter_id', Session::get('userdata')->zone_id)->count();
            $hot_leads_count = DB::table('tbl_lead')->where('lead_status_id', 1)->where('callcenter_id', Session::get('userdata')->zone_id)->count();
            // echo "<pre>";
            // print_r($hot_leads);
            // die();

            return view('frontend.activeLeads', ['hot_leads' => $hot_leads, 'total_leads_count' => $total_leads_count, 'hot_leads_count' => $hot_leads_count]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function hotLeadDetailsPage($id)
    {
        try {
            $hot_lead_detail = DB::table('tbl_lead')->select('id', 'first_name', 'last_name', 'email', 'mobile', 'created_from', 'lead_date', 'callcenter_id', 'pincode', 'state_id', 'district_id', 'lead_data', 'created_from', 'lead_type_id', 'lead_status_id')->where('id', $id)->first();
            $state_name = DB::table('tbl_state')->select('state_name')->where('id', $hot_lead_detail->state_id)->first();
            $district_nm = DB::table('cities')->select('city')->where('id', $hot_lead_detail->district_id)->first();
            if ($state_name) {
                $hot_lead_detail->lead_state = $state_name;

            } else {
                $hot_lead_detail->lead_state = (object) ['id' => null, 'state_name' => 'No State'];

            }
            if ($district_nm) {
                $hot_lead_detail->lead_district = $district_nm;

            } else {
                $hot_lead_detail->lead_district = (object) ['id' => null, 'city' => 'No District'];

            }
            $hot_lead_type_name = DB::table('tbl_lead_type')->select('lead_type_name')->where('id', $hot_lead_detail->lead_type_id)->first();
            $hot_lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $hot_lead_detail->lead_status_id)->first();
            $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates', 'call_description', 'lead_status_id')->orderBy('lead_action_dates', 'DESC')->get();
            foreach ($lead_log_detail as $lead_log) {
                $lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $lead_log->lead_status_id)->first();
                if ($lead_status_name) {
                    $lead_log->lead_status_name = $lead_status_name;
                } else {
                    $lead_log->lead_status_name = (object) ['id' => null, 'lead_status_name' => 'No Status'];
                }

            }
            // echo "<pre>";
            // print_r($lead_log_detail);
            // echo $hot_lead_status_name;
            // echo "<br>";
            // echo $hot_lead_type_name->lead_type_name;
            // die();
            return view('frontend.hotLeadDetail', ['hot_lead_detail' => $hot_lead_detail, 'lead_log_detail' => $lead_log_detail, 'hot_lead_type_name' => $hot_lead_type_name, 'hot_lead_status_name' => $hot_lead_status_name]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function hotLeadPage_admin_view_1()
    {
        try {
            $hot_leads = DB::table('tbl_lead')
                ->select('first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email')
                ->where('callcenter_id', 1)
                ->where('lead_status_id', 1)
                ->get();

            foreach ($hot_leads as $lead_ht) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $lead_ht->lead_type_id)
                    ->first();

                $lead_ht->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
            }

            // echo "<pre>";
            // print_r($hot_leads);
            // die();

            return view('frontend.hot_lead_call_1_admin_view', ['hot_leads' => $hot_leads]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function hotLeadPage_admin_view_2()
    {
        try {
            $hot_leads = DB::table('tbl_lead')
                ->select('first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email')
                ->where('callcenter_id', 2)
                ->where('lead_status_id', 1)
                ->get();

            foreach ($hot_leads as $lead_ht) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $lead_ht->lead_type_id)
                    ->first();

                $lead_ht->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
            }

            // echo "<pre>";
            // print_r($hot_leads);
            // die();

            return view('frontend.hot_lead_call_2_admin_view', ['hot_leads' => $hot_leads]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function hotLeadPage_admin_view_3()
    {
        try {
            $hot_leads = DB::table('tbl_lead')
                ->select('first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email')
                ->where('callcenter_id', 3)
                ->where('lead_status_id', 1)
                ->get();

            foreach ($hot_leads as $lead_ht) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $lead_ht->lead_type_id)
                    ->first();

                $lead_ht->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
            }

            // echo "<pre>";
            // print_r($hot_leads);
            // die();

            return view('frontend.hot_lead_call_3_admin_view', ['hot_leads' => $hot_leads]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function hotLeadPage_admin_view_4()
    {
        try {
            $hot_leads = DB::table('tbl_lead')
                ->select('first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email')
                ->where('callcenter_id', 4)
                ->where('lead_status_id', 1)
                ->get();

            foreach ($hot_leads as $lead_ht) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $lead_ht->lead_type_id)
                    ->first();

                $lead_ht->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
            }

            // echo "<pre>";
            // print_r($hot_leads);
            // die();

            return view('frontend.hot_lead_call_4_admin_view', ['hot_leads' => $hot_leads]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function nuturingLeadPage()
    {
        try {
            $nuturing_leads = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'lead_type_id', 'lead_data', 'next_date_call')
                ->where('callcenter_id', Session::get('userdata')->zone_id)
                ->where('lead_status_id', 2)
                ->orderByRaw("STR_TO_DATE(next_date_call, '%Y-%m-%d %H:%i:%s') ASC")

                ->get();


            foreach ($nuturing_leads as $lead_nurture) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $lead_nurture->lead_type_id)
                    ->first();

                $lead_nurture->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object

            }
            //  echo "<pre>";
            // print_r($nuturing_leads);
            // die();
            $total_leads_count = DB::table('tbl_lead')->where('callcenter_id', Session::get('userdata')->zone_id)->count();
            $nurturing_lead_count = DB::table('tbl_lead')->where('lead_status_id', 2)->where('callcenter_id', Session::get('userdata')->zone_id)->count();
            return view('frontend.nurturingLeads', ['nuturing_leads' => $nuturing_leads, 'total_leads_count' => $total_leads_count, 'nurturing_lead_count' => $nurturing_lead_count]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function deadLeadPage()
    {
        try {
            $dead_lead = DB::table('tbl_lead')
                ->select('first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email')
                ->where('callcenter_id', Session::get('userdata')->zone_id)
                ->where('lead_status_id', 3)
                ->orderBy('id', 'DESC')
                ->get();

            foreach ($dead_lead as $dead_l) {
                $lead_t_name = DB::table('tbl_lead_type')
                    ->select('lead_type_name')
                    ->where('id', $dead_l->lead_type_id)
                    ->first();

                $dead_l->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
            }
            //  echo "<pre>";
            // print_r($dead_lead);
            // die();
            $total_leads_count = DB::table('tbl_lead')->where('callcenter_id', Session::get('userdata')->zone_id)->count();
            $dead_lead_count = DB::table('tbl_lead')->where('lead_status_id', 3)->where('callcenter_id', Session::get('userdata')->zone_id)->count();
            return view('frontend.deadLeads', ['dead_lead' => $dead_lead, 'total_leads_count' => $total_leads_count, 'dead_lead_count' => $dead_lead_count]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function closeLeadPage()
    {
        $close_lead = DB::table('tbl_lead')
            ->select('first_name', 'last_name', 'lead_type_id', 'lead_data', 'mobile', 'email')
            ->where('callcenter_id', Session::get('userdata')->zone_id)
            ->where('lead_status_id', 4)
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($close_lead as $close_l) {
            $lead_t_name = DB::table('tbl_lead_type')
                ->select('lead_type_name')
                ->where('id', $close_l->lead_type_id)
                ->first();

            $close_l->lead_ty_name = $lead_t_name->lead_type_name; // Assign the value directly, without casting to an object
        }
        //  echo "<pre>";
        // print_r($close_lead);
        // die();
        $total_leads_count = DB::table('tbl_lead')->where('callcenter_id', Session::get('userdata')->zone_id)->count();
        $close_lead_count = DB::table('tbl_lead')->where('lead_status_id', 4)->where('callcenter_id', Session::get('userdata')->zone_id)->count();
        return view('frontend.closeLeads', ['close_lead' => $close_lead, 'total_leads_count' => $total_leads_count, 'close_lead_count' => $close_lead_count]);
    }
    public function resumeCallPage(Request $request)
    {
        $id = $request->query('id');
        $present_lead_count = $request->query('count');
        try {
            $BM_dist = [];
            $BM_distributor_list = [];
            // echo $id;
            //     die();
            $lead_type_list = DB::table('tbl_lead_type')->get();
            $lead_status_list = DB::table('tbl_lead_status')->get();
            $lead_details_nurturing = DB::table('tbl_lead')->select('id', 'first_name', 'last_name', 'email', 'mobile', 'created_from', 'lead_date', 'lead_data', 'lead_type_id', 'lead_status_id', 'pincode', 'state_id', 'district_id', 'BM_id')->where('id', $id)->first();
            $zoneId = Session::get('userdata')->zone_id;
            //=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
            $total_lead_count = DB::table('tbl_lead')
                ->where('is_new', 1)
                ->where('callcenter_id', $zoneId)
                ->count();
            $call_count = DB::table('tbl_lead_discsn')->where('lead_id', $id)->select('call_count', 'total_duration')->first();
            $state_name = DB::table('tbl_state')->select('state_name')->where('id', $lead_details_nurturing->state_id)->first();
            $district_name = DB::table('cities')->select('city')->where('id', $lead_details_nurturing->district_id)->first();
            if ($state_name) {
                $lead_details_nurturing->lead_state = $state_name;

            } else {
                $lead_details_nurturing->lead_state = (object) ['id' => null, 'state_name' => 'No State'];

            }
            if ($district_name) {
                $lead_details_nurturing->lead_district = $district_name;

            } else {
                $lead_details_nurturing->lead_district = (object) ['id' => null, 'city' => 'No District'];

            }

            if ($lead_details_nurturing->BM_id != 0) {
                $BM_dist = DB::table('tbl_distributor')->select('id as distributor_id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('id', $lead_details_nurturing->BM_id)->first();
            } else {
                $BM_dist = DB::table('tbl_distributor_pin_maps')->select('distributor_id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('pin_code', $lead_details_nurturing->pincode)->first();
            }

            if (empty($BM_dist)) {
                $BM_distributor_list = DB::table('tbl_distributor')->select('id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->get();
            }
            // if(empty($BM_dist)){
            //     $BM_distributor_list = DB::table('tbl_distributor')->select('id','distributor_name','bm_name','bm_mobile','bm_email')->get();
            // }

            // $BM_list = DB::table('BM_list')->get();
            // $distributor_list = DB::table('tbl_distributor')->get();
            //   echo "<pre>";
            //         print_r($BM_dist);
            //         die();
            // $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates','call_description')->orderBy('DESC')->get();
            $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates', 'call_description', 'lead_status_id')->orderBy('lead_action_dates', 'DESC')->get();
            foreach ($lead_log_detail as $lead_log) {
                $lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $lead_log->lead_status_id)->first();
                if ($lead_status_name) {
                    $lead_log->lead_status_name = $lead_status_name;
                } else {
                    $lead_log->lead_status_name = (object) ['id' => null, 'lead_status_name' => 'No Status'];
                }

            }

            return view('frontend.resumeCall', ['lead_type_list' => $lead_type_list, 'lead_status_list' => $lead_status_list, 'lead_details_nurturing' => $lead_details_nurturing, 'call_count' => $call_count, 'lead_log_detail' => $lead_log_detail, 'BM_dist' => $BM_dist, 'present_lead_count' => $present_lead_count, 'BM_distributor_list' => $BM_distributor_list]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function nurturingLeadDetailPage($id)
    {

        try {

            // echo $id;
            //     die();

            $lead_details_nurturing = DB::table('tbl_lead')->select('id', 'first_name', 'last_name', 'email', 'mobile', 'created_from', 'lead_date', 'lead_data', 'lead_type_id', 'lead_status_id', 'pincode', 'state_id', 'district_id', 'BM_id')->where('id', $id)->first();
            $zoneId = Session::get('userdata')->zone_id;
            //=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
            $total_lead_count = DB::table('tbl_lead')
                ->where('is_new', 1)
                ->where('callcenter_id', $zoneId)
                ->count();
            $call_count = DB::table('tbl_lead_discsn')->where('lead_id', $id)->select('call_count', 'total_duration')->first();
            $state_name = DB::table('tbl_state')->select('state_name')->where('id', $lead_details_nurturing->state_id)->first();
            $district_name = DB::table('cities')->select('city')->where('id', $lead_details_nurturing->district_id)->first();
            if ($state_name) {
                $lead_details_nurturing->lead_state = $state_name;

            } else {
                $lead_details_nurturing->lead_state = (object) ['id' => null, 'state_name' => 'No State'];

            }
            if ($district_name) {
                $lead_details_nurturing->lead_district = $district_name;

            } else {
                $lead_details_nurturing->lead_district = (object) ['id' => null, 'city' => 'No District'];

            }
            //copied from hot lead , so variable name is not changed. variables must be about nurturing lead
            $hot_lead_type_name = DB::table('tbl_lead_type')->select('lead_type_name')->where('id', $lead_details_nurturing->lead_type_id)->first();
            $hot_lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $lead_details_nurturing->lead_status_id)->first();
            //   echo "<pre>";
            //         print_r($call_count);
            //         die();
            // $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates','call_description')->orderBy('DESC')->get();
            $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates', 'call_description', 'lead_status_id')->orderBy('lead_action_dates', 'DESC')->get();
            foreach ($lead_log_detail as $lead_log) {
                $lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $lead_log->lead_status_id)->first();
                if ($lead_status_name) {
                    $lead_log->lead_status_name = $lead_status_name;
                } else {
                    $lead_log->lead_status_name = (object) ['id' => null, 'lead_status_name' => 'No Status'];
                }

            }

            //    echo "<pre>";
//             print_r($lead_log_detail);
//             die();
            return view('frontend.nurturingLeadDetail', ['lead_details_nurturing' => $lead_details_nurturing, 'call_count' => $call_count, 'lead_log_detail' => $lead_log_detail, 'hot_lead_type_name' => $hot_lead_type_name, 'hot_lead_status_name' => $hot_lead_status_name]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
    public function newCallPage(Request $request)
    {
        $encryptedId = $request->query('id');
        $present_lead_count = $request->query('count');

        try {

            $BM_dist = [];
            $BM_distributor_list = [];

            // Decrypt the ID
            // $decryptedId = Crypt::decrypt($encryptedId);
            // echo $present_lead_count;
            // die();
            $lead_type_list = DB::table('tbl_lead_type')->get();
            $lead_status_list = DB::table('tbl_lead_status')->get();
            $lead_details = DB::table('tbl_lead')->select('id', 'first_name', 'last_name', 'email', 'mobile', 'created_from', 'lead_date', 'callcenter_id', 'pincode', 'state_id', 'district_id')->where('id', $encryptedId)->first();
            $zoneId = Session::get('userdata')->zone_id;
            //=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
            $total_lead_count = DB::table('tbl_lead')
                ->where('is_new', 1)
                ->where('callcenter_id', $zoneId)
                ->count();
            $state_name = DB::table('tbl_state')->select('state_name')->where('id', $lead_details->state_id)->first();
            $district_name = DB::table('cities')->select('city')->where('id', $lead_details->district_id)->first();
            if ($state_name) {
                $lead_details->lead_state = $state_name;

            } else {
                $lead_details->lead_state = (object) ['id' => null, 'state_name' => 'No State'];

            }
            if ($district_name) {
                $lead_details->lead_district = $district_name;

            } else {
                $lead_details->lead_district = (object) ['id' => null, 'city' => 'No District'];

            }
            //$BM_dist = [];

            $BM_dist = DB::table('tbl_distributor_pin_maps')->select('distributor_id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('pin_code', $lead_details->pincode)->first();
            if (empty($BM_dist)) {
                $BM_distributor_list = DB::table('tbl_distributor')->select('id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->get();
            }

            // $BM_distributor_list = DB::table('tbl_distributor')->select('id','distributor_name','bm_name','bm_mobile','bm_email')->get();
            // if(empty($BM_dist)){
            //     $BM_distributor_list = DB::table('tbl_distributor')->select('id','distributor_name','bm_name','bm_mobile','bm_email')->get();
            // }
            // echo "<pre>";
            //         print_r($BM_dist);
            //         die();
            // $BM_list = DB::table('BM_list')->get();
            // $distributor_list = DB::table('Distributor_list')->get();
            // echo "<pre>";
            // print_r($lead_details);
            // die();
            $lead_log_detail = DB::table('lead_log')->where('lead_id', $encryptedId)->select('lead_action_dates', 'call_description', 'lead_status_id')->orderBy('lead_action_dates', 'DESC')->get();
            foreach ($lead_log_detail as $lead_log) {
                $lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $lead_log->lead_status_id)->first();
                if ($lead_status_name) {
                    $lead_log->lead_status_name = $lead_status_name;
                } else {
                    $lead_log->lead_status_name = (object) ['id' => null, 'lead_status_name' => 'No Status'];
                }

            }

            return view('frontend.newCall', ['lead_type_list' => $lead_type_list, 'lead_status_list' => $lead_status_list, 'lead_details' => $lead_details, 'total_lead_count' => $total_lead_count, 'present_lead_count' => $present_lead_count, 'lead_log_detail' => $lead_log_detail, 'BM_dist' => $BM_dist, 'BM_distributor_list' => $BM_distributor_list]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function hot_Lead_Call_Page(Request $request)
    {
        $id = $request->query('id');
        $present_lead_count = $request->query('count');
        try {
            $BM_dist = [];
            $BM_distributor_list = [];
            // echo $id;
            //     die();
            $lead_type_list = DB::table('tbl_lead_type')->get();

            $lead_status_list = DB::table('tbl_lead_status')->get();

            $lead_details_hot = DB::table('tbl_lead')->select('id', 'first_name', 'last_name', 'email', 'mobile', 'created_from', 'lead_date', 'lead_data', 'lead_type_id', 'lead_status_id', 'pincode', 'state_id', 'district_id', 'BM_id')->where('id', $id)->first();

            $zoneId = Session::get('userdata')->zone_id;
            //=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
            // $total_lead_count = DB::table('tbl_lead')
            //     ->where('is_new', 1)
            //     ->where('callcenter_id', $zoneId)
            //     ->count();
            $call_count = DB::table('tbl_lead_discsn')->where('lead_id', $id)->select('call_count', 'total_duration')->first();
            // if (empty($call_count)) {
            //     $call_count = (object) ['id' => null, 'call_count' => '0','total_duration'=>'00:00:00'];

            // }

            $state_name = DB::table('tbl_state')->select('state_name')->where('id', $lead_details_hot->state_id)->first();
            $district_name = DB::table('cities')->select('city')->where('id', $lead_details_hot->district_id)->first();
            if ($state_name) {
                $lead_details_hot->lead_state = $state_name;

            } else {
                $lead_details_hot->lead_state = (object) ['id' => null, 'state_name' => 'No State'];

            }

            if ($district_name) {
                $lead_details_hot->lead_district = $district_name;

            } else {
                $lead_details_hot->lead_district = (object) ['id' => null, 'city' => 'No District'];

            }
            if ($lead_details_hot->BM_id != 0) {
                $BM_dist = DB::table('tbl_distributor')->select('id as distributor_id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('id', $lead_details_hot->BM_id)->first();
            } else {
                $BM_dist = DB::table('tbl_distributor_pin_maps')->select('distributor_id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('pin_code', $lead_details_hot->pincode)->first();
            }



            // echo "<pre>";
            // print_r($lead_details_hot);
            // die();
            // $BM_dist = DB::table('tbl_distributor_pin_maps')->select('distributor_name','bm_name','bm_mobile','bm_email')->where('pin_code',$lead_details->pincode)->first();
            $BM_distributor_list = DB::table('tbl_distributor')->select('id', 'distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->get();
            //   echo "<pre>";
            //         print_r($call_count);
            //         die();
            // $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates','call_description')->orderBy('DESC')->get();
            $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates', 'call_description', 'lead_status_id')->orderBy('lead_action_dates', 'DESC')->get();
            foreach ($lead_log_detail as $lead_log) {
                $lead_status_name = DB::table('tbl_lead_status')->select('lead_status_name')->where('id', $lead_log->lead_status_id)->first();
                if ($lead_status_name) {
                    $lead_log->lead_status_name = $lead_status_name;
                } else {
                    $lead_log->lead_status_name = (object) ['id' => null, 'lead_status_name' => 'No Status'];
                }

            }

            return view('frontend.hot_call', ['lead_type_list' => $lead_type_list, 'lead_status_list' => $lead_status_list, 'lead_details_hot' => $lead_details_hot, 'call_count' => $call_count, 'lead_log_detail' => $lead_log_detail, 'BM_distributor_list' => $BM_distributor_list, 'present_lead_count' => $present_lead_count, 'BM_dist' => $BM_dist]);

        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function leadAssignAdminPage()
    {
        try {
            $leadlist = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'email', 'mobile', 'state_id', 'created_from', 'zone_id', 'pincode')
                ->where('callcenter_id', 0)
                ->orderBy('id', 'DESC')
                ->get();


            if ($leadlist) {
                foreach ($leadlist as $lead) {
                    $state = DB::table('tbl_state')->where('id', $lead->state_id)->select('id', 'state_name')->first();
                    $zone_nm = DB::table('tbl_zone')->where('id', $lead->zone_id)->select('id', 'zone_name')->first();
                    if ($state) {
                        $lead->lead_state = $state;
                        $lead->zone = $zone_nm;
                    } else {
                        $lead->lead_state = (object) ['id' => null, 'state_name' => 'No State'];
                        $lead->zone = (object) ['id' => null, 'zone_name' => 'No Zone'];
                    }
                }
            }
            $call_center_list = DB::table("tbl_callCenter")->get();

            // echo "<pre>";
            // print_r($leadlist);
            // die();

            return view('frontend.leadAssignAdmin', ['leadlist' => $leadlist, 'call_center_list' => $call_center_list]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function allLeadsCallCenterPage()
    {
        //=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
        try {
            $zoneId = Session::get('userdata')->zone_id;

            $callCenter_zone_wise = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email')
                ->where('is_new', 1)
                ->where('callcenter_id', $zoneId)
                ->orderBy('id', 'DESC')
                ->get();

            // Use $callCenter_zone_wise data as needed
            return view('frontend.allLeadsCallCenter', ['callCenter_zone_wise' => $callCenter_zone_wise]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function callCenter_1_page()
    {
        try {


            $callCenter_zone_wise1 = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email')
                ->where('is_new', 1)
                ->where('callcenter_id', 1)
                ->orderBy('id', 'DESC')
                ->get();

            // Use $callCenter_zone_wise data as needed
            return view('frontend.callcenter1_admin_only', ['callCenter_zone_wise' => $callCenter_zone_wise1]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }


    }
    public function callCenter_2_page()
    {
        try {


            $callCenter_zone_wise2 = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email')
                ->where('is_new', 1)
                ->where('callcenter_id', 2)
                ->orderBy('id', 'DESC')
                ->get();

            // Use $callCenter_zone_wise data as needed
            return view('frontend.callcenter2_admin_only', ['callCenter_zone_wise' => $callCenter_zone_wise2]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }


    }
    public function callCenter_3_page()
    {
        try {


            $callCenter_zone_wise3 = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email')
                ->where('is_new', 1)
                ->where('callcenter_id', 3)
                ->orderBy('id', 'DESC')
                ->get();

            // Use $callCenter_zone_wise data as needed
            return view('frontend.callcenter3_admin_only', ['callCenter_zone_wise' => $callCenter_zone_wise3]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }


    }
    public function callCenter_4_page()
    {
        try {


            $callCenter_zone_wise4 = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email')
                ->where('is_new', 1)
                ->where('callcenter_id', 4)
                ->orderBy('id', 'DESC')
                ->get();

            // Use $callCenter_zone_wise data as needed
            return view('frontend.callcenter4_admin_only', ['callCenter_zone_wise' => $callCenter_zone_wise4]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }


    }

    public function leadAssignManagerPage()
    {
        return view('frontend.leadAssignManager');
    }
    public function manualLeadUpPage()
    {
        return view('frontend.manualLeadsUpload');
    }
    public function addManagerPage()
    {
        try {
            $userslists = DB::table('tbl_users')->select('id', 'first_name', 'last_name', 'zone_id', 'role_id', 'profile_image')->get();
            foreach ($userslists as $users) {
                $role = DB::table('tbl_roles')->where('id', $users->role_id)->select('id', 'role_name')->first();
                $zone = DB::table('tbl_callCenter')->where('id', $users->zone_id)->select('id', 'call_center_name')->first();
                // $state = DB::table('tbl_state')->where('id', $users->state_id)->select('id', 'state_name')->first();
                $users->role = $role;
                $users->zone_id = $zone;
                // $users->state = $state;
            }
            // echo "<pre>";
            // print_r($userslists);
            // die();
            return view('frontend.manager_info', ['userslists' => $userslists]);
        } catch (\Exception $e) {
            // Catch and handle any exceptions to identify errors
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function createMangePage()
    {
        $roles = DB::table('tbl_roles')->get();
        $zones = DB::table('tbl_callCenter')->get();
        $states = DB::table('tbl_state')->get();
        return view('frontend.create_manage_page', ['roles' => $roles, 'zones' => $zones, 'states' => $states]);
    }
    public function allLeadAdminShowPage()
    {
        // $leadlists = DB::table('tbl_lead')->select('first_name', 'last_name', 'mobile', 'email', 'zone_id', 'state_id','lead_type_id','lead_status_id','lead_data')->whereNotNUll('lead_status_id')->get();
        try {
            $leadlists = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email', 'zone_id', 'state_id', 'lead_type_id', 'lead_status_id', 'lead_data', 'callcenter_id', 'BM_id', 'zone_id')
                ->where('lead_status_id', '<>', 0)
                ->orderBy('id', 'DESC')
                ->get();

            foreach ($leadlists as $lead_lst) {
                $lead_type_nm = DB::table('tbl_lead_type')->where('id', $lead_lst->lead_type_id)->select('id', 'lead_type_name')->first();
                $lead_status_nm = DB::table('tbl_lead_status')->where('id', $lead_lst->lead_status_id)->select('id', 'lead_status_name')->first();
                $call_center_nm = DB::table('tbl_callCenter')->where('id', $lead_lst->callcenter_id)->select('id', 'call_center_name')->first();
                // $zone_nm = DB::table('tbl_zone')->where('id', $lead_lst->zone_id)->select('id', 'zone_name')->first();
                $zone = DB::table('tbl_zone')->where('id', $lead_lst->zone_id)->select('id', 'zone_name')->first();
                $state = DB::table('tbl_state')->where('id', $lead_lst->state_id)->select('id', 'state_name')->first();
                // $call_details = DB::table('tbl_lead_discsn')->select('call_count','total_duration')->where('lead_id',$lead_lst->id)->first();
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
                // $lead_lst->state = $state;
                $lead_lst->lead_type_name = $lead_type_nm;
                $lead_lst->lead_status_name = $lead_status_nm;
                $lead_lst->call_center_name = $call_center_nm;
                // $lead_lst->call_details = $call_details;
                $lead_lst->reprt = $reprt;
            }
            $call_centerlist = DB::table('tbl_callCenter')->select('id', 'call_center_name')->get();
            $lead_status_list = DB::table('tbl_lead_status')->get();

            // echo "<pre>";
            // print_r($leadlists);
            // die();
            return view('frontend.allLeadsAdminShow', ['leadlists' => $leadlists, 'call_centerlist' => $call_centerlist, 'lead_status_list' => $lead_status_list, 'lead_status' => 0, 'call_center' => 0]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function allLeadAdminShowPageRequest(Request $request)
    {
        // print_r($request->all());
        //  die();
        $validatedData = $request->validate([

            'lead_status' => 'required',
            'call_center' => 'required',



        ]);
        try {
            $leadlists = DB::table('tbl_lead')
                ->select('id', 'first_name', 'last_name', 'mobile', 'email', 'zone_id', 'state_id', 'lead_type_id', 'lead_data', 'BM_id', 'zone_id')
                ->where('lead_status_id', '<>', 0)
                ->where('lead_status_id', $validatedData['lead_status'])
                ->where('callcenter_id', $validatedData['call_center'])
                ->get();

            foreach ($leadlists as $lead_lst) {
                $lead_type_nm = DB::table('tbl_lead_type')->where('id', $lead_lst->lead_type_id)->select('id', 'lead_type_name')->first();
                $lead_status_nm = DB::table('tbl_lead_status')->where('id', $validatedData['lead_status'])->select('id', 'lead_status_name')->first();
                $call_center_nm = DB::table('tbl_callCenter')->where('id', $validatedData['call_center'])->select('id', 'call_center_name')->first();
                // $zone_nm = DB::table('tbl_zone')->where('id', $lead_lst->zone_id)->select('id', 'zone_name')->first();
                // $call_details = DB::table('tbl_lead_discsn')->select('call_count','total_duration')->where('lead_id',$lead_lst->id)->first();
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
                if ($validatedData['lead_status'] == 1 || $validatedData['lead_status'] == 4) {
                    $BM_name = DB::table('tbl_distributor')->select('distributor_name', 'bm_name', 'bm_mobile', 'bm_email')->where('id', $lead_lst->BM_id)->first();
                    if ($BM_name) {
                        $lead_lst->BM_name = $BM_name;
                    } else {
                        $lead_lst->BM_name = (object) ['id' => null, 'bm_name' => 'No BM Name', 'distributor_name' => 'No Distributor Name', 'bm_mobile' => 'No BM Mobile', 'bm_email' => 'No BM Email'];
                    }
                }
                // $lead_lst->state = $state;
                $lead_lst->lead_type_name = $lead_type_nm;
                $lead_lst->lead_status_name = $lead_status_nm;
                $lead_lst->call_center_name = $call_center_nm;
                $lead_lst->reprt = $reprt;
                // $lead_lst->call_details = $call_details;
                // $lead_lst->zone_name = $zone_nm;

            }
            $call_centerlist = DB::table('tbl_callCenter')->select('id', 'call_center_name')->get();
            $lead_status_list = DB::table('tbl_lead_status')->get();
            // ,'call_centerlist'=>$call_centerlist,'lead_status_list'=>$lead_status_list
            // echo "<pre>";
            // print_r($leadlists);
            // die();
            return view('frontend.allLeadsAdminShow', ['leadlists' => $leadlists, 'call_centerlist' => $call_centerlist, 'lead_status_list' => $lead_status_list, 'lead_status' => $validatedData['lead_status'], 'call_center' => $validatedData['call_center']]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


    }


    public function notificationLead_id($id)
    {
        $nuturing_leads = DB::table('tbl_lead')
            ->select('id', 'first_name', 'last_name', 'lead_type_id', 'lead_data', 'next_date_call')
            ->where('callcenter_id', Session::get('userdata')->zone_id)
            ->where('lead_status_id', 2)
            ->where('id', $id)
            ->first();

        $lead_t_name = DB::table('tbl_lead_type')
            ->select('lead_type_name')
            ->where('id', $nuturing_leads->lead_type_id)
            ->first();
        $nuturing_leads->lead_name = $lead_t_name->lead_type_name;


        //  echo "<pre>";
        // print_r($nuturing_leads);
        // die();

        return view('frontend.notificationLeads_Id', ['nuturing_leads' => $nuturing_leads]);
    }

    public function resumeCallPageNotification(Request $request)
    {
        $id = $request->query('id');
        // echo $id;
        //     die();
        $lead_type_list = DB::table('tbl_lead_type')->get();
        $lead_status_list = DB::table('tbl_lead_status')->get();
        $lead_details_nurturing = DB::table('tbl_lead')->select('id', 'first_name', 'last_name', 'email', 'mobile', 'created_from', 'lead_date', 'lead_data', 'lead_type_id', 'lead_status_id', 'executive_id_assign_to')->where('id', $id)->first();
        $zoneId = Session::get('userdata')->zone_id;
        //=======================is_new (col name ) values means ============== [0=>not_assigned,1=>new,2=>assigned]
        $total_lead_count = DB::table('tbl_lead')
            ->where('is_new', 1)
            ->where('callcenter_id', $zoneId)
            ->count();
        $call_count = DB::table('tbl_lead_discsn')->where('lead_id', $id)->select('call_count', 'total_duration')->first();
        //   echo "<pre>";
        //         print_r($call_count);
        //         die();
        // $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates','call_description')->orderBy('DESC')->get();
        $lead_log_detail = DB::table('lead_log')->where('lead_id', $id)->select('lead_action_dates', 'call_description')->orderBy('lead_action_dates', 'DESC')->get();

        return view('frontend.resumeCallNotification', ['lead_type_list' => $lead_type_list, 'lead_status_list' => $lead_status_list, 'lead_details_nurturing' => $lead_details_nurturing, 'call_count' => $call_count, 'lead_log_detail' => $lead_log_detail]);
    }
    public function bmWiseReportpage()
    {
        // $bm_list = DB::table('tbl_distributor')->select('id','bm_name','bm_email','bm_mobile')->get();
        $bm_list = DB::table('tbl_distributor as dt')
            ->select('dt.id', 'dt.bm_name', 'dt.bm_email', 'dt.bm_mobile', 'dp.zone_id')
            ->leftJoin('tbl_distributor_pin_maps as dp', 'dt.id', '=', 'dp.distributor_id')
            ->groupBy('dt.id', 'dt.bm_name', 'dt.bm_email', 'dt.bm_mobile', 'dp.zone_id')
            ->orderBy('dt.bm_name', 'ASC')
            ->get();

        foreach ($bm_list as $bm) {
            $hot_lead_count = DB::table('tbl_lead')->where('BM_id', $bm->id)->where('lead_status_id', 1)->count();
            $closed_lead_count = DB::table('tbl_lead')->where('BM_id', $bm->id)->where('lead_status_id', 4)->count();
            $zone_name = DB::table('tbl_zone')->select('id', 'zone_name')->where('id', $bm->zone_id)->first();
            if ($hot_lead_count > 0) {
                $bm->hot_count = $hot_lead_count;

            } else {
                $bm->hot_count = 0;
            }
            if ($closed_lead_count > 0) {
                $bm->closed_count = $closed_lead_count;

            } else {
                $bm->closed_count = 0;
            }
            if ($zone_name) {
                $bm->zone_name = $zone_name;

            } else {
                $bm->zone_name = (object) ['id' => null, 'zone_name' => 'No Zone'];
            }
        }

        $zone = DB::table('tbl_zone')->select('id', 'zone_name')->get();
        // echo "<pre>";
        // print_r($bm_list);
        // die();
        // $lead_bm_list = DB::table('tbl_distributor as bm')
        // ->leftjoin('tbl_lead as l', 'bm.id', '=', 'l.BM_id')
        // ->where('l.lead_status_id', 1)
        // ->select('bm.bm_name', DB::raw('COUNT(l.lead_status_id) as lead_stat_count','bm.id'))
        // ->groupBy('bm.bm_name')
        // // ->get();
        // ->toSql();
        // dd($lead_bm_list);


        return view('frontend.report_BM_wise', ['bm_list' => $bm_list, 'zone' => $zone, 'zone_name' => 0]);
    }
    public function bmWiseReportFilter(Request $request)
    {
        // $bm_list = DB::table('tbl_distributor')->select('id','bm_name','bm_email','bm_mobile')->get();
        $bm_list = DB::table('tbl_distributor as dt')
            ->select('dt.id', 'dt.bm_name', 'dt.bm_email', 'dt.bm_mobile', 'dp.zone_id')
            ->leftJoin('tbl_distributor_pin_maps as dp', 'dt.id', '=', 'dp.distributor_id')
            ->groupBy('dt.id', 'dt.bm_name', 'dt.bm_email', 'dt.bm_mobile', 'dp.zone_id')
            ->where('dp.zone_id', $request->zone)
            ->orderBy('dt.bm_name', 'ASC')
            ->get();

        foreach ($bm_list as $bm) {
            $hot_lead_count = DB::table('tbl_lead')->where('BM_id', $bm->id)->where('lead_status_id', 1)->count();
            $closed_lead_count = DB::table('tbl_lead')->where('BM_id', $bm->id)->where('lead_status_id', 4)->count();
            $zone_name = DB::table('tbl_zone')->select('id', 'zone_name')->where('id', $bm->zone_id)->first();
            if ($hot_lead_count > 0) {
                $bm->hot_count = $hot_lead_count;

            } else {
                $bm->hot_count = 0;
            }
            if ($closed_lead_count > 0) {
                $bm->closed_count = $closed_lead_count;

            } else {
                $bm->closed_count = 0;
            }
            if ($zone_name) {
                $bm->zone_name = $zone_name;

            } else {
                $bm->zone_name = (object) ['id' => null, 'zone_name' => 'No Zone'];
            }
        }

        $zone = DB::table('tbl_zone')->select('id', 'zone_name')->get();
        if (isset($request->zone)) {
            $zone_name = $request->zone;
        } else {
            $zone_name = '';
        }
        // echo "<pre>";
        // print_r($bm_list);
        // die();
        // $lead_bm_list = DB::table('tbl_distributor as bm')
        // ->leftjoin('tbl_lead as l', 'bm.id', '=', 'l.BM_id')
        // ->where('l.lead_status_id', 1)
        // ->select('bm.bm_name', DB::raw('COUNT(l.lead_status_id) as lead_stat_count','bm.id'))
        // ->groupBy('bm.bm_name')
        // // ->get();
        // ->toSql();
        // dd($lead_bm_list);


        return view('frontend.report_BM_wise', ['bm_list' => $bm_list, 'zone' => $zone, 'zone_name' => $zone_name]);
    }
    public function fetchStateList()
    {
        $statelist = DB::table('tbl_state')->select('id', 'state_name', 'zone_id')->orderBy('state_name', 'asc')->get();
        foreach ($statelist as $sl) {
            $zone_name = DB::table('tbl_zone')->select('zone_name')->where('id', $sl->zone_id)->first();
            $sl->zone_name = $zone_name;
        }
        // echo "<pre>";
        // print_r($statelist);
        // die();
        return view('frontend.statelist', ['statelist' => $statelist]);

    }
    public function fetchDistrictList()
    {
        $districtlist = DB::table('cities')
            ->select('id', 'city', 'zone_id', 'state_id')
            ->orderBy('city', 'asc')
            ->get();

        foreach ($districtlist as $dl) {
            $zone_name = DB::table('tbl_zone')->select('zone_name')->where('id', $dl->zone_id)->first();
            $state_name = DB::table('tbl_state')->select('state_name')->where('id', $dl->state_id)->first();
            $dl->zone_name = $zone_name;
            $dl->state_name = $state_name;
        }
        // echo "<pre>";
        // print_r($districtlist);
        // die();
        return view('frontend.districtList', ['districtlist' => $districtlist]);

    }
    public function fetchBmList()
    {
        $bm_list_fetch = DB::table('tbl_distributor')->select('id', 'bm_name', 'bm_email', 'bm_mobile', 'distributor_name')->get();

        return view('frontend.Bm_info', ['bm_list_fetch' => $bm_list_fetch]);
    }
}
