import 'jquery';

// DEBUG
for(var instanceName in CKEDITOR.instances) {
    instanceName
}

$(document).ready(function () {
    $(this).find("#message_submit_save").hide();

    //CKEditor instance
    var editor = CKEDITOR.instances['message_submit_text'];
    var hint = $('#hint span');
    var radioButtonGroup = $('input:radio[name="message_submit[type]"]');
    var submitButton = $("#message_submit_save");
    var codeSnippetLogo = $(".codeSnippetLogo");
    var whiteText = 'Post-it reminder<br/><span style="color:white">(max. 100 characters)</span>';
    var redText = 'Post-it reminder<br/><span style="color:darkred">(max. 100 characters)</span>';
    var ckEditorCodeSnippetIcon = $('.cke_button_icon');
    hint.html("Choose your style");

    //Default value (depends on scr/Form/MessageSubmitType default value)
    var radioButtonValue = 'code';

    $(radioButtonGroup).on("click", function () {

        //Define radioButtonValue "on the fly"
        radioButtonValue = $(this).val();

        if ($(this).val() === 'code') {

            //Need to be explicit, otherwise editors are appened
            if(CKEDITOR.instances['message_submit_text'])  {
                if (CKEDITOR.instances['message_submit_text']) {
                    CKEDITOR.instances['message_submit_text'].destroy(true);
                    CKEDITOR.replace( 'message_submit_text', {
                        customConfig: '../ckeditorCodeConfig.js'
                    });
                }
            }

            hint.html("You'd better use this icon to share your code :");

            codeSnippetLogo.show();
            if (editor.getData() !== "") {
                submitButton.show();
            } else {
                submitButton.hide();
            }
        } else if ($(this).val() === 'letter') {

            //Need to be explicit, otherwise editors are appened
            if(CKEDITOR.instances['message_submit_text'])  {
                if (CKEDITOR.instances['message_submit_text']) {
                    CKEDITOR.instances['message_submit_text'].destroy(true);
                    CKEDITOR.replace( 'message_submit_text', {
                        customConfig: '../ckeditorLetterConfig.js'
                    });
                }
            }

            hint.html("Send a nice letter that cannot be copied");

            if (editor.getData() !== "") {
                submitButton.show();
            } else {
                submitButton.hide();
            }
        }
            // checks that the clicked radio button is the one of value 'Yes'
        // the value of the element is the one that's checked
        else if ($(this).val() === 'note') {

            //Need to be explicit, otherwise editors are appened
            if(CKEDITOR.instances['message_submit_text'])  {
                if (CKEDITOR.instances['message_submit_text']) {
                    CKEDITOR.instances['message_submit_text'].destroy(true);
                    CKEDITOR.replace( 'message_submit_text', {
                        customConfig: '../ckeditorNoteConfig.js'
                    });
                }
            }

            hint.html(whiteText);
            codeSnippetLogo.hide();
            if (editor.getData().length > 0 && editor.getData().length <= 100) {
                hint.html(whiteText);
                submitButton.show();
            } else {
                hint.html(redText);
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
    editor.on('change', function () {

        if (radioButtonValue !== "note") {
            codeSnippetLogo.hide();
            if (editor.getData() !== "") {
                submitButton.show();
            } else {
                submitButton.hide();
            }
            //Hide form message if note > 100 char
        } else if (radioButtonValue === "note") {
            if (editor.getData().length > 0 && editor.getData().length <= 100) {
                hint.html(whiteText);
                submitButton.show();
            } else {
                hint.html(redText);
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
        if (editor.getData() === "") {
            event.preventDefault();
        } else {
            submitButton.submit();
        }
    });

});


