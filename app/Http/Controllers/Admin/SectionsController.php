<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Section;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dump($campaign_id);
        dump('TEST');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaign_id)
    {
        $questions = Question::all();

        return view('admin.sections.create', ['campaign_id' => $campaign_id, 'questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($campaign_id, Request $request)
    {
        //dump($request->all());

        $input = $request->all();
        $input['campaign_id'] = $campaign_id;

        $s = Section::create($input);

        foreach ($input['questions'] as $qid) {
            $question = Question::find($qid);
            $s->questions()->attach($question);
        }

        return redirect()->route('campaign.show', $campaign_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($campaign_id, $id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $section  = Section::findOrFail($id);

        return view('admin.sections.show', ['campaign' => $campaign, 'section' => $section]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
