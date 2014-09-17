<?php
/**
 * Post Edit
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
<!--froala editor style start-->
<link href="<?php echo _BASE_URL_;?>/public/css/froala/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo _BASE_URL_;?>/public/css/froala/froala_editor.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo _BASE_URL_;?>/public/css/froala/froala_reset.min.css" rel="stylesheet" type="text/css">
<!--froala editor style end-->


</head>
<body>

<div id="wrapper">
    <h2><?php echo $title;?></h2>
    <form action="<?php echo _BASE_URL_;?>/posts/updatePost/<?php echo $obj_post->id; ?>" method="post" name="edit_post">
        <input type="hidden" name="ip" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" />
        <ul>
            <li>
                <label for="Title">Title</label>
                <input name="title" id="title" type="text" size="30" value="<?php echo $obj_post->title; ?>" />
            </li>
            <li>
                <label for="user_id">Writer</label>
                <span><?php echo $obj_post->user_id; ?></span>
            </li>
            <li>
                <label for="category_id">category</label>
                <input name="category_id" id="category_id" type="text" size="30" value="<?php echo $obj_post->category_id; ?>" />
            </li>
            <li>
                <label for="content">content</label>
                <textarea name="content" id="content" size="30" >
                    <?php echo $obj_post->content; ?>
                </textarea>
            </li>
            <li>
                <label for="tags">tags</label>
                <input name="tags" id="tags" type="text" size="30" value="<?php echo $obj_post->tags; ?>" />
            </li>
            <li>
                <label for="is_notice_Y">is notice yes</label>
                <input type="radio" name="is_notice" value="Y" id="is_notice_Y" <?php echo ($obj_post->is_notice == "Y" ? "checked" : ""); ?> />
                <label for="is_notice_N">is notice no</label>
                <input type="radio" name="is_notice" value="N" id="is_notice_N" <?php echo ($obj_post->is_notice == "N" ? "checked" : ""); ?> />
            </li>
            <li>
                <label for="is_notice_Y">is secret yes</label>
                <input type="radio" name="is_secret" value="Y" id="is_secret_Y" <?php echo ($obj_post->is_secret == "Y" ? "checked" : ""); ?> />
                <label for="is_notice_N">is secret no</label>
                <input type="radio" name="is_secret" value="N" id="is_secret_N" <?php echo ($obj_post->is_secret == "N" ? "checked" : ""); ?> />
            </li>
            <li>
                <label for="modify_date">modify date</label>
                <input name="modify_date" id="modify_date" type="text" size="30" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            </li>
        </ul>
        <p><input type="submit" value="submit" /> </p>
    </form>
</div>


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

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<!--froala editor js start http://editor.froala.com/-->
<script src="<?php echo _BASE_URL_;?>/public/js/froala/libs/beautify/beautify-html.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/froala_editor.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/froala_editor_ie8.min.js"></script>
<![endif]-->
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/tables.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/colors.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/fonts/fonts.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/fonts/font_family.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/fonts/font_size.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/block_styles.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/video.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/media_manager.min.js"></script>
<script src="<?php echo _BASE_URL_;?>/public/js/froala/langs/ko.js"></script>
<script>
    $(function(){
        $('#content')
            .editable({
                inlineMode: false,
                textNearImage: false,
                language: 'ko',
                height: 300,
                imageUploadURL: "<?php echo _BASE_URL_;?>/api/posts/uploadFile",
                imageUploadParams: {id: "<?php echo $obj_post->id; ?>"},
                imagesLoadURL: "<?php echo _BASE_URL_;?>/api/posts/loadFile/<?php echo $obj_post->id; ?>/<?php echo $obj_post->user_id; ?>",
                imageDeleteURL: "<?php echo _BASE_URL_;?>/api/posts/deleteFile"
            })
            .on('editable.imagesLoaded ', function (e, editor, data) {
                // Set the image source to the image delete params.
                console.log(data);

            });

        $('.f-image-list').on('click','.f-delete-img', function(){
            deleteFile( $(this).parent().find('img').attr('src') );
        });


    });

    function deleteFile(src){
        //console.log(data);
        $.ajax({
            type: "POST",
            url: "<?php echo _BASE_URL_;?>/api/posts/deleteFile/",
            data: {src: src },
            dataType: "json"
        }).success(function( data ) {
                if(data.result); alert('upload success');
        }).fail(function(response){
            //console.log(printr_json(response));
        });
    }

</script>