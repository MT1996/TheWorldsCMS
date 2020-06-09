<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.03.2019
 * Time: 19:11
 */

namespace TheWorldsCMS\View;

use TheWorldsCMS\Utility\Utility;

abstract class View extends Utility {

    /**
     * Singleton für GeneralPurposeClasses Classes
     */
    private static $abstractViewInstance;

    private function __construct(){}
    private function __clone(){}

    public static function getInstance() {
        $className = get_called_class();
        if (isset(self::$abstractViewInstance[$className]) == false) {
            self::$abstractViewInstance[$className] = new static();
        }
        return self::$abstractViewInstance[$className];
    }

    public $viewConfig = array();

    public function render(){}

    /**
     * @param $viewSettings
     * @var array $viewSettings Konfiguration wird direkt ins Array reingeschrieben, daher als Array
     */
    public function assign($viewSettings) {
        $this->viewConfig = $viewSettings;
    }
}