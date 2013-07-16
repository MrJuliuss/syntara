$(function() 
{
	$('#create-user-form').on('submit', function()
	{
		$.ajax({
            "type": "POST",
            "url": "new",
            data: '',
            "dataType": "json",
            success: function(result) 
            { 
            }
        });
		
		return false;
	});
});