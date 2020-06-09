<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.11.2018
 * Time: 23:37
 */

namespace TheWorldsCMS\Packages\Backend\Classes\Controller\Database;

use mysqli;
use TheWorldsCMS\Model\Database\Database;
use TheWorldsCMS\Packages\Backend\Classes\Controller\Abstracts\AbstractController;
use TheWorldsCMS\Packages\Journey\Classes\Annotations as Journey;

/**
 * Class DatabaseController
 * @package TheWorldsCMS\Packages\Backend\Classes\Controller\Database
 * @Journey\Singleton()
 */
class DatabaseController extends AbstractController {

    private function __construct(){}
    private function __clone(){}

    /**
     * @var mysqli $databaseConnection
     */
    private $databaseConnection = null;

    /**
     * @var Database
     */
    private $database;

    /**
     *
     */
    public function connectToDatabase():void {
        $tmpDatabase = $this->getDatabase();
        $mysqliConnection = new \mysqli($tmpDatabase->getHost(), $tmpDatabase->getUsername(), $tmpDatabase->getPassword(), $tmpDatabase->getDatabaseName(), $tmpDatabase->getPort());
        if ($mysqliConnection->connect_error) {
            die("Verbindung zum MySQL-Server konnte nicht aufgebaut werden" . $mysqliConnection->connect_error);
        }
        $this->databaseConnection = $mysqliConnection;
    }

    /**
     * @param string $query
     * @return bool|\mysqli_result
     */
    public function makeQuery(string $query) {
        return $this->databaseConnection->query($query);
    }

    /**
     * Disconnects from the current Database, which is connected to
     */
    public function disconnectFromDatabase():void {
        if ($this->databaseConnection) {
            $this->databaseConnection->close();
        } else {
            echo "There was no Databaseconnection that could be closed!";
        }
    }

    /**
     * @return mysqli
     */
    public function getDatabaseConnection() {
        return $this->databaseConnection;
    }

    /**
     * @param $host
     * @param $username
     * @param $password
     * @param $port
     * @param $databaseName
     * @return Database
     */
    public function createDatabase($host, $username, $password, $port, $databaseName) {
        $this->database = Database::getInstance();
        $this->database->setHost($host);
        $this->database->setDatabaseName($databaseName);
        $this->database->setPassword($password);
        $this->database->setUsername($username);
        $this->database->setPort($port);
        return $this->database;
    }

    /**
     * @return Database
     */
    public function getDatabase() {
        return $this->database;
    }

    public function setDatabase ($newDatabase) {
        $this->database = $newDatabase;
    }
}