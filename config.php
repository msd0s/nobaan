<?php
$config = 
[
    'root_path' => '/nobaan/',
    'root_dir' => implode('',explode('index.php',$_SERVER['SCRIPT_FILENAME'])),
    'root_url' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].implode('',explode('index.php',$_SERVER['PHP_SELF'])),

    'db_name' => 'nobaan',
    'db_username' => 'root',
    'db_password' => '',
    'db_host' => 'localhost',

    //cache config
    'cache_type' => "memcached", // 1:memcached 2:redis

    'memcache_host' => "localhost",
    'memcache_port' => 11211,

    'redis_host' => 'localhost',
    'redis_port' => 6379,

];
?>