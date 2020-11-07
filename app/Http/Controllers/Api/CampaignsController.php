<?php

namespace App\Http\Controllers\Api;

use App\Enums\AccessType;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\InviteResource;
use App\Models\Campaign;
use App\Models\Invite;
use App\Models\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        $resp = Response::updateOrCreate([
            'invite_id'   => $request->invite_id,
            'question_id' => $request->question_id,
        ], [
            'answer' => is_array($request->answer) ? json_encode($request->answer) : $request->answer,
        ]);

        $inv       = Invite::findOrFail($request->invite_id);
        $inv->page = $request->page;
        $inv->save();

        return response()->json([], 204);
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

        return new CampaignResource($campaign);
    }

    /**
     * @param $token
     *
     * @return InviteResource
     */
    public function findByToken($token)
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        if ($invite->campaign->locked) {
            return new InviteResource($invite);
        } else {
            abort(403, 'The campaign is not locked for edits.');
        }


    }
}
