<?php

namespace App\Http\Controllers;

use App\Charts\CampaignChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Audience;
use App\Models\Campaign;

class CampaignChartController extends Controller
{


    public function showChart()
    {
        $campaigns = DB::table('campaigns')
            ->select(DB::raw('COUNT(*) as count, DATE_FORMAT(date, "%M %Y") as month'))
            ->groupBy('month')
            ->orderBy('date')
            ->pluck('count', 'month');

        $months = $campaigns->keys()->toArray();
        $counts = $campaigns->values()->toArray();

        return view('frontend.charts.index', compact('months', 'counts'));
    }

    public function showDashboard()
    {
        // Example data retrieval
        $monthlyCampaigns = DB::table('campaigns')
            ->select(DB::raw('COUNT(*) as count, DATE_FORMAT(date, "%M %Y") as month'))
            ->groupBy('month')
            ->orderBy('date')
            ->pluck('count', 'month');

        $flags = DB::table('campaigns')
            ->select(DB::raw('COUNT(*) as count, flag'))
            ->groupBy('flag')
            ->pluck('count', 'flag');

        // Map flag values to labels
        $flagLabels = [
            0 => 'Draft',
            1 => 'Published',
            2 => 'Sent'
        ];

        $flagKeys = array_map(function ($flag) use ($flagLabels) {
            return $flagLabels[$flag] ?? 'Unknown';
        }, $flags->keys()->toArray());

        $flagCounts = $flags->values()->toArray();

        $channels = DB::table('campaigns')
            ->select(DB::raw('COUNT(*) as count, channel'))
            ->groupBy('channel')
            ->pluck('count', 'channel');

        $successStatus = DB::table('campaigns')
            ->select(DB::raw('COUNT(*) as count, success_status'))
            ->groupBy('success_status')
            ->pluck('count', 'success_status');

        // Prepare data for charts and boxes
        $monthlyMonths = $monthlyCampaigns->keys()->toArray();
        $monthlyCounts = $monthlyCampaigns->values()->toArray();

        $channelKeys = $channels->keys()->toArray();
        $channelCounts = $channels->values()->toArray();

        $successStatusKeys = $successStatus->keys()->toArray();
        $successStatusCounts = $successStatus->values()->toArray();

        return view('frontend.charts.index', compact(
            'monthlyMonths', 'monthlyCounts',
            'flagKeys', 'flagCounts',
            'channelKeys', 'channelCounts',
            'successStatusKeys', 'successStatusCounts'
        ));
    }

}
