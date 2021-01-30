import 'jquery';

$(document).ready(function () {
    //CKEditor instance
    var instance = CKEDITOR.instances['message_submit_text'];
    var hint = $('#hint span');
    var $radioButtonGroup = $('input:radio[name="message_submit[type]"]');

    $(this).find("#message_submit_save").hide();

    //Hide submit button if form is empty
    instance.on('change', function () {
        if (instance.getData() !== "") {
            $("#message_submit_save").show();
        } else {
            $("#message_submit_save").hide();
        }
    });

    $("#message_submit_save").submit(function (event) {
        //Prevent submit if form is empty
        if (instance.getData() === "") {
            event.preventDefault();
        } else {
            $("#message_submit_save").submit();
        }

    });


    //Check on click
    $($radioButtonGroup).click(
        function () {
            //Value of radioButtonChecked
            if ($(this).val() === 'code') {

                hint.text("You'd better use this icon to share your code : ");
                $(".codeSnippetLogo").show();

                if (instance.getData() !== "") {
                    $("#message_submit_save").show();
                } else {
                    $("#message_submit_save").hide();
                    $(".codeSnippetLogo").show();
                }

            }

            if ($(this).val() === 'letter') {

                hint.text("Send a letter to somebody");
                $(".codeSnippetLogo").hide();

                if (instance.getData() !== "") {
                    $("#message_submit_save").show();
                } else {
                    $("#message_submit_save").hide();
                }

            }

            if ($(this).val() === 'note') {

                hint.html("Post-it reminder <br/> (max. 100 characters");
                $(".codeSnippetLogo").hide();
                if (instance.getData() !== "" && instance.getData().length <= 100) {
                    hint.html("Post-it reminder <br/> (max. 100 characters");
                    $("#message_submit_save").show();
                } else {
                    $("#message_submit_save").hide();
                    hint.html('Post-it reminder <br/> <span style="color:darkred">(max. 200 characters)</span>');
                    $(".codeSnippetLogo").hide();
                }
            }

        });


    //Check on change
    $($radioButtonGroup).change(
        function () {

            // checks that the clicked radio button is the one of value 'Yes'
            // the value of the element is the one that's checked (as noted by @shef in comments)
            if ($(this).val() === 'code') {
                hint.text("You'd better use this icon to share your code :");
                $(".codeSnippetLogo").show();
            }

            if ($(this).val() === 'letter') {
                hint.text("Send a letter to somebody");
                $(".codeSnippetLogo").hide();
            }

            if ($(this).val() === 'note') {

                hint.html("Post-it reminder <br/> (max. 100 characters");
                $(".codeSnippetLogo").hide();

                instance.on('change', function () {
                    if (instance.getData() !== "" && instance.getData().length <= 100) {
                        hint.html("Post-it reminder <br/> (max. 100 characters");
                        $("#message_submit_save").show();

                    } else {
                        $("#message_submit_save").hide();
                        hint.html('Post-it reminder <br/> <span style="color:darkred">(max. 200 characters)</span>');
                        $(".codeSnippetLogo").hide();
                        //Prevent submit
                        $("#message_submit_save").submit(function (event) {
                            event.preventDefault();
                        });
                    }
                });
            }

        });

});


