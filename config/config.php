<?php
/**
 * Configuration Variables
 *
 * @category  Config
 * @package   Config
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

define ('DEVELOPMENT_ENVIRONMENT',true);

define('DB_NAME', 'gjboard');
define('DB_USER', 'gjboard');
define('DB_PASSWORD', 'gjboard');
define('DB_HOST', 'localhost');

define('UPLOAD_PATH',_BASE_URL_."/public/upload");
/*
 * SALT KEY
 * http://online-code-generator.com/generate-salt-random-string.php
 */
define('SALT', "oeA51m|D*szeqhgd2Mx|n5gkinvkeU0emCN9FA=*_jX%aj3at7EdC9%n*Ke5");