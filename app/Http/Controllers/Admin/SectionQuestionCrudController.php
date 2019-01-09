<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\QuestionRequest as StoreRequest;
use App\Http\Requests\QuestionRequest as UpdateRequest;
use App\Helpers\PanelImporter;
use App\Models\Section;

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

        $this->crud->orderBy('lft');



        $this->crud->setHeading('Questions in Section #'.$section_id.' in Campaign #'.$campaign_id, 'index');

        $this->crud->addFields([
            [
                'name'  => 'section_id',
                'label' => 'Section',
                'type'  => 'select2_grouped',
                //'value' => $section_id,
                'entity' => 'section',
                'attribute' => 'title',
                //'model' => 'App\Models\Section',
                'group_by' => 'campaign',
                'group_by_attribute' => 'title',
                'group_by_relationship_back' => 'sections',
                'value' => $section_id
            ],
            [
                'name' => 'csv',
                'label' => 'Panel',
                'type' => 'upload',
                'upload'=> true,
                'disk' => 'uploads',
            ],
        ]);

        $this->crud->allowAccess('create');
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('question', 2);
    }

    public function store(StoreRequest $request)
    {You don’t need json filter, this simply works:
        if ($request->hasFile('csv')) {

            $file = $request->file('csv');

            // Obrada CSV filea
            //$csv = PanelImporter::import($file);
            $csv = (new PanelImporter($file))->import();

            $panel = json_encode($csv);

            $request->request->add(['panel' => $panel]);
        }

        return parent::storeCrud($request);
    }

    public function update(UpdateRequest $request)
    {
        if ($request->hasFile('csv')) {

            $file = $request->file('csv');

            // Obrada CSV filea
            //$csv = PanelImporter::import($file);
            $csv = (new PanelImporter($file))->import();

            $panel = json_encode($csv);

            $request->request->add(['panel' => $panel]);
        }

        return parent::updateCrud($request);
    }
}
