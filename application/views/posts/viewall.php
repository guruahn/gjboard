<?php
/**
 * Created by PhpStorm.
 * User: gongjam
 * Date: 14. 9. 3
 * Time: 오후 7:19
 */
?>
</head>
<body>
<div id="wrapper">
    <h2><?php echo $title; ?></h2>

    <div class="post_list">
        <?php
        foreach($posts as $post):
            $obj_post = (object) $post;
            ?>
            <h3>
                <a href="<?php echo _BASE_URL_;?>/posts/view/<?php echo $obj_post->id; ?>"><?php echo text_cut_utf8($obj_post->title, 70); ?></a>
            </h3>
            <p>
                <span><a href="<?php echo _BASE_URL_;?>/posts/edit/<?php echo $obj_post->id; ?>">Edit</a></span>
                <span><a href="<?php echo _BASE_URL_;?>/posts/del/<?php echo $obj_post->id; ?>">Delete</span>
            </p>
        <?php
        endforeach;
        ?>

    </div>
    <div><a href="<?php echo _BASE_URL_;?>/posts/writeform" >Write</a></div>
</div>