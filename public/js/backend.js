$(document).ready(function () {
    $('#addQuestionField').click(function () {
        let lastField = $('#questions div:last');
        let intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1;

        let fieldWrapper = $('<div class="form-group" id="questionField" />');
        fieldWrapper.data('idx', intId);

        let fName = $("<input type=\"text\" class=\"form-control\" name=\"questions[]\" />");
        let removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
        removeButton.click(function () {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#questions").append(fieldWrapper);
    });

    $('#addOptionField').click(function () {
        let lastField = $('#options div:last');
        let intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1;

        let fieldWrapper = $('<div class="form-group" id="optionField" />');
        fieldWrapper.data('idx', intId);

        let fName = $("<input type=\"text\" class=\"form-control\" name=\"options[]\" />");
        let removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
        removeButton.click(function () {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#options").append(fieldWrapper);
    });

    /**
     * Prikazuje select elemente kao select2
     */
    $('select').select2();
});