$(document).ready(function() {

    
	$('#save_button').click(function(){
		
	});

	$('#cancel_button').click(function(){
		parent.history.back();
        return false;
	});

	$('#new_button').click(function(){
		/*alert(location.pathname.replace(/\/[^\/]+$/, '')+'/new');*/
		window.location = location.pathname.replace(/\/[^\/]+$/, '')+'/new';
	});


	$('#back_button').click(function(){
		/*alert(location.pathname.replace(/\/[^\/]+$/, '')+'/new');*/
		window.location = location.pathname.replace(/\/[^\/]+$/, '')+'/list';
	});
});