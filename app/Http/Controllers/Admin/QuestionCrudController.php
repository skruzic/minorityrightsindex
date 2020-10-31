<?php

namespace App\Http\Controllers\Admin;

use App\Enums\QuestionType;
use App\Helpers\CsvExporter;
use App\Http\Requests\QuestionRequest;
use App\Models\OptionGroup;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class QuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class QuestionCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, ReorderOperation, FetchOperation;

    protected $campaign_id;

    public function setup()
    {
        $this->campaign_id = \Route::current()->parameter('campaign_id');
        CRUD::setModel('App\Models\Question');
        CRUD::setRoute('admin/campaign/'.$this->campaign_id.'/question');
        CRUD::setEntityNameStrings('question', 'questions');
        CRUD::addClause('where', 'campaign_id', $this->campaign_id);
        CRUD::orderBy('lft');
        //CRUD::setHeading(__('admin.questions_in_section', ['campaign' => $this->campaign_id]), 'index');

        // Botun za povratak na sekciju
        //CRUD::addButtonFromView('top', 'campaign_sections', 'campaign_sections_question', 'end');

        CRUD::allowAccess('reorder');
        CRUD::enableReorder('question', 2);
    }

    protected function fetchOptionGroup()
    {
        return $this->fetch(OptionGroup::class);
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name'  => 'code',
                'label' => 'Code',
                'type'  => 'text',
            ],
            [
                'name'  => 'text',
                'label' => 'Question text',
                'type'  => 'text',
            ],
            [
                'name'    => 'type',
                'label'   => 'Type',
                'type'    => 'select_from_array',
                'options' => QuestionType::asSelectArray(),
            ],
            [
                'name'      => 'optiongroup',
                'label'     => 'Options',
                'type'      => 'select',
                'entity'    => 'options',
                'attribute' => 'name',
                'model'     => 'App\Models\OptionGroup',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(QuestionRequest::class);

        CRUD::addFields([
            [
                'name'  => 'code',
                'label' => 'Code',
                'type'  => 'text',
                'hint'  => 'Identification code and CSV column name for this question. Should be unique in the campaign.',
                'tab'   => 'General',
            ],
            [
                'name'  => 'text',
                'label' => 'Question text',
                'type'  => 'textarea',
                'tab'   => 'General',
            ],
            [
                'name'    => 'type',
                'label'   => 'Type',
                'type'    => 'select2_from_array',
                'options' => QuestionType::asSelectArray(),
                'tab'     => 'General',
            ],
            [
                'name'   => 'option_group_id',
                'label'  => 'Options',
                'type'   => 'select2',
                'entity' => 'optiongroup',
                'model'  => OptionGroup::class,
                'tab'    => 'General',
            ],
            [
                'name'  => 'campaign_id',
                'label' => 'Campaign',
                'type'  => 'hidden',
                'value' => $this->campaign_id,
                'tab'   => 'General',
            ],
            [
                'name'    => 'conditions',
                'label'   => 'Conditionals',
                'type'    => 'repeatable',
                'fields'  => [
                    [
                        'name'  => 'answer',
                        'label' => 'Answer',
                        'type'  => 'text',
                    ],
                    [
                        'name'      => 'question_id',
                        'type'      => 'select2',
                        'entity'    => 'children',
                        'model'     => 'App\Models\Question',
                        'attribute' => 'text',
                        'label'     => 'Question',
                        'options'   => function ($query) {
                            return $query->where('campaign_id', $this->campaign_id)->get();
                        },
                    ],
                ],
                'default' => [],
                'tab'     => 'Conditionals',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();

        // Micem polje za upload CSV-a kod updejta (mjenjanja postavki)
        CRUD::removeField('csv');
    }

    public function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'text');
        CRUD::set('reorder.max_lavel', 1);
    }

    public function download()
    {
        //(new AnswerExporter($this->campaign_id))->export();
        (new CsvExporter($this->campaign_id))->export();
    }
}
