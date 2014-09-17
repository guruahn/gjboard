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