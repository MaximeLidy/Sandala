import 'jquery';
$(document).ready(function () {
    $("#toggle").click(function () {
        $("#toggle").fadeToggle("slow", "linear");
        $("#howitworks").fadeToggle("fast", "linear");
    });
});