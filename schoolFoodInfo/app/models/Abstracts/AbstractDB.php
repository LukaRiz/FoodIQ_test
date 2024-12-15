<?php

require_once "app/views/components/db/DB.php";

abstract class AbstractDB {
    protected static $dbh = null;

    /**
     * Get a shared database connection instance.
     * Initializes the connection if it does not already exist.
     *
     * @return PDO The database connection instance.
     */
    public static function getConnection(): PDO {
        if (is_null(self::$dbh)) {
            self::$dbh = DBInit::getInstance();
        }

        return self::$dbh;
    }

    /**
     * Execute a modifying query (INSERT, UPDATE, DELETE).
     * Returns the last insert ID for INSERT queries.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An associative array of query parameters.
     * @return int The last inserted ID.
     */
    protected static function modify(string $sql, array $params = []): int {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute(self::filterParams($sql, $params));

        return self::getConnection()->lastInsertId();
    }

    /**
     * Execute a SELECT query and return the result.
     *
     * @param string $sql The SQL query to execute.
     * @param array $params An associative array of query parameters.
     * @return array An array of results, where each row is an associative array.
     */
    protected static function query(string $sql, array $params = []): array {
        $stmt = self::getConnection()->prepare($sql);
        $stmt->execute(self::filterParams($sql, $params));

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Filter parameters to match placeholders in the SQL query.
     * Ensures that all required parameters are provided.
     *
     * @param string $sql The SQL query containing placeholders.
     * @param array $params The provided query parameters.
     * @return array Filtered parameters matching the query's placeholders.
     * @throws Exception If there is a mismatch between required and provided parameters.
     */
    protected static function filterParams(string $sql, array $params): array {
        $params_altered = self::alterKeys($params);

        $sql_params = preg_grep("/^:/", preg_split("/[\(\) ,]/", $sql));

        $result = array_intersect_key($params_altered, array_flip($sql_params));

        if (count($sql_params) !== count($result)) {
            throw new Exception(
                "Parameter mismatch: required (" . implode(", ", $sql_params) . "), provided (" . implode(", ", array_keys($params)) . ")"
            );
        }

        return $result;
    }

    /**
     * Adjust parameter keys to match prepared statement syntax.
     * Converts keys to start with a colon (e.g., "key" becomes ":key").
     *
     * @param array $params The original query parameters.
     * @return array Parameters with adjusted keys.
     */
    protected static function alterKeys(array $params): array {
        return array_combine(
            array_map(fn($key) => ":$key", array_keys($params)),
            $params
        );
    }
}
