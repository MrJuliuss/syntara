$(function() 
{
    $('.activate-user').tooltip();

    $('#create-user-form').on('submit', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "POST",
            "url": 'new',
            "data": sArray,
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
                window.location = result.redirectUrl;
            }
        });
        
        return false;
    });

    $('#edit-user-form').on('submit', function()
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

                if(result.messageType == 'success')
                {
                    ajaxContent($(this).attr('href'), ".ajax-content", false);
                }
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

    $(document).on('click', '.delete-user .confirm-action', function()
    {
        $.each($('.table tbody tr td input:checkbox:checked'), function( key, value ) 
        {
            $.ajax(
            {
                "url": "user/"+$(this).data('user-id'),
                "type": "DELETE"
            }).done(function(result)
            {
                showStatusMessage(result.message, result.messageType);
                ajaxContent($(this).attr('href'), ".ajax-content", false);
            });
        });

        $('#confirm-modal').modal('hide');
    }).on('click', '.activate-user', function()
    {
        var userId = $(this).parent().parent().find('input[type="checkbox"]').data('user-id');

        $.ajax({
            "type": "PUT",
            "url": 'user/'+userId+'/activate/',
            "data": {userId : userId},
            "dataType": "json"
        }).done(function(result)
        {
            if(typeof result.message !== 'undefined')
            {
                showStatusMessage(result.message, result.messageType);

                if(result.messageType == 'success')
                {
                    ajaxContent($(this).attr('href'), ".ajax-content", false);
                }
            }
        });

        return false;
    });
});