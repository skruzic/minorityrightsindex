<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign, App\Models\Answer;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Campaign::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        /*Answer::create([
            'campaign_id' => $input['campaign'],
            'data' => $input['data']
        ]);*/

        dump($input);

        //return response()->json('successfull', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Campaign $campaign
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return response()->json($campaign->with(['sections' => function($query) {
            $query->with(['questions' => function($query) {
                $query->with('children');
                $query->with('options');
                $query->where('parent_id', null);
            }]);
        }])->where('id', $campaign->id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
