$(function() 
{
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
                "url": "permission/delete",
                "type": "DELETE",
                "datatype": "json",
                "data": {'permissionId' : $(this).data('permission-id')}
            }).done(function(result)
            {
                showStatusMessage(result.message, result.messageType);
                ajaxContent($(this).attr('href'), ".ajax-content", false);
            });
        });

        $('#confirm-modal').modal('hide');
    })
});