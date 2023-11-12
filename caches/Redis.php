<?php
namespace caches;

use caches\interfaces\CacheInterface;
use caches\traits\CacheTrait;

class Redis implements CacheInterface
{
    use CacheTrait;

    private $cache;
    private $config;
    public function __construct($config)
    {
        $this->config = $config;
        $this->cache = new \Redis();
        $this->cache->connect($this->config['redis_host'],$this->config['redis_port']);
    }
    public function hset($haskName,$key,$value)
    {
        $this->cache->hset($haskName,$key, $value);
        return $this;
    }

    public function hsetWithExpire($haskName,$key,$value,$timeInSecond)
    {
        $this->cache->hset($haskName,$key, $value);
        $this->cache->expire($haskName, $timeInSecond);
        return $this;
    }

    public function hmset($haskName,$dataArray)
    {
        $this->cache->hmset($haskName,$dataArray);
        return $this;
    }

    public function hmsetWithExpire($haskName,$dataArray,$timeInSecond)
    {
        $this->cache->hmset($haskName,$dataArray);
        $this->cache->expire($haskName, $timeInSecond);
        return $this;
    }

    public function hgetall($haskName)
    {
        return $this->cache->hgetall($haskName);
    }

    public function hdel($haskName,$key)
    {
        $this->cache->hdel($haskName,$key);
    }

    public function del($haskName)
    {
        $this->cache->del($haskName);
    }

    public function hexists($haskName,$key)
    {
        return $this->cache->hexists($haskName,$key);
    }

    public function hincrby($haskName,$key,$count)
    {
        $this->cache->hincrby($haskName,$key,$count);
        return $this;
    }

    public function hget($haskName,$key)
    {
        return $this->cache->hget($haskName,$key);
    }

}