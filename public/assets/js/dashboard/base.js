var lastAjxOpt = null;

$(document).ajaxStart(function()
{
    $('.ajax-loader').show();
});

$( document ).ajaxComplete(function()
{
    $('.ajax-loader').hide();
});

$(document).ready(function()
{
    $(document).on('click', '.add-input', function()
    {
        var $selected = $('.permissions-select option:selected');
        var permissionId = $selected.val();
        var label = $selected.html();

        if(typeof permissionId !== 'undefined')
        {
            $selected.remove();
            var html = '<div class="form-group"><p class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-minus-sign remove-input"></span></span><input readonly type="text" class="form-control" name="'+permissionId+'" value="'+label+'"/></p></div>';
            $('.input-container').append(html);
        }

        return false;
    }).on('click', '.remove-input', function()
    {
        var $selected = $(this).parent().parent().children('input');
        var permissionId = $selected.attr('name');
        var label = $(this).parent().parent().children('input').val();

        $('.permissions-select').prepend('<option value="'+permissionId+'">'+label+'</option>');

        $(this).parent().parent().parent().remove();
        return false;
    }).on('click', '.ajax-content .pagination a', function()
    {
        ajaxContent($(this).attr('href'), ".ajax-content", null, true);

        return false;
    }).on('change', '.table tbody input:checkbox', function()
    {
        var parent = $(this).parents('.table'); 
        if(parent.find("tbody input:checkbox:checked").length >= 1)
        {
            $('#delete-item').css('display', 'inline-block');
        }
        else
        {
             $('#delete-item').hide();
        }
    }).on('change', '.check-all', function()
    {
        var parent = $(this).parents('.table');
        if($(this).is(':checked'))
        {
            parent.find("tbody input:checkbox").prop('checked', true);
            $('#delete-item').css('display', 'inline-block');
        }
        else
        {
            parent.find("tbody input:checkbox").prop("checked", false);
            $('#delete-item').hide();
        }
    });

    $('#search-form').on('submit', function()
    {
        var sArray = $(this).serializeArray();
        ajaxContent([location.protocol,'//', location.host, location.pathname].join(''), ".ajax-content", sArray, false);

        return false;
    });
});

var ajaxContent = function(url, content, options, useSave)
{
    if(lastAjxOpt != null && useSave === true)
    {
        options = lastAjxOpt;
        lastAjxOpt = null;
    }

    $.ajax(
    {
        url: url,
        type: "GET",
        datatype: "html",
        data: options
    })
    .done(function(data)
    {
        $(content).empty().html(data.html);
        window.history.pushState(data, '', url);
        lastAjxOpt = options;
    });
};

window.onpopstate = function(e){
    if(e.state)
    {
        $(".ajax-content").empty().html(e.state.html);
    }
};

var showStatusMessage = function(message, type)
{
    $('.status-message').remove();
    $('.label-danger').remove();

    var html = '<div class="row status-message">\n\
                        <div class="col-lg-12">\n\
                            <div class="alert alert-'+type+'">\n\
                                '+message+'\n\
                            </div>\n\
                        </div>\n\
                </div>';

    $(html).prependTo('#main-container').hide().fadeIn(900);
};

var showRegisterFormAjaxErrors = function(errors)
{
    $('.status-message').remove();
    $('.label-danger').remove();
    for(var errorType in errors)
    {
        for(var i in errors[errorType])
        {
            $('[name="'+errorType+'"]').closest('.form-group').append('<span class="label label-danger error-'+errorType+'">'+errors[errorType][i]+'</span>');
        }
    }
};
