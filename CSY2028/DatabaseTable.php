<?php 
    namespace CSY2028;
    class DatabaseTable
    {
        private $pdo;
        private $table;
        private $primaryKey;
        private $entityClass;
        private $entityConstructor;

        public function __construct($pdo, $table, $primaryKey, $entityClass = 'stdclass', $entityConstructor = [])
        {
            $this->pdo = $pdo;
            $this->table = $table;
            $this->primaryKey = $primaryKey;
            $this->entityClass = $entityClass;
            $this->entityConstructor = $entityConstructor;
        }

        public function find($field, $value) //Find items in database table based on one field
        {
            $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
            $values = [
                'value' => $value
            ];
            $stmt->execute($values);
            return $stmt->fetchAll();
        }

        public function findTwo($field1, $value1, $field2, $value2) //Find items in database table based on two field
        {
            $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field1 . ' = :value1 AND ' . $field2 . ' = :value2');
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
            $values = [
                'value1' => $value1,
                'value2' => $value2
            ];
            $stmt->execute($values);
            return $stmt->fetchAll();
        }

        public function findAll() //Find all items in database table
        {
            $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
            $stmt->execute();
            return $stmt->fetchAll();
        }


        public function delete($value) //Delete item from a database table
        {
            $stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE id  = :value LIMIT 1');
            $criteria = [
                'value' => $value
            ];
            $stmt->execute($criteria);
        }

        public function insert($record) //Insert item into a database table
        {
            $keys = array_keys($record);
            $values = implode(', ', $keys);
            $valuesC = implode(', :', $keys);
            $query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesC . ')';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($record);
        }

        public function update($record) //Update item from a database table
        {
            $query = 'UPDATE ' . $this->table . ' SET ';
            $parameters = [];
            foreach ($record as $key => $value) {
                $parameters[] = $key . ' = :' . $key;
            }
            $query .= implode(', ', $parameters);
            $query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';
            $record['primaryKey'] = $record[$this->primaryKey];
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($record);
        }

        public function save($record) //Check if record is already in table to update or insert
        {
            try {
                $this->insert($record);
            } catch (\Exception $e) {
                $this->update($record);
            }
        }

        public function count($field, $value) //Count from database table based on one field
        {
            $stmt = $this->pdo->prepare('SELECT count(*) FROM ' . $this->table . ' WHERE ' . $field . ' = :value');
            $values = [
                'value' => $value
            ];
            $stmt->execute($values);
            $number = $stmt->fetch();
            return $number[0];
        }

        public function order($criteria, $field1, $value1) //Order items from database table descending
        {
            $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field1 . ' = :value1 ORDER BY ' . $criteria . ' DESC LIMIT 5 ');
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructor);
            $values = [
                'value1' => $value1
            ];
            $stmt->execute($values);
            return $stmt->fetchAll();
        }
    }