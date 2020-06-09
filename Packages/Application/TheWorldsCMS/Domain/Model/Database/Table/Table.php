<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13.12.2018
 * Time: 18:46
 */

namespace TheWorldsCMS\Database\Table;


abstract class Table {

    /**
     * @var string
     */
    public $name;

    public function __construct() {
        $this->name = strtolower(get_called_class());
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}