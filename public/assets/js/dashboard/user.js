$(function() 
{
	$('#create-user-form').on('submit', function()
	{
		if(!checkNewUserFormInput())
			return false;
		
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

var checkNewUserFormInput = function()
{
    $('.label-important').remove();
	
    var errors = new Array();
	var userName = $('#userName').val();
	var userPass = $('#userPass').val();
	var userEmail = $('#userEmail').val();
	
    if(!loginIsValidated(userName))
    {
        errors['userName'] = 'Bad login';
    }
	
    if(!passwordIsValidated(userPass))
    {
        errors['userPass'] = 'Bad password';
    }
	
	if(!emailIsValidated(userEmail))
	{
		errors['userEmail'] = 'Bad email';
	}
    
    if(Object.keys(errors).length !== 0)
    {
		showRegisterFormAjaxErrors(errors);
        return false;
    }
    else
    {
        return true;
    }	
};