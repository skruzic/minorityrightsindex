<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Enums\QuestionType;
use App\Helpers\PanelImporter;
use App\Models\Section;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SectionQuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SectionQuestionCrudController extends CrudController
{
    use ListOperation, CreateOperation, UpdateOperation, DeleteOperation, ReorderOperation;

    protected $campaign_id;
    protected $section_id;

    public function setup()
    {
        $this->campaign_id = \Route::current()->parameter('campaign_id');
        $this->section_id  = \Route::current()->parameter('section_id');
        CRUD::setModel('App\Models\Question');
        CRUD::setRoute('admin/campaign/'.$this->campaign_id.'/section/'.$this->section_id.'/question');
        CRUD::setEntityNameStrings(__('admin.question'), __('admin.questions'));
        CRUD::addClause('where', 'section_id', $this->section_id);
        CRUD::orderBy('lft');
        CRUD::setHeading(__('admin.questions_in_section',
            ['section' => $this->section_id, 'campaign' => $this->campaign_id]), 'index');

        // Botun za povratak na sekciju
        CRUD::addButtonFromView('top', 'campaign_sections', 'campaign_sections_question', 'end');

        CRUD::allowAccess('reorder');
        CRUD::enableReorder('question', 2);
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name'  => 'code',
                'label' => 'Kod',
                'type'  => 'text',
            ],
            [
                'name'  => 'text',
                'label' => ucfirst(__('admin.question')),
                'type'  => 'text',
            ],
            [
                'name'    => 'type',
                'label'   => __('admin.type'),
                'type'    => 'select_from_array',
                'options' => QuestionType::asSelectArray(),
            ],
            [
                'name'      => 'options',
                'label'     => __('admin.options'),
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
                'label' => 'Kod',
                'type'  => 'text',
                'tab'   => __('admin.general_tab'),
            ],
            [
                'name'  => 'text',
                'label' => ucfirst(__('admin.question')),
                //'type'  => 'summernote',
                'type'  => 'textarea',
                'tab'   => __('admin.general_tab'),
            ],
            [
                'name'    => 'type',
                'label'   => __('admin.type'),
                'type'    => 'select2_from_array',
                'options' => QuestionType::asSelectArray(),
                'tab'     => __('admin.general_tab'),
            ],
            [
                'name'      => 'option_group_id',
                'label'     => __('admin.options'),
                'type'      => 'select2',
                'entity'    => 'options',
                'attribute' => 'name',
                'model'     => 'App\Models\OptionGroup',
                'tab'       => __('admin.general_tab'),
            ],
            [
                'name'                       => 'section_id',
                'label'                      => 'Section',
                'type'                       => 'select2_grouped',
                //'value' => $section_id,
                'entity'                     => 'section',
                'attribute'                  => 'title',
                //'model' => 'App\Models\Section',
                'group_by'                   => 'campaign',
                'group_by_attribute'         => 'title',
                'group_by_relationship_back' => 'sections',
                'value'                      => $this->section_id,
                'tab'                        => __('admin.general_tab'),
            ],
            [
                'name'   => 'conditions',
                'label'  => 'Uvjeti',
                'type'   => 'repeatable',
                'fields' => [
                    [
                        'name'  => 'answer',
                        'type'  => 'text',
                        'label' => 'Odgovor',
                    ],
                    [
                        'name'      => 'next_question_id',
                        'type'      => 'select2',
                        'entity'    => 'children',
                        'model'     => 'App\Models\Question',
                        'attribute' => 'text',
                        'label'     => 'Sljedeće pitanje',
                    ],
                ],
                'tab'    => 'Uvjeti',
            ],
            [
                'name'   => 'csv',
                'label'  => 'Panel',
                'type'   => 'upload',
                'upload' => true,
                'disk'   => 'uploads',
                'tab'    => __('admin.panel_tab'),
            ],
            [
                'name'  => 'dynamic',
                'label' => 'Dynamic',
                'type'  => 'checkbox',
                'fake'  => true,
                'tab'   => __('admin.panel_tab'),
            ],
            [
                'name'  => 'timeout',
                'label' => 'Timeout (s)',
                'type'  => 'number',
                'fake'  => true,
                'tab'   => __('admin.panel_tab'),
            ],
            [
                'name'    => 'batch_size',
                'label'   => 'Batch size',
                'type'    => 'number',
                'default' => 5,
                'fake'    => true,
                'tab'     => __('admin.panel_tab'),
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

    /*public function store()
    {
        CRUD::setOperationSetting('saveAllInputsExcept',
            ['_token', '_method', 'http_referrer', 'current_tab', 'save_action']);

        $request = CRUD::getRequest()->request;

        if ($request->hasFile('csv')) {

            $file = $request->file('csv');

            // Obrada CSV filea
            //$csv = PanelImporter::import($file);
            $csv = (new PanelImporter($file))->import();

            $panel = json_encode($csv);

            $request->add(['panel' => $panel]);
        }

        CRUD::setRequest($request);

        return $this->traitStore();
    }*/
}
