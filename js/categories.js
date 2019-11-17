$(document).ready(function() {
    $('.edit_btn') .click(function () {
        $('.edit_con') .fadeIn();
    });
    $('.close_edit') .click(function() {
        $('.edit_con') .fadeOut();
    });
});




$('.close_edit') .css('outline', 'none');