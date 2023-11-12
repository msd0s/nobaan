<?php
namespace caches\interfaces;

interface CacheInterface
{
    public function hset($haskName,$key,$value);
    public function hsetWithExpire($haskName,$key,$value,$timeInSecond);
    public function hmset($haskName,$dataArray);
    public function hmsetWithExpire($haskName,$dataArray,$timeInSecond);
    public function hgetall($haskName);
    public function hdel($haskName,$key);
    public function del($haskName);
    public function hexists($haskName,$key);
    public function hincrby($haskName,$key,$count);
    public function hget($haskName,$key);
}