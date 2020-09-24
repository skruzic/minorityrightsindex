<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SectionRequest as StoreRequest;
use App\Http\Requests\SectionRequest as UpdateRequest;
use App\Helpers\AnswerExporter;

/**
 * Class campaignSectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CampaignSectionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    protected $campaign_id;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->campaign_id = \Route::current()->parameter('campaign_id');
        $this->crud->setModel('App\Models\Section');
        $this->crud->setRoute('admin/campaign/'.$this->campaign_id.'/section');
        $this->crud->setEntityNameStrings(__('admin.section'), __('admin.sections'));

        $this->crud->addClause('where', 'campaign_id', $this->campaign_id);
        $this->crud->orderBy('lft');

        $this->crud->removeColumn('campaign');

        $this->crud->setHeading(__('admin.sections_in_campaign').$this->campaign_id, 'index');

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

        //$this->crud->allowAccess('reorder');
        //$this->crud->enableReorder('title', 2);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }

    public function setupReorderOperation()
    {
        $this->crud->set('reorder.label', 'title');
        $this->crud->set('reorder.max_lavel', 2);
    }

    public function download()
    {
        $answers = (new AnswerExporter($this->campaign_id))->export();
    }
}
