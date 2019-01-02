<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\PanelImporter;
use App\Http\Controllers\Controller;
use App\Enums\QuestionType;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\Campaign, App\Models\Question, App\Models\OptionGroup;
use League\Csv\Reader;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();

        return view('admin.questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaign_id, $section_id)
    {
        //$types = QuestionType::all();
        $types     = QuestionType::toArray();
        $ogs       = OptionGroup::all();
        $questions = Section::find($section_id)->questions->where('parent_id', '==', null);

        return view('admin.questions.create',
            [
                'types'       => $types,
                'ogs'         => $ogs,
                'campaign_id' => $campaign_id,
                'section_id'  => $section_id,
                'questions'   => $questions,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
            dump($csv);
     * @return \Illuminate\Http\Response
     */
    public function store($campaign_id, $section_id, Request $request)
    {
        $section = Section::find($section_id);

        $input = $request->all();

        if ($request->hasFile('csv')) {

            $file = $request->file('csv');

            // Obrada CSV filea
            //$csv = PanelImporter::import($file);
            $csv = (new PanelImporter($file))->import();

            $input['question'] = json_encode($csv, JSON_UNESCAPED_UNICODE);
        }

        //dump($input);

        $section->questions()->create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($campaign_id, $section_id, $id)
    {
        Question::destroy($id);

        return redirect()->back();
    }
}
