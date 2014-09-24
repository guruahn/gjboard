<?php
/**
 * Shared
 *
 * @category  Library
 * @package   shared
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

/** Check if environment is development and display errors **/
$inflect = new Inflection();

function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors','On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors','Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
    }
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes() {
    if ( get_magic_quotes_gpc() ) {
        $_GET    = stripSlashesDeep($_GET   );
        $_POST   = stripSlashesDeep($_POST  );
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them **/

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function **/

function callHook() {
    global $url;
    global $is_API;
    global $is_MANAGER;
    global $inflect;

    $urlArray = array();
    $urlArray = explode("/",$url);

    $controller = $urlArray[0];

    if($controller === "api"){
        array_shift($urlArray);
        $controller = $urlArray[0];
        $is_API = true;
    }

    if($controller === "manager"){
        array_shift($urlArray);
        $controller = $urlArray[0];
        $is_MANAGER = true;
    }

    array_shift($urlArray);
    $action = $urlArray[0];
    array_shift($urlArray);
    $queryString = $urlArray;

    $controllerName = $controller;
    $controller = ucwords($controller);
    $model = ucfirst($inflect->singularize($controller));
    $controller .= 'Controller';
    $dispatch = new $controller($model,$controllerName,$action);

    if ((int)method_exists($controller, $action)) {
        call_user_func_array(array($dispatch,$action),$queryString);
    } else {
        /* Error Generation Code Here */
    }
}

/** Autoload any classes that are required **/

function __autoload($className) {
    global $is_MANAGER;
    $controller_path = "";
    if( $is_MANAGER ) $controller_path = DS ."manager";

    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . $controller_path . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . $controller_path . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();