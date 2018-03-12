<?php
function get_client_info($task_link)
{
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

    //$task_dom = file_get_html($task_link);

    $client_info = array(
        "is_paymented" => 0,
        "client_ranking" => 0,
        "client_ratingcount" => 0,
        "total_spent" => 0,
        "avg_hourly" => 0
    );

    $index = 0;
    $client_div = false;
    foreach ($task_dom->find("#layout > .container .row") as $row)
    {
        $index ++;
        if ($index == 2)
        {
            $client_div = $row->children[1];
            break;
        }
    }

    if ($client_div)
    {
        //$client_div = str_get_dom($client_div->innertext);
        foreach ($client_div->find("div[class=oJobsAboutBuyerDetailsSection]") as $review)
        {
            $client_info["is_paymented"] = 1;
            foreach ($review->find("span[itemprop=ratingValue]") as $span)
            {
                $client_info["client_ranking"] = $span->innertext;
            }
            foreach ($review->find("span[itemprop=ratingCount]") as $span)
            {
                $client_info["client_ratingcount"] = $span->innertext;
            }
        }

        foreach ($client_div->find("p[class=ng-cloak]") as $p)
        {
            $ngbind = $p->children[0]->children[0]->getAttribute('ng-bind');
            $ngbind = explode("|", $ngbind);
            $client_info["total_spent"] = trim($ngbind[0]);
        }

        foreach ($client_div->find("p[class=m-md-bottom] strong") as $p)
        {
            $text = strip_tags($p->innertext);
            if (strpos($text, "Avg Hourly Rate Paid") > 0)
            {
                $text = substr(trim(str_replace("\n", "", $text)), 1);
                $text = explode("/", $text);
                $text = str_replace("$", "", $text[0]);
                $text = str_replace(",", "", $text);

                $client_info['avg_hourly'] = $text;
            }
        }
    }

    return $client_info;
}

function my_add_date($add_day, $now = false, $format = "Y-m-d")
{
    if ($now)
    {
        $now = strtotime($now);
    } else
    {
        $now = time();
    }

    return date($format, $now + $add_day * 86400);
}

function my_diff_days($start, $end = 'now', $unit = 'd')
{
    $diff = strtotime($end) - strtotime($start) + 1;
    return ceil($diff / 86400);
}

function my_formart_date($date = false, $format = "Y-m-d")
{
    if (!$date)
    {
        $time = strtotime("now");
    } else
    {
        $time = strtotime($date);
    }

    return date($format, $time);
}

function get_freelancer_count_by_country($country = 'all')
{
    global $wpdb, $broswer_agents;
    $agent = $broswer_agents[time() % count($broswer_agents)];

    $current_date = date('Y-m-d');

    //echo $country . ": ";

    $link = "https://www.upwork.com/o/profiles/browse/";
    if ($country != "all")
    {
        $link .= "?loc=" . str_replace(" ", "-", strtolower($country));
    }

//  $curl = curl_init();
//  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//  curl_setopt($curl, CURLOPT_HEADER, false);
//  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
//  curl_setopt($curl, CURLOPT_URL, $link);
//  curl_setopt($curl, CURLOPT_REFERER, $link);
//  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//  curl_setopt($curl, CURLOPT_USERAGENT, $agent);
//  $task_html = curl_exec($curl);
//  curl_close($curl);

    $opts = array(
        'http' => array(
            'method' => "GET",
            'user-agent:' => $agent,
            'header' => "Accept-language: en\r\n" .
            "Cookie: session_id=41ef3c7d110e4a951fc0949f47c55ab0; device_view=full; _vhipo=0; visitor_id=61.216.35.232.1507684892688645; qt_visitor_id=61.216.35.232.1507684892688645; XSRF-TOKEN=aae3449dd381a6121c0f140b99be68ba; __cfduid=de6fedec0ecd0a47b6063ef20325aee0c1507684893; optimizelyEndUserId=oeu1507684896426r0.4911938325495395; bf_lead=1bo1jrnv59k000; _br_uid_2=uid%3D2853044773289%3Av%3D11.8%3Ats%3D1507684897460%3Ahc%3D1; __trossion=1507684898_1800_1__39f008ff-8368-4d4a-9794-98492d0c8d80%3A1507684898_1507684898_1; __troRUID=39f008ff-8368-4d4a-9794-98492d0c8d80; __troSYNC=1; ki_t=1507684908677%3B1507684908677%3B1507684908677%3B1%3B1; ki_r=; __ssid=2eb27017-2f5c-4e70-9224-85e38cb2b1c9; _ceg.s=oxmx4d; _ceg.u=oxmx4d; _px3=dde5f6ca10f878e87c0e852056631f67e5ff236f30156448e9c196fb6887ac83:jW9Y4N+L/fy163EpDeJtoTbCgcrgwKxYbWsV9mAw0GKJwl9mURdKF34sFrrBLQWL8Tt9xFa6qgFTvFpE9adGmw==:1000:FW0UqLrygQaSGhv8iz4AOmz+DS69SMQtkxswFyLGzPzp0IuJVJFgLg7UjpPvG840MX8f8Bzkauo3JVSNMlXv4EGTd/+hNR3Qf0B6O8jIWX1gJg43RrgE5zDvUh0c13ruK3+ipnvHxe5e2IAJROUv5ELbPjF3n/9xobEYrd1X1O8=; _ga=GA1.2.1860408290.1507684896; _gid=GA1.2.1091807306.1507684896; _gat_UA-62227314-1=1"
        )
    );

    $context = stream_context_create($opts);

    // Open the file using the HTTP headers set above
    $task_html = file_get_contents($link, false, $context);
    
    $pos = strpos($task_html, "var phpVars =");

    $all_count = "error";
    if ($pos !== false)
    {
        $task_html = trim(substr($task_html, $pos + strlen("var phpVars =")));

        $pos = strpos($task_html, "};");
        if ($pos === false)
        {
            
        } else
        {
            $task_html = substr($task_html, 0, $pos + 1);

            $profile_data = json_decode($task_html);

            $all_count = $profile_data->totalFreelancers * 1;
            try
            {
                $mobile_development = 0;
                if (isset($profile_data->facetCounters->subcategory2->{"mobile-development"}))
                {
                    $mobile_development = $profile_data->facetCounters->subcategory2->{"mobile-development"};
                }
                $web_development = 0;
                if (isset($profile_data->facetCounters->subcategory2->{"mobile-development"}))
                {
                    $web_development = $profile_data->facetCounters->subcategory2->{"web-development"};
                }

                $time = date('H:i:s');
                $logs = array(
                    "log_date" => $current_date,
                    "totalFreelancers" => $profile_data->totalFreelancers,
                    "mobile_development" => $mobile_development,
                    "web_development" => $web_development,
                    "facetCounters" => "", //json_encode($profile_data->facetCounters),
                    "country" => $country
                );

                //echo ($profile_data->totalFreelancers);
                //echo "\n";

                $wpdb->query("delete from upwork_freelancer_logs where log_date='{$current_date}' and country='" . $country . "'");
                $wpdb->insert("upwork_freelancer_logs", $logs);
            } catch (Exception $e)
            {
                // print_r($profile_data->facetCounters->subcategory2);
            }
        }
    } else
    {
        
    }

//  $wpdb->query("delete from logs where registed < '" . my_add_date(-1, false, 'Y-m-d H:i:s') . "'");
//  $wpdb->insert("logs", array("registed" => date('Y-m-d H:i:s'), "log" => $country . " - totalFreelancers:" . $all_count));
}
