$(document).ready(function()
{
    var ul = $('#sidebar > ul');
    
    $('#sidebar > a').click(function(e)
    {
        e.preventDefault();
        var sidebar = $('#sidebar');
        if(sidebar.hasClass('open'))
        {
            sidebar.removeClass('open');
            ul.slideUp(250);
        } 
        else
        {
            sidebar.addClass('open');
            ul.slideDown(250);
        }
	});
    
    $('.submenu > a').click(function(e)
    {
        e.preventDefault();
        var submenu = $(this).siblings('ul');
        var li = $(this).parents('li');
        var submenus = $('#sidebar li.submenu ul');
        var submenus_parents = $('#sidebar li.submenu');
        if(li.hasClass('open'))
        {
            if(($(window).width() > 768) || ($(window).width() < 479)) 
            {
                submenu.slideUp();
            } 
            else
            {
                submenu.fadeOut(250);
            }
            li.removeClass('open');
        }
        else 
        {
            if(($(window).width() > 768) || ($(window).width() < 479)) 
            {
                submenus.slideUp();			
                submenu.slideDown();
            } 
            else 
            {
                submenus.fadeOut(250);			
                submenu.fadeIn(250);
            }
            submenus_parents.removeClass('open');		
            li.addClass('open');	
        }
    });
    
    $(window).resize(function()
    {
        if($(window).width() > 479)
        {
            ul.css({'display':'block'});	
            $('#content-header .btn-group').css({width:'auto'});		
        }
        if($(window).width() < 479)
        {
            ul.css({'display':'none'});
            fix_position();
        }
        if($(window).width() > 768)
        {
            $('#user-nav > ul').css({width:'auto',margin:'0'});
            $('#content-header .btn-group').css({width:'auto'});
        }
    });

    if($(window).width() < 468)
    {
        ul.css({'display':'none'});
        fix_position();
    }
    if($(window).width() > 479)
    {
       $('#content-header .btn-group').css({width:'auto'});
        ul.css({'display':'block'});
    }
    
    $(document).on('click', '.pagination a', function()
    {
        ajaxContent($(this).attr('href'), ".ajax-content");

        return false;
    });

    $(document).on('change', '.table tbody tr td input:checkbox', function()
    {
        var parent = $(this).parents('.table'); 
        if(parent.find("tbody tr td input:checkbox:checked").length >= 1)
        {
            $('#delete-users').show();
        }
        else
        {
             $('#delete-users').hide();
        }
    });

    $(document).on('change', '.check-all', function()
    {
        var parent = $(this).parents('.table');
        if($(this).is(':checked'))
        {
            parent.find("tbody tr td input:checkbox").prop('checked', true);
            $('#delete-users').show();
        }
        else
        {
            parent.find("tbody > tr > td > input:checkbox").prop("checked", false);
            $('#delete-users').hide();
        }
    });

    $(document).on('click', '.add-input', function()
    {

    });
});

var ajaxContent = function(url, content, options)
{
    $.ajax(
    {
        url: url,
        type: "get",
        datatype: "html",
        data: options
    })
    .done(function(data)
    {
        $(content).empty().html(data.html);
    });
};

var showStatusMessage = function(message, type)
{
    $('.status-message').remove();
    
    var html = '<div class="row-fluid status-message">\n\
                    <div class="row-fluid">\n\
                        <div class="span12">\n\
                            <div class="alert alert-'+type+'">\n\
                                '+message+'\n\
                            </div>\n\
                        </div>\n\
                    </div>\n\
                </div>';
            
    $(html).prependTo('#main-container').hide().fadeIn(900);
};