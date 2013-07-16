$(function() 
{
	$('#create-user-form').on('submit', function()
	{
		$.ajax({
            "type": "POST",
            "url": 'new',
            data: {"userName" : $('#userName').val(), "userEmail" : $('#userEmail').val(), "userPass" : $('#userPass').val()},
            "dataType": "json",
            success: function(result) 
            {
				
            }
        });
		
		return false;
	});
});