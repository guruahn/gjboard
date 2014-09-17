<?php
/**
 * Header
 *
 * @category  View
 * @package   header
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
?>

<div id="topMenu">
    <a href="<?php echo _BASE_URL_; ?>/users/joinForm">Join</a>
<?php
if( isset($_SESSION['LOGIN_ID']) && !empty($_SESSION['LOGIN_ID']) ){
?>
    <a href="<?php echo _BASE_URL_; ?>/users/logout">logout</a>
<?php
}else{
?>
    <a href="<?php echo _BASE_URL_; ?>/users/loginForm">login</a>
<?php
}
?>
</div>