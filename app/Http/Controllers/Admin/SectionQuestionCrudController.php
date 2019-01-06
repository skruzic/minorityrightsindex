<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\QuestionRequest as StoreRequest;
use App\Http\Requests\QuestionRequest as UpdateRequest;
use App\Helpers\PanelImporter;

/**
 * Class SectionQuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SectionQuestionCrudController extends QuestionCrudController
{
    public function setup()
    {
        parent::setup();

        $campaign_id = \Route::current()->parameter('campaign_id');
        $section_id  = \Route::current()->parameter('section_id');

        $this->crud->setRoute('admin/campaign/'.$campaign_id.'/section/'.$section_id.'/question');

        $this->crud->addClause('where', 'section_id', $section_id);

        $this->crud->setHeading('Questions in Section #'.$section_id.' in Campaign #'.$campaign_id, 'index');

        $this->crud->addFields([
            [
                'name'  => 'section_id',
                'label' => 'Section',
                'type'  => 'hidden',
                'value' => $section_id,
            ],
            [
                'name' => 'csv',
                'label' => 'Panel',
                'type' => 'upload',
                'upload'=> true,
                'disk' => 'uploads',
            ]
        ]);

        $this->crud->allowAccess('create');
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('question', 2);
    }

    public function store(StoreRequest $request)
    {
        $input = $request->all();
        if ($request->hasFile('csv')) {

            $file = $request->file('csv');

            // Obrada CSV filea
            //$csv = PanelImporter::import($file);
            $csv = (new PanelImporter($file))->import();

            $input['question'] = json_encode($csv, JSON_UNESCAPED_UNICODE);
        }
        // your additional operations before save here
        $request->replace($input);

        return parent::storeCrud($request);
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
