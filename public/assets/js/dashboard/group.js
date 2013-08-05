$(function() 
{
    var nbInput = $('.input-group-addon').size() + 1;
    
    $('#create-group-form').on('submit', function()
    {
        var sArray = $(this).serializeArray();
        $.ajax({
            "type": "POST",
            "url": 'new',
            data: sArray,
            "dataType": "json",
            success: function(result) 
            {
                if(result.groupCreated === false)
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
                    window.location = "/dashboard/groups";
                }
            }
        });
        
        return false;
    });
    
    $(document).on('click', '.add-input', function()
    {
        var html = '<div class="form-group"><p class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-minus-sign remove-input"></span></span><input type="text" class="form-control" name="permission['+nbInput+']" /></p></div>';
        
        $('#input-container').append(html);
        
        nbInput++;
        return false;
    });
    
    $(document).on('click', '.remove-input', function()
    {
        $(this).parent().parent().parent().remove();
        return false;
    });
});