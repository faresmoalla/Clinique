/*
	Author: nicdark
	Author URI: http://www.nicdarkthemes.com/
*/



/***************************************************start function for styleswitcher*********************************************/
function nicdark_menu_layout(){

	var nicdark_menu_layout_value = jQuery( "select.nicdark_switcher_menu_layout option:selected").val();

	if ( nicdark_menu_layout_value == 'nicdark_menu_fullwidth'){
		jQuery('.nicdark_menu_fullwidth_boxed').removeClass('nicdark_menu_boxed');	
		jQuery('.nicdark_menu_fullwidth_boxed').addClass('nicdark_menu_fullwidth');	
	}else{
		jQuery('.nicdark_menu_fullwidth_boxed').removeClass('nicdark_menu_fullwidth');	
		jQuery('.nicdark_menu_fullwidth_boxed').addClass('nicdark_menu_boxed');	
	}
	
}


function nicdark_page_layout(){

	var nicdark_page_layout_value = jQuery( "select.nicdark_switcher_page_layout option:selected").val();

	if ( nicdark_page_layout_value == 'nicdark_site_fullwidth'){
		jQuery('.nicdark_site_fullwidth_boxed').removeClass('nicdark_site_boxed');	
		jQuery('.nicdark_site_fullwidth_boxed').addClass('nicdark_site_fullwidth');	
	}else{
		jQuery('.nicdark_site_fullwidth_boxed').removeClass('nicdark_site_fullwidth');	
		jQuery('.nicdark_site_fullwidth_boxed').addClass('nicdark_site_boxed');	
	}	

}


function nicdark_bgcolor_site(nicdark_rgba_color,nicdark_bg_color,nicdark_switcher_type){

	jQuery('.nicdark_switcher_color').removeClass('active');
	jQuery('.nicdark_switcher_color.'+nicdark_bg_color).addClass('active');

    if (nicdark_switcher_type == 'nicdark_switcher_bgcolor'){
    	jQuery( '.nicdark_site' ).attr( 'style', nicdark_rgba_color );
    }
	
	if (nicdark_switcher_type == 'nicdark_switcher_bgimage'){
    	jQuery( '#start_nicdark_framework' ).attr( 'style', nicdark_rgba_color );
    	jQuery( '.nicdark_site' ).attr( 'style', '' );
    }	   

}
/***************************************************end function for styleswitcher*********************************************/


(function($) {
	"use strict";



	//isotope
	$( window ).load(function() {
		
		$('.nicdark_masonry_btns div a').click( function() {
			var filterValue = $( this ).attr('data-filter');
			$container.isotope({ filter: filterValue });
		});
		  
		var $container = $('.nicdark_masonry_container').isotope({
			itemSelector: '.nicdark_masonry_item'
		});

		$( '.nicdark_simulate_click' ).trigger( "click" );
	
	});
	///////////





	//sidebar fixed 
	$( window ).load(function() {
	
		var window_Width = $(window).width(); 
		var window_Height = $(window).height();
		var nicdark_sidebar_fixed_height = $('.nicdark_sidebar_fixed').height();

		
		//chaeck if element exists
		if ( nicdark_sidebar_fixed_height > 0 ){

			//condition
			if (window_Width < 1199 || window_Height < nicdark_sidebar_fixed_height+200 ){}else{

				$(window).scroll(function () {

					//do
					var nicdark_sidebar_fixed_container = $('.nicdark_sidebar_fixed_container').offset().top;
			        var nicdark_scroll = $(this).scrollTop();
			        var nicdark_sidebar_fixed_width = $('.nicdark_sidebar_fixed').width() + 'px';

			        //get height
					var nicdark_sidebar_fixed_container_height = $('.nicdark_sidebar_fixed_container').height() - 0;
					var nicdark_difference_height = nicdark_sidebar_fixed_container_height - nicdark_sidebar_fixed_height - 200;
					var nicdark_sidebar_fixed_margin_top = nicdark_sidebar_fixed_container_height - nicdark_sidebar_fixed_height;


			        if (nicdark_scroll > nicdark_sidebar_fixed_container-200 && nicdark_scroll < nicdark_sidebar_fixed_container+nicdark_difference_height) {

			            $('.nicdark_sidebar_fixed').css({
			                'position': 'fixed',
			                'top': '200px',
			                'margin-top': '0px',
			                'width': nicdark_sidebar_fixed_width
			            });


			        }else if  ( nicdark_scroll >= nicdark_sidebar_fixed_container+nicdark_difference_height)    {

			            $('.nicdark_sidebar_fixed').css({
			                'position': 'static',
			                'margin-top': nicdark_sidebar_fixed_margin_top
			            });

			        } else {

			            $('.nicdark_sidebar_fixed').css({
			                'position': 'static',
			                'margin-top': '0px'
			            });

			        }
					//end do

				});

			}
			//end condition

		}
	
	});
	//sidebar fixed






	//inview
	var windowWidth = $(window).width(); 

	if (windowWidth < 400){
		
		$('.fade-left, .fade-up, .fade-down, .fade-right, .bounce-in, .rotate-In-Down-Left, .rotate-In-Down-Right').css('opacity','1');
			
	}else{
		
		$('.fade-up').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInUp'); } });
		$('.fade-down').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInDown'); } });
		$('.fade-left').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInLeft'); } });
		$('.fade-right').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated fadeInRight'); } });
		$('.bounce-in').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated bounceIn'); } });
		$('.rotate-In-Down-Left').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated rotateInDownLeft'); } });
		$('.rotate-In-Down-Right').bind('inview', function(event, visible) { if (visible == true) { $(this).addClass('animated rotateInDownRight'); } });	

	}
	///////////
		

	//menu	
	$('.nicdark_menu').superfish({});	
	//megamenu
	$('.nicdark_megamenu ul a').removeClass('sf-with-ul');
	$($('.nicdark_megamenu ul li').find('ul').get().reverse()).each(function(){
	  $(this).replaceWith($('<ol>'+$(this).html()+'</ol>'))
	})
	//responsive
	$('.nicdark_menu').tinyNav({
		active: 'selected',
		header: 'MENU'
	});
	///////////


	//fixed menu
	jQuery(window).scroll(function(){
		add_class_scroll();
	});
	add_class_scroll();
	function add_class_scroll() {
		if(jQuery(window).scrollTop() > 100) {
			jQuery('.nicdark_navigation').addClass('slowup');
			jQuery('.nicdark_navigation').removeClass('slowdown');
		} else {
			jQuery('.nicdark_navigation').addClass('slowdown');
			jQuery('.nicdark_navigation').removeClass('slowup');
		}
	}
	///////////
	

	
	//tooltip
    $( '.nicdark_tooltip' ).tooltip({ 
    	position: {
    		my: "center top",
    		at: "center+0 top-50"
  		}
    });
    //calendar
	$( '.nicdark_calendar' ).datepicker({ });
	//tab
	$('.nicdark_tab').tabs({show: 'fade', hide: 'fade'});
	//toogle
	$( '.nicdark_toogle' ).accordion({
		heightStyle: "content",
		collapsible: true,
		active: false
	}); 
	//accordion
	$( '.nicdark_accordion' ).accordion({
		heightStyle: "content"
	});
	//slider-range
	$( ".nicdark_slider_range" ).slider({
		range: true,
		min: 0,
		max: 1000,
		values: [ 200, 700 ],
		slide: function( event, ui ) {
			$( ".nicdark_slider_amount" ).val( "$ " + ui.values[ 0 ] + " - $ " + ui.values[ 1 ] );
		}
	});
	$( ".nicdark_slider_amount" ).val( "$ " + $( ".nicdark_slider_range" ).slider( "values", 0 ) + " - $ " + $( ".nicdark_slider_range" ).slider( "values", 1 ) );
	//slider-range-select
	var nicdark_slider_range_select_is_present = $( '.nicdark_slider_range_select' ).length;
	if ( nicdark_slider_range_select_is_present != 0 ){
		var select = $( ".nicdark_slider_range_select" );
		var slider = $( "<div class='nicdark_bg_greydark2' style='width:40%; float:left; margin-top:18px;' id='slider'></div>" ).insertAfter( select ).slider({
			min: 1,
			max: 15,
			range: "min",
			value: select[ 0 ].selectedIndex + 1,

			change: function( event, ui ) {
				nicdark_cost_calculator();
			},

			slide: function( event, ui ) {
				select[ 0 ].selectedIndex = ui.value - 1;
			}
		});
		$( ".nicdark_slider_range_select" ).change(function() {
			slider.slider( "value", this.selectedIndex + 1 );
		});
	}
	//alerts
	$('.nicdark_alerts').click(function(event){
		$(this).css({
			'display': 'none',
		});
	});
	//progressbar
	$('.animate_progressbar').bind('inview', function(event, visible) { if (visible == true) { $(this).removeClass('animate_progressbar'); } });
	///////////



	//internal-link
	$('.nicdark_internal_link').click(function(event){

		event.preventDefault();
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
	
		$('html,body').animate({scrollTop:target_top -50}, 900);
	
	});
	///////////



	//counter
	$('.nicdark_counter').data('countToOptions', {
		formatter: function (value, options) {
			return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
		}
	});
	// start all the timers
	$('.nicdark_counter').bind('inview', function(event, visible) {
		if (visible == true) {
			$('.nicdark_counter').each(count);
		} 
	});
	function count(options) {
		var $this = $(this);
		options = $.extend({}, options || {}, $this.data('countToOptions') || {});
		$this.countTo(options);
	}
	///////////


	//nicescrool
	$(".nicdark_nicescrool").niceScroll({
		touchbehavior:true,
		cursoropacitymax:1,
		cursorwidth:0,
		autohidemode:false,
		cursorborder:0
	});
	///////////

		

	//left sidebar OPEN		
	$('.nicdark_left_sidebar_btn_open').click(function(event){
		$('.nicdark_left_sidebar').css({
			'left': '0px',
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '300px',
		});
		$('.nicdark_overlay').addClass('nicdark_overlay_on');
	});
	//left sidebar CLOSE	
	$('.nicdark_left_sidebar_btn_close, .nicdark_overlay').click(function(event){
		$('.nicdark_left_sidebar').css({
			'left': '-300px'
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '0px'
		});
		$('.nicdark_overlay').removeClass('nicdark_overlay_on');
	});
	//right sidebar OPEN		
	$('.nicdark_right_sidebar_btn_open').click(function(event){
		$('.nicdark_right_sidebar').css({
			'right': '0px',
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '-300px',
		});
		$('.nicdark_overlay').addClass('nicdark_overlay_on');
	});
	//right sidebar CLOSE	
	$('.nicdark_right_sidebar_btn_close, .nicdark_overlay').click(function(event){
		$('.nicdark_right_sidebar').css({
			'right': '-300px'
		});
		$('.nicdark_site, .nicdark_navigation').css({
			'margin-left': '0px'
		});
		$('.nicdark_overlay').removeClass('nicdark_overlay_on');
	});
	///////////
	


	//nicdark_mpopup_gallery
	$('.nicdark_mpopup_gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-fade',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		}
	});
	//nicdark_mpopup_iframe
	$('.nicdark_mpopup_iframe').magnificPopup({
		disableOn: 200,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});
	//nicdark_mpopup_window
	$('.nicdark_mpopup_window').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
	//nicdark_mpopup_ajax
	$('.nicdark_mpopup_ajax').magnificPopup({
		type: 'ajax',
		alignTop: false,
		overflowY: 'scroll'
	});
	//////////



	//demo switcher
	$('.nicdark_switcher_btn.nicdark_switcher_close').on('click',function(){
	   $('.nicdark_switcher_btn.nicdark_switcher_close').css('display','none');
	   $('.nicdark_switcher_btn.nicdark_switcher_open').css('display','block');
	   $('.nicdark_switcher').css('left','-250px');
	});
	$('.nicdark_switcher_btn.nicdark_switcher_open').on('click',function(){
	   $('.nicdark_switcher_btn.nicdark_switcher_open').css('display','none');
	   $('.nicdark_switcher_btn.nicdark_switcher_close').css('display','block');
	   $('.nicdark_switcher').css('left','0');
	});
	//switcher


})(jQuery);