<?php
/**
 * Model Class
 *
 * @category  Library
 * @package   Model
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class Model extends MysqliDb {
    protected $_model;

    function __construct() {
        global $inflect;

        $this->connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $this->_model = get_class($this);

        $this->_table = strtolower($inflect->pluralize($this->_model));
    }

    function __destruct() {
    }
}