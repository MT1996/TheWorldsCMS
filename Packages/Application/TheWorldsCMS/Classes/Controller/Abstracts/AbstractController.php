<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 04.03.2019
 * Time: 23:18
 */

namespace TheWorldsCMS\Packages\Backend\Classes\Controller\Abstracts;

use TheWorldsCMS\Journey\Annotations\Annotateable;

abstract class AbstractController implements Annotateable {

    /**
     * @var array
     */
    public static $controllerInstance;

    /**
     * @var array $instanceMethods soll nachher ein zweidimensionales Array abbilden, damit in der ersten Dimension, die
     * Klasse hinterlegt wird, die annotiert werden soll
     * In der zweiten Dimension soll dann die Funktion gespeichert werden, die zur Runtime hinzugefügt wird
     */
    public $instanceMethods;
    /**
     * @var array $staticClassMethods soll ebenfalls ein zweidimensionales Array abbilden, damit in der ersten Dimension, die
     * Klasse hinterlegt wird, die annotiert werden soll
     * In der zweiten Dimension soll dann die Funktion gespeichert werden, die zur Runtime hinzugefügt wird
     */
    public static $staticClassMethods;

    public static function __callStatic($name, $arguments) {
        if (is_callable(static::$staticClassMethods[get_called_class()][$name])) {
            return call_user_func(static::$staticClassMethods[get_called_class()][$name]);
        }
    }

    public function __call($name, $arguments) {
        // TODO: Implement __call() method.
    }
}