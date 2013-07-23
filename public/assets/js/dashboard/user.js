$(function() 
{
    $('#create-user-form').on('submit', function()
    {
        if(!checkNewUserFormInput())
            return false;

        var errors = new Array();
        $.ajax({
            "type": "POST",
            "url": 'new',
            data: {"userName" : $('#userName').val(), "userEmail" : $('#userEmail').val(), "userPass" : $('#userPass').val(), "userLastName" : $('#userLastName').val(), "userFirstName" : $('#userFirstName').val()},
            "dataType": "json",
            success: function(result) 
            {
                if(result.userCreated === false)
                {
                    errors['userPass'] = 'Can not create user...';
                    showRegisterFormAjaxErrors(errors);
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
        if(!checkEditUserFormInput())
            return false;

        var errors = new Array();
        $.ajax({
            "type": "PUT",
            "url": window.location.href.toString(),
            data: {"userName" : $('#userName').val(), "userEmail" : $('#userEmail').val(), "userPass" : $('#userPass').val(), "userLastName" : $('#userLastName').val(), "userFirstName" : $('#userFirstName').val()},
            "dataType": "json",
            success: function(result)
            {
                if(result.userUpdated === false)
                {
                    showStatusMessage(result.errorMessage, 'error');
                }
                else
                {
                    showStatusMessage('User has been updated with success', 'success');
                }
            }
        });

        return false;
    });

    $(document).on('click', '#delete-users', function()
    {
        $.each($('.table tbody tr td input:checkbox:checked'), function( key, value ) 
        {
            $.ajax(
            {
                url: '/dashboard/user/delete',
                type: "POST",
                datatype: "json",
                data: {'userId' : $(this).data('user-id')}
            });
        });

        ajaxContent($(this).attr('href'), ".ajax-content");
    });
});

var checkEditUserFormInput = function()
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

    if(userPass !== "" && !passwordIsValidated(userPass))
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