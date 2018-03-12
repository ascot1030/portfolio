<!-- Side Menu -->
<ul class="list-unstyled side-menu">
  <li class="<?php if (isset($_page) && $_page == 'world') echo 'active'; ?>">
    <a class="sa-side-home" href="index.php">
      <span class="menu-item">World Chat</span>
    </a>
  </li>
  <li class="<?php if (isset($_page) && $_page == 'freelancers') echo 'active'; ?>">
    <a class="sa-side-chart" href="freelancers.php">
      <span class="menu-item">Freelancers</span>
    </a>
  </li>
  <li class="<?php if (isset($_page) && $_page == 'new_tasks') echo 'active'; ?>">
    <a class="sa-side-chart" href="new_tasks.php">
      <span class="menu-item">New Tasks</span>
    </a>
  </li>
  <li class="<?php if (isset($_page) && $_page == 'task') echo 'active'; ?>">
    <a class="sa-side-table" href="tasks.php">
      <span class="menu-item">Tasks</span>
    </a>
  </li>
  <li class="<?php if (isset($_page) && $_page == 'report_hours') echo 'active'; ?>">
    <a class="sa-side-chart" href="report_hours.php">
      <span class="menu-item">Task Report by hours</span>
    </a>
  </li>
  <li class="<?php if (isset($_page) && $_page == 'skills') echo 'active'; ?>">
    <a class="sa-side-chart" href="skills.php">
      <span class="menu-item">Skills</span>
    </a>
  </li>
</ul>