<?php
namespace caches;

use caches\interfaces\CacheInterface;
use caches\traits\CacheTrait;

class Memcache implements CacheInterface
{
    use CacheTrait;

    private $cache;
    private $config;
    public function __construct($config)
    {
        $this->config = $config;
        $this->cache = new \Memcache();
        $this->cache->addServer($this->config['memcache_host'],$this->config['memcache_port']);
    }
    public function hset($haskName,$key,$value)
    {
        $values = $this->hgetall($haskName);
        // get all cache rows
        $data = $this->getAllCacheData($values);
        // add new row to cache list
        $data[$key] = $value;
        $this->cache->set($haskName,$data);
        
        return $this;
    }

    public function hsetWithExpire($haskName,$key,$value,$timeInSecond)
    {
        $this->cache->set($haskName,[$key=> $value],$timeInSecond);
        return $this;
    }

    public function hmset($haskName,$dataArray)
    {
        $this->cache->set($haskName,$dataArray);
        return $this;
    }

    public function hmsetWithExpire($haskName,$dataArray,$timeInSecond)
    {
        $this->cache->set($haskName,$dataArray,$timeInSecond);
        return $this;
    }

    public function hgetall($haskName)
    {
        return $this->cache->get($haskName);
    }

    public function hdel($haskName,$key)
    {
        $values = $this->hgetall($haskName);
        // get all cache rows
        $data = $this->getAllCacheData($values);

        unset($data[$key]);
        $this->cache->set($haskName,$data);
        //$this->cache->delete($haskName,[$key]);
    }

    public function del($haskName)
    {
        $this->cache->delete($haskName);
    }

    public function hexists($haskName,$key)
    {
        $keyValue = $haskName[$key];
        $exists = $this->hgetall($haskName);
        if(!empty($exists) && in_array($key,array_keys($exists)))
        {
            return true;
        }
        return false ;
    }

    public function hincrby($haskName,$key,$count)
    {
        $keyCount = $this->hgetall($haskName)[$key];
        $finalCount = $keyCount + $count;

        $this->hset($haskName,$key,$finalCount);
        return $this;
    }

    public function hget($haskName,$key)
    {
        return $this->cache->get($haskName,$key);
    }
}