$(document) .ready(function () {
    
    $('.forget_btn') .click(function () {
       $('.forget_con') .show();
        $('.login_main_con') .hide();
    });

    $('.close_forget_con') .click(function () {
        $('.forget_con') .hide();
        $('.login_main_con') .show();
    });


    $('button') .css('outline', 'none');
});