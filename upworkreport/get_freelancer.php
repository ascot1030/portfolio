<?php
require_once 'include/auto_inc.php';

$current_date = date('Y-m-d');

if ($wpdb->get_var("select count(*) from upwork_freelancer_logs where log_date='{$current_date}' and country='all'") == 0) {
  get_freelancer_count_by_country('all');
}

$log_count = 0;
$countries = $wpdb->get_col("select `name` from upwork_countries");
foreach ($countries as $country) {
  if (!$country) {
    continue;
  }

  if ($wpdb->get_var("select count(*) from upwork_freelancer_logs where log_date='{$current_date}' and country='" . $country . "'") > 0) {
    continue;
  }

  $log_count ++;
  if ($log_count > 3) {
    break;
  }

  sleep(10);

  try {
    get_freelancer_count_by_country($country);
  } catch (Exception $e) {
    
  }
}
