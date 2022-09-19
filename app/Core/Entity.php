<?php 
namespace Core;

class Entity
{
    protected static $table;

    protected $connect;
    private $columns = [];
    private $as;
    private $where;
    private $join;
    private $on;
    private $mjoin;

    public function __construct()
    {
        $this->connect = Connection::connect();
    }

    public function select($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function as($as)
    {
        $this->as = $as;
        return $this;
    }

    public function where($where)
    {
        $this->where = $where;
        return $this;
    }

    public function join($join)
    {
        $this->join = $join;
        return $this;
    }
    public function mjoin($mjoin)
    {
        $this->mjoin = $mjoin;
        return $this;
    }
    public function on($on)
    {
        $this->on = $on;
        return $this;
    }


    public function next()
    {
        $stmt = $this->connect->prepare($this->select(['max(id)'])->as('maxId')->selectQuery());
        $stmt->execute();
        return $stmt->fetch()->maxId + 1;
    }

    public function selectQuery()
    {
        $query = " SELECT ";
        
        if(count($this->columns) >= 1 && !empty($this->columns[0])) {
            $query .= implode(", ", $this->columns);
        }else{
            $query .= "*";
        }

        if (!empty($this->as)) {
            $query .= " AS ";
            $query .= $this->as;
        }

        $query .= " FROM ";
        $query .= static::$table;

        if (!empty($this->mjoin)) {
            foreach ($this->mjoin as $k => $v) {
                $query .= " INNER JOIN ".$k;
                $query .= " ON ".$k;
                $query .= ".id=".static::$table;
                $query .= ".".$v;
            }
            
        }

        if (!empty($this->join)) { 
            $query .= " INNER JOIN ".$this->join;
        }

        if (!empty($this->on)) {
            $query .= " ON ".$this->join;
            $query .= ".id=".static::$table;
            $query .= ".".$this->on;
        }

        if(!empty($this->where)) {
            $query .= " WHERE ";
            $query .= $this->where;
        }

        return $query;
    }

    public function get() 
    {
        $stmt = $this->connect->prepare($this->selectQuery());
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function first($id)
    {
        $stmt = $this->connect->prepare($this->where("id=$id")->selectQuery());
        $stmt->execute();
        return $stmt->fetch();
    }

    public function firstWhere($condition, $fields=[])
    {
        $stmt = $this->connect->prepare($this->select($fields)->where($condition)->selectQuery());
        $stmt->execute();
        return $stmt->fetch();
    }
    public function find($condition, $fields=[]) {
        
        $stmt = $this->connect->prepare($this->select($fields)->where($condition)->selectQuery());
        $stmt->execute();
        return $stmt->fetch();
    }


    public function findBy($condition)
    {
        $stmt = $this->connect->prepare($this->where($condition)->selectQuery());
        $stmt->execute();
        return $stmt->fetch();
    }


    public function delete($id)
    {
        $sql = "DELETE FROM ".static::$table." WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        
        return $stmt->execute([$id]);
    }

    public function destroy($condition)
    {
        $sql = "DELETE FROM ".static::$table." WHERE ". $condition;
        $stmt = $this->connect->prepare($sql);
        
        return $stmt->execute();
    }

    public function insert($sql, $params = [])
    {
        $stmt = $this->connect->prepare($sql);
        $result = $stmt->execute($params);
        return $result;
    }

    public function save()
    {
        $class = new \ReflectionClass($this);
        $properties = [];

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property){
            if (isset($this->{$property->getName()})){
                $properties[] = ''.$property->getName().' = "'.$this->{$property->getName()}.'"';
            }
        }
        $setValues = implode(',', $properties);
        $sql = '';
        if($this->id > 0) {
            $sql = 'UPDATE '.static::$table. ' SET '. $setValues. ' WHERE id = ' .$this->id;
        } else{
            $sql = 'INSERT INTO '.static::$table. ' SET '. $setValues. ', id = '.$this->next();
        }
        $stmt = $this->connect->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

}