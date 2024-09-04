<?php

namespace App\Http\Controllers;

use App\Charts\CampaignChart;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class CampaignChartController extends Controller
{

    public function index(CampaignChart $chart)
    {

        return view('frontend.charts.index', ['chart' => $chart->build()]);
    }
}
