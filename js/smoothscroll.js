jQuery(document).ready(function($){
	$(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
			$('#smoothup') .fadeOut();
        } else {
			$('#smoothup') .fadeIn();
        }
    });
	$('#totop').on('click', function(){
		$('html, body').animate({scrollTop:0}, 'fast');
		return false;
		});
});