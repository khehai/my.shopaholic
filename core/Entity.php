<?php 
namespace Core;

class Entity
{
    protected static $table;

    protected $connect;
    private $columns = [];
    private $as;
    private $where;

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
    public function delete($id)
    {
        $sql = "DELETE FROM ".static::$table." WHERE id = ?";
        $stmt = $this->connect->prepare($sql);
        
        return $stmt->execute([$id]);
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
