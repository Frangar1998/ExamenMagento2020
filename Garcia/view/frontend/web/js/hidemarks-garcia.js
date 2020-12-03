define(['jquery'], function($) {
    return function(config, element) {
        $(element).on('click', '.hidemarkbutton', function(){
            if($(element).find('.exam-mark').is(':visible')){
                $(element).find('.exam-mark').hide();
                $(element).find('.hidemarkbutton').val('Show mark');
            } else {
                $(element).find('.exam-mark').show();
                $(element).find('.hidemarkbutton').val('Hide mark');
            }
        });
    }
});