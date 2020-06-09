<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.05.2019
 * Time: 14:16
 */

namespace TheWorldsCMS\Packages\Backend\Classes\Controller\Http;

use TheWorldsCMS\Packages\Backend\Classes\Controller\Abstracts\RestController;
use TheWorldsCMS\Packages\Backend\Domain\Model\Configuration\ControllerConfig;
use TheWorldsCMS\Packages\Backend\Domain\Model\HTTP\Request;
use TheWorldsCMS\Packages\Backend\Domain\Model\HTTP\RouteMapping;
use TheWorldsCMS\Packages\Journey\Classes\Annotations as Journey;
use TheWorldsCMS\Utility\YamlParser;

/**
 * Class HttpController
 * @package TheWorldsCMS\Packages\Backend\Classes\Controller\Http
 * @Journey\Singleton()
 */
class HttpController extends RestController {

    private function __construct(){}
    private function __clone(){}

    /** @var array */
    private $routeMappings;

    public function initialize() {
        echo "<p>Ich bin eine AUsgabe, um meinen JS Code zu testen....</p>";
    }

    public function buildRouteMapping() {
        $yamlParser = new YamlParser();
        $routes = $yamlParser->fileToArray(CONFIGURATION_PATH . "Routes.yaml");
        foreach ($routes as $key => $route) {
            $controllerConfig = new ControllerConfig(
                $route["config"]["package"],
                $route["config"]["subNamespaces"],
                $route["config"]["controller"],
                $route["config"]["function"]
            );
            $request = new Request($route["requestURL"], $route["requestMethod"]);
            $routeMapping = new RouteMapping($request, $controllerConfig);
            $this->routeMappings[] = $routeMapping;
        }
    }

    public function invokeFunctionOnRequestURL(Request $request) {
        /** @var RouteMapping $routeMapping */
        foreach ($this->routeMappings as $routeMapping) {
            if ($routeMapping->getRequest() == $request) {
                $NamespaceClassString =
                    "TheWorldsCMS\\Packages\\" . $routeMapping->getControllerConfig()->getPackageName() .
                    "\\Classes\\Controller\\";
                if ($routeMapping->getControllerConfig()->getSubNameSpaces() != "") {
                    $NamespaceClassString .= $routeMapping->getControllerConfig()->getSubNameSpaces() . "\\";
                }
                $NamespaceClassString .= $routeMapping->getControllerConfig()->getControllerName() . "Controller";
                $controllerInstance = call_user_func(
                    array(
                        $NamespaceClassString,
                        "getInstance"
                    )
                );
                call_user_func(
                    array(
                        $controllerInstance,
                        $routeMapping->getControllerConfig()->getFunctionName()
                    )
                );
            }
        }
    }

    /** @return array */
    public function getRouteMappings() {
        return $this->routeMappings;
    }

    /** @param array $routeMappings */
    public function setRequest(array $routeMappings): void {
        $this->routeMappings = $routeMappings;
    }
}