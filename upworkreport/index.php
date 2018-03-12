<?php
$_page = "world";

// jVectorMap
$ext_css = array("js/maps/jquery-jvectormap-2.0.3.css");

include_once 'header1.php';
?>

<div class="block-area" style="margin-top: 20px;">
  <div class="tile">
    <div style="width: 100px; margin-left: 2px;" class="pull-left">
      <select id="count_map_type" class="select" onchange="drawWoldMap()">
        <option value="freelancer">Freelancer</option> 
        <option value="task">Task</option> 
      </select>
    </div>
    <div style="width: 170px; margin-left: 2px;" class="pull-left" id="freelancer-count-type">
      <select id="freelancer_coun_type" class="select" onchange="drawWoldMap()">
        <option value="total">Total</option> 
        <option value="web">Web Development</option> 
        <option value="mobile">Mobile Development</option> 
      </select>
    </div>
    <h2 class="tile-title">World Map</h2>
    <div class="tile-config dropdown">
      <a data-toggle="dropdown" href="" class="tooltips tile-menu" title="Options"></a>
      <ul class="dropdown-menu animated pull-right text-right">
        <li><a href="javascript:drawWoldMap()">Refresh</a></li>
      </ul>
    </div>

    <div id="world-map" style="height: 700px"></div>
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

<script src="js/select.min.js"></script> <!-- Custom Select -->

<!-- Map -->
<!--script src="js/maps/jvectormap.min.js"></script> <!-- jVectorMap main library -->
<!--script src="js/maps/world.js"></script> <!-- World Map for jVectorMap -->

<!-- jVectorMap -->
<script src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
<script src="js/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- UX -->
<script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

<!-- Other -->
<script src="js/calendar.min.js"></script> <!-- Calendar -->

<!-- All JS functions -->
<script src="js/charts.js?v=1"></script>

<?php include_once 'footer.php'; ?>
