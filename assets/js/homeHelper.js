import 'jquery';

const $ = require('jquery');
require('bootstrap');


$(document).ready(function () {
    $("#toggle").click(function () {
        $("#toggle").fadeToggle("slow", "linear");
        $("#presentation").fadeToggle("slow", "linear");
        $("#howitworks").fadeToggle("fast", "linear");
        $("#counter:visible").fadeToggle("slow", "linear");
    });
    $('[data-toggle="popover"]').popover({
        trigger: "hover",
        delay: {
            "show": 500,
            "hide": 100
        }
    });

    $('[data-toggle="popover"]').click(function () {

        setTimeout(function () {
            $('.popover').fadeOut('slow');
        }, 500);

    });

});
