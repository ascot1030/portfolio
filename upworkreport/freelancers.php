<?php
$_page = "freelancers";

include_once 'header1.php';

$countries = $wpdb->get_col("select `name` from upwork_countries order by `name`");

$start_date = my_add_date(-60, false, 'Y-m-d');
?>

<style>
  #countries-freelancers_wrapper .row:first-child .col-sm-6:first-child {
    display: none;
  }
  
  .dataTables_scrollHeadInner .table {
    margin-bottom: 0 !important;
  }
  
  #countries-freelancers tbody tr:hover td {
    background: rgba(255, 255, 255, 1) !important;
    color: #000 !important;
    text-shadow: 0 !important;
    font-weight: bold;
  }
</style>
<div class="block-area m-t-20">
  <div class="tile">
    <div style="width: 150px; margin-left: 2px;" class="pull-left">
      <select id="freelancer_country" name="freelancer_country" class="select" onchange="drawFreelancerChart('day')">
        <option value="all">-- World --</option> 
        <?php foreach ($countries as $country): if (!$country) continue; ?>
          <option value="<?php echo $country; ?>"><?php echo $country; ?></option> 
        <?php endforeach; ?>
      </select>
    </div>

    <div class="pull-left" style="width: 280px;">
      <label class="pull-left" style="margin-left: 10px; line-height: 30px;">Date:&nbsp;</label>
      <div class="input-icon datetime-pick date-only pull-left" style="width: 110px;">
        <input id="start_date" name="start_date" data-format="yyyy-MM-dd" type="text" class="form-control input-sm" value="<?php echo $start_date; ?>" />
        <span class="add-on">
          <i class="fa fa-calendar"></i>
        </span>
      </div>
      <label class="pull-left" style="line-height: 30px;">&nbsp;-&nbsp;</label>
      <div class="input-icon datetime-pick date-only pull-left" style="width: 110px;">
        <input id="end_date" name="end_date" data-format="yyyy-MM-dd" type="text" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>" />
        <span class="add-on">
          <i class="fa fa-calendar"></i>
        </span>
      </div>
    </div>

    <button class="btn btn-sm pull-left" style="margin-top: 2px;" onclick="drawFreelancerChart($('#freelancer_country').val())"><i class="fa fa-refresh"></i> Refresh</button>

    <h2 class="tile-title">
      Freelncer Count
    </h2>
    <div class="tile-config dropdown">
      <a data-toggle="dropdown" href="" class="tooltips tile-menu" title="Options"></a>
      <ul class="dropdown-menu animated pull-right text-right">
        <li><a href="javascript: drawFreelancerChart('date');"><i class="fa fa-refresh pull-left"></i> Date</a></li>
        <li><a href="javascript: drawFreelancerChart('month');"><i class="fa fa-refresh pull-left"></i> Month</a></li>
        <li><a href="javascript: drawFreelancerChart('year');"><i class="fa fa-refresh pull-left"></i> Year</a></li>
      </ul>
    </div>
    <div class="p-10">
      <div id="freelancer-chart" class="main-chart" style="height: 500px"></div>
    </div>
  </div>
</div>

<div>
  <div class="col-md-12">
    <div class="block-area m-b-20" id="defaultStyle">
      <table id="countries-freelancers" class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th rowspan="2">Country:</th>
            <th colspan="3" id="start_date_text" style="text-align: center;"></th>
            <th colspan="3" id="end_date_text" style="text-align: center;"></th>
            <th colspan="3" align="center" style="text-align: center;">Changed Count</th>
            <th colspan="3" align="center" style="text-align: center;">Changed Percent</th>
          </tr>
          <tr>
            <th>Total:</th>
            <th>Web:</th>
            <th>Mobile:</th>
            
            <th>Total:</th>
            <th>Web:</th>
            <th>Mobile:</th>
            
            <th>Total:</th>
            <th>Web:</th>
            <th>Mobile:</th>
            
            <th>Total:</th>
            <th>Web:</th>
            <th>Mobile:</th>
          </tr>
        </thead>
      </table>
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


<!-- All JS functions -->
<script src="js/charts.js?v=1.0"></script>

<?php include_once 'footer.php'; ?>
