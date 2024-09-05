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

    public function removeMultiple(Request $request, $audienceId)
    {
        $leadIds = $request->input('lead_ids');

        $audience = Audience::findOrFail($audienceId);

        if (!empty($leadIds)) {
            $audienceLeadIds = $audience->lead_ids;

            foreach ($leadIds as $leadId) {
                if (($key = array_search($leadId, $audienceLeadIds)) !== false) {
                    unset($audienceLeadIds[$key]);
                }
            }
            $audience->lead_ids = array_values($audienceLeadIds);
            $audience->save();

            return redirect()->back()->with('status', 'Selected leads have been removed from the audience.');
        } else {
            return redirect()->back()->with('status', 'No leads selected for removal.');
        }
    }
}
