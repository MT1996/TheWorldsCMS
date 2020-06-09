<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.11.2018
 * Time: 23:38
 */

namespace TheWorldsCMS\Model\Database;

abstract class Database {

    private static $databaseInstance;

    private function __construct(){}
    private function __clone(){}

    public static function getInstance() {
        if (isset(self::$databaseInstance)) {
            self::$databaseInstance = new static();
        }
        return self::$databaseInstance;
    }

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $databaseName;

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }
    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }
    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }
    /**
     * @return string
     */
    public function getDatabaseName() {
        return $this->databaseName;
    }
    /**
     * @return integer
     */
    public function getPort() {
        return $this->port;
    }

    /**
     * @param string $databaseName
     */
    public function setDatabaseName(string $databaseName): void
    {
        $this->databaseName = $databaseName;
    }
    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }
    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }
}