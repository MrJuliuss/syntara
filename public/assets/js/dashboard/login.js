$(document).ready(function() 
{
    $('#login-form').on('submit', function() 
    {
        if(!checkLoginFormInput())
            return false;
        
        $.ajax({
            "type": "POST",
            "url": "login",
            "data": {"login" : $('#login').val(), "pass" : $('#pass').val()},
            "dataType": "json",
            success: function(result) 
            { 
                if(result.logged === true)
                {
                    window.location = "";
                }
                else
                {
                    $('#pass').after('<div class="label label-important">Bad login or password</div>');
                }
            }
        });
        
        return false;
    });
});

var checkLoginFormInput = function()
{
    $('.label-important').remove();
    var errors = new Array();
    if($('#login').val() === "")
    {
        errors['login'] = 'Please enter your login';
    }
    if($('#pass').val() === "")
    {
        errors['pass'] = 'Please enter your password';
    }
    
    if(Object.keys(errors).length !== 0)
    {
        showRegisterFormAjaxErrors(errors);
        return false;
    }
    else
    {
        return true;
    }
};