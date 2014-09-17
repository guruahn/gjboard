<?php
/**
 * Controller Class
 *
 * @category  Library
 * @package   Controller
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class Controller {

    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;

    function __construct($model, $controller, $action) {

        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;

        $this->$model = new $model;
        $this->_template = new Template($controller,$action);

    }

    function set($name,$value) {
        $this->_template->set($name,$value);
    }

    function __destruct() {
        global $is_API;
        global $is_MANAGER;
        if(!$is_API) $this->_template->render();
        if($is_MANAGER && !is_login() && $this->_action != "loginForm") redirect(_BASE_URL_."/manager/users/loginForm");
    }

}