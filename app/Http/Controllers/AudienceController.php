<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Audience;
use App\Models\Campaign;
use App\Models\Lead;

class AudienceController extends Controller
{
    public function showLeads($id)
    {
        $audience = Audience::findOrFail($id);
        $leadIds = $audience->lead_ids;
        $leads = Lead::whereIn('id', $leadIds)->get();
        return view('frontend.audience-leads', compact('audience', 'leads'));
    }

    public function removeLead($id, $leadId)
    {
        $audience = Audience::findOrFail($id);
        $leadIds = $audience->lead_ids;

        // Check if the lead ID exists in the array and remove it
        if (($key = array_search($leadId, $leadIds)) !== false) {
            unset($leadIds[$key]);
            $leadIds = array_values($leadIds);
            $audience->lead_ids = $leadIds;
            $audience->save();
        }
        return redirect()->route('audience.leads', $id)->with('status', 'Lead removed successfully!');
    }
}
