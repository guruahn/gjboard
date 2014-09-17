<?php
/**
 * Template Class
 *
 * @category  Library
 * @package   Template
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class Template {

    protected $variables = array();
    protected $_controller;
    protected $_action;

    function __construct($controller,$action) {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->set("controller", $controller);
        $this->set("action", $action);
    }

    /** Set Variables **/

    function set($name,$value) {
        $this->variables[$name] = $value;
    }

    /** Display Template **/

    function render() {
        extract($this->variables);
        global $is_MANAGER;
        $view_path = "views";
        if( $is_MANAGER ) $view_path = "views".DS."manager";

        if (file_exists(ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . 'header.php')) {
            include (ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . 'header.php');
        } else {
            include (ROOT . DS . 'application' . DS . $view_path . DS . 'header.php');
        }

        if (file_exists(ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . 'topMenu.php')) {
            include (ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . 'topMenu.php');
        } else {
            include (ROOT . DS . 'application' . DS . $view_path . DS . 'topMenu.php');
        }

        include (ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . $this->_action . '.php');

        if (file_exists(ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . 'footer.php')) {
            include (ROOT . DS . 'application' . DS . $view_path . DS . $this->_controller . DS . 'footer.php');
        } else {
            include (ROOT . DS . 'application' . DS . $view_path . DS . 'footer.php');
        }
    }

}