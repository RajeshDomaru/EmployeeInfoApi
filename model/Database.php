<?php

class Database {

    protected $connection = null;

    public function __construct() {

        try {

            $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

            if (mysqli_connect_errno()) {

                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }

    public function insertOrUpdate(string $query = "", array $params = []) {
        $stmt = $this->executeStatement($query, $params);
        $stmt->close();
    }

    public function select($query = "", $params = [], $is_all = true) {

        try {

            $stmt = $this->executeStatement($query, $params);

            $result = $is_all ? $stmt->get_result()->fetch_all(MYSQLI_ASSOC) : $result = $stmt->get_result()->fetch_object();

            $stmt->close();

            return $result;
        } catch (Exception $e) {

            throw New Exception($e->getMessage());
        }

        return false;
    }

    protected function executeStatement($query = "", $params = []) {

        try {

            $stmt = $this->connection->prepare($query);

            if (!$stmt) {

                throw New Exception("Unable to do prepared statement: " . $query);
            }

            if ($params) {

//                $stmt->bind_param("i", $params[0]);
                $stmt->execute($params);
            } else {

                throw New Exception("Unable to do bind param: " . $params);
            }

            return $stmt;
        } catch (Exception $e) {

            throw New Exception($e->getMessage());
        }
    }

}
