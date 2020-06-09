<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.05.2019
 * Time: 14:54
 */

namespace TheWorldsCMS\Packages\Backend\Domain\Model\Configuration;

class ControllerConfig {

    /** @var string */
    private $controllerName;
    /** @var string */
    private $packageName;
    /** @var string */
    private $functionName;
    /** @var string */
    private $subNameSpaces;

    public function __construct(string $packageName = null, string $subNamespaces = null, string $controllerName = null, string $methodName = null) {
        $this->packageName = $packageName;
        $this->controllerName = $controllerName;
        if ($methodName == "") {
            $this->functionName = "initialize";
        } else {
            $this->functionName = $methodName;
        }
        $this->subNameSpaces = $subNamespaces;
    }

    /** @return string */
    public function getControllerName() {
        return $this->controllerName;
    }

    /** @param string $controllerName */
    public function setControllerName($controllerName) : void {
        $this->controllerName = $controllerName;
    }

    /** @return string */
    public function getPackageName() {
        return $this->packageName;
    }

    /** @param string $packageName */
    public function setPackageName($packageName) : void {
        $this->packageName = $packageName;
    }

    /** @return string */
    public function getFunctionName() {
        return $this->functionName;
    }

    /** @param string $functionName */
    public function setFunctionName($functionName) : void {
        $this->functionName = $functionName;
    }

    /** @return string */
    public function getSubNameSpaces() : string {
        return $this->subNameSpaces;
    }

    /** @param string $subNameSpaces */
    public function setSubNameSpaces(string $subNameSpaces) : void {
        $this->subNameSpaces = $subNameSpaces;
    }
}