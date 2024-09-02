<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function currentReportPage()
    {
        $now = Carbon::now();

        // Get the current year
        $currentYear = $now->year;
        $currentMonth = $now->format('m'); // Get the month as a two-digit number


        $call_center_arr = [1, 2, 3, 4];

        // $monthlyLeads = DB::table('tbl_lead as l')
        //     ->select(
        //         DB::raw('MONTH(l.lead_date) as month'),
        //         DB::raw('COUNT(*) as total_lead_count'),
        //         DB::raw('SUM(CASE WHEN l.lead_status_id = 1 THEN 1 ELSE 0 END) as hot_lead_count'),
        //         DB::raw('SUM(CASE WHEN l.lead_status_id = 2 THEN 1 ELSE 0 END) as nurturing_lead_count'),
        //         DB::raw('SUM(CASE WHEN l.lead_status_id = 3 THEN 1 ELSE 0 END) as dead_lead_count'),
        //         DB::raw('SUM(CASE WHEN l.lead_status_id = 4 THEN 1 ELSE 0 END) as close_lead_count'),
        //         'l.callcenter_id',
        //         DB::raw('SUM(CASE WHEN l.is_new = 1 THEN 1 ELSE 0 END) as pending_leads_count'),
        //         'cc.call_center_name'
        //     )
        //     ->leftJoin('tbl_callCenter as cc', 'l.callcenter_id', '=', 'cc.id')
        //     ->whereYear('l.lead_date', now()->year)
        //     ->whereIn('l.callcenter_id', $call_center_arr)
        //     ->groupBy('month', 'l.callcenter_id')  // Use the alias directly in groupBy
        //     ->orderBy('month')
        //     ->get();

        // ! surajit code
        $monthlyLeads = DB::table('tbl_lead as l')
            ->select(
                DB::raw('MONTH(l.lead_date) as month'),
                DB::raw('COUNT(*) as total_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 1 THEN 1 ELSE 0 END) as hot_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 2 THEN 1 ELSE 0 END) as nurturing_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 3 THEN 1 ELSE 0 END) as dead_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 4 THEN 1 ELSE 0 END) as close_lead_count'),
                'l.callcenter_id',
                DB::raw('SUM(CASE WHEN l.is_new = 1 THEN 1 ELSE 0 END) as pending_leads_count'),
                'cc.call_center_name'
            )
            ->leftJoin('tbl_callCenter as cc', 'l.callcenter_id', '=', 'cc.id')
            ->whereYear('l.lead_date', now()->year)
            ->whereIn('l.callcenter_id', $call_center_arr)
            ->groupBy('month', 'l.callcenter_id', 'cc.call_center_name') // Add cc.call_center_name to GROUP BY
            ->orderBy('month')
            ->get();

        $call_centerlist = DB::table('tbl_callCenter')->select('id', 'call_center_name')->get();
        //   DB::raw('SUM(CASE WHEN callcenter_id = 0 THEN 1 ELSE 0 END) as unassigned_count'),
        // echo "<pre>";
        // print_r($monthlyLeads);
        // die();
        return view('frontend.reports', ['monthlyLeads' => $monthlyLeads, 'currentYear' => $currentYear, 'call_centerlist' => $call_centerlist, 'currentMonth' => $currentMonth, 'call_center_id' => 0]);
    }



    public function currentReportFilter(Request $request)
    {


        $monthYear = $request->month_year; // Assuming this is where you get the value from
        list($currentYear, $currentMonth) = explode('-', $monthYear);
        $monthlyLeads = DB::table('tbl_lead as l')
            ->select(
                DB::raw('MONTH(l.lead_date) as month'),
                DB::raw('COUNT(*) as total_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 1 THEN 1 ELSE 0 END) as hot_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 2 THEN 1 ELSE 0 END) as nurturing_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 3 THEN 1 ELSE 0 END) as dead_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 4 THEN 1 ELSE 0 END) as close_lead_count'),
                'l.callcenter_id',
                DB::raw('SUM(CASE WHEN l.is_new = 1 THEN 1 ELSE 0 END) as pending_leads_count'),
                'cc.call_center_name'
            )
            ->leftJoin('tbl_callCenter as cc', 'l.callcenter_id', '=', 'cc.id')
            ->whereYear('l.lead_date', $currentYear)
            ->whereMonth('l.lead_date', $currentMonth) // Use the extracted $month variable here
            ->where('l.callcenter_id', $request->call_center)
            ->groupBy('month', 'l.callcenter_id')  // Use the alias directly in groupBy
            ->orderBy('month')
            ->get();
        if (isset($request->call_center)) {
            $call_center_id = $request->call_center;
        } else {
            $call_center_id = '';
        }
        //     echo "<pre>";
        // print_r($monthlyLeads);
        // die();
        $call_centerlist = DB::table('tbl_callCenter')->select('id', 'call_center_name')->get();
        return view('frontend.reports', ['monthlyLeads' => $monthlyLeads, 'currentYear' => $currentYear, 'call_centerlist' => $call_centerlist, 'currentMonth' => $currentMonth, 'call_center_id' => $call_center_id]);
    }


    public function reportZonePage()
    {
        $zone_arr = [0, 1, 2, 3, 4];
        $year = now()->year;
        $zoneLeads = DB::table('tbl_lead as l')
            ->select(
                DB::raw('YEAR(l.lead_date) as year'),
                DB::raw('COUNT(*) as total_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 1 THEN 1 ELSE 0 END) as hot_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 2 THEN 1 ELSE 0 END) as nurturing_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 3 THEN 1 ELSE 0 END) as dead_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 4 THEN 1 ELSE 0 END) as close_lead_count'),
                'l.zone_id',
                DB::raw('SUM(CASE WHEN l.is_new = 1 THEN 1 ELSE 0 END) as pending_leads_count'),
                'z.zone_name',
                DB::raw('SUM(CASE WHEN l.callcenter_id = 0 THEN 1 ELSE 0 END) as unassigned_leads_count')
            )
            ->leftJoin('tbl_zone as z', 'l.zone_id', '=', 'z.id')
            ->whereYear('l.lead_date', $year)
            ->whereIn('l.zone_id', $zone_arr)
            ->groupBy('year', 'l.zone_id', 'z.zone_name')  // Include 'z.zone_name' in the GROUP BY clause
            ->orderBy('z.zone_name')
            ->get();

        //  echo "<pre>";
        // print_r($zoneLeads);
        // die();
        $zone_nm = DB::table('tbl_zone')->select('id', 'zone_name')->get();
        return view('frontend.report_zone_wise', ['zone_nm' => $zone_nm, 'zoneLeads' => $zoneLeads, 'zone' => '']);
    }

    public function reportZonePageFilter(Request $request)
    {
        $zone = $request->zone;
        $year = $request->year;
        $zoneLeads = DB::table('tbl_lead as l')
            ->select(
                DB::raw('YEAR(l.lead_date) as year'),
                DB::raw('COUNT(*) as total_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 1 THEN 1 ELSE 0 END) as hot_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 2 THEN 1 ELSE 0 END) as nurturing_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 3 THEN 1 ELSE 0 END) as dead_lead_count'),
                DB::raw('SUM(CASE WHEN l.lead_status_id = 4 THEN 1 ELSE 0 END) as close_lead_count'),
                'l.zone_id',
                DB::raw('SUM(CASE WHEN l.is_new = 1 THEN 1 ELSE 0 END) as pending_leads_count'),
                'z.zone_name',
                DB::raw('SUM(CASE WHEN l.callcenter_id = 0 THEN 1 ELSE 0 END) as unassigned_leads_count')
            )
            ->leftJoin('tbl_zone as z', 'l.zone_id', '=', 'z.id')
            ->whereYear('l.lead_date', $year)
            ->where('l.zone_id', $zone)
            ->groupBy('year', 'l.zone_id', 'z.zone_name')  // Include 'z.zone_name' in the GROUP BY clause
            ->orderBy('z.zone_name')
            ->get();

        //  echo "<pre>";
        // print_r($zoneLeads);
        // die();
        $zone_nm = DB::table('tbl_zone')->select('id', 'zone_name')->get();
        return view('frontend.report_zone_wise', ['zone_nm' => $zone_nm, 'zoneLeads' => $zoneLeads, 'zone' => $zone]);
    }
}
