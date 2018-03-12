<?php

require_once 'include/auto_inc.php';

$action = $_POST['action'];

function create_where($category) {
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];
  $task_type = $_POST["task_type"];
  $budget = $_POST["budget"];
  $skills = $_POST["skills"];
  $client_paymented = $_POST["client_paymented"];
  $client_ranking = $_POST["client_ranking"];
  $client_total_spent = $_POST["client_total_spent"];
  $client_avg_hourly = $_POST["client_avg_hourly"];
  $client_countries = $_POST["client_countries"];

  $where = "";
  if ($task_type && $task_type != 'all') {
    $where .= " and `type` = '{$task_type}'";
  }
  if ($budget) {
    $where .= " and (`type` = 'hourly' or `budget` >= '" . $budget . "')";
  }
  if ($client_paymented != 'all') {
    $where .= " and `is_paymented` = '{$client_paymented}'";
  }
  if ($client_ranking && $client_ranking != '0,5') {
    $client_ranking = explode(",", $client_ranking);
    $where .= " and (`client_ranking` between " . $client_ranking[0] . " and " . $client_ranking[1] . ")";
  }
  if ($client_total_spent) {
    $where .= " and `total_spent` >= '" . $client_total_spent . "'";
  }
  if ($client_avg_hourly) {
    $where .= " and `avg_hourly` > '" . $client_avg_hourly . "'";
  }
  if ($client_countries) {
    $client_countries = explode(",", $client_countries);
    $where .= " and (1=0";
    for ($c = 0; $c < count($client_countries); $c ++) {
      $where .= " OR `country` = '" . $client_countries[$c] . "'";
    }
    $where .= ")";
  }
  if ($skills) {
//		$skills = explode(",", $skills);
    $where .= " and (`id` in (select task_id from upwork_task_skills where skill_id in (" . $skills . ")))";
  }
  if ($category && $category != 'all') {
    $where .= " and category='" . $category . "'";
  }

  return $where;
}

if ($action == 'get_last_24_tasks') {
  $category = $_POST['category'];

  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];

  $now_day = date('Y-m-d');
  $next_day = my_add_date(1);
  $prev_day = my_add_date(-1);

  $sum_count = array(
      "all_tasks" => 0,
      "hours" => 0,
      "paymented_tasks" => 0,
      "non_paymented_tasks" => 0,
      "hourly_tasks" => 0,
      "fixed_tasks" => 0
  );

  $return = array(
      "all_tasks" => array(),
      "hours" => array(),
      "paymented_tasks" => array(),
      "non_paymented_tasks" => array(),
      "hourly_tasks" => array(),
      "fixed_tasks" => array()
  );

  $search_times = array();

  if ($start_date == $end_date) {
    if ($start_date == $now_day) {
      $h = date('G');
      for ($i = 23; $i >= 0; $i --) {
        $_h = $h - $i;
        if ($_h < 0) {
          $_h = 24 + $_h;
          $search_times[] = array($prev_day . " " . $_h . ":00:00", $prev_day . " " . $_h . ":59:59");
        } else {
          $search_times[] = array($now_day . " " . $_h . ":00:00", $now_day . " " . $_h . ":59:59");
        }
        $return["hours"][] = ($_h . '-' . ($_h + 1));
      }
    } else {
      for ($_h = 0; $_h < 24; $_h ++) {
        $search_times[] = array($start_date . " " . $_h . ":00:00", $start_date . " " . $_h . ":59:59");
        if ($_h == 0) {
          $return["hours"][] = my_formart_date($start_date, "j/M");
        } else {
          $return["hours"][] = ($_h . '-' . ($_h + 1));
        }
      }
    }
  } else {
    if ($start_date > $end_date) {
      $dd = $start_date;
      $start_date = $end_date;
      $end_date = $dd;
    }

    $dff = my_diff_days($start_date, $end_date);
    if ($dff <= 30) {
      $month = "";
      do {
        $search_times[] = array($start_date . " 00:00:00", $start_date . " 23:59:59");

        if ($month != substr($start_date, 0, 7)) {
          $return["hours"][] = my_formart_date($start_date, "j/M");
          $month = substr($start_date, 0, 7);
        } else {
          $return["hours"][] = my_formart_date($start_date, "j");
        }


        $start_date = my_add_date(1, $start_date);
      } while ($start_date <= $end_date);
    } else {
      $year = "";

      $start_year = substr($start_date, 0, 4);
      $start_month = substr($start_date, 5, 2);

      $end_year = substr($end_date, 0, 4);
      $end_month = substr($end_date, 5, 2);

      while ($start_year . $start_month <= $end_year . $end_month) {
        $search_times[] = array($start_year . "-" . $start_month . "-01 00:00:00", $start_year . "-" . $start_month . "-31 23:59:59");
        if ($year != $start_year) {
          $return["hours"][] = my_formart_date($start_year . "-" . $start_month . "-01", "M, Y");
          $year = $start_year;
        } else {
          $return["hours"][] = my_formart_date($start_year . "-" . $start_month . "-01", "M");
        }

        $start_month = $start_month * 1 + 1;
        if ($start_month == 13) {
          $start_year ++;
          $start_month = 1;
        }

        if ($start_month < 10) {
          $start_month = "0" . $start_month;
        }
      };
    }
  }

  $where = create_where($category);

  foreach ($search_times as $search_time) {
    $sql = "select count(`id`) as all_tasks,";
    $sql .= " sum(if(`type`='hourly', 1, 0)) as hourly_tasks,";
    $sql .= " sum(if(`type`='fixed', 1, 0)) as fixed_tasks,";
    $sql .= " sum(if(`is_paymented`=1, 1, 0)) as paymented_tasks,";
    $sql .= " sum(if(`is_paymented`=0, 1, 0)) as non_paymented_tasks";
    $sql .= " from upwork_tasks";
    $sql .= " where 1=1";
    $sql .= $where;
    $sql .= " and pubdate between '{$search_time[0]}' and '{$search_time[1]}'";

    $counts = $wpdb->get_row($sql);

    $return["all_tasks"][] = $counts->all_tasks;
    $return["hourly_tasks"][] = $counts->hourly_tasks * 1;
    $return["fixed_tasks"][] = $counts->fixed_tasks * 1;
    $return["paymented_tasks"][] = $counts->paymented_tasks * 1;
    $return["non_paymented_tasks"][] = $counts->non_paymented_tasks * 1;

    $sum_count["all_tasks"] = $sum_count["all_tasks"] + $counts->all_tasks;
    $sum_count["hourly_tasks"] = $sum_count["hourly_tasks"] + $counts->hourly_tasks * 1;
    $sum_count["fixed_tasks"] = $sum_count["fixed_tasks"] + $counts->fixed_tasks * 1;
    $sum_count["paymented_tasks"] = $sum_count["paymented_tasks"] + $counts->paymented_tasks * 1;
    $sum_count["non_paymented_tasks"] = $sum_count["non_paymented_tasks"] + $counts->non_paymented_tasks * 1;
  }

  header('Content-Type: application/json');
  echo json_encode(array($return, $sum_count));
} elseif ($action == 'get_world_count') {
  $type = $_POST['type'];

  $result = array();
  $codeData = array();

  $temp = $wpdb->get_results("select * from upwork_countries");
  $countries = array();
  foreach ($temp as $row) {
    $countries[$row->name] = $row;
  }
  
  if ($type == 'freelancer') {
    $f_type = $_POST['f_type'];

    $field = "totalFreelancers";
    if ($f_type == 'web') {
      $field = "web_development";
    } elseif ($f_type == 'mobile') {
      $field = "mobile_development";
    }

    $last_date = $wpdb->get_var("select max(log_date) from upwork_freelancer_logs limit 1");

    $logs = $wpdb->get_results("select country, {$field} as f_count from upwork_freelancer_logs where `log_date` = '{$last_date}'");

    foreach ($logs as $log) {
      if (!isset($countries[$log->country])) {
        continue;
      }

      $country = $countries[$log->country];

      $country_info = array(
          "code" => $country->code,
          "country" => $country->name,
          "latitude" => $country->latitude,
          "longitude" => $country->longitude,
          "task_count" => $log->f_count * 1
      );

      $codeData[$country->code] = $log->f_count * 1;
      $result[] = $country_info;
    }

    $last_date = $wpdb->get_var("select max(log_date) from upwork_freelancer_logs where `log_date` < '{$last_date}' limit 1");

    $logs = $wpdb->get_results("select country, {$field} as f_count from upwork_freelancer_logs where `log_date` = '{$last_date}'");
    foreach ($logs as $log) {
      if (!isset($countries[$log->country])) {
        continue;
      }

      $country = $countries[$log->country];
      if (isset($codeData[$country->code])) {
        continue;
      }

      $country_info = array(
          "code" => $country->code,
          "country" => $country->name,
          "latitude" => $country->latitude,
          "longitude" => $country->longitude,
          "task_count" => $log->f_count * 1
      );

      $codeData[$country->code] = $log->f_count * 1;
      $result[] = $country_info;
    }
  } else {
    $task_counts = $wpdb->get_results("select country, count(`id`) as t_count from upwork_tasks group by country");

    foreach ($task_counts as $task_count) {
      if (!isset($countries[$task_count->country])) {
        continue;
      }

      $country = $countries[$task_count->country];
      
      $country_info = array(
          "code" => $country->code,
          "country" => $country->name,
          "latitude" => $country->latitude,
          "longitude" => $country->longitude,
          "task_count" => $task_count->t_count
      );
      $result[] = $country_info;
      
      $codeData[$country->code] = $task_count->t_count;
    }
  }

  header('Content-Type: application/json');
  echo json_encode(array($result, $codeData));
} elseif ($action == 'get_last_tasks') {
  $last_id = $_POST['last_id'];

  $where = create_where('all');

  $sql = "select * from upwork_tasks where 1=1" . $where . " and `id` > '" . $last_id . "' order by `id` desc limit 10";
  $new_tasks = $wpdb->get_results($sql);

  header('Content-Type: application/json');
  echo json_encode($new_tasks);
} elseif ($action == "get_avg_budget") {
  $date = my_add_date(-30, false, 'Y-m-d');
  $avgs = $wpdb->get_results("select category, avg(budget) as avg_budget, sum(`id`) as task_count from upwork_tasks where `type` = 'fixed' and pubdate >= '{$date} 00:00:00' group by category");

  foreach ($avgs as $avg) {
    $result[$avg->category] = round($avg->avg_budget);
  }

  header('Content-Type: application/json');
  echo json_encode($result);
} elseif ($action == "get_tasks") {
  $start = $_POST['start'];
  $length = $_POST['length'];
  $category = $_POST['category'];

  $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];

  $where = create_where($category);
  if ($start_date) {
    $where .= " and pubdate >= '" . $start_date . " 00:00:00'";
  }
  if ($end_date) {
    $where .= " and pubdate <= '" . $end_date . " 23:59:59'";
  }

  $returnData = array(
      'draw' => $draw,
      'recordsTotal' => $wpdb->get_var("select count(*) from upwork_tasks"),
      'recordsFiltered' => $wpdb->get_var("select count(*) from upwork_tasks where 1=1 " . $where),
      'data' => array()
  );

  $sql = "select * from upwork_tasks where 1=1 " . $where . " order by pubdate desc limit " . $start . ", " . $length;
  $result = $wpdb->get_results($sql);
  foreach ($result as $row) {
    $task = array(
        "category" => $row->category,
        "pubdate" => $row->pubdate,
        "type" => $row->type,
        "budget" => $row->budget == 0 ? "" : number_format($row->budget),
        "client" => ($row->is_paymented == 1 ? "<i class='fa fa-check'></i> " : "") . $row->country,
        "title" => '<a href="javascript:void()" class="task-link" data-clipboard-text="' . $row->link . '"><i class="fa fa-copy" title="Copy link"></i></a> ',
    );

    if ($row->total_spent > 0) {
      $class = "danger";
      $width = $row->total_spent / 500;

      if ($row->total_spent < 1000) {
        $class = "success";
      } elseif ($row->total_spent < 10000) {
        $class = "into";
      } elseif ($row->total_spent < 50000) {
        $class = "warning";
      } else {
        $width = 100;
      }
      $task['client'] .= '<div class="progress" title="Client Total Spent: ' . number_format($row->total_spent) . '"><div class="progress-bar progress-bar-' . $class . '" style="width: ' . $width . '%"></div></div>';
    }
    $task['title'] .= '<span class="task-title">' . $row->title . '</span>';
    $task['title'] .= '<div class="task-description"> <i class="fa fa-link"></i>: <a href="' . $row->link . '" target="_blank">' . $row->link . '</a><br/><br/>' . $row->description . "<br/>";
    $task['title'] .= '<strong>Client Rating: </strong>' . $row->client_ranking . "<br/>";
    $task['title'] .= '<strong>Client Avg Hourly Rating: </strong>$' . $row->avg_hourly . "/h<br/>";
    $task['title'] .= '<strong>TaskID: </strong>' . $row->id . "<br/>";
    $task['title'] .= '</div>';

    $returnData['data'][] = $task;
  }

  header('Content-Type: application/json');
  echo json_encode($returnData);
} elseif ($action == 'get_freelancer_count') {
  $type = $_POST['type'];
  $country = $_POST['country'];
  if ($type == 'day') {
    $date = date('Y-m-d');
    if ($wpdb->get_var("select count(*) from upwork_freelancer_logs where log_date='{$date}' and country='{$country}'") == 0) {
      get_freelancer_count_by_country($country);
    }
  }

  $returnData = array();
  $returnData = array(
      "date" => array(),
      "all" => array(),
      "web" => array(),
      "mobile" => array(),
      "mins" => array()
  );
  if ($type == 'year') {
    $year = 2015;

    $this_year = date('Y');

    $start_date = $year . "-01-01";
    $end_date = date('Y-m-d');

    $sql = "select min(totalFreelancers) as _totalFreelancers, min(mobile_development) as _mobile_development, min(web_development) as _web_development"
            . " from upwork_freelancer_logs"
            . " where country='{$country}' and log_date between '{$start_date}' and '{$end_date}'";
    $mins = $wpdb->get_row($sql);
    $returnData['mins'][0] = $mins->_totalFreelancers - 1;
    $returnData['mins'][1] = $mins->_web_development - 1;
    $returnData['mins'][2] = $mins->_mobile_development - 1;

    do {
      $year ++;
      $returnData['date'][] = $year;

      $sql = "select avg(totalFreelancers) as _totalFreelancers, avg(mobile_development) as _mobile_development, avg(web_development) as _web_development"
              . " from upwork_freelancer_logs"
              . " where country='{$country}' and log_date like '{$year}-%'";
      $counts = $wpdb->get_row($sql);
      if ($counts && $counts->_totalFreelancers) {
        $returnData['all'][] = $counts->_totalFreelancers * 1 - $returnData['mins'][0];
        $returnData['web'][] = $counts->_web_development * 1 - $returnData['mins'][1];
        $returnData['mobile'][] = $counts->_mobile_development * 1 - $returnData['mins'][2];
      } else {
        $returnData['all'][] = 0;
        $returnData['web'][] = 0;
        $returnData['mobile'][] = 0;
      }
    } while ($year < $this_year);
  } elseif ($type == 'month') {
    $year = 2017;
    $month = 3;

    $this_month = date('Y-m');

    $start_date = $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-01";
    $end_date = date('Y-m-d');

    $sql = "select min(totalFreelancers) as _totalFreelancers, min(mobile_development) as _mobile_development, min(web_development) as _web_development"
            . " from upwork_freelancer_logs"
            . " where country='{$country}' and log_date between '{$start_date}' and '{$end_date}'";
    $mins = $wpdb->get_row($sql);
    $returnData['mins'][0] = $mins->_totalFreelancers - 1;
    $returnData['mins'][1] = $mins->_web_development - 1;
    $returnData['mins'][2] = $mins->_mobile_development - 1;

    $_year = "";
    do {
      $month ++;
      if ($month == 13) {
        $year ++;
        $month = 1;
      }

      $date = $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT);

      if ($_year != $year) {
        $_year = $year;
        $returnData['date'][] = $date;
      } else {
        $returnData['date'][] = str_pad($month, 2, "0", STR_PAD_LEFT);
      }

      $sql = "select avg(totalFreelancers) as _totalFreelancers, avg(mobile_development) as _mobile_development, avg(web_development) as _web_development"
              . " from upwork_freelancer_logs"
              . " where country='{$country}' and log_date like '{$date}-%'";
      $counts = $wpdb->get_row($sql);
      if ($counts && $counts->_totalFreelancers) {
        $returnData['all'][] = $counts->_totalFreelancers * 1 - $returnData['mins'][0];
        $returnData['web'][] = $counts->_web_development * 1 - $returnData['mins'][1];
        $returnData['mobile'][] = $counts->_mobile_development * 1 - $returnData['mins'][2];
      } else {
        $returnData['all'][] = 0;
        $returnData['web'][] = 0;
        $returnData['mobile'][] = 0;
      }
    } while ($date < $this_month);
  } else {
    $month = "";

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "select min(totalFreelancers) as _totalFreelancers, min(mobile_development) as _mobile_development, min(web_development) as _web_development"
            . " from upwork_freelancer_logs"
            . " where country='{$country}' and log_date between '{$start_date}' and '{$end_date}'";

    $mins = $wpdb->get_row($sql);
    $returnData['mins'][0] = $mins->_totalFreelancers - 1;
    $returnData['mins'][1] = $mins->_web_development - 1;
    $returnData['mins'][2] = $mins->_mobile_development - 1;

    $returnData['date_string'] = [];

    $old_total = $old_mobile = $old_web = 0;
    do {
      $returnData['date_string'][] = my_formart_date($start_date, "Y-m-d (D)");
      ;

      if ($month != substr($start_date, 0, 7)) {
        $month = substr($start_date, 0, 7);
        $returnData['date'][] = my_formart_date($start_date, "j/M");
      } else {
        $returnData['date'][] = my_formart_date($start_date, "j");
      }

      $sql = "select totalFreelancers, mobile_development, web_development"
              . " from upwork_freelancer_logs"
              . " where country='{$country}' and log_date='{$start_date}'";
      $counts = $wpdb->get_row($sql);
      if ($counts) {
        $old_total = $counts->totalFreelancers * 1 - $returnData['mins'][0];
        $old_web = $counts->web_development * 1 - $returnData['mins'][1];
        $old_mobile = $counts->mobile_development * 1 - $returnData['mins'][2];
      }

      $returnData['all'][] = $old_total;
      $returnData['web'][] = $old_web;
      $returnData['mobile'][] = $old_mobile;

      $start_date = my_add_date(1, $start_date);
    } while ($start_date <= $end_date);
  }

  header('Content-Type: application/json');
  echo json_encode($returnData);
} elseif ($action == 'get_freelancer_detail_count') {
  $returnData = array();

  $code = $_POST['code'];
  $country = $wpdb->get_var("select `name` from upwork_countries where `code` = '{$code}'");
  if ($country) {
    $last_date = $wpdb->get_var("select max(log_date) from upwork_freelancer_logs where `country` = '" . $country . "'");

    if ($last_date) {
      $sql = "select facetCounters"
              . " from upwork_freelancer_logs"
              . " where `country` = '" . $country . "' and log_date='{$last_date}'";
      $returnData = json_decode($wpdb->get_var($sql));
    }
  }

  header('Content-Type: application/json');
  echo json_encode($returnData);
} elseif ($action == 'report_hours') {
  $returnData = [
      "hours" => [],
      //"all" => [],
      "web" => [],
      "mobile" => []
  ];

  $start_date = my_add_date(-30, false, 'Y-m-d');
  $d_count = my_diff_days($start_date);
  for ($h = 0; $h < 23; $h ++) {
    $returnData["hours"][] = $h . "-" . ($h + 1);

    $_h = str_pad($h, 2, "0", STR_PAD_LEFT);
    $sql = "select `category`, count(`id`) as c_task from upwork_tasks where pubdate like '___________{$_h}:_____' and pubdate >= '{$start_date} 00:00:00' group by `category`";
    $counts = $wpdb->get_results($sql);

    $c_web = 0;
    $c_mobile = 0;
    foreach ($counts as $count) {
      if ($count->category === 'web') {
        $c_web = round($count->c_task / $d_count);
      } else {
        $c_mobile = round($count->c_task / $d_count);
      }
    }
    //$returnData['all'][] = $c_web + $c_mobile;
    $returnData['web'][] = $c_web;
    $returnData['mobile'][] = $c_mobile;
  }

  header('Content-Type: application/json');
  echo json_encode($returnData);
} elseif ($action == 'get_countries_freelancers') {
  $countryData = array();

  $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];

  $countries = $wpdb->get_results("select * from upwork_countries");

  $sql = "select * from upwork_freelancer_logs where log_date='{$start_date}'";
  $startCounts = array();
  $temp = $wpdb->get_results($sql);
  foreach ($temp as $row) {
    if ($row->country == '') {
      $row->country = "-";
    }

    $startCounts[$row->country] = $row;
  }

  $sql = "select * from upwork_freelancer_logs where log_date='{$end_date}'";
  $endCounts = array();
  $temp = $wpdb->get_results($sql);
  foreach ($temp as $row) {
    if ($row->country == '') {
      $row->country = "-";
    }

    $endCounts[$row->country] = $row;
  }

  foreach ($countries as $country) {
    if ($country->name == '') {
      continue;
    }

    if (!isset($startCounts[$country->name]) && !isset($endCounts[$country->name])) {
      continue;
    }
    
    $data = array(
        "country" => $country->name,
        "start_total_count" => "",
        "start_web_count" => "",
        "start_mobile_count" => "",
        "end_total_count" => "",
        "end_web_count" => "",
        "end_mobile_count" => "",
        "changed_total_count" => "",
        "changed_web_count" => "",
        "changed_mobile_count" => "",
        "changed_total_percent" => "",
        "changed_web_percent" => "",
        "changed_mobile_percent" => "",
    );

    if (isset($startCounts[$country->name])) {
      $startCount = $startCounts[$country->name];
      $data['start_total_count'] = $startCount->totalFreelancers;
      $data['start_web_count'] = $startCount->web_development;
      $data['start_mobile_count'] = $startCount->mobile_development;
    }

    if (isset($endCounts[$country->name])) {
      $endCount = $endCounts[$country->name];
      $data['end_total_count'] = $endCount->totalFreelancers;
      $data['end_web_count'] = $endCount->web_development;
      $data['end_mobile_count'] = $endCount->mobile_development;
    }

    if (isset($startCounts[$country->name]) && isset($endCounts[$country->name])) {
      $data['changed_total_count'] = $data['end_total_count'] - $data['start_total_count'];
      $data['changed_web_count'] = $data['end_web_count'] - $data['start_web_count'];
      $data['changed_mobile_count'] = $data['end_mobile_count'] - $data['start_mobile_count'];

      $data['changed_total_percent'] = $data['end_total_count'] == 0 ? 0 : round($data['changed_total_count'] / $data['end_total_count'] * 100, 2);
      $data['changed_web_percent'] = $data['end_web_count'] == 0 ? 0 : round($data['changed_web_count'] / $data['end_web_count'] * 100, 2);
      $data['changed_mobile_percent'] = $data['end_mobile_count'] == 0 ? 0 : round($data['changed_mobile_count'] / $data['end_mobile_count'] * 100, 2);
    }

    $countryData[] = $data;
  }

  $returnData = array(
      'draw' => $draw,
      'recordsTotal' => count($countryData),
      'data' => $countryData
  );

  header('Content-Type: application/json');
  echo json_encode($returnData);
}