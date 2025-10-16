$(document).ready( 
	function(){
		$('#slideshow-home').innerfade({
			animationtype: 'fade', 
			speed: 1000, 
			timeout: 5000, 
			type: 'sequence', 
			containerheight: '217px' 
		});
		$('#candidateCitiesList').innerfade({
			animationtype: 'slide', 
			speed: 1000, 
			timeout: 5000, 
			type: 'sequence', 
			containerheight: '30px' 
		});
	}
);