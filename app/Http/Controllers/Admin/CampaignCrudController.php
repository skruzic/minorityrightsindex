<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

use App\Models\Campaign;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CampaignRequest as StoreRequest;
use App\Http\Requests\CampaignRequest as UpdateRequest;

/**
 * Class CampaignCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CampaignCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Campaign');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/campaign');
        $this->crud->setEntityNameStrings(__('admin.campaign'), __('admin.campaigns'));

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
                'name'      => 'user',
                'label'     => 'User',
                'type'      => 'select',
                'entity'    => 'user',
                'attribute' => 'name',
                'model'     => '\App\User',
            ],
        ]);

        $this->crud->addFields([
            [
                'name'  => 'title',
                'label' => __('admin.title'),
                'type'  => 'text',
            ],
            [
                'name'  => 'description',
                'label' => __('admin.description'),
                'type'  => 'textarea',
            ],
            [
                'name'  => 'user_id',
                'label' => 'User',
                'type'  => 'hidden',
                'value' => backpack_user()->id,
            ],
        ]);


        // add asterisk for fields that are required in CampaignRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

        $this->crud->addButtonFromView('line', 'campaign_sections', 'campaign_sections', 'beginning');
        $this->crud->addButtonFromView('line', 'download_answers', 'export_csv', 'end');

        // Dozvola za kloniranje
        $this->crud->allowAccess('clone');
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

    public function clone($id)
    {
        $model = Campaign::find($id);

        $this->crud->hasAccessOrFail('clone');
        $this->crud->setOperation('clone');

        $clone        = $model->replicate();
        $clone->title = $model->title.' (klon)';
        $clone->push();


        foreach ($model->sections as $section) {
            $section_clone = $section->replicate();
            $clone->sections()->save($section_clone);

            foreach ($section->questions as $question) {
                if ( ! isset($question->parent_id)) {
                    $question_clone = $question->replicate();
                    $section_clone->questions()->save($question_clone);

                    foreach ($question->children as $child) {
                        $child_clone            = $child->replicate();
                        $child_clone->parent_id = $question_clone->id;
                        $question_clone->children()->save($child_clone);
                    }
                }
            }
        }
    }


}
