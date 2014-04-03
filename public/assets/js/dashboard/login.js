$(document).ready(function() 
{
    $(document).on('submit', '#login-form', function() 
    {
        var remember = false;
        if($("#remember").is(':checked'))
        {
            remember = true;
        }
        
        $.ajax({
            "type": "POST",
            "url": window.location.href.toString(),
            "data": {"email" : $('#email').val(), "pass" : $('#pass').val(), 'remember' : remember},
            "dataType": "json"
        }).done(function(result) 
        { 
            if(result.logged === false)
            {
                if(typeof result.errorMessage !== 'undefined')
                {
                    showStatusMessage(result.errorMessage, 'danger');
                }
                else if(typeof result.errorMessages !== 'undefined')
                {
                    showRegisterFormAjaxErrors(result.errorMessages);
                }
            }
            else
            {
                window.location = "";
            }
        });
        
        return false;
    });
});