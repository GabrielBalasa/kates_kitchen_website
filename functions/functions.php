<?php
    function find($pdo, $table, $field, $value){ //Find items in database table based on one field function
        $stmt = $pdo -> prepare('SELECT * FROM ' . $table . ' WHERE ' . $field . ' = :value');
        $values = [
            'value' => $value
        ];
        $stmt->execute($values);
        return $stmt->fetchAll();
    }

    function findAll($pdo, $table){ //Find all items in a database table function
        $stmt = $pdo->prepare('SELECT * FROM ' . $table );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function insert($pdo, $table, $record){ //Insert item into a database table
        $keys = array_keys($record);
        $values = implode(', ', $keys);
        $valuesC = implode(', :', $keys);
        $query = 'INSERT INTO ' . $table . ' (' . $values . ') VALUES (:' . $valuesC . ')';
        $stmt = $pdo->prepare($query);
        $stmt->execute($record);
    }


    function delete($pdo, $table, $field, $value){ //Delete item from a database table
        $stmt = $pdo->prepare('DELETE FROM ' . $table . ' WHERE ' . $field . ' = :value');
        $criteria = [
        'value' => $value
        ];
        $stmt->execute($criteria);
    }

    function update($pdo, $table, $record, $primaryKey){ //Update item from a database table
        $query = 'UPDATE ' . $table . ' SET ';
        $parameters = [];
        foreach ($record as $key => $value) {
        $parameters[] = $key . ' = :' .$key;
        }
        $query .= implode(', ', $parameters);
        $query .= ' WHERE ' . $primaryKey . ' = :primaryKey';
        $record['primaryKey'] = $record[$primaryKey];
        $stmt = $pdo->prepare($query);
        $stmt->execute($record);
    }

    function save($pdo, $table, $record, $primaryKey){ //Check if record is already in table to update or insert
        try {
            insert($pdo, $table, $record);
        }
        catch (Exception $e) {
        update($pdo, $table, $record, $primaryKey);
        }
    }