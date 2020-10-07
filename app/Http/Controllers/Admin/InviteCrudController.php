<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Requests\InviteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class InviteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class InviteCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;

    protected $campaign_id;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $this->campaign_id = \Route::current()->parameter('campaign_id');

        CRUD::setModel(\App\Models\Invite::class);
        CRUD::setRoute(config('backpack.base.route_prefix').'/campaign/'.$this->campaign_id.'/invite');
        //CRUD::setRoute('admin/campaign/'.$this->campaign_id.'/section/'.$this->section_id.'/question');
        CRUD::setEntityNameStrings('pozivnica', 'pozivnice');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name'  => 'email',
                'label' => 'E-mail',
                'type'  => 'text',
            ],
            [
                'name'  => 'token',
                'label' => 'Pristupni token',
            ],
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(InviteRequest::class);


        CRUD::addFields([
            [
                'name'  => 'campaign_id',
                'type'  => 'hidden',
                'value' => $this->campaign_id,
            ],
            [
                'name'  => 'email',
                'label' => 'E-mail',
                'type'  => 'email',
            ],
            [
                'name'       => 'token',
                'label'      => 'Pristupni token',
                'type'       => 'text',
                'default'    => Str::random(36),
                'attributes' => [
                    'readonly' => 'readonly',
                ],
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
