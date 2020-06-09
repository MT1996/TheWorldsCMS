<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.04.2019
 * Time: 16:04
 */

namespace TheWorldsCMS\Packages\Backend\Domain\Model\HTTP;


class Request {

    /** @var string */
    private $requestURL;

    /** @var string */
    private $requestMethod;

    public function __construct(string $requestURL = null, string $requestMethod = null) {
        $this->requestURL = $requestURL;
        $this->requestMethod = $requestMethod;
    }

    /** @return string */
    public function getRequestURL(): string {
        return $this->requestURL;
    }

    /** @param string $requestURL */
    public function setRequestURL(string $requestURL): void {
        $this->requestURL = $requestURL;
    }

    /** @return string */
    public function getRequestMethod(): string {
        return $this->requestMethod;
    }

    /** @param string $requestMethod */
    public function setRequestMethod(string $requestMethod): void {
        $this->requestMethod = $requestMethod;
    }

}