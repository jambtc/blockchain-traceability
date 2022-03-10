$(function () {
    'use strict';
    $('#pictureFile').change(ev => {
        $(ev.target).closest('form').trigger('submit');
    })
});
