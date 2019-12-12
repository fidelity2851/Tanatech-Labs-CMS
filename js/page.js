jQuery_3_4_1(document).ready(function() {
    jQuery_3_4_1('.edit_btn') .click(function () {
        jQuery_3_4_1('.edit_con') .fadeIn();
    });
    jQuery_3_4_1('.close_edit') .click(function() {
        jQuery_3_4_1('.edit_con') .fadeOut();
    });
});


$(document).ready(function () {
    //alert('hello');
    $('#summernote').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true
    });

    $('#summernote').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true
    });
})


jQuery_3_4_1('.close_edit') .css('outline', 'none');