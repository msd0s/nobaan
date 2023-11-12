<?php
include_once 'config.php';
require_once 'vendor/autoload.php';
use databases\mysqlConnection;
use configs\Route;
use caches\Memcache;
use caches\Redis;

if($config['cache_type']=='memcached')
{
    $cache = new Memcache($config);
}elseif($config['cache_type']=='redis')
{
    $cache = new Redis($config);
}else
{
    die('please select cache : redis or memcached');
}

$database = new mysqlConnection($config['db_host'],$config['db_username'],$config['db_password'],$config['db_name']);
$route = new Route($config);

include_once 'routes/web.php';

$setting = $database->select('*')->from('settings')->where(['id'=>1,'database_type'=>'mysql'])->fetchOne();