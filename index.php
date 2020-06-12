<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.11.2018
 * Time: 19:24
 */

$returnValue = apcu_add("someKey", "someValue");
echo '<pre>' , var_dump($returnValue) , '</pre>';
echo '<pre>' , var_dump(apcu_cache_info()) , '</pre>';
$someValue = apcu_fetch("someKey");
echo '<pre>' , var_dump($someValue) , '</pre>';

$composerAutoLoader = require("./Packages/Libraries/autoload.php");
$bootstrap = new \TheWorldsCMS\Journey\Core\Bootstrap($composerAutoLoader, "Development");
$bootstrap->run();