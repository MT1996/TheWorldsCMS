<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.03.2019
 * Time: 23:11
 */

namespace TheWorldsCMS\Packages\Backend\Classes\Controller;

use TheWorldsCMS\Packages\Backend\Classes\Controller\Abstracts\AbstractController;
use TheWorldsCMS\Packages\Backend\Classes\Controller\Database\DatabaseController;
use TheWorldsCMS\Packages\Backend\Classes\Controller\Http\HttpController;
use TheWorldsCMS\Packages\Backend\Domain\Model\HTTP\Request;
use TheWorldsCMS\Journey\Annotations as Journey;
use TheWorldsCMS\Journey\Core\Bootstrap;
/**
 * Class BootstrapController
 * @package TheWorldsCMS\Packages\Backend\Classes\Controller
 * @Journey\Singleton()
 */
class BootstrapController extends AbstractController {

    private function __construct() {}
    private function __clone() {}

    /**
     * @var
     */
    protected $bootstrapContext;

    /**
     * @var HttpController
     * @Journey\Injection(HttpController)
     */
    private $httpController;

    /**
     * @var DatabaseController
     * @Journey\Injection(DatabaseController)
     */
    private $databaseController;

    /** @return HttpController */
    public function getHttpController(): HttpController {
        return $this->httpController;
    }

    /**
     */
    public function bootstrap() {
        $this->prepareCMSByBootstrapContext();
        $this->httpController = HttpController::getInstance();
        $this->httpController->buildRouteMapping();
        $this->httpController->invokeFunctionOnRequestURL(new Request($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]));
    }

    public function initialize() {
        $this->getWebView();
    }

    public function getWebView() {
        echo file_get_contents(VIEW_PATH . "HTML/index.html");
    }

    /**
     * @param Bootstrap $bootstrapContext
     * @return BootstrapController
     */
    public function setBootstrapContext(Bootstrap $bootstrapContext) {
        $this->bootstrapContext = $bootstrapContext;
        return $this;
    }
}