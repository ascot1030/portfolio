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

<body id="skin-cloth">
  <header id="header" class="media">
    <a href="" id="menu-toggle"></a> 
    <a class="logo pull-left" href="index.php">Upwork Analytics</a>	


    <div class="media-body">
      <div class="media" id="top-menu">
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
      