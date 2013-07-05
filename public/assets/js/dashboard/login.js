$(document).ready(function() 
{
    $('#login-form').on('submit', function() 
    {
        if(!checkLoginFormInput())
            return false;
        
        $.ajax({
            "type": "POST",
            "url": "login",
            data: {"userLogin" : $('#userLogin').val(), "userPass" : $('#userPass').val()},
            "dataType": "json",
            success: function(result) 
            { 
                if(result.logged === true)
                {
                    window.location = "";
                }
                else
                {
                     $('#userPass').after('<div class="label label-important">Bad login or password</div>');
                }
            }
        });
        
        return false;
    });
});

function checkLoginFormInput()
{
    $('.label-important').remove();
    var errors = new Array();
    if($('#userLogin').val() === "")
    {
        errors['userLogin'] = 'Please enter your login';
    }
    if($('#userPass').val() === "")
    {
        errors['userPass'] = 'Please enter your password';
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
}