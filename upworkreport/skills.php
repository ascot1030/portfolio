<?php
$_page = "skills";

include_once 'header1.php';
?>

<div class="block-area">
  <h3 class="block-title">Best Skills in Last Month</h3>

  <!-- Easy Pie charts -->
  <div class="tile text-center">
    <div class="tile-dark p-10">
      <?php
      $_date = my_add_date(-30, false, 'Y-m-d 00:00:00');
      $web_task_count = $wpdb->get_var("select count(*) from upwork_tasks where category='web'");
      $sql = "select distinct s.*, count(t.`task_id`) skill_count from skills s join upwork_task_skills t on s.`id` = t.skill_id where t.task_id in (select `id` from upwork_tasks where category='web' and pubdate >= '{$_date}') group by s.`id` order by skill_count desc limit 26";
      $web_skills = $wpdb->get_results($sql);
      ?>
      <?php foreach ($web_skills as $skill): ?>
        <?php
        $percent = round($skill->skill_count * 100 / $web_task_count, 2);
        ?>
        <div class="pie-chart-tiny" data-percent="<?php echo $percent; ?>">
          <span class="percent"></span>
          <span class="pie-title"><?php echo $skill->skill; ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="tile-dark p-10">
      <?php
      $mobile_task_count = $wpdb->get_var("select count(*) from upwork_tasks where category='mobile'");
      $sql = "select distinct s.*, count(t.`task_id`) skill_count from skills s join upwork_task_skills t on s.`id` = t.skill_id where t.task_id in (select `id` from upwork_tasks where category='mobile' and pubdate >= '{$_date}') group by s.`id` order by skill_count desc limit 26";
      $mobile_skills = $wpdb->get_results($sql);
      ?>
      <?php foreach ($mobile_skills as $skill): ?>
        <?php
        $percent = round($skill->skill_count * 100 / $mobile_task_count, 2);
        ?>
        <div class="pie-chart-tiny" data-percent="<?php echo $percent; ?>">
          <span class="percent"></span>
          <span class="pie-title"><?php echo $skill->skill; ?></span>
        </div>
      <?php endforeach; ?>
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

<!-- Charts -->
<script src="js/sparkline.min.js"></script> <!-- Sparkline - Tiny charts -->
<script src="js/easypiechart.js"></script> <!-- EasyPieChart - Animated Pie Charts -->

<!-- UX -->
<script src="js/scroll.min.js"></script> <!-- Custom Scrollbar -->

<script src="js/calendar.min.js"></script> <!-- Calendar -->

<script>
/* --------------------------------------------------------
 Easy Pie Charts
 -----------------------------------------------------------*/
$(function () {
  $('.pie-chart-tiny').easyPieChart({
    easing: 'easeOutBounce',
    barColor: 'rgba(255,255,255,0.75)',
    trackColor: 'rgba(0,0,0,0.3)',
    scaleColor: 'rgba(255,255,255,0.3)',
    lineCap: 'square',
    lineWidth: 4,
    size: 100,
    animate: 3000,
    onStep: function (from, to, percent) {
      $(this.el).find('.percent').text(Math.round(percent));
    }
  });
});
</script>

<?php include_once 'footer.php'; ?>