<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AccessType;
use App\Helpers\AnswerExporter;
use App\Http\Requests\CampaignRequest;
use App\Models\Campaign;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CampaignCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud`
 */
class CampaignCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, CloneOperation;

    public function setup()
    {
        CRUD::setModel('App\Models\Campaign');
        CRUD::setRoute(config('backpack.base.route_prefix').'/campaign');
        CRUD::setEntityNameStrings('campaign', 'campaigns');

        //CRUD::addButtonFromView('line', 'campaign_sections', 'campaign_sections', 'beginning');
        CRUD::addButtonFromView('line', 'campaign_invites', 'campaign_invites');
        CRUD::addButtonFromView('line', 'download_answers', 'export_csv', 'end');
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name'    => 'title',
                'label'   => 'Title',
                'type'    => 'text',
                'wrapper' => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('campaign/'.$entry->id.'/question');
                    },
                ],
            ],
            [
                'name' => 'locked',
                'type' => 'boolean',
            ],
            [
                'name'  => 'updated_at',
                'label' => 'Last update',
                'type'  => 'datetime',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CampaignRequest::class);

        CRUD::addFields([
            [
                'name'  => 'title',
                'label' => 'Title',
                'type'  => 'text',
                'tab'   => 'General',
            ],
            [
                'name'  => 'slug',
                'label' => 'Slug',
                'type'  => 'text',
                'hint'  => 'If left empty, it will be generated automatically',
                'tab'   => 'General',
            ],
            [
                'name'  => 'description',
                'label' => 'Description',
                'type'  => 'textarea',
                'tab'   => 'General',
            ],
            [
                'name'  => 'locked',
                'type'  => 'checkbox',
                'label' => 'Lock the campaign',
                'hint'  => 'When the campaign is locked, no new questions can be created and it can be filled by users',
                'tab'   => 'General',
            ],
            [
                'name'     => 'intro',
                'label'    => 'Introductory message',
                'type'     => 'tinymce',
                'hint'     => 'If set, the message is displayed as the first page of the survey.',
                'tab'      => 'Messages',
                'fake'     => true,
                'store_in' => 'messages',
            ],
            [
                'name'     => 'final',
                'label'    => 'Final message',
                'type'     => 'tinymce',
                'hint'     => 'If set, the message is displayed as the last page of the survey. Otherwise, a generic thank-you message is displayed.',
                'tab'      => 'Messages',
                'fake'     => true,
                'store_in' => 'messages',
            ],
            [
                'name'     => 'email_before',
                'label'    => 'E-mail: text before the link to the survey',
                'type'     => 'tinymce',
                'hint'     => 'The message is displayed at the beginning of the invitation e-mail.',
                'tab'      => 'Messages',
                'fake'     => true,
                'store_in' => 'messages',
            ],
            [
                'name'     => 'email_after',
                'label'    => 'E-mail: text after the link to the survey',
                'type'     => 'tinymce',
                'hint'     => 'The message is displayed after the link to the survey in the invitation e-mail.',
                'tab'      => 'Messages',
                'fake'     => true,
                'store_in' => 'messages',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function clone($id)
    {
        $model = Campaign::find($id);

        CRUD::hasAccessOrFail('clone');
        CRUD::setOperation('clone');

        $clone        = $model->replicate();
        $clone->title = $model->title.' (clone)';
        $clone->push();


        foreach ($model->sections as $section) {
            $section_clone = $section->replicate();
            $clone->sections()->save($section_clone);

            foreach ($section->questions as $question) {
                //if ( ! isset($question->parent_id)) {
                $question_clone = $question->replicate();
                $section_clone->questions()->save($question_clone);

                foreach ($question->children as $child) {
                    $child_clone             = $child->replicate();
                    $child_clone->parent_id  = $question_clone->id;
                    $child_clone->section_id = $section_clone->id;
                    $question_clone->children()->save($child_clone);
                }
                //}
            }
        }
    }


}
