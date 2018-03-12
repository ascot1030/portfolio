var searchFilters = {
  "start_date": moment().tz(js_options.timezone).format('YYYY-MM-DD'),
  "end_date": moment().tz(js_options.timezone).format('YYYY-MM-DD'),
  "task_type": "all",
  "budget": "0",
  "skills": "",
  "client_paymented": "all",
  "client_ranking": "0,5",
  "client_total_spent": "0",
  "client_avg_hourly": "0",
  "client_countries": "",
}

function research() {
  var f = document.frmSearchFilter;
  searchFilters.start_date = f.start_date.value;
  searchFilters.end_date = f.end_date.value;
  searchFilters.task_type = f.task_type.value;
  searchFilters.budget = f.budget.value;
  searchFilters.skills = $("#skills").val();
  if (searchFilters.skills) {
    searchFilters.skills = searchFilters.skills.join();
  }
  searchFilters.client_paymented = f.client_paymented.value;
  searchFilters.client_ranking = f.client_ranking.value;
  searchFilters.client_total_spent = f.client_total_spent.value;
  searchFilters.client_avg_hourly = f.client_avg_hourly.value;
  searchFilters.client_countries = $("#client_countries").val();
  if (searchFilters.client_countries) {
    searchFilters.client_countries = searchFilters.client_countries.join();
  }

  $.cookie("searchFilters", JSON.stringify(searchFilters));

  if ($('#web-task-chart').length) {
    drawLast24TaskChart('web-task-chart', 'web');
    drawLast24TaskChart('mobile-task-chart', 'mobile');
  }
  
  if ($('#world-map').length) {
    drawWoldMap();
  }  
  
  if ($('#table-tasks').length) {
    reloadTaskTable();
  }  
  
  if ($('#freelancer-chart').length) {
    drawFreelancerChart("day");
  }
  
  return false;
}

if ($.cookie("searchFilters")) {
  searchFilters = $.extend(searchFilters, JSON.parse($.cookie("searchFilters")));
  
  searchFilters.start_date = moment().tz(js_options.timezone).format('YYYY-MM-DD');
  searchFilters.end_date = moment().tz(js_options.timezone).format('YYYY-MM-DD');
}

$(document).ready(function () {
  /* --------------------------------------------------------
   Template Settings
   -----------------------------------------------------------*/

  var settings = '<a id="settings" href="#changeSkin" data-toggle="modal">' +
          '<i class="fa fa-gear"></i> Change Skin' +
          '</a>' +
          '<div class="modal fade" id="changeSkin" tabindex="-1" role="dialog" aria-hidden="true">' +
          '<div class="modal-dialog modal-lg">' +
          '<div class="modal-content">' +
          '<div class="modal-header">' +
          '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
          '<h4 class="modal-title">Change Template Skin</h4>' +
          '</div>' +
          '<div class="modal-body">' +
          '<div class="row template-skins">' +
          '<a data-skin="skin-blur-violate" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-violate.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-lights" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-lights.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-city" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-city.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-greenish" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-greenish.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-night" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-night.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-blue" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-blue.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-sunny" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-sunny.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-cloth" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-cloth.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-tectile" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-tectile.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-chrome" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-chrome.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-ocean" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-ocean.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-sunset" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-sunset.jpg" alt="">' +
          '</a>' +
          '<a data-skin="skin-blur-yellow" class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-yellow.jpg" alt="">' +
          '</a>' +
          '<a  data-skin="skin-blur-kiwi"class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-kiwi.jpg" alt="">' +
          '</a>' +
          '<a  data-skin="skin-blur-nexus"class="col-sm-2 col-xs-4" href="">' +
          '<img src="img/skin-nexus.jpg" alt="">' +
          '</a>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>' +
          '</div>';
  $('#main').prepend(settings);

  $('body').on('click', '.template-skins > a', function (e) {
    e.preventDefault();
    var skin = $(this).attr('data-skin');
    $('body').attr('id', skin);
    $('#changeSkin').modal('hide');

    $.cookie("theme_skin", skin);
  });

  (function () {
    if ($.cookie("theme_skin")) {
      $('body').attr('id', $.cookie("theme_skin"));
    }
  })();


  /* --------------------------------------------------------
   Components
   -----------------------------------------------------------*/
  (function () {
    /* Textarea */
    if ($('.auto-size')[0]) {
      $('.auto-size').autosize();
    }

    //Select
    if ($('.select')[0]) {
      $('.select').selectpicker();
    }

    //Sortable
    if ($('.sortable')[0]) {
      $('.sortable').sortable();
    }

    //Tag Select
    if ($('.tag-select')[0]) {
      $('.tag-select').chosen();
    }

    /* Tab */
    if ($('.tab')[0]) {
      $('.tab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
      });
    }

    /* Collapse */
    if ($('.collapse')[0]) {
      $('.collapse').collapse();
    }

    /* Accordion */
    $('.panel-collapse').on('shown.bs.collapse', function () {
      $(this).prev().find('.panel-title a').removeClass('active');
    });

    $('.panel-collapse').on('hidden.bs.collapse', function () {
      $(this).prev().find('.panel-title a').addClass('active');
    });

    //Popover
    if ($('.pover').len && $('.pover')[0]) {
      $('.pover').popover();
    }
  })();

  /* --------------------------------------------------------
   Sidebar + Menu
   -----------------------------------------------------------*/
  (function () {
    /* Menu Toggle */
    $('body').on('click touchstart', '#menu-toggle', function (e) {
      e.preventDefault();
      $('html').toggleClass('menu-active');
      $('#sidebar').toggleClass('toggled');
      //$('#content').toggleClass('m-0');
    });

    /* Active Menu */
    $('#sidebar .menu-item').hover(function () {
      $(this).closest('.dropdown').addClass('hovered');
    }, function () {
      $(this).closest('.dropdown').removeClass('hovered');
    });

    /* Prevent */
    $('.side-menu .dropdown > a').click(function (e) {
      e.preventDefault();
    });


  })();

  /* --------------------------------------------------------
   Chart Info
   -----------------------------------------------------------*/
  (function () {
    $('body').on('click touchstart', '.tile .tile-info-toggle', function (e) {
      e.preventDefault();
      $(this).closest('.tile').find('.chart-info').toggle();
    });
  })();

  /* --------------------------------------------------------
   Todo List
   -----------------------------------------------------------*/
  (function () {
    setTimeout(function () {
      //Add line-through for alreadt checked items
      $('.todo-list .media .checked').each(function () {
        $(this).closest('.media').find('.checkbox label').css('text-decoration', 'line-through')
      });

      //Add line-through when checking
      $('.todo-list .media input').on('ifChecked', function () {
        $(this).closest('.media').find('.checkbox label').css('text-decoration', 'line-through');
      });

      $('.todo-list .media input').on('ifUnchecked', function () {
        $(this).closest('.media').find('.checkbox label').removeAttr('style');
      });
    })
  })();

  /* --------------------------------------------------------
   Custom Scrollbar
   -----------------------------------------------------------*/
  (function () {
    if ($('.overflow')[0]) {
      var overflowRegular, overflowInvisible = false;
      overflowRegular = $('.overflow').niceScroll();
    }
  })();

  /* --------------------------------------------------------
   Messages + Notifications
   -----------------------------------------------------------*/
  (function () {
    $('body').on('click touchstart', '.drawer-toggle', function (e) {
      e.preventDefault();
      var drawer = $(this).attr('data-drawer');

      $('.drawer:not("#' + drawer + '")').removeClass('toggled');

      if ($('#' + drawer).hasClass('toggled')) {
        $('#' + drawer).removeClass('toggled');
      } else {
        $('#' + drawer).addClass('toggled');
      }
    });

    //Close when click outside
    $(document).on('mouseup touchstart', function (e) {
      var container = $('.drawer, .tm-icon');
      if (container.has(e.target).length === 0) {
        $('.drawer').removeClass('toggled');
        $('.drawer-toggle').removeClass('open');
      }
    });

    //Close
    $('body').on('click touchstart', '.drawer-close', function () {
      $(this).closest('.drawer').removeClass('toggled');
      $('.drawer-toggle').removeClass('open');
    });
  })();


  /* --------------------------------------------------------
   Calendar
   -----------------------------------------------------------*/
  (function () {
    //Sidebar
    if ($('#sidebar-calendar')[0]) {
      var date = new Date(moment().tz(js_options.timezone).format('YYYY-MM-DD'));
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();
      $('#sidebar-calendar').fullCalendar({
        selectable: true,
        dayClick: function (date, jsEvent, view) {
          document.frmSearchFilter.start_date.value = moment(date).tz(js_options.timezone).format('YYYY-MM-DD');
          document.frmSearchFilter.end_date.value = moment(date).tz(js_options.timezone).format('YYYY-MM-DD');

          research();
        },
        editable: false,
        events: [],
        header: {
          left: 'title'
        }
      });
      $('#sidebar-calendar').fullCalendar('gotoDate', date);
    }

    //Content widget
    if ($('#calendar-widget')[0]) {
      $('#calendar-widget').fullCalendar({
        header: {
          left: 'title',
          right: 'prev, next',
          //right: 'month,basicWeek,basicDay'
        },
        editable: true,
        events: [
          {
            title: 'All Day Event',
            start: new Date(y, m, 1)
          },
          {
            title: 'Long Event',
            start: new Date(y, m, d - 5),
            end: new Date(y, m, d - 2)
          },
          {
            title: 'Repeat Event',
            start: new Date(y, m, 3),
            allDay: false
          },
          {
            title: 'Repeat Event',
            start: new Date(y, m, 4),
            allDay: false
          }
        ]
      });
    }

  })();

  /* --------------------------------------------------------
   RSS Feed widget
   -----------------------------------------------------------*/
  (function () {
    if ($('#news-feed')[0]) {
      $('#news-feed').FeedEk({
        FeedUrl: 'http://rss.cnn.com/rss/edition.rss',
        MaxCount: 5,
        ShowDesc: false,
        ShowPubDate: true,
        DescCharacterLimit: 0
      });
    }
  })();

  /* --------------------------------------------------------
   Chat
   -----------------------------------------------------------*/
  $(function () {
    $('body').on('click touchstart', '.chat-list-toggle', function () {
      $(this).closest('.chat').find('.chat-list').toggleClass('toggled');
    });

    $('body').on('click touchstart', '.chat .chat-header .btn', function (e) {
      e.preventDefault();
      $('.chat .chat-list').removeClass('toggled');
      $(this).closest('.chat').toggleClass('toggled');
    });

    $(document).on('mouseup touchstart', function (e) {
      var container = $('.chat, .chat .chat-list');
      if (container.has(e.target).length === 0) {
        container.removeClass('toggled');
      }
    });
  });

  /* --------------------------------------------------------
   Form Validation
   -----------------------------------------------------------*/
  (function () {
    if ($("[class*='form-validation']")[0]) {
      $("[class*='form-validation']").validationEngine();

      //Clear Prompt
      $('body').on('click', '.validation-clear', function (e) {
        e.preventDefault();
        $(this).closest('form').validationEngine('hide');
      });
    }
  })();

  /* --------------------------------------------------------
   `Color Picker
   -----------------------------------------------------------*/
  (function () {
    //Default - hex
    if ($('.color-picker')[0]) {
      $('.color-picker').colorpicker();
    }

    //RGB
    if ($('.color-picker-rgb')[0]) {
      $('.color-picker-rgb').colorpicker({
        format: 'rgb'
      });
    }

    //RGBA
    if ($('.color-picker-rgba')[0]) {
      $('.color-picker-rgba').colorpicker({
        format: 'rgba'
      });
    }

    //Output Color
    if ($('[class*="color-picker"]')[0]) {
      $('[class*="color-picker"]').colorpicker().on('changeColor', function (e) {
        var colorThis = $(this).val();
        $(this).closest('.color-pick').find('.color-preview').css('background', e.color.toHex());
      });
    }
  })();

  /* --------------------------------------------------------
   Date Time Picker
   -----------------------------------------------------------*/
  (function () {
    //Date Only
    if ($('.date-only')[0]) {
      $('.date-only').datetimepicker({
        pickTime: false
      });
    }

    //Time only
    if ($('.time-only')[0]) {
      $('.time-only').datetimepicker({
        pickDate: false
      });
    }

    //12 Hour Time
    if ($('.time-only-12')[0]) {
      $('.time-only-12').datetimepicker({
        pickDate: false,
        pick12HourFormat: true
      });
    }

    $('.datetime-pick input:text').on('click', function () {
      $(this).closest('.datetime-pick').find('.add-on i').click();
    });
  })();

  /* --------------------------------------------------------
   Input Slider
   -----------------------------------------------------------*/
  (function () {
    if ($('.input-slider')[0]) {
      $('.input-slider').slider().on('slide', function (ev) {
        $(this).closest('.slider-container').find('.slider-value').val(ev.value);
      });
    }
  })();

  /* --------------------------------------------------------
   WYSIWYE Editor + Markedown
   -----------------------------------------------------------*/
  (function () {
    //Markedown
    if ($('.markdown-editor')[0]) {
      $('.markdown-editor').markdown({
        autofocus: false,
        savable: false
      });
    }

    //WYSIWYE Editor
    if ($('.wysiwye-editor')[0]) {
      $('.wysiwye-editor').summernote({
        height: 200
      });
    }

  })();

  /* --------------------------------------------------------
   Media Player
   -----------------------------------------------------------*/
  (function () {
    if ($('audio, video')[0]) {
      $('audio,video').mediaelementplayer({
        success: function (player, node) {
          $('#' + node.id + '-mode').html('mode: ' + player.pluginType);
        }
      });
    }
  })();

  /* ---------------------------
   Image Popup [Pirobox]
   --------------------------- */
  (function () {
    if ($('.pirobox_gall')[0]) {
      //Fix IE
      jQuery.browser = {};
      (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
          jQuery.browser.msie = true;
          jQuery.browser.version = RegExp.$1;
        }
      })();

      //Lightbox
      $().piroBox_ext({
        piro_speed: 700,
        bg_alpha: 0.5,
        piro_scroll: true // pirobox always positioned at the center of the page
      });
    }
  })();

  /* ---------------------------
   Vertical tab
   --------------------------- */
  (function () {
    $('.tab-vertical').each(function () {
      var tabHeight = $(this).outerHeight();
      var tabContentHeight = $(this).closest('.tab-container').find('.tab-content').outerHeight();

      if ((tabContentHeight) > (tabHeight)) {
        $(this).height(tabContentHeight);
      }
    })

    $('body').on('click touchstart', '.tab-vertical li', function () {
      var tabVertical = $(this).closest('.tab-vertical');
      tabVertical.height('auto');

      var tabHeight = tabVertical.outerHeight();
      var tabContentHeight = $(this).closest('.tab-container').find('.tab-content').outerHeight();

      if ((tabContentHeight) > (tabHeight)) {
        tabVertical.height(tabContentHeight);
      }
    });


  })();

  /* --------------------------------------------------------
   Login + Sign up
   -----------------------------------------------------------*/
  (function () {
    $('body').on('click touchstart', '.box-switcher', function (e) {
      e.preventDefault();
      var box = $(this).attr('data-switch');
      $(this).closest('.box').toggleClass('active');
      $('#' + box).closest('.box').addClass('active');
    });
  })();



  /* --------------------------------------------------------
   Checkbox + Radio
   -----------------------------------------------------------*/
  if ($('input:checkbox, input:radio')[0]) {

    //Checkbox + Radio skin
    $('input:checkbox:not([data-toggle="buttons"] input, .make-switch input), input:radio:not([data-toggle="buttons"] input)').iCheck({
      checkboxClass: 'icheckbox_minimal',
      radioClass: 'iradio_minimal',
      increaseArea: '20%' // optional
    });

    //Checkbox listing
    var parentCheck = $('.list-parent-check');
    var listCheck = $('.list-check');

    parentCheck.on('ifChecked', function () {
      $(this).closest('.list-container').find('.list-check').iCheck('check');
    });

    parentCheck.on('ifClicked', function () {
      $(this).closest('.list-container').find('.list-check').iCheck('uncheck');
    });

    listCheck.on('ifChecked', function () {
      var parent = $(this).closest('.list-container').find('.list-parent-check');
      var thisCheck = $(this).closest('.list-container').find('.list-check');
      var thisChecked = $(this).closest('.list-container').find('.list-check:checked');

      if (thisCheck.length == thisChecked.length) {
        parent.iCheck('check');
      }
    });

    listCheck.on('ifUnchecked', function () {
      var parent = $(this).closest('.list-container').find('.list-parent-check');
      parent.iCheck('uncheck');
    });

    listCheck.on('ifChanged', function () {
      var thisChecked = $(this).closest('.list-container').find('.list-check:checked');
      var showon = $(this).closest('.list-container').find('.show-on');
      if (thisChecked.length > 0) {
        showon.show();
      } else {
        showon.hide();
      }
    });
  }

  /* --------------------------------------------------------
   MAC Hack 
   -----------------------------------------------------------*/
  (function () {
    //Mac only
    if (navigator.userAgent.indexOf('Mac') > 0) {
      $('body').addClass('mac-os');
    }
  })();

  /* --------------------------------------------------------
   Photo Gallery
   -----------------------------------------------------------*/
  (function () {
    if ($('.photo-gallery')[0]) {
      $('.photo-gallery').SuperBox();
    }
  })();

});

$(window).load(function () {
  /* --------------------------------------------------------
   Tooltips
   -----------------------------------------------------------*/
  (function () {
    if ($('.tooltips')[0]) {
      $('.tooltips').tooltip();
    }
  })();

  /* --------------------------------------------------------
   Animate numbers
   -----------------------------------------------------------*/
  $('.quick-stats').each(function () {
    var target = $(this).find('h2');
    var toAnimate = $(this).find('h2').attr('data-value');
    // Animate the element's value from x to y:
    $({someValue: 0}).animate({someValue: toAnimate}, {
      duration: 1000,
      easing: 'swing', // can be anything
      step: function () { // called on every step
        // Update the element's text with rounded-up value:
        target.text(commaSeparateNumber(Math.round(this.someValue)));
      }
    });

    function commaSeparateNumber(val) {
      while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
      }
      return val;
    }
  });


  /* --------------------------------------------------------
   Init Search Options
   -----------------------------------------------------------*/
  {
    //console.log(searchFilters);
    try {
      var f = document.frmSearchFilter;
      f.start_date.value = searchFilters.start_date;
      f.end_date.value = searchFilters.end_date;
      f.task_type.value = searchFilters.task_type;
      $('#task_type').selectpicker('refresh');
      f.budget.value = searchFilters.budget;
      if (searchFilters.skills && searchFilters.skills.length > 0) {
        $("#skills").val(searchFilters.skills.split(","));
      }

      f.client_paymented.value = searchFilters.client_paymented;
      $('#client_paymented').selectpicker('refresh');
      if (searchFilters.client_ranking && searchFilters.client_ranking.length > 0) {
        $("#client_ranking").slider('setValue', searchFilters.client_ranking.split(","));
      }
      f.client_total_spent.value = searchFilters.client_total_spent;
      f.client_avg_hourly.value = searchFilters.client_avg_hourly;
      if (searchFilters.client_countries && searchFilters.client_countries.length > 0) {
        $("#client_countries").val(searchFilters.client_countries.split(","));
      }
    } catch (e) {
      console.log(e);
    }
  }

  if ($("#client_countries").length) {
	  $("#client_countries").chosen({
		max_selected_options: 5
	  });
  }

  if ($("#skills").length) {
	  $("#skills").chosen({
		max_selected_options: 10
	  });
  }

  $("#btnSearchFilter").click(function () {
    research();
  });
  
  {
    $('#task_type').change(function() {
      research();
    });
    
    $('#client_paymented').change(function() {
      research();
    });
    
    $('#client_total_spent').change(function() {
      research();
    });
    
    $('#client_avg_hourly').change(function() {
      research();
    });
  }


  if ($('#web-task-alam')[0]) {
    get_new_tasks();

    setInterval(function () {
      get_new_tasks();
    }, 300 * 1000);
  }

  if ($('#web-task-chart').length) {
    drawLast24TaskChart('web-task-chart', 'web');

//    setInterval(function () {
//      drawLast24TaskChart('web-task-chart', 'web');
//    }, 300 * 1000);
  }

  if ($('#mobile-task-chart').length) {
    drawLast24TaskChart('mobile-task-chart', 'mobile');

//    setInterval(function () {
//      drawLast24TaskChart('mobile-task-chart', 'mobile');
//    }, 300 * 1000);
  }

  //World Map
  if ($('#world-map').length) {
    drawWoldMap();
  }

  // Avg Budget
  if ($("#mobile-avg-budget").length) {
    //getAvgBudget();
  }

  // Freelancer Chart
  if ($("#freelancer-chart").length) {
    drawFreelancerChart("day");
  }
});

/* --------------------------------------------------------
 Date Time Widget
 -----------------------------------------------------------*/
(function () {
  var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

  // Create a newDate() object
  var newDate = new Date();

  // Extract the current date from Date object
  newDate.setDate(newDate.getDate());

  // Output the day, date, month and year
  $('#date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

  setInterval(function () {
    $("#time").html("UTC+8: " + moment().tz(js_options.timezone).format('h:mm:ss a'));
  }, 1000);
})();