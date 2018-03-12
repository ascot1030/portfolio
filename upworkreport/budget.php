<?php
require_once 'include/auto_inc.php';

$tasks = $wpdb->get_row("select `id`, `link`, `budget` from upwork_tasks where `id` = 5034");

$client_info = get_client_info($task->link);
print_r($client_info);

/*foreach($tasks as $task) {
	
	$task_link = $task->link;
	
	$curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $task_link);
    curl_setopt($curl, CURLOPT_REFERER, $task_link);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $task_html = curl_exec($curl);
    curl_close($curl);
	$task_dom = str_get_dom($task_html);
	
	$client_info = get_client_info($task->link);
	print_r($client_info);exit;
	if ($client_info['avg_hourly'] > 0) {
		$wpdb->update("upwork_tasks", array("avg_hourly" => $client_info['avg_hourly']), array("id" => $task->id));
	}
	
	echo $task->id . " : " . $client_info['avg_hourly'];
	echo "\n";
}

echo "Finished";*/
exit;