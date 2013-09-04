$(function() 
{
    $(document).on('click', '#delete-item', function()
    {
        $('#confirm-modal').modal();
    });

    $(document).on('click', '.delete-permission .confirm-action', function()
    {
        $('#confirm-modal').modal('hide');
    })
});