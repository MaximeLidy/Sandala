import 'jquery';
const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

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
