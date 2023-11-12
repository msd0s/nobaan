<?php
namespace databases;

use \PDO;
use databases\interfaces\DatabaseInterface;
use databases\traits\DatabaseTrait;

class mysqlConnection implements DatabaseInterface
{
    use DatabaseTrait;

    private $connection;
    private $query;
    private $dataType = PDO::FETCH_ASSOC;

    public function __construct($db_host,$db_username,$db_password,$db_name)
    {
        try{
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function connect($db_host,$db_username,$db_password,$db_name)
    {
        try{
            $this->connection = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    public function select($fields = '*')
    {
        //$fieldList = $this->getFields($fields);
        $this->query = "select {$fields} ";
        return $this;
    }

    public function delete()
    {
        $this->query = "delete ";
        return $this;
    }

    public function insert($table)
    {
        $this->query = "insert into {$table} ";
        return $this;
    }

    public function update($table)
    {
        $this->query = "update {$table} set ";
        return $this;
    }

    public function insertFields($fields)
    {
        $fieldList = $this->createInsertFieldsList($fields);
        $this->query .= "({$fieldList['keys']}) VALUES ({$fieldList['values']}) ";
        
        return $this;
    }

    public function updateFields($fields)
    {
        $fieldList = $this->createUpdateFieldsList($fields);
        $this->query .= "{$fieldList} ";
        return $this;
    }

    public function from($table)
    {
        $this->query .= "from {$table} ";
        return $this;
    }

    public function table($table)
    {
        $this->query .= "{$table} ";
        return $this;
    }

    public function where($whereArray = '')
    {
        $where = $this->getWhereList($whereArray,'&&');
        $this->query .= "where {$where}";
        return $this;
    }

    public function orWhere($whereArray = '')
    {
        $where = $this->getWhereList($whereArray,'||');
        $this->query .= "or where {$where} ";
        return $this;
    }

    public function fetchOne()
    {
        $finalQuery = $this->connection->prepare($this->query);
        $finalQuery->execute();
        return $finalQuery->fetch($this->dataType);
    }

    public function fetchAll()
    {
        $finalQuery = $this->connection->prepare($this->query);
        $finalQuery->execute();
        return $finalQuery->fetchAll($this->dataType);
    }

    public function exec()
    {
        $finalQuery = $this->connection->exec($this->query);
    }

    public function toJson()
    {
        $this->dataType = PDO::FETCH_OBJ;
    }

    public function toArray()
    {
        $this->dataType = PDO::FETCH_ASSOC;
    }

    public function close()
    {
        return $this->$connection = null;
    }

}