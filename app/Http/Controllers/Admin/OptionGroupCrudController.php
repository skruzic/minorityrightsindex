<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\OptionGroupRequest as StoreRequest;
use App\Http\Requests\OptionGroupRequest as UpdateRequest;

/**
 * Class OptionGroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class OptionGroupCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\OptionGroup');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/optiongroup');
        $this->crud->setEntityNameStrings('option group', 'option groups');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();
        $this->crud->addColumns([
            [
                'name'  => 'name',
                'label' => 'Name',
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => 'Description',
                'type'  => 'text',
            ],
            [
                'name'    => 'options',
                'label'   => 'Options',
                'type'    => 'table',
                'columns' => [
                    'value' => 'Numeric value',
                    'text'  => 'Display text',
                ],
            ],
        ]);

        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => 'Name',
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => 'Description',
                'type'  => 'text',
            ],
            [
                'name'            => 'options',
                'label'           => 'Options',
                'type'            => 'table',
                'entity_singular' => 'option',
                'columns'         => [
                    'value' => 'Numeric value',
                    'text'  => 'Display text',
                ],
                'min'             => 2,
            ],
        ]);

        // add asterisk for fields that are required in OptionGroupRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
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
