<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.04.2019
 * Time: 16:09
 */

namespace TheWorldsCMS\Packages\Backend\Domain\Model\HTTP;

use TheWorldsCMS\Packages\Backend\Domain\Model\Configuration\ControllerConfig;

class RouteMapping {

    /** @var Request */
    private $request;
    /** @var ControllerConfig */
    private $controllerConfig;

    public function __construct(Request $request = null, ControllerConfig $controllerConfig = null) {
        $this->request = $request;
        $this->controllerConfig = $controllerConfig;
    }

    /**
     * @param ControllerConfig $controllerConfig
     * @return RouteMapping
     */
    public function setControllerConfig(ControllerConfig $controllerConfig): RouteMapping {
        $this->controllerConfig = $controllerConfig;
        return $this;
    }

    /**
     * @param Request $request
     * @return RouteMapping
     */
    public function setRequest(Request $request): RouteMapping {
        $this->request = $request;
        return $this;
    }

    /** @return Request */
    public function getRequest(): Request {
        return $this->request;
    }

    /** @return ControllerConfig */
    public function getControllerConfig(): ControllerConfig {
        return $this->controllerConfig;
    }

}