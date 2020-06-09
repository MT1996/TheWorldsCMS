<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.05.2019
 * Time: 16:18
 */

namespace TheWorldsCMS\Packages\Backend\Domain\Model\HTTP;


class Response {

    /** @var array */
    public $content;

    public function toJSONString() {
        return json_encode($this->content);
    }

    /** @return array */
    public function getContent() : array {
        return $this->content;
    }

    /** @param array $content */
    public function setContent(array $content) : void {
        $this->content = $content;
    }

    /**
     * @param string $key
     * @param string $value
     * @throws \ErrorException
     */
    public function insertIntoContent(string $key, string $value) {
        if ($this->content[$key] != null) {
            throw new \ErrorException("Key bereits besetzt, nutze neuen Key im Array");
        } else {
            $this->content[$key] = $value;
        }
    }

}