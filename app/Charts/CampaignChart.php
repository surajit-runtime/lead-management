<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
class CampaignChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Query to get the count of campaigns grouped by month
        $campaigns = DB::table('campaigns')
            ->select(DB::raw('COUNT(*) as count, DATE_FORMAT(date, "%M %Y") as month'))
            ->groupBy('month')
            ->orderBy('date')
            ->pluck('count', 'month');

        $months = $campaigns->keys()->toArray();
        $counts = $campaigns->values()->toArray();

        // Creating the bar chart
        $chart = (new LarapexChart)->barChart()
            ->setTitle('Campaigns Per Month')
            ->setSubtitle('Number of campaigns created each month.')
            ->addData('Campaigns', $counts)
            ->setXAxis($months)
            ->setColors(['#1E3A8A']); // Example color: Tailwind's green-400


        return $chart;
    }
}

