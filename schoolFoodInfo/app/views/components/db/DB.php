<?php

// require_once "vendor/autoload.php";

// use Dotenv\Dotenv;

class DBInit {
    private static $instance = null;

    /**
     * Get a singleton instance of the database connection.
     * Reads database configuration from environment variables using Dotenv.
     *
     * @return PDO The shared PDO instance for database interaction.
     */
    public static function getInstance(): PDO {
        if (!self::$instance) {
            // $dotenv = Dotenv::createImmutable("/var/www/html/schoolFoodInfo/");
            // $dotenv->load();

            $host = "localhost";
            $user = "root";
            $password = "";
            $schema = "schoolFoodInfo";

            $dsn = "mysql:host=" . $host . ";dbname=" . $schema;

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ];

            try {
                self::$instance = new PDO($dsn, $user, $password, $options);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
