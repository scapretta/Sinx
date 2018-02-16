$( document ).ready(function() {
$('#cssmenu ul ul li:odd').addClass('odd');
$('#cssmenu ul ul li:even').addClass('even');
$('#cssmenu > ul > li > a').click(function() {
	$('#cssmenu li').removeClass('active');
	$(this).closest('li').addClass('active');
	
	var checkElement = $(this).next();
	if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
		return false;
	}
	if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
		$('#cssmenu ul ul:visible').slideUp('normal');
		checkElement.slideDown('normal');
		return false;
	}
});
});