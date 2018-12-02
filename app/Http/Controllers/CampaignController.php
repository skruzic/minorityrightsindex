<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function show($id)
    {
        $campaign  = Campaign::find($id);

        //dump($campaign->questions);

        return view('campaign.show')->with(['campaign' => $campaign]);
    }
}
