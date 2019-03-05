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
        $this->crud->setEntityNameStrings(__('admin.option_group'), __('admin.option_groups'));

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
                'label' => __('admin.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => __('admin.description'),
                'type'  => 'text',
            ],
            [
                'name'    => 'options',
                'label'   => __('admin.options'),
                'type'    => 'table',
                'columns' => [
                    'value' => __('admin.numval'),
                    'text'  => __('admin.dispval'),
                ],
            ],
        ]);

        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => __('admin.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => __('admin.description'),
                'type'  => 'text',
            ],
            [
                'name'            => 'options',
                'label'           => __('admin.options'),
                'type'            => 'table',
                'entity_singular' => __('admin.option'),
                'columns'         => [
                    'value' => __('admin.numval'),
                    'text'  => __('admin.dispval'),
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
