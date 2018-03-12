<?php 
$inc_dir = dirname(__FILE__) . "/";

require_once $inc_dir . 'config.php';
require_once $inc_dir . 'db.php';
require_once $inc_dir . 'simple_html_dom.php';
require_once $inc_dir . 'functions.php';

$wpdb = new wpdb(DB_USER, DB_PASSWORD, DB_DATABASE, DB_DOMAIN);

$broswer_agents = array(
    "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246",
    "Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36",
    "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322; 2345Explorer 5.0.0.14136)",
    "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2376.0 Safari/537.36 OPR/31.0.1857.0",
    "Opera/9.80 (Windows NT 5.1) Presto/2.12.388 Version/12.14",
    "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36 OPR/45.0.2552.812",
    "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3067.6 Safari/537.36 OPR/46.0.2590.0 (Edition developer)",
);

