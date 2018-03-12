<?php
$_page = "freelancers";

include_once 'header1.php';
?>

<div class="block-area m-t-20">
  <div class="tile">
    <h2 class="tile-title">
      Task report by hours
    </h2>
    <div class="p-10">
      <div id="tast-report-by-hours-chart" class="main-chart" style="height: 500px"></div>
    </div>
  </div>
</div>

<br/><br/><br/>
</section>
</section>

<!-- Javascript Libraries -->
<!-- jQuery -->
<script src="js/jquery.min.js"></script> <!-- jQuery Library -->
<script src="js/jquery-ui.min.js"></script> <!-- jQuery UI -->
<script src="js/jquery.easing.1.3.js"></script> <!-- jQuery Easing - Requirred for Lightbox -->
<script src="js/jquery.cookie.js"></script> <!-- jQuery Cookie Plugin -->
<script src="js/jquery.number.min.js"></script> <!-- jQuery Number Plugin -->
<script src="js/datetimepicker.min.js"></script> <!-- Date & Time Picker -->

<!-- Moment -->
<script src="js/json/json2.js"></script>


<!-- Moment -->
<script src="js/moment.min.js"></script>
<script src="js/moment-timezone-with-data-2012-2022.js"></script>

<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>

<script src="js/select.min.js"></script> <!-- Custom Select -->

<!-- ECharts -->
<script src="js/echarts/echarts.min.js"></script>

<!-- UX -->
<script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="js/calendar.min.js"></script> <!-- Calendar -->

<script>
  $(function () {
    var post_data = $.extend(searchFilters, {
      action: 'report_hours'
    });
    $.post("ajax.php", post_data, function (chart_data) {
//      var colors = ['rgba(255, 255, 255, 1)', 'rgba(38,185,154, 0.8)', 'rgba(155,89,182, 0.8)'];
      var colors = ['rgba(38,185,154, 0.8)', 'rgba(155,89,182, 0.8)'];
      var chart = echarts.init(document.getElementById("tast-report-by-hours-chart"), {color: colors});

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

            var data = chart_data.hours[params[0].dataIndex] + "<br />";
            for (var i = 0; i < params.length; i++) {
              data += '<span style="display:inline-block;margin-right:5px;border-radius:10px;width:9px;height:9px;background-color:' + params[i].color + '"></span> ';
              data += params[i].seriesName + ": " + $.number(params[i].value) + "<br/>";
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
            data: chart_data.hours,
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
//          {name: labels[0], data: chart_data.all, smooth: false, type: 'line'},
          {name: labels[1], data: chart_data.web, smooth: false, type: 'line'},
          {name: labels[2], data: chart_data.mobile, smooth: false, type: 'line'}
        ]
      });

      $(window).on('resize', function () {
        if (chart != null && chart != undefined) {
          chart.resize();
        }
      });
    }, 'json');
  });
</script>
<?php include_once 'footer.php'; ?>
