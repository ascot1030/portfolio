<?php require_once 'include/auto_inc.php'; ?><!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  <meta name="format-detection" content="telephone=no">
  <meta charset="UTF-8">

  <meta name="description" content="Upwork Analytics">
  <meta name="keywords" content="Upwork, Analytics">

  <title>Upwork Analytics</title>

  <link rel="icon" href="img/favicon.ico">

  <!-- CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/form.css" rel="stylesheet">
  <link href="css/calendar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/icons.css?v=1" rel="stylesheet">        
  <link href="css/generics.css" rel="stylesheet"> 

  <?php if (isset($ext_css) && is_array($ext_css)): ?>
    <?php foreach ($ext_css as $css): ?>
      <link href="<?php echo $css; ?>" rel="stylesheet"/>
    <?php endforeach; ?>
  <?php endif; ?>

  <script>
    var js_options = {timezone: '<?php echo DEFAULT_TIMEZONE; ?>'};
  </script>
  
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-102346015-2', 'auto');
    ga('send', 'pageview');

  </script>
</head>

<?php
if (isset($new_messages)) {
  
} else {
  $new_messages = true;
}
?>

<body id="skin-cloth">
  <header id="header" class="media">
    <a href="" id="menu-toggle"></a> 
    <a class="logo pull-left" href="index.php">Upwork Analytics</a>	


    <div class="media-body">
      <div class="media" id="top-menu">
        <?php if ($new_messages): ?>
          <div class="pull-left tm-icon">
            <a data-drawer="new-web-tasks" class="drawer-toggle" href="" id="web-task-alam">
              <i class="fa fa-globe" style="font-size: 30px; line-height: 48px;"></i>
              <i class="n-count animated"></i>
              <span>New Web</span>
            </a>
          </div>

          <div class="pull-left tm-icon">
            <a data-drawer="new-mobile-tasks" class="drawer-toggle" href="" id="mobile-task-alam">
              <i class="fa fa-mobile" style="font-size: 30px; line-height: 48px;"></i>
              <i class="n-count animated"></i>
              <span>New Mobile</span>
            </a>
          </div>
        <?php endif; ?>
        <div id="time" class="pull-right"></div>
      </div>
    </div>
  </header>

  <div class="clearfix"></div>

  <section id="main" class="p-relative" role="main">

    <!-- Sidebar -->
    <aside id="sidebar">

      <!-- Sidbar Widgets -->
      <div class="side-widgets overflow">
        <!-- Profile Menu -->
        <div class="text-center s-widget m-b-25 dropdown" id="profile-menu">
          <a href="index.php" data-toggle="dropdown">
            <img class="profile-pic animated" src="img/upwork-analytics.png" alt="">
          </a>
        </div>

        <!-- Calendar -->
        <div class="s-widget">
          <div id="sidebar-calendar"></div>
        </div>

        <hr class="whiter m-b-20">

        <h4 class="page-title m-t-20">Task Report <small>in last month</small></h4>

        <!-- Avg Budget -->
        <div class="s-widget">

          <?php
          $before_month = my_add_date(-30, false, 'Y-m-d');
          $avgs = $wpdb->get_results("select category, avg(budget) as avg_budget, count(`id`) as task_count from upwork_tasks where `type` = 'fixed' and pubdate >= '{$before_month} 00:00:00' group by category");

          $avg_budgets = array();
          $tatal_task_counts = array();
          foreach ($avgs as $avg) {
            $avg_budgets[$avg->category] = round($avg->avg_budget);
            $tatal_task_counts[$avg->category] = number_format($avg->task_count);
          }
          ?>

          <h2 class="tile-title">
            Avg Budget (<span style="text-transform:none;">All clients</span>)
          </h2>

          <div class="s-widget-body">
            <div class="listview narrow">
              <div class="media">
                <div class="pull-right">
                  <div class="counts" id="mobile-avg-budget"><?php echo (isset($avg_budgets['mobile']) ? $avg_budgets['mobile'] : 0); ?></div>
                </div>
                <div class="media-body">
                  <h6>Mobile: </h6>
                </div>
              </div>

              <div class="media">
                <div class="pull-right">
                  <div class="counts" id="web-avg-budget"><?php echo (isset($avg_budgets['web']) ? $avg_budgets['web'] : 0); ?></div>
                </div>
                <div class="media-body">
                  <h6>Web: </h6>
                </div>
              </div>
            </div>
          </div>
        </div>                    

        <!-- All Task Count -->
        <div class="s-widget m-b-25">                    
          <h2 class="tile-title">
            Task Count (<span style="text-transform:none;">All clients</span>)
          </h2>

          <div class="s-widget-body">
            <div class="listview narrow">
              <div class="media">
                <div class="pull-right">
                  <div class="counts" id="mobile-avg-budget"><?php echo (isset($tatal_task_counts['mobile']) ? $tatal_task_counts['mobile'] : 0); ?></div>
                </div>
                <div class="media-body">
                  <h6>Mobile: </h6>
                </div>
              </div>

              <div class="media">
                <div class="pull-right">
                  <div class="counts" id="web-avg-budget"><?php echo (isset($tatal_task_counts['web']) ? $tatal_task_counts['web'] : 0); ?></div>
                </div>
                <div class="media-body">
                  <h6>Web: </h6>
                </div>
              </div>
            </div>
          </div>
        </div>                   

        <?php
        $before_month = my_add_date(-30, false, 'Y-m-d');
        $avgs = $wpdb->get_results("select category, avg(budget) as avg_budget, count(`id`) as task_count from upwork_tasks where `type` = 'fixed' and is_paymented=1 and pubdate >= '{$before_month} 00:00:00' group by category");

        $avg_budgets = array();
        $tatal_task_counts = array();
        foreach ($avgs as $avg) {
          $avg_budgets[$avg->category] = round($avg->avg_budget);
          $tatal_task_counts[$avg->category] = number_format($avg->task_count);
        }
        ?>

        <h2 class="tile-title">
          Avg Budget (<span style="text-transform:none;">Paymented clients</span>)
        </h2>

        <div class="s-widget-body">
          <div class="listview narrow">
            <div class="media">
              <div class="pull-right">
                <div class="counts" id="mobile-avg-budget"><?php echo (isset($avg_budgets['mobile']) ? $avg_budgets['mobile'] : 0); ?></div>
              </div>
              <div class="media-body">
                <h6>Mobile: </h6>
              </div>
            </div>

            <div class="media">
              <div class="pull-right">
                <div class="counts" id="web-avg-budget"><?php echo (isset($avg_budgets['web']) ? $avg_budgets['web'] : 0); ?></div>
              </div>
              <div class="media-body">
                <h6>Web: </h6>
              </div>
            </div>
          </div>
        </div>                    

        <!-- All Task Count -->
        <div class="s-widget m-b-25">                    
          <h2 class="tile-title">
            Task Count (<span style="text-transform:none;">Paymented clients</span>)
          </h2>

          <div class="s-widget-body">
            <div class="listview narrow">
              <div class="media">
                <div class="pull-right">
                  <div class="counts" id="mobile-avg-budget"><?php echo (isset($tatal_task_counts['mobile']) ? $tatal_task_counts['mobile'] : 0); ?></div>
                </div>
                <div class="media-body">
                  <h6>Mobile: </h6>
                </div>
              </div>

              <div class="media">
                <div class="pull-right">
                  <div class="counts" id="web-avg-budget"><?php echo (isset($tatal_task_counts['web']) ? $tatal_task_counts['web'] : 0); ?></div>
                </div>
                <div class="media-body">
                  <h6>Web: </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include_once 'menu.php'; ?>


    </aside>

    <!-- Content -->
    <section id="content" class="container">

      <?php if ($new_messages): ?>
        <!-- Messages Drawer -->
        <div id="new-web-tasks" class="tile drawer animated">
          <div class="listview narrow">
            <div class="overflow" style="height: 254px"></div>
          </div>
        </div>

        <div id="new-mobile-tasks" class="tile drawer animated">
          <div class="listview narrow">
            <div class="overflow" style="height: 254px"></div>
          </div>
        </div>
      <?php endif; ?>

      <div id="search-filter" class="tile">
        <h4 class="page-title">
          Choose Search Options
          <button class="btn btn-sm" id="btnSearchFilter"><i class="fa fa-search"></i> Search</button>
        </h4>

        <div class="tile-dark p-10" id="input-masking">
          <form id="frmSearchFilter" name="frmSearchFilter" method="post" onsubmit="return research();">
            <input type="submit" style="display: none;"/>
            <div class="row">
              <div class="col-lg-1 col-md-2 col-sm-4 m-b-15">
                <label>Start Date</label>
                <div class="input-icon datetime-pick date-only">
                  <input id="start_date" name="start_date" data-format="yyyy-MM-dd" type="text" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>" />
                  <span class="add-on">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-sm-4 m-b-15">
                <label>End Date</label>
                <div class="input-icon datetime-pick date-only">
                  <input id="end_date" name="end_date" data-format="yyyy-MM-dd" type="text" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>" />
                  <span class="add-on">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-sm-4 m-b-15">
                <label>Task Type</label>
                <select id="task_type" name="task_type" class="select">
                  <option value="all">All</option>
                  <option value="hourly">Hourly</option>
                  <option valuye="fixed">Fixed</option>
                </select>
              </div>                                
              <div class="col-lg-1 col-md-2 m-b-15">
                <label>Budget <small>(min)</small></label>
                <div class="p-relative">
                  <input type="text" id="budget" name="budget" class="form-control input-sm spinedit" />
                </div>
              </div>

              <div class="col-lg-8 col-md-4 m-b-15">
                <label>Skills(Set to 10)</label>
                <select id="skills" name="skills" data-placeholder="Select Skill..." class="tag-select-limited" multiple>
                  <?php $skills = $wpdb->get_results("select * from skills order by skill"); ?>
                  <?php foreach ($skills as $skill): ?>
                    <option value="<?php echo $skill->id; ?>"><?php echo $skill->skill; ?></option> 
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-1 col-md-2 col-sm-4 m-b-15">
                <label>Client Payment?</label>
                <select id="client_paymented" name="client_paymented" class="select">
                  <option value="all">All</option>
                  <option value="1">Paymented</option>
                  <option valuye="0">Non Paymented</option>
                </select>
              </div>
              <div class="col-lg-1 col-md-2 col-sm-4 m-b-15">
                <label>Ranking</label>
                <div class="col-md-12">
                  <input type="text" id="client_ranking" name="client_ranking" class="input-slider" data-slider-min="0" data-slider-max="5" data-slider-step="0.5" data-slider-value="[0,5]">
                </div>
              </div>
              <div class="col-lg-1 col-md-2 col-sm-4 m-b-15">
                <label>Total Spent <small>(min)</small></label>
                <div class="p-relative">
                  <input type="number" id="client_total_spent" name="client_total_spent" class="form-control input-sm spinedit" />
                </div>
              </div>
              <div class="col-lg-1 col-md-2 m-b-15">
                <label>Avg Hourly <small>(min)</small></label>
                <div class="p-relative">
                  <input type="text" id="client_avg_hourly" name="client_avg_hourly" class="form-control input-sm spinedit" />
                </div>
              </div>

              <div class="col-lg-8 col-md-4 m-b-15">
                <label>Country(Set to 5)</label>
                <select id="client_countries" name="client_countries" data-placeholder="Select Country..." class="tag-select-limited" multiple>
                  <?php $countries = $wpdb->get_col("select `name` from upwork_countries"); ?>
                  <?php foreach ($countries as $country): if (!$country) continue; ?>
                    <option value="<?php echo $country; ?>"><?php echo $country; ?></option> 
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="clearfix"></div>
            </div>
          </form>

          <div class="clearfix"></div>
        </div>
      </div>