$(document).ready(function () {
    $('#addQuestionField').click(function () {
        var lastField = $('#questions div:last');
        var intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1;

        var fieldWrapper = $('<div class="form-group" id="questionField" + intId + "/>"');
        fieldWrapper.data('idx', intId);

        var fName = $("<input type=\"text\" class=\"form-control\" name=\"questions[]\" />");
        var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
        removeButton.click(function () {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#questions").append(fieldWrapper);
    });

    $('#addOptionField').click(function () {
        var lastField = $('#options div:last');
        var intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1;

        var fieldWrapper = $('<div class="form-group" id="optionField" + intId + "/>"');
        fieldWrapper.data('idx', intId);

        var fName = $("<input type=\"text\" class=\"form-control\" name=\"options[]\" />");
        var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
        removeButton.click(function () {
            $(this).parent().remove();
        });
        fieldWrapper.append(fName);
        fieldWrapper.append(removeButton);
        $("#options").append(fieldWrapper);
    });
});