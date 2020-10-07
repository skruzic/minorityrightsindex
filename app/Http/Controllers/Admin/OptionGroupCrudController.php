<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OptionGroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\OptionGroupRequest as StoreRequest;
use App\Http\Requests\OptionGroupRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OptionGroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class OptionGroupCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, InlineCreateOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        CRUD::setModel('App\Models\OptionGroup');
        CRUD::setRoute(config('backpack.base.route_prefix').'/optiongroup');
        CRUD::setEntityNameStrings('group', 'option groups');
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name'  => 'name',
                'label' => 'Group Name',
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
                    'text'  => 'UI Display value',
                ],
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OptionGroupRequest::class);

        CRUD::addFields([
            [
                'name'  => 'name',
                'label' => 'Group Name',
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
                'entity_singular' => 'Option',
                'columns'         => [
                    'value' => 'Numeric value',
                    'text'  => 'UI Display value',
                ],
                'min'             => 2,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
