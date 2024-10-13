<?php

class Database {

    public static $connection;

    }

    // Insert, Update, Delete (IUD) queries
    public static function iud($query, $params, $types) {
        try {
            Database::setUpConnection();
            $stmt = Database::$connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Error preparing statement: " . Database::$connection->error);
            }
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            if ($stmt->affected_rows <= 0) {
                throw new Exception("No rows affected.");
            }
        } catch (Exception $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    // Search queries
    public static function search($query) {
        try {
            Database::setUpConnection();
            $result = Database::$connection->query($query);
            if (!$result) {
                throw new Exception("Error executing query: " . Database::$connection->error);
            }
            return $result;
        } catch (Exception $e) {
            die("Error retrieving data: " . $e->getMessage());
        }
    }
}

?>
