<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ledenev.p
 * Date: 30.08.13
 * Time: 9:27
 * To change this template use File | Settings | File Templates.
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE);

include $_SERVER['DOCUMENT_ROOT'] . "/public/prolog.php";

$controller = new IndexController($request);

$controller->process()->view();

include $_SERVER['DOCUMENT_ROOT'] . "/public/epilog.php";