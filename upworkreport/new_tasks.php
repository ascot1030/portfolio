<?php
$_page = "new_tasks";
$new_messages = false;
include_once 'header.php';
?>

<hr class="whiter m-t-20 m-b-20">

<div class="block-area">
  <div class="tile">
    <h2 class="tile-title">Web Tasks<span id="web-count-info" class="pull-right" style="margin-right: 30px;"></span></h2>
    <div class="tile-config dropdown">
      <a data-toggle="dropdown" href="" class="tooltips tile-menu" title="Options"></a>
      <ul class="dropdown-menu animated pull-right text-right">
        <li><a href="javascript: drawLast24TaskChart('web-task-chart', 'web');"><i class="fa fa-refresh pull-left"></i> Refresh</a></li>
      </ul>
    </div>
    <div class="p-10">
      <div id="web-task-chart" class="main-chart" style="height: 250px"></div>
    </div>
  </div>

  <div class="tile">
    <h2 class="tile-title">Mobile Tasks<span id="mobile-count-info" class="pull-right" style="margin-right: 30px;"></span></h2>
    <div class="tile-config dropdown">
      <a data-toggle="dropdown" href="" class="tooltips tile-menu" title="Options"></a>
      <ul class="dropdown-menu animated pull-right text-right">
        <li><a href="javascript: drawLast24TaskChart('mobile-task-chart', 'mobile');"><i class="fa fa-refresh pull-left"></i> Refresh</a></li>
      </ul>
    </div>
    <div class="p-10">
      <div id="mobile-task-chart" class="main-chart" style="height: 250px"></div>
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

<!-- Moment -->
<script src="js/json/json2.js"></script>


<!-- Moment -->
<script src="js/moment.min.js"></script>
<script src="js/moment-timezone-with-data-2012-2022.js"></script>

<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>

<!--  Form Related -->
<script src="js/validation/validate.min.js"></script> <!-- jQuery Form Validation Library -->
<script src="js/validation/validationEngine.min.js"></script> <!-- jQuery Form Validation Library - requirred with above js -->
<script src="js/select.min.js"></script> <!-- Custom Select -->
<script src="js/chosen.min.js"></script> <!-- Custom Multi Select -->
<script src="js/datetimepicker.min.js"></script> <!-- Date & Time Picker -->
<script src="js/colorpicker.min.js"></script> <!-- Color Picker -->
<script src="js/icheck.js"></script> <!-- Custom Checkbox + Radio -->
<script src="js/autosize.min.js"></script> <!-- Textare autosize -->
<script src="js/toggler.min.js"></script> <!-- Toggler -->
<script src="js/input-mask.min.js"></script> <!-- Input Mask -->
<script src="js/spinner.min.js"></script> <!-- Spinner -->
<script src="js/slider.min.js"></script> <!-- Input Slider -->
<script src="js/fileupload.min.js"></script> <!-- File Upload -->

<!-- Text Editor -->
<script src="js/editor.min.js"></script> <!-- WYSIWYG Editor -->
<script src="js/markdown.min.js"></script> <!-- Markdown Editor -->

<!-- ECharts -->
<script src="js/echarts/echarts.min.js"></script>

<!-- UX -->
<script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="js/calendar.min.js"></script> <!-- Calendar -->
<script src="js/feeds.min.js"></script> <!-- News Feeds -->

<script>
  $(function () {
    //$("#client_total_spent").spinedit('setMinimum', 0);
    $("#client_avg_hourly").spinedit('setMinimum', 0);
  });
</script>


<!-- All JS functions -->
<script src="js/charts.js?v=1"></script>
<script src="js/news.js"></script>

<?php include_once 'footer.php'; ?>
