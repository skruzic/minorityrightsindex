<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SectionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SectionRequest as StoreRequest;
use App\Http\Requests\SectionRequest as UpdateRequest;
use App\Helpers\AnswerExporter;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class campaignSectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CampaignSectionCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, ReorderOperation;

    protected $campaign_id;

    public function setup()
    {
        $this->campaign_id = \Route::current()->parameter('campaign_id');

        CRUD::setModel('App\Models\Section');
        CRUD::setRoute('admin/campaign/'.$this->campaign_id.'/section');
        CRUD::setEntityNameStrings(__('admin.section'), __('admin.sections'));

        CRUD::addClause('where', 'campaign_id', $this->campaign_id);
        CRUD::orderBy('lft');

        CRUD::setHeading(__('admin.sections_in_campaign').$this->campaign_id, 'index');

        CRUD::addButtonFromView('line', 'section_questions', 'section_questions', 'beginning');

        //$this->crud->allowAccess('reorder');
        //$this->crud->enableReorder('title', 2);
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
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
            /*[
                'name'      => 'campaign',
                'label'     => __('admin.campaign'),
                'type'      => 'select',
                'entity'    => 'campaign',
                'attribute' => 'title',
                'model'     => 'App\Models\Campaign',
            ],*/
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SectionRequest::class);

        CRUD::addFields([
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
                'default'   => $this->campaign_id,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_lavel', 2);
    }

    public function download()
    {
        $answers = (new AnswerExporter($this->campaign_id))->export();
    }
}
