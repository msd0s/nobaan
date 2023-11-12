<?php
namespace caches\traits;

trait CacheTrait
{
    private function getAllCacheData($values)
    {
        $data = [];
        if(!empty($values))
        {
            foreach($values as $dataKey => $dataValue)
            {
                $data[$dataKey] = $dataValue;
            }
        }
        return $data;
    }
}