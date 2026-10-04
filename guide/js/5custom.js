jQuery(document).ready(function (){
    $('#sidebar').css({ 'display': "block" });
	$('#sidebar').affix({
		offset: {
			top: $('header').height()
		}
	});     
	
    $('.slideTo').click(function(e){
		e.preventDefault();
		var $this = $(this);
		var el = $( $this.attr('href') );
		if( el.length > 0 ){
			var position = Math.round(el.offset().top);
			$("html, body").stop().animate(
				{
					scrollTop: position
				}, 
				{
					duration: 1200,
					easing: 'easeInOutExpo'
				}
			);
		}
	});	
});