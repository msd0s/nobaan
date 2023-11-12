<?php
namespace databases\traits;

trait DatabaseTrait
{
    private function getWhereList($wheres,$operator)
    {
        if($fields = '')
        {
            return '';
        }else
        {
            $whereList = '';
            $x = 1;
            foreach($wheres as $condition => $value)
            {
                count($wheres) != $x ? $whereList .= $condition.'='."'{$value}'"." {$operator} " : $whereList .= $condition.'='."'{$value}'";
                $x++;
            }
            return $whereList;
        }
    }

    private function createInsertFieldsList($fields)
    {
        $keys = '';
        $values = '';
        if(count($fields)>0)
        {
            $x=1;
            foreach($fields as $key => $value)
            {
                count($fields) != $x ? $keys .= $key.',' : $keys .= $key;
                count($fields) != $x ? $values .= "'{$value}'".',' : $values .= "'{$value}'";
                $x++;
            }
        }
        return [
            'keys'=> $keys,
            'values' => $values
        ];
    }

    private function createUpdateFieldsList($fields)
    {
        $keys = '';
        if(count($fields)>0)
        {
            $x=1;
            foreach($fields as $key => $value)
            {
                count($fields) != $x ? $keys .= $key.'='."'{$value}'".',' : $keys .= $key.'='."'{$value}'";
                $x++;
            }
        }
        return $keys;
    }

    public function getFields($fields)
    {
        if($fields = '*')
        {
            return '*';
        }else
        {
            $fieldList = '';
            $x = 1;
            foreach($fields as $field)
            {
                count($fields) != $x ? $fieldList .= $field.',' : $fieldList .= $field;
                $x++;
            }
            return $fieldList;
        }
    }
}