<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => 'Spremi i dodaj novi zapis',
    'save_action_save_and_edit' => 'Spremi i uredi ovaj zapis',
    'save_action_save_and_back' => 'Spremi i povratak na prethodnu',
    'save_action_changed_notification' => 'Default behaviour after saving has been changed.',

    // Create form
    'add'                 => 'Dodaj',
    'back_to_all'         => 'Povratak na sve ',
    'cancel'              => 'Poništi',
    'add_a_new'           => 'Dodaj novi ',

    // Edit form
    'edit'                 => 'Uredi',
    'save'                 => 'Spremi',

    // Revisions
    'revisions'            => 'Revisions',
    'no_revisions'         => 'No revisions found',
    'created_this'         => 'created this',
    'changed_the'          => 'changed the',
    'restore_this_value'   => 'Restore this value',
    'from'                 => 'from',
    'to'                   => 'to',
    'undo'                 => 'Undo',
    'revision_restored'    => 'Revision successfully restored',
    'guest_user'           => 'Guest User',

    // Translatable models
    'edit_translations' => 'EDIT TRANSLATIONS',
    'language'          => 'Language',

    // CRUD table view
    'all'                       => 'Sve ',
    'in_the_database'           => 'in the database',
    'list'                      => 'Popis',
    'actions'                   => 'Akcije',
    'preview'                   => 'Predpregled',
    'delete'                    => 'Izbriši',
    'admin'                     => 'Admin',
    'details_row'               => 'This is the details row. Modify as you please.',
    'details_row_loading_error' => 'There was an error loading the details. Please retry.',

        // Confirmation messages and bubbles
        'delete_confirm'                              => 'Are you sure you want to delete this item?',
        'delete_confirmation_title'                   => 'Item Deleted',
        'delete_confirmation_message'                 => 'The item has been deleted successfully.',
        'delete_confirmation_not_title'               => 'NOT deleted',
        'delete_confirmation_not_message'             => "There's been an error. Your item might not have been deleted.",
        'delete_confirmation_not_deleted_title'       => 'Not deleted',
        'delete_confirmation_not_deleted_message'     => 'Nothing happened. Your item is safe.',

        // Bulk actions
        'bulk_no_entries_selected_title' => 'No entries selected',
        'bulk_no_entries_selected_message' => 'Please select one or more items to perform a bulk action on them.',

        // Bulk confirmation
        'bulk_delete_are_you_sure' => 'Are you sure you want to delete these :number entries?',
        'bulk_delete_sucess_title' => 'Entries deleted',
        'bulk_delete_sucess_message' => ' items have been deleted',
        'bulk_delete_error_title' => 'Delete failed',
        'bulk_delete_error_message' => 'One or more items could not be deleted',

        // Ajax errors
        'ajax_error_title' => 'Error',
        'ajax_error_text'  => 'Error loading page. Please refresh the page.',

        // DataTables translation
        'emptyTable'     => 'No data available in table',
        'info'           => 'Prikazujem od _START_ do _END_ od ukupno _TOTAL_ zapisa',
        'infoEmpty'      => 'Showing 0 to 0 of 0 entries',
        'infoFiltered'   => '(filtered from _MAX_ total entries)',
        'infoPostFix'    => '',
        'thousands'      => ',',
        'lengthMenu'     => '_MENU_ zapisa po stranici',
        'loadingRecords' => 'Loading...',
        'processing'     => 'Processing...',
        'search'         => 'Pretraga: ',
        'zeroRecords'    => 'No matching records found',
        'paginate'       => [
            'first'    => 'First',
            'last'     => 'Last',
            'next'     => 'Next',
            'previous' => 'Previous',
        ],
        'aria' => [
            'sortAscending'  => ': activate to sort column ascending',
            'sortDescending' => ': activate to sort column descending',
        ],
        'export' => [
            'export'            => 'Export',
            'copy'              => 'Copy',
            'excel'             => 'Excel',
            'csv'               => 'CSV',
            'pdf'               => 'PDF',
            'print'             => 'Print',
            'column_visibility' => 'Column visibility',
        ],

    // global crud - errors
        'unauthorized_access' => 'Unauthorized access - you do not have the necessary permissions to see this page.',
        'please_fix' => 'Please fix the following errors:',

    // global crud - success / error notification bubbles
        'insert_success' => 'The item has been added successfully.',
        'update_success' => 'The item has been modified successfully.',

    // CRUD reorder view
        'reorder'                      => 'Promjena redosljeda',
        'reorder_text'                 => 'Koristi drag&drop za promjenu redosljeda.',
        'reorder_success_title'        => 'Kraj',
        'reorder_success_message'      => 'Vaš redosljed je sačuvan.',
        'reorder_error_title'          => 'Greška',
        'reorder_error_message'        => 'Vaš redosljed nije sačuvan.',

    // CRUD yes/no
        'yes' => 'Da',
        'no' => 'Ne',

    // CRUD filters navbar view
        'filters' => 'Filters',
        'toggle_filters' => 'Toggle filters',
        'remove_filters' => 'Remove filters',

    // Fields
        'browse_uploads' => 'Browse uploads',
        'select_all' => 'Select All',
        'select_files' => 'Select files',
        'select_file' => 'Select file',
        'clear' => 'Clear',
        'page_link' => 'Link na stranicu',
        'page_link_placeholder' => 'http://primjer.com/vasa-stranica',
        'internal_link' => 'Link na internu stranicu',
        'internal_link_placeholder' => 'Interni slug. Npr: \'admin/page\'',
        'external_link' => 'Link na vanjsku stranicu',
        'choose_file' => 'Odaberi datoteku',

    //Table field
        'table_cant_add' => 'Cannot add new :entity',
        'table_max_reached' => 'Maximum number of :max reached',

    // File manager
    'file_manager' => 'File Manager',
];
