<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OptionGroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\OptionGroupRequest as StoreRequest;
use App\Http\Requests\OptionGroupRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
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
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        CRUD::setModel('App\Models\OptionGroup');
        CRUD::setRoute(config('backpack.base.route_prefix').'/optiongroup');
        CRUD::setEntityNameStrings(__('admin.option_group'), __('admin.option_groups'));
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
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
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OptionGroupRequest::class);

        CRUD::addFields([
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
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
