(function($) {
    $(document).ready(function(){
    	$('ul.menu > li.active-trail').children('.submenu-wrapper').show();
    	$('ul.menu > li.active-trail').children('.submenu-wrapper .custom-submenu').show();

        $('[data-toggle="offcanvas"]').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('.row-offcanvas').toggleClass('active');
            $('#sidebar-mobile li.active-trail').toggleClass('open');
        });

        $('#sidebar-mobile > ul').prepend('<h3>Menu</h3>');

        $('#sidebar-mobile li.expanded').append('<span><a href="javascript:void(0)">+</a></span>');

        $('#sidebar-mobile li.expanded span a').click(function(e){
            e.preventDefault();
            e.stopPropagation();
        	if($(this).parents('li').hasClass('open')){
        		$(this).text('+');
                $(this).parents('li').removeClass('open');
        	}else{
                $(this).parents('li').toggleClass('open');
        		$(this).text('-');
        	}
        });



    });
})(jQuery);
