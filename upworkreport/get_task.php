<?php
require_once 'include/auto_inc.php';

$new_tasks = array();

$xmlDoc = new DOMDocument();
$xmlDoc->load(RSS_WEB_MOBILE_DEVELOPMENT);

//get elements from "<channel>"
$channel = $xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
		->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
		->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
		->item(0)->childNodes->item(0)->nodeValue;

//get and output "<item>" elements
$task_items = $xmlDoc->getElementsByTagName('item');
$task_index = 0;
while(is_object($task_item = $task_items->item($task_index))) {
  $item_title = $task_item->getElementsByTagName('title')
		  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link = urldecode($task_item->getElementsByTagName('link')
		  ->item(0)->childNodes->item(0)->nodeValue);
  $item_desc = $task_item->getElementsByTagName('description')
		  ->item(0)->childNodes->item(0)->nodeValue;
  $item_pubdate = $task_item->getElementsByTagName('pubDate')
		  ->item(0)->childNodes->item(0)->nodeValue;
  
  $item_pubdate = date('Y-m-d H:i:s', strtotime($item_pubdate));
  
  $item_link = str_replace("/jobs/", "/job/", $item_link);
  $item_link = str_replace("?source=rss", "/", $item_link);
  
  $descs = str_replace("<br />", "<br>", $item_desc);
  $descs = str_replace("<br/>", "<br>", $descs);
  
  $descs = explode("<br>", $descs);
  $task_info = array(
	"category" => "",
	"country" => "",
	"pubdate" => date('Y-m-d H:i:s', strtotime($item_pubdate)),
	"link" => $item_link,
	"title" => $item_title, 
	"description" => $item_desc,
	"type" => "fixed",
	"budget" => 0
  );
  //echo $task_index . " : " . $item_link;
  //echo "\n";
  $task_index ++;
  
  $skills = array();
  
  $row = 0;
  foreach($descs as $desc) {
	  $desc = strip_tags($desc);
	  $desc = str_replace("\n", "", $desc);
	  $desc = str_replace("\r", "", $desc);
	  $desc = str_replace("&amp;", "&", $desc);
	  
	  if (strpos($desc, "Budget") === 0) {
		  $budget = str_replace(",", "", substr($desc, 9));
		  $task_info['budget'] = $budget;
	  } elseif (strpos($desc, "Country") === 0) {
		  $task_info['country'] = substr($desc, 9);
	  } elseif (strpos($desc, "Skills") === 0) {
		  $skills = explode(",", substr($desc, 8));
	  } elseif (strpos($desc, "Category: Web") === 0) {
		  $category = substr($desc, 10);
		  if (strpos($category, "Web Development") === false) {
			  $task_info['category'] = "mobile";
		  } else {
			  $task_info['category'] = "web";
		  }
	  }
	  
	  $row ++;
  }
  
  if ($task_info['budget'] == 0) {
	  $task_info['type'] = "hourly";
  }
  
  $task_count = $wpdb->get_var("select count(*) from upwork_tasks where link='" . $item_link . "'");
  if ($task_count > 0) {
	  continue;
  }
  
  $wpdb->insert("upwork_tasks", $task_info);
  $task_id = $wpdb->insert_id;
  
  $new_tasks[$task_id] = $item_link;
  
  foreach($skills as $skill) {
	  $skill = trim($skill);
	  
	  $skill_id = $wpdb->get_var("select `id` from skills where skill='" . $skill . "'");
	  if ($skill_id) {
		  
	  } else {
		  $wpdb->insert("skills", array("skill" => $skill));
		  $skill_id = $wpdb->insert_id;
	  }
	  
	  $wpdb->insert("upwork_task_skills", array("task_id" => $task_id, "skill_id" => $skill_id));
  }
  
  $country = $wpdb->get_row("select * from upwork_countries where `name`='".$task_info['country']."'");
  if ($country) {
    
  } else {
    $country = $wpdb->get_row("select * from world_countries where `name` like '".$task_info['country']."%'");
    if ($country) {
      $wpdb->insert("upwork_countries", array("name" => $task_info['country'], "code" => $country->code, "latitude" => $country->latitude, "longitude" => $country->longitude));
    }
  }
}

foreach($new_tasks as $task_id => $item_link) {
	$client_info = get_client_info($item_link);
	
	$wpdb->update("upwork_tasks", $client_info, array("id" => $task_id));
}

$wpdb->query("delete from logs where registed < '" . my_add_date(-1, false, 'Y-m-d H:i:s') . "'");
$log = "Registed:" . count($new_tasks);
$wpdb->insert("logs", array("registed" => date('Y-m-d H:i:s'), "log" => $log));

echo $log;

require_once 'get_freelancer.php';

$wpdb->close();
exit;