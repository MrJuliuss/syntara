$(function() 
{
    $('#create-permission-form').on('submit', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "POST",
            "url": 'new',
            "data": sArray,
            "dataType": "json"
        }).done(function(result)
        {
            if(result.permissionCreated === false)
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
                window.location = result.redirectUrl;
            }
        });

        return false;
    });

    $('#edit-permission-form').on('submit', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            "data": sArray,
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
        $('#confirm-modal').modal();
    });

    $(document).on('click', '.delete-permission .confirm-action', function()
    {
        $.each($('.table tbody tr td input:checkbox:checked'), function( key, value ) 
        {
            $.ajax(
            {
                "url": "permission/"+$(this).data('permission-id'),
                "type": "DELETE"
            }).done(function(result)
            {
                showStatusMessage(result.message, result.messageType);
                ajaxContent($(this).attr('href'), ".ajax-content", false);
            });
        });

        $('#confirm-modal').modal('hide');
    })
});