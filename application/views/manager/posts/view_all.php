<?php
/**
 * Post list
 *
 * @category  View
 * @package   post
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

?>
</head>
<body>
<div id="wrapper" class="small-11 small-centered panel radius columns">

    <dl class="sub-nav">
        <dt>Filter:</dt>
    <?php

    foreach($categories as $category):
        $obj_category = (object) $category;
        $is_active = "";
        if( $obj_category->id == $filter_category_id ) $is_active = "active";
        ?>
        <dd class="<?php echo $is_active; ?>">
            <a href="<?php echo _BASE_URL_;?>/manager/posts/view_all/category/<?php echo $obj_category->id; ?>"><?php echo text_cut_utf8($obj_category->name, 70); ?></a>
        </dd>
    <?php
    endforeach;
    ?>
    </dl>
    <div class="post_list ">
        <?php
        foreach($posts as $post):
            $obj_post = (object) $post;
            ?>
            <h3>
                <a href="<?php echo _BASE_URL_;?>/manager/posts/view/<?php echo $obj_post->id; ?>"><?php echo text_cut_utf8($obj_post->title, 70); ?></a>
            </h3>
            <p class="button-group radius">
                <span><a href="<?php echo _BASE_URL_;?>/manager/posts/editForm/<?php echo $obj_post->id; ?>" class="button radius secondary tiny">수정</a></span>
                <span><a href="<?php echo _BASE_URL_;?>/manager/posts/del/<?php echo $obj_post->id; ?>" class="button radius secondary tiny">삭제</a></span>
            </p>
        <?php
        endforeach;
        ?>

    </div>
    <p class="button-group radius">
        <span><a href="<?php echo _BASE_URL_;?>/manager/posts/addForm" class="button radius tiny">Add</a></span>
    </p>
</div>