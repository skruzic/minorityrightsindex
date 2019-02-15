<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SectionRequest as StoreRequest;
use App\Http\Requests\SectionRequest as UpdateRequest;

/**
 * Class SectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SectionCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Section');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/section');
        $this->crud->setEntityNameStrings(__('admin.section'), __('admin.sections'));

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
                'label' => __('admin.title'),
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => __('admin.description'),
                'type'  => 'text',
            ],
            [
                'name'      => 'campaign',
                'label'     => __('admin.campaign'),
                'type'      => 'select',
                'entity'    => 'campaign',
                'attribute' => 'title',
                'model'     => 'App\Models\Campaign',
            ],
        ]);

        $this->crud->addFields([
            [
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => 'Description',
                'type'  => 'textarea',
            ],
            [
                'name'      => 'campaign_id',
                'label'     => 'Campaign',
                'type'      => 'select2',
                'entity'    => 'campaign',
                'attribute' => 'title',
                'model'     => 'App\Models\Campaign',
            ],
        ]);

        // add asterisk for fields that are required in SectionRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->addButtonFromView('line', 'section_questions', 'section_questions', 'beginning');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
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
