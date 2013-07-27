$(document).ready(function() 
{
    $('#login-form').on('submit', function() 
    {
        if(!checkLoginFormInput())
            return false;
        
        $.ajax({
            "type": "POST",
            "url": "login",
            "data": {"email" : $('#email').val(), "pass" : $('#pass').val()},
            "dataType": "json",
            success: function(result) 
            { 
                if(result.logged === true)
                {
                    window.location = "";
                }
                else
                {
                    showRegisterFormAjaxErrors(result.errorMessages);
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
    if($('#email').val() === "")
    {
        errors['email'] = new Array('Please enter your login');
    }
    if($('#pass').val() === "")
    {
        errors['pass'] = new Array('Please enter your password');
    }
    
    if(Object.keys(errors).length)
    {
        showRegisterFormAjaxErrors(errors);
        return false;
    }
    else
    {
        return true;
    }
};