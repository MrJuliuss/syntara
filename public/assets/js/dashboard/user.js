$(function() 
{
    $('#create-user-form').on('submit', function()
    {
        $.ajax({
            "type": "POST",
            "url": 'new',
            data: {"username" : $('#username').val(), "email" : $('#email').val(), "pass" : $('#pass').val(), "last_name" : $('#last_name').val(), "first_name" : $('#first_name').val()},
            "dataType": "json",
            success: function(result) 
            {
                if(result.userCreated === false)
                {
                    if(typeof result.errorMessage !== 'undefined')
                    {
                        showStatusMessage(result.errorMessage, 'error');
                    }
                    else if(typeof result.errorMessages !== 'undefined')
                    {
                        showRegisterFormAjaxErrors(result.errorMessages);
                    }
                }
                else
                {
                    window.location = "/dashboard/users";
                }
            }
        });
        
        return false;
    });

    $('#edit-user-form').on('submit', function()
    {
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            data: {"username" : $('#username').val(), "email" : $('#email').val(), "pass" : $('#pass').val(), "last_name" : $('#last_name').val(), "first_name" : $('#first_name').val()},
            "dataType": "json",
            success: function(result)
            {
                if(result.userUpdated === false)
                {
                    if(typeof result.errorMessage !== 'undefined')
                    {
                        showStatusMessage(result.errorMessage, 'error');
                    }
                    else if(typeof result.errorMessages !== 'undefined')
                    {
                        showRegisterFormAjaxErrors(result.errorMessages);
                    }
                }
                else
                {
                    showStatusMessage('User has been updated with success', 'success');
                }
            }
        });

        return false;
    });

    $(document).on('click', '#delete-item', function()
    {
        $.each($('.table tbody tr td input:checkbox:checked'), function( key, value ) 
        {
            $.ajax(
            {
                url: '/dashboard/user/delete',
                type: "DELETE",
                datatype: "json",
                data: {'userId' : $(this).data('user-id')}
            });
        });

        ajaxContent($(this).attr('href'), ".ajax-content");
    });
});