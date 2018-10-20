<?php
define('BASE_DIR', __DIR__);
global $config;
 date_default_timezone_set ("Europe/Berlin");
$config = require_once BASE_DIR.'/config.php';

# require limonade
require_once BASE_DIR.'/vendors/limonade.php';

require_once BASE_DIR.'/vendors/core/Model.php';


# require option limonade
function configure()
{
option('env', ENV_DEVELOPMENT);
#option('env', ENV_PRODUCTION);
option('controllers_dir', BASE_DIR.'/controllers');
option('views_dir', BASE_DIR.'/views');
option('session', true);
option('debug',              true);
}


# Automatically load router files
$filesrouters = glob(BASE_DIR.'/routers/*.router.php');
foreach ($filesrouters as $filesrouter) {
    require $filesrouter;
}


run();