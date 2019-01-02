<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function fill($id)
    {
        $campaign  = Campaign::find($id);

        return view('campaign.fill')->with(['campaign' => $campaign]);
    }

    public function save(Request $request) {
        dump($request->all());
    }
}
