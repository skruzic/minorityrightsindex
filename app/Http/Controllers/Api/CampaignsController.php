<?php

namespace App\Http\Controllers\Api;

use App\Enums\AccessType;
use App\Models\Invite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign, App\Models\Answer;
use App\Http\Resources\CampaignResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index()
    {
        return CampaignResource::collection(Campaign::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Answer::create([
            'campaign_id' => $request->campaign_id,
            'data'        => json_encode($request->data),
        ]);

        return response()->json('success', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Campaign  $campaign
     *
     * @return CampaignResource
     */
    public function show(Campaign $campaign)
    {
        /*return response()->json($campaign->with(['sections' => function($query) {
            $query->with(['questions' => function($query) {
                $query->with('children');
                $query->with('options');
                $query->where('parent_id', null);
                $query->orderBy('lft');
            }]);
        }])->where('id', $campaign->id)->first());*/
        return new CampaignResource($campaign);
    }

    /**
     * @param $slug
     *
     * @return CampaignResource|JsonResponse
     */
    public function findBySlug($slug)
    {
        $campaign = Campaign::findBySlugOrFail($slug);

        if ($campaign->access_type == AccessType::Free) {
            return new CampaignResource($campaign);
        } else {
            return response()->json(['error' => 'error'], 400);
        }
    }

    /**
     * @param $token
     *
     * @return CampaignResource
     */
    public function findByToken($token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        return new CampaignResource($invite->campaign);
    }
}
