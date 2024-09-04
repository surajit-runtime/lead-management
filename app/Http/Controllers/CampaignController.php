<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    // Method to show draft campaigns
    public function showDraftCampaigns()
    {
        $campaigns = Campaign::where('flag', 0)->get();
        $heading = 'Draft Campaigns'; // Dynamic heading
        $showFilter = false; // Don't show filter form
        return view('frontend.campaigns', compact('campaigns', 'heading', 'showFilter'));
    }

    // Method to show published campaigns
    public function showPublishedCampaigns()
    {
        $campaigns = Campaign::where('flag', 1)->get();
        $heading = 'Published Campaigns'; // Dynamic heading
        $showFilter = false; // Don't show filter form
        return view('frontend.campaigns', compact('campaigns', 'heading', 'showFilter'));
    }

    // Method to show sent campaigns
    public function showSentCampaigns()
    {
        $campaigns = Campaign::where('flag', 2)->get();
        $heading = 'Sent Campaigns'; // Dynamic heading
        $showFilter = false; // Don't show filter form
        return view('frontend.campaigns', compact('campaigns', 'heading', 'showFilter'));
    }

    // Method to show all campaigns with optional filter
    public function allCampaign()
    {
        $campaigns = Campaign::with('audience')->get();
        $heading = 'All Campaigns'; // Dynamic heading
        $showFilter = true; // Show filter form
        return view('frontend.campaigns', compact('campaigns', 'heading', 'showFilter'));
    }

    // Method to filter campaigns
    public function campaignFilter(Request $request)
    {
        $query = Campaign::query();

        // Filter by campaign flag if provided
        if ($request->has('campaign_flag') && $request->campaign_flag !== '') {
            $query->where('flag', $request->campaign_flag);
        }

        $campaigns = $query->get();
        $heading = 'Filtered Campaigns'; // Dynamic heading
        $showFilter = true; // Show filter form
        return view('frontend.campaigns', compact('campaigns', 'heading', 'showFilter'));
    }
}
