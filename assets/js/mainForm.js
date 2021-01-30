import 'jquery';

$(document).ready(function () {
    $(this).find("#message_submit_save").hide();

    //CKEditor instance
    var instance = CKEDITOR.instances['message_submit_text'];
    var hint = $('#hint span');
    var radioButtonGroup = $('input:radio[name="message_submit[type]"]');
    var submitButton = $("#message_submit_save");
    var codeSnippetLogo = $(".codeSnippetLogo");

    hint.html("Choose your style");

    //Default value (depends on scr/Form/MessageSubmitType default value)
    var radioButtonValue = 'code';

    $(radioButtonGroup).on("click", function () {

        //Define radioButtonValue "on the fly"
        radioButtonValue = $(this).val();

        if ($(this).val() === 'code') {
            hint.html("You'd better use this icon to share your code :");
            codeSnippetLogo.show();
            if (instance.getData() !== "") {
                submitButton.show();
            } else {
                submitButton.hide();
            }
        } else if ($(this).val() === 'letter') {
            hint.html("Send a nice letter to somebody that cannot be copied");
            codeSnippetLogo.hide();
            if (instance.getData() !== "") {
                submitButton.show();
            } else {
                submitButton.hide();
            }
        }
            // checks that the clicked radio button is the one of value 'Yes'
        // the value of the element is the one that's checked
        else if ($(this).val() === 'note') {
            hint.html('Post-it reminder <br/> <span style="color:white">(max. 100 characters)</span>');
            codeSnippetLogo.hide();
            if (instance.getData().length > 0 && instance.getData().length <= 100) {
                hint.html('Post-it reminder <br/> <span style="color:white">(max. 100 characters)</span>');
                submitButton.show();
            } else {
                hint.html('Post-it reminder <br/> <span style="color:darkred">(max. 100 characters)</span>');
                submitButton.hide();
                submitButton.submit(function (event) {
                    event.preventDefault();
                });
            }
        } else {
            hint.hide()
        }
    });

    //CHANGE Hide submit button if form is empty
    instance.on('change', function () {
        if (radioButtonValue !== "note") {
            if (instance.getData() !== "") {
                submitButton.show();
            } else {
                submitButton.hide();
            }
            //Hide form message if note > 100 char
        } else if (radioButtonValue === "note") {
            if (instance.getData().length > 0 && instance.getData().length <= 100) {
                hint.html('Post-it reminder <br/> <span style="color:white">(max. 100 characters)</span>');
                submitButton.show();
            } else {
                hint.html('Post-it reminder <br/> <span style="color:darkred">(max. 100 characters)</span>');
                submitButton.hide();
                submitButton.submit(function (event) {
                    event.preventDefault();
                });
            }
        } else {
            //do nothing for the moment
        }

    });

    submitButton.submit(function (event) {
        //Prevent submit if form is empty
        if (instance.getData() === "") {
            event.preventDefault();
        } else {
            submitButton.submit();
        }
    });
});


