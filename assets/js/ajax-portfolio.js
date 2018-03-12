jQuery(document).ready(function($){
  
  "use strict";
  $.fn.dt_ajax_portfolio = function( args ){
    var win  = $(window),
        defaults = {
          open_wrap	: '.ajax-portfolio-details',
          open_in		: '.ajax-portfolio-details-inner',
          easing		: 'easeOutQuint',
          timing		: 800,
          transition	: 'slide' // 'fade' or 'slide'
        }; //defaults end
    
    var options = $.extend({}, defaults, args);
    
    return this.each(function(){
      
      var container			= $(this),
          target_wrap			= container.find(options.open_wrap),
          target_container	= container.find(options.open_in),
          items				= container.find('.portfolio-item'),
          content_retrieved	= {},
          is_open				= false,
          animating			= false,
          index_open			= false,
          ajax_call			= false,
          controls,
          methods = {
            load_item : function(){
              var post_id = $(this).data("ajax-id"),
                  clickedIndex	= $(this).index();
              
              container.find('.active-ajax-item').removeClass('active-ajax-item');
              $(this).addClass('active-ajax-item');
              
              methods.ajax_get_contents(post_id, clickedIndex);
              return false;
            },//load_item

            ajax_get_contents: function(post_id, clickedIndex){
              if(content_retrieved[post_id] !== undefined) {
                methods.show_item(post_id, clickedIndex);
                return;
              }
              
              $.ajax({
                url:mytheme_urls.ajaxurl,
                type:"POST",
                data:"action=load_portfolio_item&pid="+post_id,
                success:function(msg){
                  content_retrieved[post_id] = msg;
                  methods.attach_item(post_id);
                  methods.show_item(post_id, clickedIndex);
                },
                error:function(){
                  console.log("Error in loading portfolio item");
                }
              });
            },//ajax_get_contents

            attach_item: function(post_id) {
              content_retrieved[post_id] = $(content_retrieved[post_id]).appendTo(target_container);
            }, //attach_item()

            show_item : function(post_id, clickedIndex){
              
              methods.scroll_top();
              target_wrap.slideUp(options.timing);
              
              setTimeout(function(){
                target_wrap.addClass('container-opened');
                $('.current-portfolio-item').removeClass("current-portfolio-item");
                content_retrieved[post_id].addClass('current-portfolio-item'); 
                target_wrap.slideDown(options.timing);
              },options.timing);
              
            },//show_item()
            
            scroll_top: function() {
              var target_offset = container.offset().top - 230,
                  window_offset = win.scrollTop();
              if(window_offset > target_offset || target_offset - window_offset > 230  ) {
                $('html,body').animate({ scrollTop: target_offset }, options.timing);
              }
            },//scroll_top()
            
            controls_click: function(){
              var showItem,
                  activeID = container.find('.active-ajax-item').data('ajax-id'),
                  active   = container.find('.portfolio-item-entry-'+activeID);

              switch(this.hash) {
                case "#next":
                  showItem = active.nextAll('.portfolio-item:not(.isotope-hidden):eq(0)').find('a:eq(0)');
                  if(!showItem.length) { showItem = $('.portfolio-item:not(.isotope-hidden):eq(0)', container).find('a:eq(0)'); }
                  showItem.trigger('click');
                  break;
                  
                case "#prev":
                  showItem = active.prevAll('.portfolio-item:not(.isotope-hidden):eq(0)').find('a:eq(0)');
                  if(!showItem.length) { showItem = $('.portfolio-item:not(.isotope-hidden):last', container).find('a:eq(0)'); }
                  showItem.trigger('click');
                  break;
                  
                case "#close":
                  target_wrap.slideUp( options.timing,function()	{ 
                    container.find('.active-ajax-item').removeClass('active-ajax-item');
                    target_wrap.removeClass('container-opened');
                  });
                  break;
              }//switch()
							
              return false;              
            }
            
          }; //method()
      
      items.on("click",methods.load_item);
      $(".ajax-controls").on("click","a",methods.controls_click);
      
      });//each()
  };//dt_ajax_portfolio
  
  
  if($('.ajax-portfolio-container').length > 0){
    $('.ajax-portfolio-container').dt_ajax_portfolio();
  }
  
});