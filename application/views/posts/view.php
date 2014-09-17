<?php
/**
 * Post View
 *
 * @category  View
 * @package   post
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
$obj_post = (object) $post;
?>
</head>
<body>
    <div id="wrapper">
        <div id="content">
            <h2><?php echo $obj_post->title?></h2>
            <ul>

                <li>
                    <span>Writer : </span>
                    <span><?php echo $obj_post->user_id; ?></span>
                </li>
                <li>
                    <span>category : </span>
                    <input name="category_id" id="category_id" type="text" size="30" value="<?php echo $obj_post->category_id; ?>" />
                </li>
                <li>
                    <span>content :</span>
                    <div><?php echo $obj_post->content; ?></div>
                </li>
                <li>
                    <span>tags : </span>
                    <span><?php echo $obj_post->tags; ?></span>
                </li>
                <li>
                    <span>is notice :</span>
                    <span><?php echo $obj_post->is_notice; ?></span>
                </li>
                <li>
                    <span>is secret yes</span>
                    <span><?php echo $obj_post->is_secret; ?></span>
                </li>
                <li>
                    <span>modify date</span>
                    <span><?php echo $obj_post->modify_date; ?></span>
                </li>
            </ul>
            <a href="/posts/edit/<?php echo $obj_post->id?>">
                <span>
                edit this post
                </span>
            </a>

            <a href="/posts/delete/<?php echo $obj_post->id?>">
                <span>
                Delete this post
                </span>
            </a>

            <a href="/posts/viewall/">
                <span>
                list post
                </span>
            </a>
        </div>
        <div id="comment">
            <div id="respond" class="comment-respond">
                <h3 id="reply-title" class="comment-reply-title">
                    Reply
                </h3>
                <form action="<?php echo _BASE_URL_;?>/comment/add/<?php echo $obj_post->id; ?>" method="post" id="commentform" class="comment-form">
                    <input id="name" name="name" type="text" placeholder="Name (required)" value="" size="30" aria-required="true">
                    <input id="email" name="email" type="text" placeholder="Email (required)" value="" size="30" aria-required="true">
                    <input id="website" name="website" type="text" placeholder="Website" value="" size="30">
                    <p class="comment-form-comment">
                        <textarea id="content" placeholder="Comment..." name="content" cols="45" rows="8" aria-required="true"></textarea>
                    </p>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit-comment" value="Submit">
                        <input type="hidden" name="post_id" value="<?php echo $obj_post->id?>" id="post_id">
                        <?php
                        if(is_login()) echo '<input type="hidden" name="user_id" id="user_id" value="'.$_SESSION['LOGIN_ID'].'">';
                        ?>

                    </p>
                </form>
            </div>
        </div>
    </div>