$(function(){
    $('#password').keyup(function(e) {
         var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
         var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
         var weakRegex = new RegExp("(?=.{6,}).*", "g");
 
        var password = $(this).val();
        if(false == weakRegex.test(password))
        {
            $('span.bar').css("width","25%");
            $('.progress').addClass('orange');
            $('.progress').addClass('red');
            $('.feedback').html('Weak');
        }
        else if(strongRegex.test(password))
        {
            $('span.bar').css("width","100%");
            $('.progress').removeClass('orange');
            $('.progress').removeClass('red');
            $('.feedback').html('Strong');
        }
        else if(mediumRegex.test(password))
        {
            $('span.bar').css("width","50%");
            $('.progress').removeClass('red');
            $('.progress').addClass('orange');
            $('.feedback').html('Medium');
        }
        else
        {
            $('span.bar').css("width","2%");
            $('.progress').addClass('orange');
            $('.progress').addClass('red');
            $('.feedback').html('Weak');
        }
    });
});