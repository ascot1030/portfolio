"use strict";
	
/******************************************************************************/
/*	Responsive																  */
/******************************************************************************/

var layoutExclude=':not(.template-layout-responsive-0):not(.template-process-list)';

jQuery('.template-layout-50x50'+layoutExclude).responsiveElement({width:650,className:'template-responsive-column-a'});
jQuery('.template-layout-33x33x33'+layoutExclude).responsiveElement({width:650,className:'template-responsive-column-a'});
jQuery('.template-layout-25x25x25x25'+layoutExclude).responsiveElement({width:650,className:'template-responsive-column-a'});
jQuery('.template-layout-66x33'+layoutExclude).responsiveElement({width:650,className:'template-responsive-column-a'});
jQuery('.template-layout-33x66'+layoutExclude).responsiveElement({width:650,className:'template-responsive-column-a'});
	
jQuery('.template-timeline').responsiveElement({width:620,children:null,className:'template-timeline-responsive',classNameRemove:'template-timeline-responsive'});
jQuery('.template-process-list').responsiveElement({width:740,className:'template-responsive-column-a'});

jQuery(window).dimensionListener({'change':function(width,height) 
{
	if(height) jQuery.waypoints('refresh');
}});

/******************************************************************************/
/*	Vertical center															  */
/******************************************************************************/

var helper=new Helper();
helper.verticalCenter('.template-vertical-center');

/******************************************************************************/
/*	Component																  */
/******************************************************************************/

	/**************************************************************************/
	/*	Component / Preformatted Text										  */
	/**************************************************************************/
	
	jQuery('.template-preformatted-text').templatePreformattedText();
	
	/**************************************************************************/
	/*	Component / Accordion												  */
	/**************************************************************************/
	
	jQuery('.template-accordion').templateAccordion(
	{
		active			:	0,
		header			:	'>h5',
		disabled		:	false,
		collapsible		:	false,
		heightStyle		:	'content',
		animate			:
		{
			easing		:	'easeOutQuad',
			duration	:	300
		}
	});
	
	/**************************************************************************/
	/*	Component / Tab														  */
	/**************************************************************************/
	
	jQuery('.template-tab').templateTab(
	{
		active			:	0,
		disabled		:	false,
		collapsible		:	false,
		heightStyle		:	'content',
		show			:
		{
			delay		:	0,
			easing		:	'swing',
			duration	:	200
		},
		hide			:
		{
			delay		:	0,
			easing		:	'swing',
			duration	:	100		
		}
	});
	
	/**************************************************************************/
	/*	Component / Google Map												  */
	/**************************************************************************/
	
	jQuery('#google_map_content').templateGoogleMap(
	{
		coordinate		:
		{
			lat			:	'-37.823952',
			lng			:	'144.958766'
		},
		marker			:	'media/image/map_pointer.png'
	});
	
	jQuery('#google_map_footer').templateGoogleMap(
	{
		coordinate		:
		{
			lat			:	'-37.823952',
			lng			:	'144.958766'
		},
		marker			:	'media/image/map_pointer_footer.png'
	});
	
	/**************************************************************************/
	/*	Component / Skill list												  */
	/**************************************************************************/	
	
	jQuery('.template-skill-list').templateSkillList();
	
	/**************************************************************************/
	/*	Component / Counter list											  */
	/**************************************************************************/	
	
	jQuery('.template-counter-list').templateCounterList();
	
	/**************************************************************************/
	/*	Component / Nivo slider												  */
	/**************************************************************************/
	
	jQuery('.template-nivo-slider').templateNivoSlider(
	{
		nivoSlider	:
		{
			prevText			:	'',
			nextText			:	'',
			controlNav			:	false
		}
	});
	
	jQuery('.template-nivo-slider-box').templateNivoSliderBox(
	{
		nivoSlider	:
		{
			prevText			:	'',
			nextText			:	'',
			controlNav			:	false,
			manualAdvance		:	true
		},
		dimension		:
		{
			baseWidth			:	1080,
			headerFontSize		:	38,
			paragraphFontSize	:	21
		}
	});	
	
	/**************************************************************************/
	/*	Component / Notice													  */
	/**************************************************************************/

	jQuery('.template-notice').templateNotice();
	
	/**************************************************************************/
	/*	Component / Call To Action											  */
	/**************************************************************************/
	
	jQuery('.template-call-to-action').templateCallToAction();	
	
	/**************************************************************************/
	/*	Component / Testimonial Carousel									  */
	/**************************************************************************/
	
	jQuery('.template-testimonial.template-testimonial-carousel').templateTestimonial();
	
	/**************************************************************************/
	/*	Component / Player													  */
	/**************************************************************************/	
	
	jQuery('audio').templateAudioPlayer(
	{
		audioWidth	:	'100%'
	});
	
	/**************************************************************************/
	/*	Component / Twitter User Timeline									  */
	/**************************************************************************/	

	jQuery('.template-twitter-user-timeline').templateTwitterUserTimeline();
	
/******************************************************************************/
/*	Carousel																  */
/******************************************************************************/

jQuery('.template-carousel-testimonial').carousel();

jQuery('.template-carousel-latest-post').carousel(
{
	carouFredSel	:
	{
		direction	:	'up',
		items		:
		{
			visible	:	3
		}
	}
});

/******************************************************************************/
/*	Fancybox																  */
/******************************************************************************/

jQuery('.template-image>a').fancybox(
{
	type				:	'image',
	helpers				:	
	{
		title			:	
		{
			type		:	'inside'
		},
		buttons			:
		{
			skipSingle	:	true
		}
	},
	afterLoad			:	function()
	{
		var object=jQuery(this.element[0]);
		
		this.title=object.parents('.template-image').children('.template-fancybox-description').html();
	}
});

jQuery('.template-image-box-hover-link-popup').bind('click',function(e) 
{
	e.preventDefault();
		
	var object=jQuery(this).parents('.template-image').find('a:first');
	
	if(object.length!=1) return;
	
	object.trigger('click');
});

/******************************************************************************/
/*	Page																	  */
/******************************************************************************/
	
jQuery('#google_map_contact').templateGoogleMap(
{
	map				:
	{
		zoom		:	15
	},
	coordinate		:
	{
		lat			:	'45.359386',
		lng			:	'-75.703489'
	},
	marker			:	'media/image/map_pointer.png'
});

/******************************************************************************/
/*	Filter																	  */
/******************************************************************************/

jQuery('.template-filter').listFilter();

/******************************************************************************/
/*	Preloader																  */
/******************************************************************************/
	
jQuery('.template-image-preloader:not(.template-image-preloader-custom)').preloaderImage();

/******************************************************************************/
/*	Miscellaneous															  */
/******************************************************************************/

jQuery('label.template-infield').inFieldLabels();
jQuery('#contact-form').contactForm();

jQuery('textarea').elastic();

jQuery.waypoints('refresh');

jQuery('.template-post-button-post-reply').bind('click',function(e) 
{
	e.preventDefault();
	jQuery.scrollTo(jQuery('#comment-form').prev('h4:first'),{duration:500,axis:'y',easing:'easeInOutExpo'});
});