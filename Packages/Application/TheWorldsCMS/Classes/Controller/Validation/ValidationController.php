<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.03.2019
 * Time: 19:56
 */
namespace TheWorldsCMS\Packages\Backend\Classes\Controller\Validation;

use TheWorldsCMS\Packages\Backend\Classes\Controller\Abstracts\AbstractController;
use TheWorldsCMS\Packages\Backend\Classes\Controller\Database\DatabaseController;
use TheWorldsCMS\Utility\YamlParser;

/**
 * Class ValidationController
 * @package TheWorldsCMS\Packages\Backend\Classes\Controller\Validation
 */
class ValidationController extends AbstractController {

    /**
     * @var DatabaseController
     */
    private $databaseController;

    /**
     * @var $postArray
     * @type array
     * @return array
     */
    public function connectToDatabaseAndBuildSchema() : array {
        $websiteProject = $_POST["WebsiteProject"];
        $userName = $_POST["WebsiteAdmin"];
        $userPassword = $_POST["WebsiteAdminPassword"];
        $hashedUserPassword = password_hash($userPassword, PASSWORD_BCRYPT);
        $userEmail = $_POST["WebsiteAdminEmail"];
        $dbUsername = $_POST["DBUsername"];
        $dbPassword = $_POST["DBPassword"];
        $hashedDatabasePassword = password_hash($dbPassword, PASSWORD_BCRYPT);
        $dbHostname = $_POST["DBHostname"];
        $dbPort = (int) $_POST["DBPortNumber"];
        $dbDatabase = $_POST["DBDatabaseName"];
        $database = $this->databaseController->createDatabase($dbHostname, $dbUsername, $dbPassword, $dbPort, $dbDatabase);
        $this->databaseController->connectTo($database);
        foreach ($this->setupController->getDatabaseQueries() as $query) {
            $result = $this->databaseController->makeQuery($query);
            if( ! $result) {
                die("Tabelle konnte nicht erfolgreich angelegt werden!");
            }
        }
        $this->databaseController->disconnectFromDatabase();
        return [
            "websiteProject" => $websiteProject,
            "UserName" => $userName,
            "UserPassword" => $hashedUserPassword,
            "UserEmail" => $userEmail,
            "DBUserName" => $dbUsername,
            "DBPassword" => $hashedDatabasePassword,
            "DBHostName" => $dbHostname,
            "DBPort" => $dbPort,
            "DBDatabaseName" => $dbDatabase
        ];
    }

    public function initializeValidation() {
        $this->databaseController = DatabaseController::getInstance();
    }

    public function buildSettings(array $settingsForYAML) {
        $settingsArray = [
            "WebsiteProject" => $settingsForYAML["websiteProject"],
            "Settings" => [
                "database" => [
                    "DBHostname" => $settingsForYAML["DBHostName"],
                    "DBUsername" => $settingsForYAML["DBUserName"],
                    "DBPassword" => $settingsForYAML["DBPassword"],
                    "DBDatabaseName" => $settingsForYAML["DBDatabaseName"],
                    "DBPortNumber" => $settingsForYAML["DBPort"],
                ],
                "admin" => [
                    "WebsiteAdmin" => $settingsForYAML["UserName"],
                    "userPassword" => $settingsForYAML["UserPassword"],
                    "WebsiteEmail" => $settingsForYAML["UserEmail"]
                ]
            ]
        ];
        $yamlParser = new YamlParser();
        $yamlParser->arrayToFile($settingsArray, "Settings.yaml");
    }

    public function buildConfigAndDatabases() {
        $this->initializeValidation();
        $tmpInputConfigs = $this->connectToDatabaseAndBuildSchema();
        $this->buildSettings($tmpInputConfigs);
    }
}