$(document).ready(function() {
	$(window).resize(function(){
		if ($(window).width()>768) {

		}
	})
	$('.sousuo').click(function(){
		if ($('.seek').css('display') == 'none') {
			$('.seek').css('display','block');
		}
		else {
			$('.seek').css('display','none');
		}
		$('#nav-ul').hide();
	})
	$('.fenlei').click(function(){
		if ($('#nav-ul').css('display') == 'none') {
			$('#nav-ul').css('display','block');
		}
		else {
			$('#nav-ul').css('display','none');
		}
		$('.seek').hide();
	})
	

})