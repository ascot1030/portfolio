<?php
$_page = "task";

$new_messages = false;

include_once 'header.php'
?>

<style>
  .dataTables_length select[name='table-tasks_length'] {
    width: 70px;
  }

  .task-description {
    border-top: 1px solid #ccc;
    display: none;
    margin-top: 10px;
    padding-top: 10px;
  }

  .dataTables_paginate .pagination li.paginate_button a {
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.31) !important;
  }
  
  .dataTables_paginate .pagination li.paginate_button.disabled a {
    color: #333;
  }
  
  .dataTables_paginate .pagination li.paginate_button.active a {
    background: rgba(0, 0, 0, 0.75);
    border: 1px solid rgba(255, 255, 255, 0.31) !important;
  }
</style>

<h4 class="page-title">
  Tasks
  <div style="width: 80px; margin: -8px 10px 0 0;" class="pull-left">
    <select id='category' class="select" onchange="reloadTaskTable()">
      <option value='all'>All</option>
      <option value='web'>Web</option>
      <option value='mobile'>Mobile</option>
    </select>
  </div>
</h4>

<div class="block-area m-b-20" id="defaultStyle">
  <table id="table-tasks" class="table table-striped table-bordered" width="100%">
    <thead>
      <tr>
        <th class="nosort" width='50'>Category:</th>
        <th class="nosort" width='100'>Pubdate:</th>
        <th class="nosort" width='50'>Type:</th>
        <th class="nosort" width='100'>Budget:</th>
        <th class="nosort" width='150'>Client:</th>
        <th class="nosort">Title:</th>
      </tr>
    </thead>
  </table>
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

<!-- DataTable -->
<script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.buttons.min.js"></script>
<script src="js/datatables/buttons.bootstrap.min.js"></script>
<script src="js/datatables/buttons.flash.min.js"></script>
<script src="js/datatables/buttons.html5.min.js"></script>
<script src="js/datatables/buttons.print.min.js"></script>
<script src="js/datatables/dataTables.fixedColumns.min.js"></script>
<script src="js/datatables/dataTables.fixedHeader.min.js"></script>
<script src="js/datatables/dataTables.keyTable.min.js"></script>
<script src="js/datatables/dataTables.responsive.min.js"></script>
<script src="js/datatables/responsive.bootstrap.min.js"></script>
<script src="js/datatables/dataTables.scroller.min.js"></script>
<script src="js/datatables/fnFilterClear.js"></script>

<!-- UX -->
<script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="js/calendar.min.js"></script> <!-- Calendar -->
<script src="js/feeds.min.js"></script> <!-- News Feeds -->
<script src="js/clipboard.min.js"></script> <!-- ClipBoard -->

<script>
  $(function () {
    //$("#client_total_spent").spinedit('setMinimum', 0);
    $("#client_avg_hourly").spinedit('setMinimum', 0);
  });
</script>


<script src="js/news.js"></script>
<script src="js/task.js"></script>

<?php include_once 'footer.php'; ?>
