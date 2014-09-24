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

<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="<?php echo _BASE_URL_; ?>/manager/site/main">GJboard manager</a></h1>
        </li>

    </ul>

    <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
            <?php
            if( isset($_SESSION['LOGIN_ID']) && !empty($_SESSION['LOGIN_ID']) ){
            ?>
            <li><a href="<?php echo _BASE_URL_; ?>/manager/users/logout">Logout</a></li>
            <?php
            }else{
            ?>
            <li><a href="<?php echo _BASE_URL_; ?>/manager/users/loginForm">Login</a></li>
            <?php
            }
            ?>
        </ul>

        <!-- Left Nav Section -->
        <ul class="left">
            <li class="has-dropdown posts">
                <a href="<?php echo _BASE_URL_; ?>/manager/posts/view_all">Posts</a>
                <ul class="dropdown">
                    <li><a href="<?php echo _BASE_URL_; ?>/manager/posts/view_all">All Posts</a></li>
                    <li><a href="<?php echo _BASE_URL_; ?>/manager/posts/writeform">Add post</a></li>
                </ul>
            </li>
            <li class="categories">
                <a href="<?php echo _BASE_URL_; ?>/manager/categories/view_all">Categories</a>
            </li>
        </ul>
    </section>
</nav>
