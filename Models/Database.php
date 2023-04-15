<?php

class Database {

    public PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=db;dbname=pdo", 'user', 'secret');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function exists($table, array $attributes)
    {
        $attributesName =  array_keys($attributes);
        if(count($attributesName) == 1){
            $attributeName = $attributesName[0];
            $query = "SELECT COUNT(*) as count FROM $table WHERE $attributeName = :$attributeName";
        } else {
            $query = "SELECT COUNT(*) as count FROM $table WHERE ";

            foreach($attributesName as $index => $item)
            {
                $query .= "$item = :$item";
                
                if($index != count($attributesName) -1)
                {
                    $query .= " AND ";
                }
            }
        }

        $result = $this->connection->prepare($query);
        $result->execute($attributes);
        return $result->fetch()['count'] > 0;
    }

    public function create($table, array $data)
    {
        $attributes = array_keys($data);

        $sql = "INSERT INTO $table (". implode(', ', $attributes) .") VALUES (:". implode(', :', $attributes) .")";
        
        $result = $this->connection->prepare($sql);
        $result->execute($data);
    }
}