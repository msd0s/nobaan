<?php
namespace configs\traits;

trait RouteTrait
{
    private function clearRouteRootPath($root_path,$routeUri)
    {
        $route = explode($root_path,$routeUri);
        if(empty($route[1]))
        {
            return '/';
        }else
        {
            $finalRoute = $this->clearRouteRequestParameters($route[1]);
            return $finalRoute;
        }
    }

    private function clearRouteRequestParameters($routeUrl)
    {
        $route = explode('?',$routeUrl);
        return $route[0];
    }

    private function addRouteToRouteList($urlMethod,$route,$controllerObject,$controllerMethod)
    {
        $this->routeList[$urlMethod][$route] = [$controllerObject,$controllerMethod];
    }

    private function getRouteParameters($urlMethod)
    {
        if($urlMethod == 'post')
        {
            return array_merge($_FILES, $_POST);
        }elseif($urlMethod == 'get')
        {
            return $_GET;
        }else
        {
            return null;
        }
    }
}