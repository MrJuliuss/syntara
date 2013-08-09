$(function() 
{
    $('#create-user-form').on('submit', function()
    {
        $.ajax({
            "type": "POST",
            "url": 'new',
            data: {"username" : $('#username').val(), "email" : $('#email').val(), "pass" : $('#pass').val(), "last_name" : $('#last_name').val(), "first_name" : $('#first_name').val()},
            "dataType": "json"
        }).done(function(result)
        {
            if(result.userCreated === false)
            {
                if(typeof result.message !== 'undefined')
                {
                    showStatusMessage(result.message, result.messageType);
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
        });
        
        return false;
    });

    $('#edit-user-form').on('submit', function()
    {
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            data: {"username" : $('#username').val(), "email" : $('#email').val(), "pass" : $('#pass').val(), "last_name" : $('#last_name').val(), "first_name" : $('#first_name').val()},
            "dataType": "json"
        }).done(function(result)
        {
            if(typeof result.message !== 'undefined')
            {
                showStatusMessage(result.message, result.messageType);
            }
            else if(typeof result.errorMessages !== 'undefined')
            {
                showRegisterFormAjaxErrors(result.errorMessages);
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
            }).done(function(result)
            {
                showStatusMessage(result.message, result.messageType);
            });
        });

        ajaxContent($(this).attr('href'), ".ajax-content");
    });
});