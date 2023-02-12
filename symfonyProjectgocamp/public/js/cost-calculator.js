/*
Author: nicdark
Author URI: http://www.nicdarkthemes.com/
*/



function nicdark_cost_calculator(paged){

	//get value
	var value_accomodation = jQuery( "select#nicdark_cost_calculator_accomodation option:selected").val();
	var value_person = jQuery( "select#nicdark_cost_calculator_person option:selected").val();
	var value_day = jQuery( "select#nicdark_cost_calculator_day option:selected").val();
	var value_season = jQuery( "select#nicdark_cost_calculator_season option:selected").val();	

	jQuery.ajax({

		 method: "POST",
		 url: "http://www.nicdarkthemes.com/themes/camping-village/html/demo/include/ajax/cost-calculator.php",
		 data: { 
		     value_accomodation: value_accomodation,
		     value_person: value_person,
		     value_day: value_day,
		     value_season: value_season
		 }

	})

	.success(function( nicdark_ajax_cost_calculator_result ) {
		 
		jQuery( ".nicdark_ajax_cost_calculator_result" ).empty(); //empty the content
  		jQuery( ".nicdark_ajax_cost_calculator_result" ).append( nicdark_ajax_cost_calculator_result ); // insert new content base on the new query

	})
	

	.error(function(){
	         
	 	alert('error'); 

	});

}

