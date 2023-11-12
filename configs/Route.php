<?php
namespace configs;

use configs\traits\RouteTrait;

class Route
{
    use RouteTrait;

    private $config;
    private $routeList;
    public function __construct($config)
    {
        $this->config = $config;
    }
    public function get($routeUrl,$controllerArray)
    {
        // clear root_path from request_uri address
        $route = $this->clearRouteRootPath($this->config['root_path'],$_SERVER['REQUEST_URI']);
        // add cleared route to routelist array
        $this->addRouteToRouteList($_SERVER['REQUEST_METHOD'],$route,$controllerArray[0],$controllerArray[1]);
        // if send url parameters to route, get thats
        $routeParameters = $this->getRouteParameters('get');
        // call class method and send url parameters data to that
        if($routeUrl == $route)
        {
            $method = $controllerArray[1];
            $controllerArray[0]->$method($routeParameters);
            exit();
        }
    }

    public function post($routeUrl,$controllerArray)
    {
        // clear root_path from request_uri address
        $route = $this->clearRouteRootPath($this->config['root_path'],$_SERVER['REQUEST_URI']);
        // add cleared route to routelist array
        $this->addRouteToRouteList($_SERVER['REQUEST_METHOD'],$route,$controllerArray[0],$controllerArray[1]);
        // if send url parameters to route, get thats
        $routeParameters = $this->getRouteParameters('post');
        // call class method and send url parameters data to that
        if($routeUrl == $route)
        {
            $method = $controllerArray[1];
            $controllerArray[0]->$method($routeParameters);
            exit();
        }
    }
}