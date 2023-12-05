<?php

namespace Acme\system;

use PDO;
use PDOStatement;

/**
 * Singleton design pattern voor de database
 */
final class Database extends PDO
{
    protected static $instance;
    private static ?array $env = null; // Vraagteken betekent: $env is NULLABLE: moet array OF NULL zijn

    //A cache to hold prepared statements
    protected $cache;

    /**
     * Get instance of the PDO
     *
     * @return PDO
     */
    public static function getInstance($envpath): Database
    {
        if ( ! self::$instance) {
            self::$instance = new Database($envpath);
        }
        return self::$instance;
    }

    public function __construct($envpath)
    {
        //Database connection data uit .env-bestand lezen als nog niet gedaan
        if (is_null(self::$env)) {
            (new DotEnv($envpath))->load();
            $connection = getenv("DB_CONNECTION");
            $host = getenv("DB_HOST");
            $port = getenv("DB_PORT");
            $dbname = getenv("DB_DATABASE");

            self::$env['dsn'] = "$connection:host=$host;port=$port;dbname=$dbname;charset=utf8";
            self::$env['username'] = getenv("DB_USERNAME");
            self::$env['password'] = getenv("DB_PASSWORD");
        }

        parent::__construct(
            self::$env['dsn'],
            self::$env['username'],
            self::$env['password']
        );
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->cache = array();
    }

    /**
     * If the statement is not cached, cache it and return PDOStatement
     * If the statement is already cached, return the cached statement
     *
     * @return PDOStatement
     */
    public function getPreparedStatement($query): PDOStatement
    {
        $hash = md5($query);
        if ( ! isset($this->cache[$hash])) {
            $this->cache[$hash] = $this->prepare($query);
        }
        return $this->cache[$hash];
    }

    public function __destruct()
    {
        $this->cache = null;
    }

    private function __clone()
    {
    }
}