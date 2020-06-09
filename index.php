<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 24.11.2018
 * Time: 19:24
 */

$composerAutoLoader = require("./Packages/Libraries/autoload.php");
$bootstrap = new \TheWorldsCMS\Journey\Core\Bootstrap($composerAutoLoader, "Development");
$bootstrap->run();