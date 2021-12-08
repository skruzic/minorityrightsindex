<?php

namespace App\Http\Controllers\Api;

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
    public function index(): ResourceCollection
    {
        return CampaignResource::collection(Campaign::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->has('question_id')) {
            $resp = Response::updateOrCreate([
                'invite_id'   => $request->invite_id,
                'question_id' => $request->question_id,
            ], [
                'answer' => is_array($request->answer) ? json_encode($request->answer) : $request->answer,
            ]);
        }

        /*$inv                = Invite::findOrFail($request->invite_id);
        $inv->page          = $request->page + 1; // uvecavam za 1, da spremi sljedecu stranicu kao pocetnu kod refresha
        $inv->visited_pages = array_merge($inv->visited_pages, [$request->page]);
        $inv->save();*/

        return response()->json([], 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  Campaign  $campaign
     *
     * @return CampaignResource
     */
    public function show(Campaign $campaign): CampaignResource
    {
        return new CampaignResource($campaign);
    }

    /**
     * @param $slug
     *
     * @return CampaignResource
     */
    public function findBySlug($slug): ?CampaignResource
    {
        $campaign = Campaign::findBySlugOrFail($slug);

        if ( ! $campaign->locked) {
            return new CampaignResource($campaign);
        } else {
            abort(403, 'The campaign is currently open. To test it, please lock it.');

            return null;
        }
    }

    /**
     * @param $token
     *
     * @return InviteResource|void
     */
    public function findByToken($token): ?InviteResource
    {
        $invite = Invite::where('token', $token)->firstOrFail();

        if ($invite->campaign->locked) {
            return new InviteResource($invite);
        } else {
            abort(403, 'The campaign is currently not accessible.');

            return null;
        }
    }

    public function updateStatus(Request $request)
    {
        $inv = Invite::findOrFail($request->invite_id);

        if ($request->direction > 0) {
            // Sljedeća stranica
            $inv->page          = $request->jump != 1 ? $request->jump : $request->page + 1; // uvecavam za step, da spremi sljedecu stranicu kao pocetnu kod refresha
            $inv->visited_pages = array_merge($inv->visited_pages ?? [], [$request->page]);
        } else {
            $visited_pages      = $inv->visited_pages ?? [];
            $current_page       = array_pop($visited_pages);
            $inv->page          = $current_page; // smanjujem za step, da spremi prethodnu stranicu kao pocetnu kod refresha
            $inv->visited_pages = $visited_pages;
        }

        $inv->save();

        return response()->json([
            'page'         => $inv->page,
            'visitedPages' => $inv->visited_pages,
        ]);
    }
}
