import $ from 'jquery';

$('body').bind('select copy paste cut drag drop', function (e) {
    e.preventDefault();
});

