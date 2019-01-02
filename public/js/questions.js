$(document).ready(function () {
    $('#question-type').on('change', function () {
        let parent_wrapper = $('#question-parent-wrapper');
        let question_wrapper = $('#question-wrapper');
        let options_wrapper = $('#question-options-wrapper');
        let csv_upload = $('#csv-upload-wrapper');
        switch (parseInt(this.value)) {
            case 0:
            case 1:
                parent_wrapper.addClass('hidden');
                question_wrapper.removeClass('hidden');
                options_wrapper.addClass('hidden');
                csv_upload.addClass('hidden');
                break;
            case 2:
            case 3:
                parent_wrapper.removeClass('hidden');
                question_wrapper.removeClass('hidden');
                options_wrapper.removeClass('hidden');
                csv_upload.addClass('hidden');
                break;
            case 4:
                parent_wrapper.addClass('hidden');
                question_wrapper.addClass('hidden');
                options_wrapper.addClass('hidden');
                csv_upload.removeClass('hidden');
        }
    });
});