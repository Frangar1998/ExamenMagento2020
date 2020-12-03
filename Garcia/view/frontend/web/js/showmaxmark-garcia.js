define(['jquery'], function($) {
    return function(config, element) {
        $(element).on('click', function(){
            alert("La maxima nota es: "+config['maxmark']);
        });
    }
});