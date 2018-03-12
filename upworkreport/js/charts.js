/* --------------------------------------------------------
 Flot Charts
 -----------------------------------------------------------*/
function drawLast24TaskChart(element, category) {
  var post_data = $.extend(searchFilters, {
    action: 'get_last_24_tasks',
    category: category
  });

  $.post("ajax.php", post_data, function (result) {
    var chart_data = result[0];
    var sum_data = result[1];

    $('#' + element).empty();

    var colors = ['rgba(255, 255, 255, 1)', 'rgba(38,185,154, 0.8)', 'rgba(52,73,94, 0.8)', 'rgba(155,89,182, 0.8)', 'rgba(52,152,219, 0.8)'];
    chart = echarts.init(document.getElementById(element), {color: colors});

    var labels = [
      'All(' + sum_data.all_tasks + ')',
      'Paymented(' + sum_data.paymented_tasks + ')',
      'Non Paymented(' + sum_data.non_paymented_tasks + ')',
      'Hourly(' + sum_data.hourly_tasks + ')',
      'Fixed(' + sum_data.fixed_tasks + ')'
    ];

    chart.setOption({
      grid: {x: 30, x2: 10, y: 35, y2: 30},
      title: {show: false},
      tooltip: {trigger: 'axis'},
      legend: {x: 'left', y: 'top', data: labels, backgroundColor: "rgba(255,255,255,1)"},
      toolbox: {
        show: true,
        feature: {magicType: {show: true, type: ['line', 'bar']}}
      },
      calculable: true,
      xAxis: [{type: 'category', boundaryGap: true, data: chart_data.hours, axisLabel: {textStyle: {color: "rgba(255,255,255,0.8)"}}}],
      yAxis: [{type: 'value', axisLabel: {textStyle: {color: "rgba(255,255,255,0.8)"}}}],
      series: [
        {name: labels[0], data: chart_data.all_tasks, smooth: true, type: 'line', itemStyle: {normal: {areaStyle: {type: 'default', color: "rgba(255, 255, 255, 0.25)"}}}},
        {name: labels[1], data: chart_data.paymented_tasks, smooth: true, type: 'line', itemStyle: {normal: {areaStyle: {type: 'default', color: "rgba(38,185,154,0.25)"}}}},
        {name: labels[2], data: chart_data.non_paymented_tasks, smooth: true, type: 'line', itemStyle: {normal: {areaStyle: {type: 'default', color: "rgba(52,73,94,0.25)"}}}},
        {name: labels[3], data: chart_data.hourly_tasks, smooth: true, type: 'line', itemStyle: {normal: {areaStyle: {type: 'default', color: "rgba(155,89,182,0.25)"}}}},
        {name: labels[4], data: chart_data.fixed_tasks, smooth: true, type: 'line', itemStyle: {normal: {areaStyle: {type: 'default', color: "rgba(52,152,219,0.25)"}}}}
      ]
    });

    $(window).on('resize', function () {
      if (chart != null && chart != undefined) {
        chart.resize();
      }
    });
  }, 'json');
}

function drawFreelancerChart(type) {
  var element = "freelancer-chart";
  var post_data = {
    action: 'get_freelancer_count',
    type: type,
    country: $("#freelancer_country").val(),
    start_date: $("#start_date").val(),
    end_date: $("#end_date").val()
  };

  $.post("ajax.php", post_data, function (chart_data) {
    if ($("#freelancer_country").val() === 'all') {
      getCountriesFreelancers(type);
    }
    
    $('#' + element).empty();

    var colors = ['rgba(255, 255, 255, 1)', 'rgba(38,185,154, 0.8)', 'rgba(155,89,182, 0.8)'];
    chart = echarts.init(document.getElementById(element), {color: colors});
    $(window).on('resize', function () {
      if (chart != null && chart != undefined) {
        chart.resize();
      }
    });
    
    var labels = [
      'All',
      'Web Development',
      'Mobile Development'
    ];

    chart.setOption({
      grid: {x: 70, x2: 10, y: 35, y2: 30},
      title: {show: false},
      tooltip: {
        trigger: 'axis',
        formatter: function (params) {
          
          if (params[0].value == 0)
            return '';

          var date_string = chart_data.date_string[params[0].dataIndex];
          
          var data = "";
          if (date_string.indexOf('Sun') > 0) {
            data = '<span style="color:red">' + date_string + '</span>';
          } else {
            data = date_string;
          }
          data += "<br />";
          for (var i = 0; i < params.length; i++) {
            data += '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + params[i].color + '"></span> ';
            data += params[i].seriesName + ": " + $.number(chart_data.mins[params[i].seriesIndex] * 1 + params[i].value) + "<br/>";
          }

          return data;
        }
      },
      legend: {x: 'left', y: 'top', data: labels, backgroundColor: "rgba(255,255,255,1)"},
      toolbox: {
        show: true,
        feature: {magicType: {show: true, type: ['line', 'bar']}}
      },
      calculable: true,
      xAxis: [
        {
          type: 'category', 
          splitLine: {show: false}, 
          boundaryGap: true, 
          data: chart_data.date, 
          axisLabel: {
            textStyle: {color: "rgba(255,255,255,0.8)"}
          }
        }
      ],
      yAxis: [
        {
          type: 'value', 
          axisLabel: {
            textStyle: {color: "rgba(255,255,255,0.8)"}
          }
        }
      ],
      series: [
        {name: labels[0], data: chart_data.all, smooth: false, type: 'line'},
        {name: labels[1], data: chart_data.web, smooth: false, type: 'line'},
        {name: labels[2], data: chart_data.mobile, smooth: false, type: 'line'}
      ]
    });
  }, 'json');
}

var $tableFreelancers = null;

function getCountriesFreelancers() {
  $("#start_date_text").text($("#start_date").val());
  $("#end_date_text").text($("#end_date").val());
  
  if ($tableFreelancers) {
    $tableFreelancers.ajax.reload(function () {
    }, false);
  } else {
    $tableFreelancers = $('#countries-freelancers').DataTable({
      columns: [
        {"data": "country"},
        {"data": "start_total_count", className: "text-right"},
        {"data": "start_web_count", className: "text-right"},
        {"data": "start_mobile_count", className: "text-right"},
        {"data": "end_total_count", className: "text-right"},
        {"data": "end_web_count", className: "text-right"},
        {"data": "end_mobile_count", className: "text-right"},
        {"data": "changed_total_count", className: "text-right"},
        {"data": "changed_web_count", className: "text-right"},
        {"data": "changed_mobile_count", className: "text-right"},
        {"data": "changed_total_percent", className: "text-right"},
        {"data": "changed_web_percent", className: "text-right"},
        {"data": "changed_mobile_percent", className: "text-right"}
      ],
      order: [[7, "desc"]],
      processing: true,
      serverSide: false,
      "scrollY": 500 + "px",
      "scrollX": true,
      "scrollCollapse": true,
      "searching": true,
      ajax: {
        url: "ajax.php",
        type: 'POST',
        data: function (d) {
          return $.extend(searchFilters, d, {
            action: 'get_countries_freelancers',
            start_date: $("#start_date").val(),
            end_date: $("#end_date").val()
          });
        }
      },
      responsive: true,
      filter: false,
      bPaginate: false
    });
  }
}

function drawWoldMap() {
  var map_type = $("#count_map_type").val();
  if (map_type == 'freelancer') {
    $("#freelancer-count-type").show();
  } else {
    $("#freelancer-count-type").hide();
  }
  
  $.post("ajax.php", {
    action: "get_world_count",
    type: map_type,
    f_type: $("#freelancer_coun_type").val(),
  }, function (result) {
    $('#world-map').html("");

    var countries = result[0];
    var codeData = result[1];

    /*var makers = [];
     var min_count = -1;
     var max_count = 0;
     for(var i = 0; i < result.length; i ++) {
     if (result[i].latitude == 0) {
     continue;
     }
     
     makers.push( {latLng: [result[i].latitude, result[i].longitude], name: result[i].country + " - " + result[i].task_count} );
     
     if (min_count == -1 || min_count > result[i].task_count) {
     min_count = result[i].task_count;
     }
     
     if (max_count < result[i].task_count) {
     max_count = result[i].task_count;
     }
     
     
     //countryData = $.extend( countryData, { result[i].code : result[i].task_count } );
     }*/

    $('#world-map').vectorMap({
      /*map: 'world_mill_en',
       backgroundColor: 'rgba(0,0,0,0)',
       series: {
       markers: [{
       attribute: 'fill',
       scale: ['#FEE5D9', '#A50F15'],
       values: max_count,
       min: min_count,
       max: max_count
       }, {
       attribute: 'r',
       scale: [5, 20],
       values: max_count,
       min: min_count,
       max: max_count
       }],
       regions: [{
       scale: ['#C8EEFF', '#0071A4'],
       normalizeFunction: 'polynomial'
       }]
       },
       regionStyle: {
       initial: {
       fill: 'rgba(255,2552,255,0.7)'
       },
       hover: {
       fill: '#fff'
       },
       },
       markerStyle: {
       initial: {
       fill: '#e80000',
       stroke: 'rgba(0,0,0,0.4)',
       "fill-opacity": 2,
       "stroke-width": 7,
       "stroke-opacity": 0.5,
       r: 4
       },
       hover: {
       stroke: 'black',
       "stroke-width": 2,
       },
       selected: {
       fill: 'blue'
       },
       selectedHover: {
       }
       },
       markers : makers,*/

      map: 'world_mill_en',
      backgroundColor: 'transparent',
      zoomOnScroll: false,
      series: {
        regions: [{
            values: codeData,
            scale: ['#FEE5D9', '#A50F15'],
            normalizeFunction: 'polynomial'
          }]
      },
      onRegionTipShow: function (e, el, code) {
        if (codeData[code]) {
          el.html(el.html() + ' (Count - ' + $.number(codeData[code]) + ')');
          /*$.post("ajax.php", {
            "action": "get_freelancer_detail_count",
            "code" : code
          }, function() {
            el.html(el.html() + ' (Count - ' + $.number(codeData[code]) + ')');
          }, 'json');*/
        } else {

        }
      }
    });
  }, 'json');
}


/* --------------------------------------------------------
 Map
 -----------------------------------------------------------*/
$(function () {
  //USA Map
  /*if($('#usa-map')[0]) {
   $('#usa-map').vectorMap({
   map: 'us_aea_en',
   backgroundColor: 'rgba(0,0,0,0.25)',
   regionStyle: {
   initial: {
   fill: 'rgba(255,2552,255,0.7)'
   },
   hover: {
   fill: '#fff'
   },
   },
   
   zoomMin:0.88,
   focusOn:{
   x: 5,
   y: 1,
   scale: 1.8
   },
   markerStyle: {
   initial: {
   fill: '#e80000',
   stroke: 'rgba(0,0,0,0.4)',
   "fill-opacity": 2,
   "stroke-width": 7,
   "stroke-opacity": 0.5,
   r: 4
   },
   hover: {
   stroke: 'black',
   "stroke-width": 2,
   },
   selected: {
   fill: 'blue'
   },
   selectedHover: {
   }
   },
   zoomOnScroll: false,
   
   markers :[
   {latLng: [33, -86], name: 'Sample Name 1'},
   {latLng: [33.7, -93], name: 'Sample Name 2'},
   {latLng: [36, -79], name: 'Sample Name 3'},
   {latLng: [29, -99], name: 'Sample Name 4'},
   {latLng: [33, -95], name: 'Sample Name 4'},
   {latLng: [31, -92], name: 'Liechtenstein'},
   ],
   });
   }*/
});