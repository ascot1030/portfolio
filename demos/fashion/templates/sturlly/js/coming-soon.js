 jQuery('#counter').countdown('2015/12/15 12:00:00').on('update.countdown',function(event){var $this = jQuery(this).html(event.strftime('' + '<div class="counter-container"><div class="counter-box first"><div class="number">%-D</div><span>Day%!d<span></div>' + '<div class="counter-box"><div class="number">%H</div><span>Hours</span></div>' + '<div class="counter-box"><div class="number">%M</div><span>Minutes</span></div>' + '<div class="counter-box last"><div class="number">%S</div><span>Seconds</span></div></div>'))});
            

jQuery(document).ready(function () {
    jQuery("#submitbutton").click(function()
    {alert('a')
        var error = true;
        if(!(/(.+)@(.+){2,}\.(.+){2,}/.test(jQuery("#email").val())))
        {
            jQuery("#email").addClass("not-valid");
            error = false ;
        } else { jQuery("#email").removeClass("not-valid"); }
        var bturl = jQuery('.bturi').val();
        if(error)
        {
            jQuery.ajax
            ({
                type: "POST",
                url: bturl+"notifyme.php",
                data: jQuery("form#notifyMe").serialize(),
                success: function(result) {
                    jQuery("#email").val('');
                        jQuery("#successmsg").show();
                        jQuery("#successmsg").html(result); 
                }
            });
        }
    });

    });