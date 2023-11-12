<?php
namespace databases\interfaces;

interface DatabaseInterface
{
    public function connect($db_host,$db_username,$db_password,$db_name);
    public function select($fields);
    public function insert($table);
    public function update($table);
    public function delete();
    public function from($table);
    public function fetchOne();
    public function fetchAll();
    public function where($whereArray);
    public function orWhere($whereArray);
    public function exec();
    public function close();
}