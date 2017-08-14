(function($) {
    $(document).ready(function(){

	    $('#pauseButton').click(function(){
	        $('#carousel').carousel('pause');
	    });

	    // placeholders for contact form
	    $('#webform-client-form-12 #edit-submitted-email').attr('placeholder','Your Email Here');
	    $('#webform-client-form-12 #edit-submitted-message').attr('placeholder','Type Message Here');

	    $("#edit-submitted-inquiry-type option:first").text("Please Select an Area of Inquiry");


	    // add class to mobile cart form subtotal price
	    $("#subtotal-title").next('.uc-price').addClass('subtotal');

	    // add class to press images
		$('.press-items .node-press-teaser .field-name-field-cover-image a img').addClass('img-responsive');

		// wrap table with responsive class
		$(".node-page .table").wrap( "<div class='table-responsive'></div>" );

		resizeMobileNav();

		$(window).resize(function(){
			resizeMobileNav();
		});

		function resizeMobileNav() {
			vph = $(window).height();
			$("#sidebar-mobile").css({'height': vph});
		}
	    
	});
})(jQuery);


