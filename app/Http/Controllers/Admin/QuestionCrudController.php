<?php

namespace App\Http\Controllers\Admin;

use App\Enums\QuestionType;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\QuestionRequest as StoreRequest;
use App\Http\Requests\QuestionRequest as UpdateRequest;

/**
 * Class QuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class QuestionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Question');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/question');
        $this->crud->setEntityNameStrings('question', 'questions');

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
        ]);

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
        ]);

        // add asterisk for fields that are required in QuestionRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        // Ne može se kreirati pitanja ovako, trebaju pripadati kampanji/sekciji
        $this->crud->denyAccess('create');
    }

    public function store(StoreRequest $request)
    {


        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
