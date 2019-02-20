<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Enums\QuestionType;

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
class SectionQuestionCrudController extends CrudController
{
    public function setup()
    {
        //parent::setup();
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $campaign_id = \Route::current()->parameter('campaign_id');
        $section_id  = \Route::current()->parameter('section_id');
        $this->crud->setModel('App\Models\Question');
        $this->crud->setRoute('admin/campaign/'.$campaign_id.'/section/'.$section_id.'/question');
        $this->crud->setEntityNameStrings('question', 'questions');
        $this->crud->addClause('where', 'section_id', $section_id);
        $this->crud->orderBy('lft');
        $this->crud->setHeading('Questions in Section #'.$section_id.' in Campaign #'.$campaign_id, 'index');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();
        $this->crud->addColumns([
            [
                'name'  => 'title',
                'label' => 'Kod',
                'type'  => 'text',
            ],
            [
                'name'  => 'question',
                'label' => 'Question',
                'type'  => 'text',
            ],
            [
                'name'    => 'type',
                'label'   => 'Type',
                'type'    => 'select_from_array',
                'options' => QuestionType::toArray(),
            ],
            [
                'name'      => 'options',
                'label'     => 'Options',
                'type'      => 'select',
                'entity'    => 'options',
                'attribute' => 'name',
                'model'     => 'App\Models\OptionGroup',
            ],
        ]);

        $this->crud->addFields([
            [
                'name'  => 'title',
                'label' => 'Kod',
                'type'  => 'text',
                'tab' => 'General'
            ],
            [
                'name'  => 'question',
                'label' => 'Question',
                'type'  => 'text',
                'tab' => 'General'
            ],
            [
                'name'    => 'type',
                'label'   => 'Type',
                'type'    => 'select2_from_array',
                'options' => QuestionType::toArray(),
                'tab' => 'General'
            ],
            [
                'name'      => 'option_group_id',
                'label'     => 'Options',
                'type'      => 'select2',
                'entity'    => 'options',
                'attribute' => 'name',
                'model'     => 'App\Models\OptionGroup',
                'tab' => 'General'
            ],
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
                'tab' => 'General'
            ],
            [
                'name' => 'csv',
                'label' => 'Panel',
                'type' => 'upload',
                'upload'=> true,
                'disk' => 'uploads',
                'tab' => 'General'
            ],
            [
                'name'                       => 'section_id',
                'label'                      => 'Section',
                'type'                       => 'select2_grouped',
                //'value' => $section_id,
                'entity'                     => 'section',
                'attribute'                  => 'title',
                //'model' => 'App\Models\Section',
                'group_by'                   => 'campaign',
                'group_by_attribute'         => 'title',
                'group_by_relationship_back' => 'sections',
                'value'                      => $section_id,
                'tab'                        => 'General',
            ],
            [
                'name'   => 'csv',
                'label'  => 'Panel',
                'type'   => 'upload',
                'upload' => true,
                'disk'   => 'uploads',
                'tab'    => 'Panel Properties',
            ],
            [
                'name'  => 'dynamic',
                'label' => 'Dynamic',
                'type'  => 'checkbox',
                'fake'  => true,
                'tab'   => 'Panel Properties',
            ],
            [
                'name'  => 'timeout',
                'label' => 'Timeout (s)',
                'type'  => 'number',
                'fake'  => true,
                'tab'   => 'Panel Properties',
            ],
            [
                'name'    => 'batch_size',
                'label'   => 'Batch size',
                'type'    => 'number',
                'default' => 5,
                'fake'    => true,
                'tab'     => 'Panel Properties',
            ],
        ]);

        $this->crud->allowAccess('create');
        $this->crud->allowAccess('reorder');
        $this->crud->enableReorder('question', 2);

        // Micem polje za upload CSV-a kod updejta (mjenjanja postavki)
        $this->crud->removeField('csv', 'update');

        // add asterisk for fields that are required in QuestionRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
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
        /*if ($request->hasFile('csv')) {

            $file = $request->file('csv');

            // Obrada CSV filea
            //$csv = PanelImporter::import($file);
            $csv = (new PanelImporter($file))->import();

            $panel = json_encode($csv);

            $request->request->add(['panel' => $panel]);
        }*/

        return parent::updateCrud($request);
    }
}
